@extends('layouts.main')

@section('content')

<div class="main">
    <div class="left">
        @include('components.home.left-aside')
    </div><!-- End Aside Left -->
    <div class="middle-block">
        <div class="navigationTab">
            <div class="tab">
                <h4><a class="thirdtitle active" href="#">Accueil</a></h4>
            </div>
            <div class="tab">
                <h4><a class="thirdtitle" href="#">Récent</a></h4>
            </div>
            <div class="tab">
                <h4><a class="thirdtitle" href="#">Favoris</a></h4>
            </div>
        </div> <!-- End navigation bar -->
            <!-- Template du projet -->
            <?php // include_once('template/project-item.php'); ?>
    </div>
    <!--ENd Middle Content -->

    <div class="right">
        @include('components.home.right-aside')
    </div>
</div>

@endsection