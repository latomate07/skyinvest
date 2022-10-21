<header>
        <div class="headerContainer">
                    <!-- Visible uniquement sur mobile -->
                    <div class="burgerMenu authAction">       
                            <a href="javascript:void(0)" id="menuIcon"><i class="fa fa-bars"></i></a>
                    </div>
    
                    <div class="menuPrincipal aside-block" id="menuPrincipal">
                            <i class="fa fa-arrow-right close-btn" id="menuClose-btn"></i> <!-- Button pour fermer fenetre -->
                            <!-- Visible pour les utilisateurs non connecté -->
                            @guest
                                <div class="card calltoaction">
                                        <h2 class="subtitle"><span class="colorThis">TahirouTest</span> est une communauté qui ne vise que la réussite ! </h2>
                                        <p class="content">Nous sommes le premier réseau social dédié à l'investissement.</p>
                                        <div class="calltoaction">
                                                <a class="btn" href="{{ route('signin') }}">S'inscrire</a>
                                                <a class="noBtn" href="{{ route('login') }}">Se connecter</a>
                                        </div>
                                </div>  
                            @endguest
                            @if (auth()->check() && auth()->user()->role == "Investisseur")
                                <!-- Visible pour les utilisateurs connecté et ayant un rôle d'INVESTISSEUR-->
                                <div class="card calltoaction">
                                        <h2 class="subtitle">Bonjour, <span class="colorThis">{{ auth()->user()->investor_username }}</span></h2>
                                        <!-- Si profil utilisateur est rempli afficher ce qui suit -->
                                        <p class="content">Alors, on investi dans quoi aujourd'hui ?</p>
                                        <!-- Sinon Demander le remplissage de celui-ci -->
                                        <!-- <p class="content">Votre profil n'est pas rempli, veuillez le remplir afin d'investir sur <span class="colorThis">TahirouTest</span></p> -->
                                        <div class="calltoaction">
                                                <!-- Si profil utilisateur rempli => afficher ce qui suit -->
                                                <a class="btn" href="#">Commencer</a>
                                                <!-- SInon -->
                                                <!-- <a class="btn" href="#">Remplir le profil</a> -->
                                                <a class="noBtn" href="{{ route('auth.logout') }}" onclick="destroySession()">Déconnexion</a>
                                        </div>
                                </div>   
                            @elseif (auth()->check() && auth()->user()->role == "Entreprise")
                                <!-- Visible pour les utilisateurs connecté et ayant un rôle d'INVESTISSEUR-->
                                <div class="card calltoaction">
                                        <h2 class="subtitle">Bonjour, <span class="colorThis">{{ auth()->user()->enterprise_name }}</span></h2>
                                        <!-- Si profil utilisateur est rempli afficher ce qui suit -->
                                        <p class="content">Alors, quel projet souhaitez-vous réaliser aujourd'hui ?</p>
                                        <!-- Sinon Demander le remplissage de celui-ci -->
                                        <!-- <p class="content">Votre profil n'est pas rempli, veuillez le remplir afin d'investir sur <span class="colorThis">TahirouTest</span></p> -->
                                        <div class="calltoaction">
                                                <!-- Si profil utilisateur rempli => afficher ce qui suit -->
                                                <a class="btn" href="{{ route('client.project.publish') }}">Commencer</a>
                                                <!-- SInon -->
                                                <!-- <a class="btn" href="#">Remplir le profil</a> -->
                                                <a class="noBtn" href="{{ route('auth.logout') }}" onclick="destroySession()">Déconnexion</a>
                                        </div>
                                </div>
                            @endif
                            <div class="aside-block card">
                                  @auth()
                                  <!-- Useful Link and Help --->
                                  <h2 class="subtitle forUsefulLinks">Navigation</h2>
                                  <ul class="usefulLinks">
                                        <li><a class="listItem" href="{{ route('client.dashboard') }}"><i class="fa fa-arrow-right" style="font-size:20px; margin-right:5px;"></i>Tableau de bord</a></li>
                                        <li><a class="listItem" href="#"><i class="fa fa-arrow-right" style="font-size:20px; margin-right:5px;"></i>Mes contrats</a></li>
                                        <li><a class="listItem" href="#"><i class="fa fa-arrow-right" style="font-size:20px; margin-right:5px;"></i>Abonnement</a></li>
                                        <li><a class="listItem" href="#"><i class="fa fa-arrow-right" style="font-size:20px; margin-right:5px;"></i>Paramètre</a></li>
                                  </ul>
                                  @endauth

                                  <!-- Categorie list -->                              
                                  <h2 class="subtitle">Nos secteurs</h2>
                                  <ul class="catList">
                                        <li><a class="listItem" href="#"><i class="fa fa-igloo" style="font-size:20px; margin-right:5px;"></i>Immobilier</a></li>
                                        <li><a class="listItem" href="#"><i class="fa fa-dumpster-fire" style="font-size:20px; margin-right:5px;"></i>Commerce</a></li>
                                        <li><a class="listItem" href="#"><i class="fa fa-desktop" style="font-size:20px; margin-right:5px;"></i>Informatique</a></li>
                                        <li><a class="listItem" href="#"><i class="fa fa-utensils" style="font-size:20px; margin-right:5px;"></i>Alimentation</a></li>
                                        <li><a class="listItem" href="#"><i class="fa fa-industry" style="font-size:20px; margin-right:5px;"></i>Industrie</a></li>
                                        <li><a class="listItem" href="#"><i class="fa fa-plus" style="font-size:20px; margin-right:5px;"></i>Autres</a></li>
                                  </ul>
                                  
                                  <!-- Useful Link and Help --->
                                  <h2 class="subtitle forUsefulLinks">Informations & Aide</h2>
                                  <ul class="usefulLinks">
                                        <li><a class="listItem" href="#"><i class="fa fa-arrow-right" style="font-size:20px; margin-right:5px;"></i>Qui sommes-nous ?</a></li>
                                        <li><a class="listItem" href="#"><i class="fa fa-arrow-right" style="font-size:20px; margin-right:5px;"></i>Mentions légales</a></li>
                                        <li><a class="listItem" href="#"><i class="fa fa-arrow-right" style="font-size:20px; margin-right:5px;"></i>Confidentialité</a></li>
                                        <li><a class="listItem" href="#"><i class="fa fa-arrow-right" style="font-size:20px; margin-right:5px;"></i>Devenir Investisseur</a></li>
                                        <li><a class="listItem" href="#"><i class="fa fa-arrow-right" style="font-size:20px; margin-right:5px;"></i>Aide & Support</a></li>
                                  </ul>
                            </div> <!-- End Category -->  
                    </div> <!-- Fin menu principal -->  
    
                    <div class="logoDiv">
                         <h1><a href="/">Logo</a></h1>
                    </div>
                    <form class="searchBar" method="POST" id="searchBar">
                        @csrf
                        <input type="search" placeholder="Trouver un projet..." class="searchInput" id="searchInput">
                        <button type="submit" class="btn"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true" class="crayons-icon c-btn__icon" focusable="false"><path d="m18.031 16.617 4.283 4.282-1.415 1.415-4.282-4.283A8.96 8.96 0 0 1 11 20c-4.968 0-9-4.032-9-9s4.032-9 9-9 9 4.032 9 9a8.96 8.96 0 0 1-1.969 5.617zm-2.006-.742A6.977 6.977 0 0 0 18 11c0-3.868-3.133-7-7-7-3.868 0-7 3.132-7 7 0 3.867 3.132 7 7 7a6.977 6.977 0 0 0 4.875-1.975l.15-.15z"></path></svg></button>
                        <ul class="resultOfLiveSearch"></ul>
                    </form>
                    @guest
                        <!-- Show this when user is not connected -->
                        <div class="auth">
                                <a class="noBtn" href="{{ route('login') }}">Connexion</a>
                                <a class="btn" href="{{ route('signin') }}">Inscription</a>
                        </div>  
                    @endguest
                    @auth
                        <!-- Show this when user is connected -->
                        <div class="auth authAction">
                                <a href="javascript:void(0)" class="notifications"><i class="fa fa-bell"></i></a>
                                <div class="notif-block">
                                        <div class="topContent">
                                                <i class="fa fa-arrow-left close-btn" id="notifClose-btn"></i> <!-- Button pour fermer fenetre -->
                                                <div class="notif-bar">
                                                <h4 class="title"><a href="">Notifications</a></h4>
                                                </div>
                                                <div class="message-bar">
                                                        <h4 class="title"><a href="">Messages</a></h4>
                                                </div>
                                        </div> 
                                </div>                       
                                <a href="javascript:void(0)" class="viewMore"><i class="fa fa-compass"></i></a>
                                <div class="block-content">
                                        <ul class="tools-list">
                                                <li><a href="{{ route('client.dashboard') }}"><i class="fa fa-user"></i><h5>Tableau de bord</h5></a></li>
                                                <li><a><i class="fa fa-file-signature"></i><h5>Contrat</h5></a></li>
                                                <li><a><i class="fa fa-users"></i><h5>Inviter un ami</h5></a></li>
                                                <li><a><i class="fa fa-gear"></i><h5>Paramètre</h5></a></li>
                                                <li><a><i class="fa fa-bolt"></i><h5>Abonnement</h5></a></li>
                                                <li><a><i class="fa fa-info"></i><h5>Centre d'aide</h5></a></li>
                                        </ul>
                                        <a class="logoutBtn" href="{{ route('auth.logout') }}" onclick="destroySession()">Déconnexion</a> 
                                </div> 
                                @if($medias !== null)
                                        <a href="javascript:void(0)" class="userLink"><img src="{{ asset('assets/client/logos/' . $medias->url) }}"  alt="photo de profil" width="30px" height="30px" class="userLogo"><h4 class="userName">{{ auth()->user()->role == "Investisseur" ? auth()->user()->investor_username : auth()->user()->enterprise_name }}</h4></a>
                                @else
                                        <a href="javascript:void(0)" class="userLink"><img src="{{ asset('assets/client/logos/default.png') }}"  alt="photo de profil" width="30px" height="30px" class="userLogo"><h4 class="userName">{{ auth()->user()->role == "Investisseur" ? auth()->user()->investor_username : auth()->user()->enterprise_name }}</h4></a>      
                                @endif                     
                        </div>
                    @endauth
            </div>
    </header>
    
    <div id="overlay"></div>