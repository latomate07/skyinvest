@extends('layouts.main')

@section('content')
<div class="form_wrapper">
        <div class="form_container">
            <div class="title_container">
            <h2>Inscription</h2>
            </div>
            <div class="row clearfix">
            <div class=""> 
                <form action="">
                @method('post')
                @csrf
                @foreach ($errors->all() as $error)
                    <p class="error">{{ $error }}</p>
                @endforeach
                <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                    <input type="email" name="email" placeholder="Email" required />
                </div>
                <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                    <input type="password" name="password" placeholder="Mot de passe" required />
                </div>
                <div class="row clearfix">
                    <div class="col_half">
                    <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                        <input type="text" name="userFullName" placeholder="Nom complet" />
                    </div>
                    </div>
                    <div class="col_half">
                    <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                        <input type="text" name="userPseudo" placeholder="Nom d'utilisateur" required />
                    </div>
                    </div>
                </div>
                    <div class="input_field radio_option">
                        <h5>Type d'utilisateur : </h5>
                        <input type="radio" name="userRole" id="rd1" value="Entreprise" checked>
                        <label for="rd1">Entreprise</label>
                        <input type="radio" name="userRole" id="rd2" value="Investisseur">
                        <label for="rd2">Investisseur</label>
                    </div>
                    <div class="input_field select_option">
                        <select name="userCountry">
                        <option>Selectionnez un pays</option>
                        <option value="France">France</option>
                        <option value="Belgique">Belgique</option>
                        <option value="Canada">Canada</option>
                        <option value="Suisse">Suisse</option>
                        <option value="Maroc">Maroc</option>
                        <option value="Algérie">Algérie</option>
                        <option value="Kenya">Kenya</option>
                        <option value="Afrique du sud">Afrique du sud</option>
                        </select>
                        <div class="select_arrow"></div>
                    </div>
                    <div class="input_field checkbox_option">
                        <input type="checkbox" id="cb1">
                        <label for="cb1">J'accepte les termes et conditions</label>
                    </div>
                    <div class="input_field checkbox_option">
                        <input type="checkbox" id="cb2">
                        <label for="cb2">Je veux recevoir la newsletter</label>
                    </div>
                <input class="button" type="submit" value="S'inscrire" name="register"/>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
