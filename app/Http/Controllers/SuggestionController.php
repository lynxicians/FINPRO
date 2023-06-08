<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuggestionController extends Controller
{
    public function index(){
        return view('suggestion.suggestion');
    }
    
}
