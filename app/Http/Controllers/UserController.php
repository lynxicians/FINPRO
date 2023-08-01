<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suggestion;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function UserUpdate(Request $request, $id)
    {
        $suggestion = Suggestion::find($id);
        $user = auth()->user();
    
        $suggestion->name = $request->nickname;
        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $extension = $file->extension();
            $filename = $user->name . time() . '.' . $extension;
            
            // Check if the file already exists and delete it
            if (file_exists(public_path($suggestion->image))) {
                unlink(public_path($suggestion->image));
            }
            
            // Store the new file
            $file->move(public_path('uploads/images'), $filename);
            $suggestion->image = 'uploads/images/' . $filename;
        }
        $suggestion->save(); // Corrected: use $suggestion instead of $blog
    }    
}
