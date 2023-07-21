<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function comment(Request $request)
    {
        $comment = new Comment;
        $comment->user_id = Auth::user()->id;
        $comment->suggestion_id = $request->suggestion_id;
        $comment->content = $request->content;

        $comment->save();

        return redirect()->route('suggestion.show', ['id' => $request->suggestion_id]);

    }
}
