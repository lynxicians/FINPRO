<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suggestion;
use App\Models\Notification;
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
            'title' => 'required|string|unique:suggestions',
            'description' => 'required|string',
            'content' => 'required|string',
            'front_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Add validation rules for the image
        ]);

        $suggestion = new Suggestion();
        $suggestion->title = $request->input('title');
        $suggestion->description = $request->input('description');
        $suggestion->content = $request->input('content');
        $suggestion->user_id = auth()->user()->id;
        $suggestion->status = 1;

        $image = $request->file('front_image');

        if ($image) {
            $imageContents = file_get_contents($image->getRealPath());
            $base64Encoded = base64_encode($imageContents);

            $suggestion->picture = $base64Encoded;
            Session::flash('success', 'Suggestion created successfully.');
        }

        $suggestion->save();

        $notif = new Notification();
        $notif->title = 'new Suggestion! || ' . $request->input('title');
        $notif->body = 'User had been added new Suggestion';
        $notif->suggestion_id = $suggestion->id;
        $notif->user_id = auth()->user()->id;
        $notif->addressed = 2;
        $notif->save();
        return redirect()->route('suggestion.SuggestionManagementSystem');
    }

    
    public function SuggestionShow($id)
    {
        $content = DB::table('suggestions')
        ->select('id', 'title', 'description', 'content', 'created_at', 'picture')
        ->where('id', '=', $id)
        ->get();
        
        $comments = Comment::where('suggestion_id', $id)
        ->orderByRaw('user_id = 4 desc')
        ->orderBy('created_at', 'desc')
        ->get();

        $status = DB::table('suggestions')
        ->select('status')
        ->where('id', '=', $id)
        ->get();

        return view('suggestion.show', [
            'content' => $content,
            'comments' => $comments,
            'status' => $status,
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