@extends('layouts.main')

@section('content')
<div class="dashboard-container">
            <nav class="dashboard-nav">
                <ul class="nav-list">
                <li><a href="javascript:void(0)" class="nav-link">Tableau de bord</a></li>
                <li><a href="javascript:void(0)" class="nav-link active">Compte</a></li>
                </ul>
            </nav>
            <div class="wherearewe">
                <h2 class="title">Mon compte</h2>
                <h4 class="userRegistrated">
                Membre depuis le <span class="colorThis">{{ \Carbon\Carbon::parse(auth()->user()->created_at)->format('d/m/Y') }}</span>
                </h4>
            </div>
            <div class="top-content">
                <div class="synth-infos">
                    <div class="left-content">
                        <div class="left-side">
                                @if($medias !== null)
                                    <img src="{{ asset('assets/client/logos/' . $medias->url) }}"  alt="photo de profil" width="90px" height="90px" class="userLogo">
                                @else
                                    <img src="{{ asset('assets/client/logos/default.png') }}"  alt="photo de profil" width="90px" height="90px" class="userLogo">    
                                @endif
                            <i class="fa fa-camera" id="addImg"></i>
                            <div class="addImgContainer">
                                <div class="userLogo preview"><img id="preview" src="{{ $medias !== null ? asset('assets/client/logos/' . $medias->url) : asset('assets/client/logos/default.png') }}"></div>
                                <form id="changeImg" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <input type="file" id="file" accept='image/*' name="user_logo" onchange="previewFile()"> 
                                    <input type="submit" value="Modifier" id="submitBtn">
                                </form>
                            </div>
                        </div>
                        <div class="right-side">
                            <h4><a href="javascript:void(0)">{{  auth()->user()->role == "Investisseur" ? auth()->user()->investor_username : auth()->user()->enterprise_name }}</a></h4>
                            <a class="userMail" href="javascript:void(0)">{{ auth()->user()->email }}</a>
                        </div>
                    </div>
                    <div class="middle-content">
                        <div class="top-elements">
                            <i class="fa fa-circle" style="color:gray"></i>
                            <p class="info">profil <strong>{{ $isReadyToInvest == true ? 'validé' : 'non validé' }}</strong></p>
                        </div>
                        <div class="middle-elements">
                            <i class="fa fa-phone"></i>
                            <p class="info">Non défini</p>
                        </div>
                        <div class="bottom-elements">
                            <i class="fa fa-circle-check"></i>
                            <p class="info">newsletter <strong>active</strong></p>
                        </div>
                    </div>

                    <!-- Visible pour les investisseurs -->
                    <div class="right-content">
                        <strong>Complétez ces étapes avant d'investir</strong>
                        <div class="top-elements">
                            <i class="fa fa-id-card"></i>
                            <p class="info">Complétez vos données personnelles</p>
                        </div>
                        <div class="middle-elements">
                            <i class="fa fa-check"></i>
                            <p class="info">Indiquez le type d'investisseur</p>
                        </div>
                    </div>

                </div>

                <div class="nav-pages">
                    <ul class="list">
                        <li id="tab-1" class="active"><a href="javascript:void(0)">Mes données</a></li>
                        <li id="tab-2"><a href="javascript:void(0)">Accès</a></li>
                        <li id="tab-3"><a href="javascript:void(0)">Investir</a></li>
                        <li id="tab-4"><a href="javascript:void(0)">Préférences</a></li>
                    </ul>
                </div>
            </div> <!-- Fin synth-infos -->
            
            <div class="bottom-content" id="bottom-1"> <!-- Élements du bas, change en fonction de la navigation -->
                <div class="left">
                    <div class="step-content firstStep">
                        <span class="step stepOne active">1</span>
                        <p class="infos">Compléter vos informations</p>
                    </div>
                    <div class="step-content secondStep">
                        <span class="step stepTwo inactive">2</span>
                        <p class="infos">Vérifier l'identité et l'adresse</p>
                    </div>
                    <div class="step-content thirdStep">
                        <span class="step stepThird inactive">3</span>
                        <p class="infos">Ajouter un compte bancaire</p>
                    </div>
                    <div class="step-content fourStep">
                        <span class="step stepFour inactive">4</span>
                        <p class="infos">Lutte anti-blanchiment</p>
                    </div>
                </div>
                
                <div class="right"> <!-- Contenu flexible en fonction de la navigation -->
                    <form id="step-1" class="dashboardForm">
                        @csrf
                        <h3 class="title">Compléter vos données personnelles</h3>
                        <div class="sectionContainer">
                            <div class="left-content">
                                <label for="userFullName">Nom complet</label>
                                <input type="text" value="{{ auth()->user()->name }}" name="userFullName">
                                <label for="userBirthCountry">Pays de naissance</label>
                                <select name="userBirthCountry">
                                    @if (auth()->user()->residence_country != "")
                                        <option value="{{ auth()->user()->residence_country }}">{{ auth()->user()->residence_country }}</option>
                                    @endif
                                    <option value="France">France</option>
                                    <option value="Belgique">Belgique</option>
                                    <option value="Suisse">Suisse</option>
                                    <option value="Maroc">Maroc</option>
                                    <option value="Niger">Niger</option>
                                </select>
                                <label for="userNationality">Nationalité</label>
                                <select name="userNationality">
                                @if (auth()->user()->nationality != "")
                                    <option value="{{ auth()->user()->nationality }}">{{ auth()->user()->nationality }}</option>
                                @endif
                                    <option value="France">France</option>
                                    <option value="Belgique">Belgique</option>
                                    <option value="Suisse">Suisse</option>
                                    <option value="Maroc">Maroc</option>
                                    <option value="Niger">Niger</option>
                                </select>
                            </div>
                            <div class="right-content">
                                <label for="userResidence">Pays de résidence</label>
                                <select name="userResidence">
                                    @if (auth()->user()->residence_country != "")
                                        <option value="{{ auth()->user()->residence_country }}">{{ auth()->user()->residence_country }}</option>
                                    @endif
                                    <option value="France">France</option>
                                    <option value="Belgique">Belgique</option>
                                    <option value="Suisse">Suisse</option>
                                    <option value="Maroc">Maroc</option>
                                    <option value="Niger">Niger</option>
                                </select>
                                <label for="userBirthday">Date de naissance</label>
                                <input type="date" name="userBirthday" value="{{ auth()->user()->birthday_date }}">
                                <label for="userGenre">Genre</label>
                                <select name="userGenre">
                                    @if (auth()->user()->genre != "")
                                        <option value="{{ auth()->user()->genre }}">{{ auth()->user()->genre }}</option>
                                    @endif
                                    <option value="Homme">Homme</option>
                                    <option value="Femme">Femme</option>
                                </select>
                            </div>
                        </div>
                        <input type="submit" class="btn" value="Continuer">
                    </form> 

                    <form id="step-2" class="hiddenBlock dashboardForm">
                        @csrf
                        <h3 class="title">Vérification de votre identité et votre adresse</h3>
                        <div class="sectionContainer">
                            <div class="left-content">
                                <label for="userAdress">Adresse postale</label>
                                <input type="text" placeholder="Votre adresse postale" name="userAdress" value="{{ $user->adresse }}">
                                <label for="userCity">Ville</label>
                                <input type="text" placeholder="Votre ville" name="userCity" value="{{ $user->city }}">
                                <label for="userAdressFile">Justificatif de domicile</label>
                                <input type="file" name="userAdressFile">
                            </div>
                            <div class="right-content">
                                <label for="userFamilyName">Personne à contacter en cas de décès</label>
                                <input type="text" placeholder="Indiquez le nom de la personne" name="userFamilyName" value="{{ $user->relation_to_call_name }}">
                                <label for="userFamilyAdress">Adresse de la personne à contacter en cas de décès</label>
                                <input type="text" placeholder="Indiquez l'adresse de la personne" name="userFamilyAdress" value="{{ $user->relation_to_call_adress }}">
                                <label for="userFamilyTel">Numéro de téléphone de la personne à contacter en cas de décès</label>
                                <input type="text" placeholder="Indiquez le numéro de téléphone de la personne" name="userFamilyTel" value="{{ $user->relation_to_call_phoneNumber }}">
                            </div>
                        </div>
                        <input type="submit" class="btn" value="Continuer">
                    </form>

                    <form id="step-3" class="hiddenBlock dashboardForm">
                        @csrf
                        <h3 class="title">Ajouter un compte bancaire</h3>
                        <div class="sectionContainer">
                            <div class="left-content">
                                <label for="bankOwnerName">Nom du détenteur</label>
                                <input type="text" placeholder="Le nom du détenteur" name="bankOwnerName" value="{{ $user->bank_account_owner_name }}">
                                <label for="bankOwnerLastName">Prénom du détenteur</label>
                                <input type="text" placeholder="Le prénom du détenteur" name="bankOwnerLastName" value="{{ $user->bank_account_owner_lastName }}">
                            </div>
                            <div class="right-content">
                                <label for="bankName">Nom de la banque</label>
                                <input type="text" placeholder="Nom de votre banque" name="bankName" value="{{ $user->bank_account_name }}">
                                <label for="bankIban">IBAN</label>
                                <input type="text" name="bankIban" placeholder="Votre IBAN" value="{{ $user->iban }}">
                            </div>
                        </div>
                        <input type="submit" class="btn" value="Continuer">
                    </form>

                    <form id="step-4" class="hiddenBlock dashboardForm">
                        @csrf
                        <h3 class="title">Lutte anti-blanchiment</h3>
                        <div class="sectionContainer">
                            <div class="left-content">
                                <label for="source_of_incomes_description">D'où proviennent vos revenues ?</label>
                                <input type="text" placeholder="Rédigez en quelques mots, d'où proviennent vos revenues" name="source_of_incomes_description" value="{{ $user->source_of_income_justificatif }}">
                                <label for="source_of_incomes">Justificatif (Ajouter une fiche de paie ou autres justificatif)</label>
                                <input type="file" name="source_of_incomes">
                            </div>
                        </div>
                        <input type="submit" class="btn" value="Continuer">
                    </form>
                </div>
            </div> <!-- End bottom 1 -->

            <div class="bottom-content hideBottom" id="bottom-2"> <!-- Élements du bas, change en fonction de la navigation -->
                <div class="left">
                    <div class="step-content firstStep">
                        <span class="step stepOne active"><i class="fa fa-key" style="font-size: 15px;"></i></span>
                        <p class="infos">Mot de passe</p>
                    </div>
                    <div class="step-content secondStep">
                        <span class="step stepTwo inactive"><i class="fa fa-envelope" style="font-size: 15px;"></i></span>
                        <p class="infos">E-mail</p>
                    </div>
                </div>
                
                <div class="right"> <!-- Contenu flexible en fonction de la navigation -->
                    <form id="mdpBlock">
                        <h3 class="title">Modifier votre mot de passe</h3>
                        <div class="sectionContainer">
                            <div class="left-content">
                                <label for="userFullName">Nouveau mot de passe</label>
                                <input type="password" placeholder="Saisir votre nouveau mot de passe" name="userFullName">
                                <label for="userFullName">Confirmer le mot de passe</label>
                                <input type="password" placeholder="Confirmez votre nouveau mot de passe" name="userFullName">
                            </div>
                        </div>
                        <input type="submit" style="float:left;" class="btn" value="Enregistrer">
                    </form> 

                    <form id="mailBlock" class="hiddenBlock">
                        <h3 class="title">Modifier votre E-mail</h3>
                        <div class="sectionContainer">
                            <div class="left-content">
                                <label for="userFullName">Nouveau E-mail</label>
                                <input type="password" placeholder="Saisir votre nouveau e-mail" name="userFullName">
                                <label for="userFullName">Confirmer l'E-mail</label>
                                <input type="password" placeholder="Confirmez votre nouveau e-mail" name="userFullName">
                            </div>
                        </div>
                        <input type="submit" style="float:left;" class="btn" value="Enregistrer">
                    </form>
                </div>
            </div> <!-- End bottom 2 -->

            <div class="bottom-content hideBottom" id="bottom-3"> <!-- Élements du bas, change en fonction de la navigation -->
                <div class="left">
                    <div class="step-content firstStep">
                        <span class="step stepOne active"><i class="fa fa-envelope-open-text"></i></span>
                        <p class="infos">Réglement intérieur</p>
                    </div>
                </div>
                
                <div class="right"> <!-- Contenu qui contiendra le livre pour télécharger le réglèment intérieur -->
                    <h3 class="title">Tous ce qu'il faut savoir avant d'investir</h3>
                    <div class="component">
                        <ul class="align">
                            <li>
                                <figure class='book'>
                                    <!-- Front -->
                                    <ul class='hardcover_front'>
                                        <li>
                                            <div class="coverDesign blue">
                                                <h3>RÉGLÈMENT</h3>
                                                <p>INTÉRIEUR</p>
                                            </div>
                                        </li>
                                        <li></li>
                                    </ul>
                                    <!-- Pages -->
                                    <ul class='page'>
                                        <li></li>
                                        <li>
                                            <a class="book-btn" href="#" download="reglement-interieur">Télécharger</a>
                                        </li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                    </ul>
                                    <!-- Back -->
                                    <ul class='hardcover_back'>
                                        <li></li>
                                        <li></li>
                                    </ul>
                                    <ul class='book_spine'>
                                        <li></li>
                                        <li></li>
                                    </ul>
                                </figure>
                            </li>
                        </ul>
			       </div>
                </div>
            </div> <!-- End bottom 3 -->

            <div class="bottom-content hideBottom" id="bottom-4"> <!-- Élements du bas, change en fonction de la navigation -->
                
            </div> <!-- End bottom 4 -->
        </div>
    </div> <!-- Fin container -->
    <div id="overlay" class="addImgOverlay"></div>   
