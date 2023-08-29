<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    public function index(Request $request)
    {
        $query = Restaurant::query();
        $query->where('owner_id', '!=',null);
        
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

        
        return view("user.index", compact('restaurants'));
    }

    public function detail($id)
    {
        $restaurant = Restaurant::find($id);
        if(is_null($restaurant) || is_null($restaurant->owner_id)) {
            $message = "店舗が見つかりません";
            $buttonName = "ホームへ";
            $path = "/";
            return view('user.thanks', compact('message', 'buttonName', 'path'));
        }
        $hasCommented = $restaurant->hasCommentFromUser(Auth::guard('users')->id());
        return view("user.detail", compact('restaurant', 'hasCommented'));
    }

    public function reserve(ReservationRequest $request, $id)
    {
        Reservation::create([
            "user_id" => Auth::guard('users')->id(),
            "restaurant_id" => $id,
            "date" => $request->date,
            "time" => $request->time,
            "number" => $request->number
        ]);

        $message = "ご予約ありがとうございます";
        $buttonName = "戻る";
        $path = "/mypage";
        return view('user.thanks', compact('message', 'buttonName', 'path'));
    }

    public function change($id)
    {
        $reservation = Reservation::find($id);
        return view('user.update', compact('reservation'));
    }

    public function update(ReservationRequest $request, $id)
    {
        Reservation::where('id', $id)->update([
            "date" => $request->date,
            "time" => $request->time,
            "number" => $request->number
        ]);

        return redirect(route('user.mypage'));
    }
}
