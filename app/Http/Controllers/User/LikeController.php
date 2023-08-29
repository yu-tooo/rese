<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function create($id)
    {
        Like::create([
            'user_id' => Auth::guard('users')->id(),
            'restaurant_id' => $id
        ]);

        return back();
    }

    public function delete($id)
    {
        Like::where('user_id', Auth::guard('users')->id())->where('restaurant_id', $id)->delete();

        return back();
    }
}