@endsection     

@section('scripts')
<script src="{{ asset('assets/js/dashboard/script.js') }}"></script>

<script>
    // Update User Informations
    $('#step-1').on('submit', function(event){
        event.preventDefault();
        let data = {
            'userBirthCountry': $('select[name="userBirthCountry"]').val(),
            'userResidence': $('select[name="userResidence"]').val(),
            'userNationality': $('select[name="userNationality"]').val(),
            'userBirthday': $('input[name="userBirthday"]').val(),
            'userGenre': $('select[name="userGenre"]').val(),
            'userFullName': $('input[name="userFullName"]').val()
        }
        $.ajax({
            url: " {{ route('investor.storeUserInfos.stepOne') }} ",
            type: "POST",
            data: {
                '_token': '{{ csrf_token() }}',
                'data': data
            },
            success: function(data){
                $('#successNotifBlock').css({
                    'transform': 'translateX(0px)',
                    'color': 'white'
                })
                // Fill content
                $('#notif_message_title').html('<strong>Notification :</strong>');
                $('#notif_message_content').html(data.message);

                // Hide block after 3 seconds
                setTimeout(() => {
                    $('#successNotifBlock').css({
                        'transform': 'translateX(420px)'
                    })
                }, 3000);
            },
            error: function(error){
                console.log(error);
            }
        })
    })
    $('#step-2').on('submit', function(event){
        event.preventDefault();
        let data = {
            'userAdress': $('input[name="userAdress"]').val(),
            'userCity': $('input[name="userCity"]').val(),
            'userFamilyName': $('input[name="userFamilyName"]').val(),
            'userFamilyAdress': $('input[name="userFamilyAdress"]').val(),
            'userFamilyTel': $('input[name="userFamilyTel"]').val()    }
        $.ajax({
            url: " {{ route('investor.storeUserInfos.stepTwo') }} ",
            type: "POST",
            data: {
                '_token': '{{ csrf_token() }}',
                'data': data
            },
            success: function(data){
                $('#successNotifBlock').css({
                    'transform': 'translateX(0px)',
                    'color': 'white'
                })
                // Fill content
                $('#notif_message_title').html('<strong>Notification :</strong>');
                $('#notif_message_content').html(data.message);

                // Hide block after 3 seconds
                setTimeout(() => {
                    $('#successNotifBlock').css({
                        'transform': 'translateX(420px)'
                    })
                }, 3000);
            },
            error: function(error){
                console.log(error);
            }
        })
    })
    $('#step-3').on('submit', function(event){
        event.preventDefault();
        let data = {
            'bankOwnerName': $('input[name="bankOwnerName"]').val(),
            'bankOwnerLastName': $('input[name="bankOwnerLastName"]').val(),
            'bankName': $('input[name="bankName"]').val(),
            'bankIban': $('input[name="bankIban"]').val()
        }
        $.ajax({
            url: " {{ route('investor.storeUserInfos.stepThree') }} ",
            type: "POST",
            data: {
                '_token': '{{ csrf_token() }}',
                'data': data
            },
            success: function(data){
                $('#successNotifBlock').css({
                    'transform': 'translateX(0px)',
                    'color': 'white'
                })
                // Fill content
                $('#notif_message_title').html('<strong>Notification :</strong>');
                $('#notif_message_content').html(data.message);

                // Hide block after 3 seconds
                setTimeout(() => {
                    $('#successNotifBlock').css({
                        'transform': 'translateX(420px)'
                    })
                }, 3000);
            },
            error: function(error){
                console.log(error);
            }
        })
    })
    $('#step-4').on('submit', function(event){
        event.preventDefault();
        let data = {
            'source_of_incomes_description': $('input[name="source_of_incomes_description"]').val(),
            'userRevenues': $('input[name="userRevenues"]').val()   
        }
        $.ajax({
            url: " {{ route('investor.storeUserInfos.stepFourth') }} ",
            type: "POST",
            data: {
                '_token': '{{ csrf_token() }}',
                'data': data
            },
            success: function(data){
                $('#successNotifBlock').css({
                    'transform': 'translateX(0px)',
                    'color': 'white'
                })
                // Fill content
                $('#notif_message_title').html('<strong>Notification :</strong>');
                $('#notif_message_content').html(data.message);

                // Hide block after 3 seconds
                setTimeout(() => {
                    $('#successNotifBlock').css({
                        'transform': 'translateX(420px)'
                    })
                }, 3000);
            },
            error: function(error){
                console.log(error);
            }
        })
    })

    // Toggle active tab to bottom-section
    $('.firstStep').on('click', function() {
        // Add active class to this tab nav
        $('.stepOne').addClass('active')
        // Remove inactive class to this tab nav
        $('.stepOne').removeClass('inactive')
        // Remove active class for other tab nav
        $('.stepTwo').removeClass('active')
        $('.stepTwo').addClass('inactive')
        $('.stepThird').removeClass('active')
        $('.stepThird').addClass('inactive')
        $('.stepFour').removeClass('active')
        $('.stepFour').addClass('inactive')
    })
    $('.secondStep').on('click', function() {
        // Add active class to this tab nav
        $('.stepTwo').addClass('active')
        // Remove inactive class to this tab nav
        $('.stepTwo').removeClass('inactive')
        // Remove active class for other tab nav
        $('.stepOne').removeClass('active')
        $('.stepOne').addClass('inactive')
        $('.stepThird').removeClass('active')
        $('.stepThird').addClass('inactive')
        $('.stepFour').removeClass('active')
        $('.stepFour').addClass('inactive')
    })
    $('.thirdStep').on('click', function() {
        // Add active class to this tab nav
        $('.stepThird').addClass('active')
        // Remove inactive class to this tab nav
        $('.stepThird').removeClass('inactive')
        // Remove active class for other tab nav
        $('.stepTwo').removeClass('active')
        $('.stepTwo').addClass('inactive')
        $('.stepOne').removeClass('active')
        $('.stepOne').addClass('inactive')
        $('.stepFour').removeClass('active')
        $('.stepFour').addClass('inactive')
    })
    $('.fourStep').on('click', function() {
        // Add active class to this tab nav
        $('.stepFour').addClass('active')
        // Remove inactive class to this tab nav
        $('.stepFour').removeClass('inactive')
        // Remove active class for other tab nav
        $('.stepOne').removeClass('active')
        $('.stepOne').addClass('inactive')
        $('.stepThird').removeClass('active')
        $('.stepThird').addClass('inactive')
        $('.stepTwo').removeClass('active')
        $('.stepTwo').addClass('inactive')
    })
</script>
@endsection