<div class="logo">
    <h3 style="display: flex; align-items:center"><a href="{{ route('home') }}"><i class="fa fa-arrow-left" style="margin-right: 3px"></i>SkyInvest</a></h3>
</div>
<div class="search-bar">
    <input type="text" placeholder="Rechercher..." />
</div>
<div class="user-settings">
    <div class="dark-light">
        <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round"
            stroke-linejoin="round">
            <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" />
        </svg>
    </div>
    @if($medias !== null)
        <img class="user-profile account-profile" src="{{ asset('assets/client/logos/' . $medias->url) }}" alt="" />
    @else
        <img class="user-profile account-profile" src="{{ asset('assets/client/logos/default.png') }}" alt="" />
    @endif
</div>