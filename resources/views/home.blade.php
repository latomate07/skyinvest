@extends('layouts.main')

@section('content')
<div class="main">
    <div class="left">
        @include('components.home.left-aside')
    </div>
    <div class="middle-block">
        @include('components.home.navTab')
        <?php // include_once('template/project-item.php'); ?>
    </div>
    <div class="right">
        @include('components.home.right-aside')
    </div>
</div>
@endsection