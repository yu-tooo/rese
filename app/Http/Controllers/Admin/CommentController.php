<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentController extends Controller
{
    public function delete($id)
    {
        $comment = Comment::where('id', $id)->first();

        if ($comment) {
            $restaurantId = $comment->restaurant_id;
            $comment->delete();
            return redirect(route('admin.detail', ['id' =>$restaurantId]));
        } else {
            $message = "口コミを削除できませんでした";
            $buttonName = "ホームへ";
            $path = "/admin";
            return view('warning', compact('message', 'buttonName', 'path'));
        }
    }
}
