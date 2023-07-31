<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Like;
use App\Models\User;
use App\Models\Suggestion;
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

    public function like(Request $request)
    {
        $user = Auth::user();
        $suggestionId = $request->suggestion_id;

        // Check if the user has already liked the suggestion
        $existingLike = Like::where('user_id', $user->id)->where('suggestion_id', $suggestionId)->first();

        if ($existingLike) {
            // If the user has already liked the suggestion, remove the like (dislike)
            $existingLike->delete();
        } else {
            // If the user has not liked the suggestion yet, create a new like
            $like = new Like;
            $like->user_id = $user->id;
            $like->suggestion_id = $suggestionId;
            $like->save();
        }

        return redirect()->route('homepage');
    }
}
