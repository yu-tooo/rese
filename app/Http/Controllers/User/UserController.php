<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show()
    {
        $user = Auth::guard('users')->user();
        $user_id = Auth::guard('users')->id();
        $restaurants = Restaurant::whereHas('likes', function($q) use($user_id) {
            $q->where('user_id', $user_id);
        })->get();

        return view("user.mypage", compact('user', 'restaurants'));
    }

    public function delete(Request $request)
    {
        Reservation::where('id', $request->id)->delete();
        return redirect(route('user.mypage'));
    }
}
