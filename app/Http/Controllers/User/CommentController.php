<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Comment;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function show($id)
    {
        $isPreComment = Comment::where('user_id', Auth::guard('users')->id())
                                ->where('restaurant_id', $id)->exists();
        if ($isPreComment) {
            $message = "同一店舗に複数投稿できません";
            $buttonName = "ホームへ";
            $path = "/";
            return view('user.thanks', compact('message', 'buttonName', 'path'));
        }

        $restaurant = Restaurant::find($id);

        if(is_null($restaurant)) {
            $message = "店舗が見つかりませんでした";
            $buttonName = "ホームへ";
            $path = "/";
            return view('user.thanks', compact('message', 'buttonName', 'path'));
        }
        return view('user.comment', compact('restaurant'));
    }

    public function create(CommentRequest $request, $id)
    {
        $image = $request->file('image');
        if ($image) {
            $path = public_path('storage/comments');
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $filename);
            $imagePath = 'comments/' . $filename;
        }

        Comment::create([
            'user_id' => Auth::guard('users')->id(),
            'restaurant_id' => $id,
            'body' => $request->body,
            'rate' => $request->rate,
            'img_url' => $imagePath ?? null
        ]);

        $message = "口コミ投稿、ありがとうございます";
        $buttonName = "マイページへ";
        $path = "/mypage";
        return view('user.thanks', compact('message', 'buttonName', 'path'));
    }

    public function edit($id)
    {
        $comment = Comment::find($id);
        if(is_null($comment) || !$comment->isOwnComment(Auth::guard('users')->id())) {
            $message = "他ユーザの口コミは編集できません";
            $buttonName = "ホームへ";
            $path = "/";
            return view('user.thanks', compact('message', 'buttonName', 'path'));
        }

        return view('user.recomment', compact('comment'));
    }

    public function update(CommentRequest $request, $id)
    {
        $comment = Comment::find($id);
        if (!$comment->isOwnComment(Auth::guard('users')->id())) {
            return redirect(route('user.home'));
        }
        
        $image = $request->file('image');
        if ($image) {
            $path = public_path('storage/comments');
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $filename);
            $imagePath = 'comments/' . $filename;
        } else {
            $imagePath = $comment->img_url;
        }
        
        $comment->update([
            'rate' => $request->rate,
            'body' => $request->body,
            'img_url' => $imagePath
        ]);

        $message = "口コミ編集、ありがとうございます";
        $buttonName = "マイページへ";
        $path = "/mypage";
        return view('user.thanks', compact('message', 'buttonName', 'path'));
    }

    public function delete($id)
    {
        $comment = Comment::where('id', $id)->where('user_id', Auth::guard('users')->id())
                            ->delete();

        if($comment) {
            $message = "口コミは削除されました";
            $buttonName = "マイページへ";
            $path = "/mypage";
            return view('user.thanks', compact('message', 'buttonName', 'path'));
        } else {
            $message = "口コミを削除できませんでした";  
            $buttonName = "ホームへ";
            $path = "/";
            return view('user.thanks', compact('message', 'buttonName', 'path'));
        }   
    }
}
