<div class="conversation-area">
    <div class="chat-area-header">
        <div class="chat-area-title">Messages</div>
    </div>
    @forelse ($conversations as $conversation)
        @php
            $receiver = $conversation->receiver;
            // If current user is a conversation receiver, then receiver may be a sender
            if($receiver->id === auth()->user()->id)
            {
                $receiver = $conversation->sender;
            }
        @endphp
        <a class="msg online {{ (request()->route()->uid == $conversation->uid) ? "active" : ""}}" href="{{ route('conversations.show', $conversation->uid) }}">
            @if(!is_null($receiver->medias))
                <img class="msg-profile" src="{{ asset('assets/client/logos/' . $receiver->medias->url) }}" alt="logo">
            @else
                <img class="msg-profile" src="{{ asset('assets/client/logos/default.png') }}" alt="logo">
            @endif
            <div class="msg-detail">
                <div class="msg-username">{{ ($receiver?->role == "Investisseur") ? $receiver?->investor_username : $receiver?->enterprise_name }}</div>
                <div class="msg-content">
                    <span class="msg-message">Ceci est un test blablablba</span>
                    <span class="msg-date">{{ \Carbon\Carbon::parse($conversation->updated_at)->diffForHumans() }}</span>
                </div>
            </div>
        </a>
    @empty
        <p style="text-align:center">Aucune conversation trouvée.</p>
    @endforelse
    <div class="overlay"></div>
</div>