<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Suggestion;
use App\Models\Notification;
use App\Models\User;

class NotificationController extends Controller
{
    public function notifsuccess($id)
    {
        // Find the suggestion by its ID
        $suggestion = Suggestion::findOrFail($id);

        // Check if the suggestion status is already "solved"
        if ($suggestion->status === 2) {
            return redirect()->route('suggestion.show', ['id' => $id])->with('warning', 'The suggestion is already marked as solved!');
        }

        // Update the suggestion status to "solved"
        $suggestion->status = 2;
        $suggestion->save();

        // Notify the user about the status change
        $user = User::find($suggestion->user_id);

        // Get additional data for the notification title
        $additionalInfo = 'Additional Information'; // Replace this with your logic to fetch additional information

        $notificationTitle = 'Suggestion Solved - ' . $additionalInfo;
        $notificationBody = 'Your suggestion has been solved. Thank you for your contribution!';
        $notif = new Notification();
        $notif->title = $notificationTitle;
        $notif->body = $notificationBody;
        $notif->suggestion_id = $id;
        $notif->user_id = $suggestion->user_id;
        $notif->save();

        return redirect()->route('suggestion.show', ['id' => $id])->with('success', 'Suggestion marked as solved!');
    }

    public function notiffailed($id)
    {
        // Find the suggestion by its ID
        $suggestion = Suggestion::findOrFail($id);

        // Check if the suggestion status is already "solved"
        if ($suggestion->status === 2) {
            return redirect()->route('suggestion.show', ['id' => $id])->with('warning', 'The suggestion is already marked as solved!');
        }

        // Update the suggestion status to "solved"
        $suggestion->status = 2;
        $suggestion->save();

        // Notify the user about the status change
        $user = User::find($suggestion->user_id);

        // Get additional data for the notification title
        $additionalInfo = 'Additional Information'; // Replace this with your logic to fetch additional information

        $notificationTitle = 'Suggestion Failed to solve - ' . $additionalInfo;
        $notificationBody = 'Your suggestion cannot be solved.';
        $notif = new Notification();
        $notif->title = $notificationTitle;
        $notif->body = $notificationBody;
        $notif->suggestion_id = $id;
        $notif->user_id = $suggestion->user_id;
        $notif->save();

        return redirect()->route('suggestion.show', ['id' => $id])->with('success', 'Suggestion marked as solved!');
    }
    

    public function notification()
    {
        $content = DB::table('notifications')->get();

        return view('suggestion.userNotification', [
            'content' => $content,
        ]);
    }
}
