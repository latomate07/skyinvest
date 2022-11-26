<?php

namespace App\Http\Controllers\Conversations;
use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ConversationMessage;

class ConversationController extends Controller
{
    /**
     * Get conversations page
     */
    public function index(Request $request)
    {
        $conversations = Conversation::getAllConversations()->get();

        return view('client.livechat.index', [
            'conversations' => $conversations
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
        $conversations = Conversation::getAllConversations()->get();

        return view('client.livechat.index', [
            'conversation' => $conversation,
            'conversations' => $conversations
        ]);
    }
}
