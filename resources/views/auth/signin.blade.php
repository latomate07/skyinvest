@extends('layouts.main')

@section('content')
<div class="form_wrapper">
        <div class="form_container">
            <div class="title_container">
            <h2>Inscription</h2>
            </div>
            <div class="row clearfix">
            <div> 
                <form action="{{ route('auth.signin') }}" method="POST">
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
                                <input type="text" name="name" placeholder="Nom complet" required/>
                            </div>
                        </div>
                        <div class="col_half" id="enterprise_name_div">
                            <div class="input_field"> <span><i aria-hidden="true" class="fa fa-building"></i></span>
                                <input type="text" name="enterprise_name" placeholder="Nom de votre entreprise"/>
                            </div>
                        </div>
                        <div class="col_half" id="investor_name_div">
                            <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                                <input type="text" name="investor_username" placeholder="Nom d'utilisateur"/>
                            </div>
                        </div>
                    </div>
                    <div class="input_field radio_option">
                        <h5>Type d'utilisateur : </h5>
                        <input type="radio" name="role" id="rd1" value="Entreprise" checked>
                        <label for="rd1">Entreprise</label>
                        <input type="radio" name="role" id="rd2" value="Investisseur">
                        <label for="rd2">Investisseur</label>
                    </div>
                    <div class="input_field" id="enterprise_description_div">
                        <span><i aria-hidden="true" class="fa fa-building"></i></span>
                        <textarea name="enterprise_description" placeholder="Veuillez décrire votre entreprise ici..." id="enterprise_description"></textarea>
                    </div>
                    <div class="input_field select_option">
                        <select name="country">
                            <option>Selectionnez votre pays de résidence</option>
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
                        <input type="checkbox" id="cb1" name="isAgreedWithTerms">
                        <label for="cb1">J'accepte les termes et conditions</label>
                    </div>
                    <div class="input_field checkbox_option">
                        <input type="checkbox" id="cb2" name="wishNewsletter">
                        <label for="cb2">Je veux recevoir la newsletter</label>
                    </div>
                <input class="button" type="submit" value="S'inscrire" name="register"/>
                <p>Si vous disposez déjà d'un compte, <a href="{{ route('auth.login') }}">connectez-vous ici</a></p>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $('#investor_name_div').hide()
    $('input[name="role"]').on('change', function(){
        let value = $(this).val();
        switch (value) {
            case "Entreprise" : 
                $('#investor_name_div').hide()
                $('#enterprise_name_div').show()
                $('#enterprise_description_div').show()
                $('#enterprise_description_div').attr('required', true)
                break;
            case "Investisseur" :
                $('#investor_name_div').show()
                $('#investor_name_div').attr('required', true)
                $('#enterprise_name_div').hide()
                $('#enterprise_description_div').hide()
                break;
        }
    })
</script>
@endsection
