@extends('client.livechat.layout.main')
@section('content')
<div class="app">
  <div class="header">
    @include('client.livechat.components.header')
  </div>
  <div class="wrapper">
    @include('client.livechat.components.list-conversation')
    @include('client.livechat.components.chat-area')
    @if (isset($conversation))
      @include('client.livechat.components.detail-side')
    @endif
  </div>
</div>
@vite('resources/js/app.js')
@endsection