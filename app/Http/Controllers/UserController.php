<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suggestion;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function userUpdate(Request $request)
    {
        $user = auth()->user(); // Use $user instead of $users
        $user->name = $request->nickname; // Use $user instead of $suggestion

        if ($request->hasFile('images')) {
            $image = $request->file('images'); // Correct variable name
            $imageContents = file_get_contents($image->getRealPath()); // Correct variable name
            $base64Encoded = base64_encode($imageContents);

            $user->picture = $base64Encoded;
        }

        $user->save(); // Save the updated user data

        Session::flash('success', 'Profile updated successfully.');

        if(auth()->user()->role_id == '2')
        {
            return redirect()->route('admin.index');
        }
        else {
            return redirect()->route('suggestion.SuggestionManagementSystem');
        }
    } 
}
