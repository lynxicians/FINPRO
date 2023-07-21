<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomepageController extends Controller
{
    public function index()
{
    $content = DB::table('suggestions')->select('id', 'title', 'description', 'content', 'created_at')->get();
    $wordLimit = 100;

    // Add a new 'first_paragraph' property to each content item with the first <p> tag
    foreach ($content as $item) {
        $firstParagraph = $this->extractFirstParagraph($item->content);
        $item->first_paragraph = $firstParagraph;
    }

    return view('homepage.index', [
        'content' => $content,
    ]);
}

private function extractFirstParagraph($html)
{
    $pattern = "/<p>(.*?)<\/p>/i";
    preg_match($pattern, $html, $matches);

    if (isset($matches[0])) {
        return $matches[0];
    }

    return '';
}
}
