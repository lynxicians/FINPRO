<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class LoginController extends Controller
{
    public function index(){
        return view('login.login');
    }
    
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            $roleId = $user->role_id;

            if ($roleId === 2) {
                return redirect()->intended(route('admin.index'));

            } else {
                // Handle other roles or show a different view for non-admin users
                return redirect()->intended(route('homepage'));
            }
        }
        
 
        return back()->withInput()->withErrors([
            'password' => 'The provided credentials do not match our records',
        ])->onlyInput('email');
    }
    
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
