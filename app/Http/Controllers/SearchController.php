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
        $sortedBlogTitles = Suggestion::orderBy('title')->pluck('title')->toArray();

        $targetTitle = $request->input('title');

        // Perform binary search to find the index of the target blog title.
        $index = $this->binarySearch($sortedBlogTitles, $targetTitle);

        if ($index !== -1) {
            // Blog found! You can now retrieve the blog record from the database.
            $foundBlog = Suggestion::where('title', $sortedBlogTitles[$index])->first();

            return response()->json([
                'status' => 'success',
                'data' => $foundBlog,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Blog not found.',
            ], 404);
        }
    }

    private function binarySearch(array $arr, $target)
    {
        $low = 0;
        $high = count($arr) - 1;

        while ($low <= $high) {
            $mid = (int)(($low + $high) / 2);

            if ($arr[$mid] === $target) {
                return $mid;
            } elseif ($arr[$mid] < $target) {
                $low = $mid + 1;
            } else {
                $high = $mid - 1;
            }
        }

        return -1; // Target not found.
    }
}
