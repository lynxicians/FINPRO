<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suggestion;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class SuggestionController extends Controller
{
    public function index()
    {
        return view('suggestion.suggestion');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'content' => 'required|string',
        ]);

        $suggestion = new Suggestion();
        $suggestion->title = $request->input('title');
        $suggestion->description = $request->input('description');
        $suggestion->content = $request->input('content');
        $suggestion->user_id = auth()->user()->id; // Assuming you have authentication set up

        $suggestion->save();

        return redirect()->back()->with('success', 'Suggestion created successfully.');
    }
    
    public function SuggestionShow($id)
    {
        $content = DB::table('suggestions')
        ->select('id', 'title', 'description', 'content', 'created_at')
        ->where('id', '=', $id)
        ->get();
        
        $comments = Comment::where('suggestion_id', $id)->get();
        
        return view('suggestion.show', [
            'content' => $content,
            'comments' => $comments,
        ]);
    }
}

