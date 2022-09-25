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
            <p>Oups ! Aucun projet n'a été trouvé.</p>
        @endforelse
    </div>
    <div class="right">
        @include('components.home.right-aside')
    </div>
</div>
@endsection