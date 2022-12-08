<?php

use App\Models\Conversation;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('messagerie.{conversation_id}', function ($user, $conversation_id) {
    $conversation = Conversation::find($conversation_id);
    return (int) $conversation->from_id === auth()->user()->id || (int) $conversation->to_id === auth()->user()->id;
    // return true;
});