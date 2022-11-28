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
<div class="chat-area">
    <div class="chat-area-header">
        <div class="chat-area-title">Conversation avec {{ ($receiver->role == "Investisseur") ? $receiver->investor_username : $receiver->enterprise_name }}</div>
    </div>
    <div class="chat-area-main">
        <div class="chat-msg">
            <div class="chat-msg-profile">
                <img class="chat-msg-img"
                    src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%283%29+%281%29.png" alt="" />
                <div class="chat-msg-date">Message vu 1.22pm</div>
            </div>
            <div class="chat-msg-content">
                <div class="chat-msg-text">Luctus et ultrices posuere cubilia curae.</div>
                <div class="chat-msg-text">
                    <img
                        src="https://media0.giphy.com/media/yYSSBtDgbbRzq/giphy.gif?cid=ecf05e47344fb5d835f832a976d1007c241548cc4eea4e7e&rid=giphy.gif" />
                </div>
                <div class="chat-msg-text">Neque gravida in fermentum et sollicitudin ac orci phasellus egestas. Pretium
                    lectus quam id leo.</div>
            </div>
        </div>
        <div class="chat-msg owner">
            <div class="chat-msg-profile">
                <img class="chat-msg-img"
                    src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%281%29.png" alt="" />
                <div class="chat-msg-date">Message vu 1.22pm</div>
            </div>
            <div class="chat-msg-content">
                <div class="chat-msg-text">Sit amet risus nullam eget felis eget. Dolor sed viverra ipsum😂😂😂</div>
                <div class="chat-msg-text">Cras mollis nec arcu malesuada tincidunt.</div>
            </div>
        </div>
        <div class="chat-msg">
            <div class="chat-msg-profile">
                <img class="chat-msg-img"
                    src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%282%29.png" alt="">
                <div class="chat-msg-date">Message vu 2.45pm</div>
            </div>
            <div class="chat-msg-content">
                <div class="chat-msg-text">Aenean tristique maximus tortor non tincidunt. Vestibulum ante ipsum primis
                    in faucibus orci luctus et ultrices posuere cubilia curae😊</div>
                <div class="chat-msg-text">Ut faucibus pulvinar elementum integer enim neque volutpat.</div>
            </div>
        </div>
        <div class="chat-msg owner">
            <div class="chat-msg-profile">
                <img class="chat-msg-img"
                    src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%281%29.png" alt="" />
                <div class="chat-msg-date">Message vu 2.50pm</div>
            </div>
            <div class="chat-msg-content">
                <div class="chat-msg-text">posuere eget augue sodales, aliquet posuere eros.</div>
                <div class="chat-msg-text">Cras mollis nec arcu malesuada tincidunt.</div>
            </div>
        </div>
        <div class="chat-msg">
            <div class="chat-msg-profile">
                <img class="chat-msg-img"
                    src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%2812%29.png" alt="" />
                <div class="chat-msg-date">Message vu 3.16pm</div>
            </div>
            <div class="chat-msg-content">
                <div class="chat-msg-text">Egestas tellus rutrum tellus pellentesque</div>
            </div>
        </div>
        <div class="chat-msg">
            <div class="chat-msg-profile">
                <img class="chat-msg-img"
                    src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%283%29+%281%29.png" alt=""
                    class="account-profile" alt="">
                <div class="chat-msg-date">Message vu 3.16pm</div>
            </div>
            <div class="chat-msg-content">
                <div class="chat-msg-text">Consectetur adipiscing elit pellentesque habitant morbi tristique senectus
                    et.</div>
            </div>
        </div>
        <div class="chat-msg owner">
            <div class="chat-msg-profile">
                <img class="chat-msg-img"
                    src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%281%29.png" alt="" />
                <div class="chat-msg-date">Message vu 2.50pm</div>
            </div>
            <div class="chat-msg-content">
                <div class="chat-msg-text">Tincidunt arcu non sodales😂</div>
            </div>
        </div>
        <div class="chat-msg">
            <div class="chat-msg-profile">
                <img class="chat-msg-img"
                    src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%282%29.png" alt="">
                <div class="chat-msg-date">Message vu 3.16pm</div>
            </div>
            <div class="chat-msg-content">
                <div class="chat-msg-text">Consectetur adipiscing elit pellentesque habitant morbi tristique senectus
                    et🥰</div>
            </div>
        </div>
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
        <input type="text" placeholder="Tapez votre message ici..." />
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16"> 
            <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/> 
        </svg>
    </div>
</div>
@endif