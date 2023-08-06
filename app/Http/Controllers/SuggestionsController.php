<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suggestion;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;

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
        $suggestion->status = 1; // Assuming you have authentication set up

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

    public function getUsersData(Request $request)
    {
        $users = Auth::user();
        $sugg = Suggestion::where('user_id', $users->id)->orderBy('created_at', 'desc');

        return DataTables::of($sugg)
            ->editColumn('action', function ($sugg) {
                return
                '<form action="' . route('suggestion.delete', ['id' => $sugg->id]) . '" method="POST" style="display:inline">'
                . csrf_field()
                . method_field('DELETE')
                . '<button type="submit" class="btn btn-danger custom-edit">Delete</button>'
                . '</form>'
                . '<a class="btn btn-info custom-edit" style="color: black;" href="' . route('suggestion.show', ['id' => $sugg->id]) . '">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
 
    public function SuggestionManagementSystem()
    {
        return view('suggestion.userManagement');
    }

    public function suggestionEdit()
    {
        return view('suggestion.show');
    }

    public function suggestionDelete($id)
    {
        $suggestion = Suggestion::find($id); 
        $suggestion->delete(); 

        return redirect()->route('suggestion.SuggestionManagementSystem');
    }

}

