<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'suggestion_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likesCount()
    {
        return $this->likes()->count();
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'suggestion_id');
    }
}
