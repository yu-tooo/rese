<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'restaurant_id'
    ];

    public function isExist($user_id = 0)
    {
        return $this->where('user_id', $user_id)->where('restaurant_id', $this->restaurant_id)->exists();
    }
}
