<div class="conversation-area">
    <div class="chat-area-header">
        <div class="chat-area-title">Messages</div>
    </div>
    @forelse ($conversations as $conversation)
        <div class="msg online">
            @if(!is_null($conversation->receiver->medias))
                <img class="msg-profile" src="{{ asset('assets/client/logos/' . $conversation->receiver->medias->url) }}" alt="logo">
            @else
                <img class="msg-profile" src="{{ asset('assets/client/logos/default.png') }}" alt="logo">
            @endif
            <a class="msg-detail" href="{{ route('conversations.show', $conversation->uid) }}">
                <div class="msg-username">{{ ($conversation->receiver->role == "Investisseur") ? $conversation->receiver->investor_username : $conversation->receiver->enterprise_name }}</div>
                <div class="msg-content">
                    <span class="msg-message">Ceci est un test blablablba</span>
                    <span class="msg-date">{{ \Carbon\Carbon::parse($conversation->updated_at)->diffForHumans() }}</span>
                </div>
            </a>
        </div>
    @empty
        <p style="text-align:center">Aucune conversation trouvée.</p>
    @endforelse
    <div class="overlay"></div>
</div>