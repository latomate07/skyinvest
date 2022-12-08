@if (!isset($conversation))
    <div class="conversationNotFound" style="margin: 0 auto">
        <lottie-player src="https://assets5.lottiefiles.com/packages/lf20_maxj5quq.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop  autoplay></lottie-player>
        <h3 style="text-align: center">Votre conversation s'affichera ici.</h3>    
    </div>
@else
@php
    $receiver = $conversation->receiver;
    // If current user is a conversation receiver, then receiver may be a sender
    if($receiver->id === auth()->user()->id)
    {
        $receiver = $conversation->sender;
    }
@endphp
<div id="chat" class="chat-area">
    <div class="chat-area-header">
        <div class="chat-area-title">Conversation avec {{ ($receiver->role == "Investisseur") ? $receiver->investor_username : $receiver->enterprise_name }}</div>
    </div>
    <input type="hidden" id="messageData"
           value="{{ json_encode(['site_url' => url(), 'user_logo' => auth()->user()->medias?->url ? 'assets/client/logos/'.auth()->user()->medias->url : 'assets/client/logos/default.png', 'message_from' => auth()->user()->id, 'message_to' => $receiver->id, 'conversation_id' => $conversation->id ]) }}">
    <div id="chat-main-area">
        @forelse ($conversation->messages as $conversation_message)
            @php
                /**
                 * Get Message from user
                */
                $message_sender = \App\Models\User::find($conversation_message->from_id);
                $message_receiver = \App\Models\User::find($conversation_message->to_id);

                if($message_sender->id === auth()->user()->id)
                {
                    $message_sender = $message_receiver;
                }
                // dd($message_sender);
            @endphp
            <div class="chat-area-main">
                <div class="chat-msg {{ ($conversation_message->from_id === auth()->user()->id || $message_sender->id === auth()->user()->id) ? "owner" : "" }}">
                    <div class="chat-msg-profile">
                        @if ($conversation_message->from_id === auth()->user()->id)
                            <img id="user-logo" class="chat-msg-img" src="{{ auth()->user()->medias?->url ? asset('assets/client/logos/').'/'. auth()->user()->medias?->url : asset('assets/client/logos/default.png') }}" alt="logo">  
                        @else
                            <img id="user-logo" class="chat-msg-img" src="{{ $message_sender->medias?->url ? asset('assets/client/logos/').'/'. $message_sender->medias?->url : asset('assets/client/logos/default.png') }}" alt="logo">  
                        @endif
                        <div class="chat-msg-date">{{ $conversation_message->is_seen ? "Message vu ".\Carbon\Carbon::parse($conversation_message->updated_at)->format('h:i') : '' }}</div>
                    </div>
                    <div class="chat-msg-content">
                        <div class="chat-msg-text">{{ $conversation_message->message }}</div>
                    </div>
                </div>
            </div>
        @empty
            <div id="informations" style="line-height: 1.8; text-align:center">
                <lottie-player src="https://assets8.lottiefiles.com/packages/lf20_hp09atmh.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px; margin:0 auto;"  loop  autoplay></lottie-player>
                <h3>C'est le début de votre conversation avec {{ ($receiver->role == "Investisseur") ? $receiver->investor_username : $receiver->enterprise_name }}</h3>
                <p>Pour votre sécurité, nous vous invitons à rester sur ce tchat afin qu'on puisse vous aider en cas de litige.</p>
            </div>
        @endforelse
    </div>
    <div class="chat-area-footer">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
            stroke-linecap="round" stroke-linejoin="round" class="feather feather-video">
            <path d="M23 7l-7 5 7 5V7z" />
            <rect x="1" y="5" width="15" height="14" rx="2" ry="2" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
            stroke-linecap="round" stroke-linejoin="round" class="feather feather-image">
            <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
            <circle cx="8.5" cy="8.5" r="1.5" />
            <path d="M21 15l-5-5L5 21" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
            stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip">
            <path
                d="M21.44 11.05l-9.19 9.19a6 6 0 01-8.49-8.49l9.19-9.19a4 4 0 015.66 5.66l-9.2 9.19a2 2 0 01-2.83-2.83l8.49-8.48" />
        </svg>
        <input type="text" id="messageContent" placeholder="Tapez votre message ici..." />
        <svg id="sendMessage" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16"> 
            <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/> 
        </svg>
    </div>
</div>
@endif