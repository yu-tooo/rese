<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'restaurant_id',
        'body',
        'rate',
        'img_url'
    ];

    public function isOwnComment($user_id = 0)
    {
        return $this->user_id == $user_id;
    }
}
