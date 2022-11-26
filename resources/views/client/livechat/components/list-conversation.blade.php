<div class="conversation-area">
    <div class="chat-area-header">
        <div class="chat-area-title">Messages</div>
    </div>
    @forelse ($conversations as $conversation)
        <div class="msg online">
            @if($medias !== null)
                <img class="msg-profile" src="{{ asset('assets/client/logos/' . $medias->url) }}" alt="" />
            @else
                <img class="msg-profile" src="{{ asset('assets/client/logos/default.png') }}" alt="" />
            @endif
            <a class="msg-detail" href="{{ route('conversations.show', $conversation->uid) }}">
                <div class="msg-username">{{ $conversation->receiver->name }}</div>
                <div class="msg-content">
                    <span class="msg-message">What time was our meet</span>
                    <span class="msg-date">{{ \Carbon\Carbon::parse($conversation->updated_at)->diffForHumans() }}</span>
                </div>
            </a>
        </div>
    @empty
        <p style="text-align:center">Aucune conversation trouvée.</p>
    @endforelse
    <div class="overlay"></div>
</div>