<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'name',
        'img_url',
        'comment',
    ];

    public function detail() {
        return $this->hasOne(Detail::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function like()
    {
        return $this->hasOne(Like::class)->withDefault();
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function hasCommentFromUser($userId)
    {
        return $this->comments()->where('user_id', $userId)->exists();
    }
}
