<div class="detail-area">
    @php
        $receiver = $conversation->receiver;
        // If current user is a conversation receiver, then receiver may be a sender
        if($receiver->id === auth()->user()->id)
        {
            $receiver = $conversation->sender;
        }
    @endphp
    <div class="detail-area-header">
       @if(!is_null($receiver->medias))
            <img class="msg-profile group" src="{{ asset('assets/client/logos/' . $receiver->medias->url) }}" alt="logo">
        @else
            <img class="msg-profile group" src="{{ asset('assets/client/logos/default.png') }}" alt="logo">
        @endif
        <div class="detail-title">{{ ($receiver->role == "Investisseur") ? $receiver->investor_username : $receiver->enterprise_name }}</div>
        <div class="detail-subtitle">Rejoint {{ \Carbon\Carbon::parse($receiver->created_at)->diffForHumans() }}</div>
        <div class="detail-buttons">
            <button class="detail-button">
                <svg viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="currentColor" stroke="currentColor"
                    stroke-width="0" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone">
                    <path
                        d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z" />
                </svg>
                Appel
            </button>
            <button class="detail-button">
                <svg viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="currentColor" stroke="currentColor"
                    stroke-width="0" stroke-linecap="round" stroke-linejoin="round" class="feather feather-video">
                    <path d="M23 7l-7 5 7 5V7z" />
                    <rect x="1" y="5" width="15" height="14" rx="2" ry="2" />
                </svg>
                Appel vidéo
            </button>
        </div>
    </div>
    <div class="detail-changes">
        <div class="detail-change">
            Changer de couleur
            <div class="colors">
                <div class="color blue selected" data-color="blue"></div>
                <div class="color purple" data-color="purple"></div>
                <div class="color green" data-color="green"></div>
                <div class="color orange" data-color="orange"></div>
            </div>
        </div>
    </div>
</div>