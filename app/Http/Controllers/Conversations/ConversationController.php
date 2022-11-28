<?php

namespace App\Http\Controllers\Conversations;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Models\ConversationMessage;
use App\Http\Controllers\Controller;

class ConversationController extends Controller
{
    /**
     * Get conversations page
     */
    public function index(Request $request)
    {
        $conversations = Conversation::with('receiver', 'sender')
                                    ->AllConversations()
                                    ->get();

        return view('client.livechat.index', [
            'conversations'                 => $conversations,
        ]);
    }

    /**
     * Show conversation page with user
     * 
     * Parameter unique id
     */
    public function show($uid, Request $request)
    {
        $conversation = Conversation::getConversation($uid);
        $conversations = Conversation::with('receiver', 'sender')
                                     ->AllConversations()
                                     ->get();

        return view('client.livechat.index', [
            'conversation' => $conversation,
            'conversations' => $conversations
        ]);
    }

    /**
     * Create conversation or show conversation if already exist
     */
    public function create($receiver_id, Request $request)
    {
        // Get sender data
        $sender = User::find(auth()->user()->id);
        // Get receiver data
        $receiver = User::find($receiver_id);

        // Don't continue if user doesn't exist
        if (!$receiver->exists()) {
            return redirect('/')->withErrors('Oups ! L\'utilisateur n\'existe pas.');
        }

        // Don't continue if sender is receiver
        if ($receiver->id === $sender->id) {
            return redirect('/')->withErrors('Oups ! Vous ne pouvez pas envoyer un message à vous même.');
        }

        // Check if conversation exist between these 2 users
        $conversation = Conversation::where([
            'from_id' => $sender->id,
            'to_id'   => $receiver->id
        ])
            ->first();

        // If conversation does'nt exists, then create one
        if (!$conversation) {
            $newConversation = Conversation::create([
                'uid' => Str::random(20),
                'from_id' => auth()->user()->id,
                'to_id' => $receiver->id,
                'status' => 'active'
            ]);
        }

        return redirect(route('conversations.show', $conversation->uid ?? $newConversation->uid));
    }
}
