@extends('layouts.main')

@section('content')
<div class="main">
    <div class="left">
        @include('components.home.left-aside')
    </div>
    <div class="middle-block">
        @include('components.home.navTab')
        @forelse ($projects as $project)
            @include('components.project.item')
        @empty
            <lottie-player src="https://assets8.lottiefiles.com/packages/lf20_awc77jfz.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px; margin: 0 auto;"  loop  autoplay></lottie-player>    
            <p style="text-align: center; margin-top: 50px">Oups ! Aucun projet n'a été trouvé.</p>
        @endforelse
    </div>
    <div class="right">
        @include('components.home.right-aside')
    </div>
</div>
@endsection