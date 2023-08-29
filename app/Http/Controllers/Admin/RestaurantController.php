<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Http\Requests\RestaurantRequest;
use App\Http\Requests\CreateRestaurantRequest;
use App\Models\Detail;
use App\Models\Owner;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    protected $buttonName = "ホームへ";
    protected $path = "/admin";

    public function index(Request $request)
    {
        $query = Restaurant::query();

        if (!empty($request->area)) {
            $query->whereHas('detail', function ($q) use ($request) {
                $q->where('area', $request->area);
            });
        }

        if (!empty($request->genre)) {
            $query->whereHas('detail', function ($q) use ($request) {
                $q->where('genre', $request->genre);
            });
        }

        if (!empty($request->name)) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        if ($request->sort == "random") {
            $restaurants = $query->inRandomOrder()->get();
        } else if ($request->sort == "high") {
            $restaurants = $query->withAvg('comments', 'rate')
            ->orderBy('comments_avg_rate', 'desc')
            ->get();
        } else if ($request->sort == "low") {
            $restaurants = $query->withAvg('comments', 'rate')
            ->withCount('comments')
            ->orderByRaw('comments_count = 0, comments_avg_rate')
            ->orderBy('comments_avg_rate', 'asc')
            ->get();
        } else {
            $restaurants = $query->get();
        }


        return view("admin.index", compact('restaurants'));
    }

    public function detail($id)
    {
        $restaurant = Restaurant::where('id', $id)->first();
        if (is_null($restaurant)) {
            $message = "店舗が見つかりません";
            $buttonName = $this->buttonName;
            $path = $this->path;
            return view('warning', compact('message', 'buttonName', 'path'));
        }

        $owners = Owner::all();

        return view('admin.detail', compact('restaurant', 'owners'));
    }

    public function update(RestaurantRequest $request, $id)
    {
        $restaurant = Restaurant::find($id);
        if (is_null($restaurant)) {
            $message = "店舗が見つかりません";
            $buttonName = $this->buttonName;
            $path = $this->path;
            return view('warning', compact('message', 'buttonName', 'path'));
        }

        $image = $request->file('image');
        if ($image) {
            $path = public_path('storage/restaurants');
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $filename);
            $imagePath = 'restaurants/' . $filename;
        } else {
            $imagePath = $restaurant->img_url;
        }

        $restaurant->update([
            'name' => $request->name,
            'img_url' => $imagePath,
            'comment' => $request->comment,
            'owner_id' => $request->owner_id
        ]);

        $owners = Owner::all();

        return view('admin.detail', compact('restaurant', 'owners'));
    }

    public function create(CreateRestaurantRequest $request)
    {
        $csvFile = $request->file('csv_file');
        $csvData = array_map('str_getcsv', file($csvFile));
        $row = $csvData[0];

        $validationResult = $this->validateRow($row);

        if ($validationResult !== null) {
            return $validationResult;
        }

        $restaurant = Restaurant::create([
            'name' => $row[0],
            'comment' => $row[3],
            'img_url' => "restaurants/" . $row[4]
        ]);

        Detail::create([
            'restaurant_id' => $restaurant->id,
            'area' => $row[1],
            'genre' => $row[2]
        ]);

        return redirect(route('admin.detail', ['id' => $restaurant->id]));
    }

    private function validateRow($row)
    {
        $area = ['東京', '大阪', '福岡'];
        $genre = ['寿司', '焼肉', '居酒屋', 'イタリアン', 'ラーメン'];

        if (empty($row)) {
            return view('warning', $this->getWarningData('送信ファイルに誤りがあります'));
        }

        if (empty($row[0]) || mb_strlen($row[0]) > 50) {
            return view('warning', $this->getWarningData('店舗名に誤りがあります'));
        }

        if (empty($row[1]) || !in_array($row[1], $area)) {
            return view('warning', $this->getWarningData('エリア名に誤りがあります'));
        }

        if (empty($row[2]) || !in_array($row[2], $genre)) {
            return view('warning', $this->getWarningData('ジャンル名に誤りがあります'));
        }

        if (empty($row[3]) || mb_strlen($row[3]) > 400) {
            return view('warning', $this->getWarningData('店舗概要に誤りがあります'));
        }

        if (empty($row[4]) || !(substr($row[4], -5) === '.jpeg' || substr($row[4], -4) === '.png')) {
            return view('warning', $this->getWarningData('画像URLに誤りがあります'));
        }

        return null;
    }

    private function getWarningData($message)
    {
        return [
            'message' => $message,
            'buttonName' => $this->buttonName,
            'path' => $this->path
        ];
    }
}
