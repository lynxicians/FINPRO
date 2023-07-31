<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    
    // Define the table associated with the model (optional if the table name follows the convention)
    protected $table = 'comments';

    // Define the fillable attributes (columns) of the table
    protected $fillable = ['user_id', 'post_id', 'content'];

    // Define relationships with other models
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
