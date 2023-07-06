<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function index(){
        return view('register.register');
    }
    
    public function register(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => ['required', 'min: 3', 'max: 255', 'unique:users'],
            'student_id' => ['required', 'min: 3', 'max: 255', 'unique:users'],
            'password' => 'required|min:8|max:255',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);
        $validatedData['role_id'] = 1;
        
        session()->flash('success', 'Your account has been created successfully.');

        $successMessage = session('success');

        return redirect(route('login'))->with('success', $successMessage);
    }
}
