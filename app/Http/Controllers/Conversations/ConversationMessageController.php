<?php

namespace App\Http\Controllers\Conversations;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ConversationMessage;
use App\Http\Controllers\Controller;
use App\Events\ConversationMessageEvent;
use App\Models\Conversation;

class ConversationMessageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        // Get conversation
        $conversation = Conversation::find($request->messageData['conversation_id']);
        // Check if user is authorized
        if ($conversation->from_id === auth()->user()->id || $conversation->to_id === auth()->user()->id) {
            // Store message
            $message = ConversationMessage::create([
                'uid' => Str::random(20),
                'message' => $request->message,
                'conversation_id' => $conversation->id,
                'from_id' => $request->messageData['message_from'],
                'to_id' => $request->messageData['message_to'],
                'is_seen' => 0
            ]);

            // If message is stored
            if ($message) {
                // Send Message
                ConversationMessageEvent::dispatch($request->logo, $request->message, $request->messageData);
            }

            return response()->json([
                'success' => 'message sent.'
            ]);
        }

        return response()->json([
            'error' => "Vous n'êtes pas autorisé à envoyer de message dans cette conversation."
        ]);
    }
}