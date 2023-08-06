<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $content = DB::table('suggestions')
        ->select('id', 'title', 'description', 'content', 'created_at')
        ->where('status', '=', 1)
        ->get();

        return view('admin.index', [
            'content' => $content
        ]);
    }
}