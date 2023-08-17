<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Suggestion;
use App\Models\Notification;
use App\Models\User;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // Assuming you have a sorted list of blog titles in the database.
        $content = Suggestion::leftJoin('likes', 'suggestions.id', '=', 'likes.suggestion_id')
        ->select('suggestions.id', 'suggestions.title', 'suggestions.description', 'suggestions.content', 'suggestions.created_at', DB::raw('COUNT(likes.id) AS likes_count'))
        ->groupBy('suggestions.id', 'suggestions.title', 'suggestions.description', 'suggestions.content', 'suggestions.created_at')
        ->orderBy('suggestions.title')
        ->get();

        foreach ($content as $item) {
            $firstParagraph = $this->extractFirstParagraph($item->content);
            $item->first_paragraph = $firstParagraph;
        }

        $sortedBlogTitles = Suggestion::orderBy('title')->pluck('title')->toArray();

        $targetTitle = $request->input('title');
        $keyword = $request->input('title'); // Using 'title' input for the keyword as well
        if (!$request->filled('title')) {
            return redirect()->route('homepage');
        }
        // Perform binary search to find the index of the target blog title.
        $index = $this->binarySearchCaseInsensitive($sortedBlogTitles, $targetTitle);

        $matchingSuggestions = [];

        if ($index !== -1) {
            // Blog found! You can now retrieve the blog record from the database.
            $foundBlog = $content->where('title', $sortedBlogTitles[$index])->first();
            // Search for suggestions containing the keyword
            if ($keyword) {
                $matchingSuggestions = Suggestion::where('title', 'like', "%$keyword%")->get();
            }

            // Remove the foundBlog from matchingSuggestions
            $matchingSuggestions = $matchingSuggestions->reject(function ($suggestion) use ($foundBlog) {
                return strtolower($suggestion->title) === strtolower($foundBlog->title);
            });

            return view('homepage.index', [
                'foundBlog' => $foundBlog,
                'matchingSuggestions' => $matchingSuggestions,
            ]);

        } else {
            // If no exact match found, search for similar titles
            $matchingSuggestions = Suggestion::where('title', 'like', "%$keyword%")
            ->leftJoin('likes', 'suggestions.id', '=', 'likes.suggestion_id')
            ->select('suggestions.id', 'suggestions.title', 'suggestions.description', 'suggestions.content', 'suggestions.created_at', DB::raw('COUNT(likes.id) AS likes_count'))
            ->groupBy('suggestions.id', 'suggestions.title', 'suggestions.description', 'suggestions.content', 'suggestions.created_at')
            ->orderBy('suggestions.title')
            ->get();

            foreach ($matchingSuggestions as $item) {
                $firstParagraph = $this->extractFirstParagraph($item->content);
                $item->first_paragraph = $firstParagraph;
            }

            if ($matchingSuggestions->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Blog not found.',
                ], 404);
            }
            return view('homepage.index', [
                'matchingSuggestions' => $matchingSuggestions,
                'keyword' => $keyword
            ]);
        }
    }

    private function binarySearchCaseInsensitive(array $arr, $target)
    {
        $low = 0;
        $high = count($arr) - 1;

        while ($low <= $high) {
            $mid = (int)(($low + $high) / 2);

            if (strcasecmp($arr[$mid], $target) === 0) {
                return $mid;
            } elseif (strcasecmp($arr[$mid], $target) < 0) {
                $low = $mid + 1;
            } else {
                $high = $mid - 1;
            }
        }

        return -1; // Target not found.
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
