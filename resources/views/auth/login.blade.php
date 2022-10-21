@extends('layouts.main')

@section('content')
<div class="form_wrapper">
        <div class="form_container">
            <div class="title_container">
            <h2>Connexion</h2>
            </div>
            <div class="row clearfix">
            <div class=""> 
                <form action="{{ route('auth.login') }}" method="POST">
                @csrf
                @foreach ($errors->all() as $error)
                    <p class="error">{{ $error }}</p>
                @endforeach
                    <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                        <input type="text" name="identifiant" placeholder="Nom d'utilisateur ou d'entreprise" required />
                    </div>
                    <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                        <input type="password" name="password" placeholder="Mot de passe" required />
                    </div>
                    <input class="button" type="submit" value="Se connecter" name="login"/>
                    <p>Si vous n'avez pas de compte utilisateur, <a href="{{ route('auth.signin') }}">inscrivez-vous ici</a></p>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection

