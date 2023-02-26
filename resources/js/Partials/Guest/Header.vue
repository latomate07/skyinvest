<template>
    <header>
        <div class="headerContainer">
            <div class="burgerMenu authAction">
                <a href="javascript:void(0)" id="menuIcon"><i class="fa fa-bars"></i></a>
            </div>
            <div class="menuPrincipal aside-block" id="menuPrincipal">
                <i class="fa fa-arrow-right close-btn" id="menuClose-btn"></i>
                <div class="card calltoaction">
                    <h2 class="subtitle"><span class="colorThis">TahirouTest</span> est une communauté qui ne vise que la
                        réussite ! </h2>
                    <p class="content">Nous sommes le premier réseau social dédié à l'investissement.</p>
                    <div class="calltoaction">
                        <a class="btn" href="">S'inscrire</a>
                        <a class="noBtn" href="">Se connecter</a>
                    </div>
                </div>
                <div class="aside-block card">
                    <h2 class="subtitle">Nos secteurs</h2>
                    <ul class="catList">
                        <li v-for="(categorie, index) in categories"><a class="listItem" href="#"><i class="fa fa-igloo" style="font-size:20px; margin-right:5px;"></i>{{ categorie }}</a></li>
                    </ul>
                    <h2 class="subtitle forUsefulLinks">Informations & Aide</h2>
                    <ul class="usefulLinks">
                        <li v-for="(informationsPage, index) in informationsPages"><a class="listItem" href="#"><i class="fa fa-arrow-right" style="font-size:20px; margin-right:5px;"></i>{{ informationsPage }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="logoDiv">
                <h1><a href="/">Logo</a></h1>
            </div>
            <form class="searchBar" method="POST" id="searchBar">
                <input type="search" placeholder="Trouver un projet..." class="searchInput" id="searchInput">
                <button type="submit" class="btn"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" aria-hidden="true" class="crayons-icon c-btn__icon" focusable="false">
                        <path
                            d="m18.031 16.617 4.283 4.282-1.415 1.415-4.282-4.283A8.96 8.96 0 0 1 11 20c-4.968 0-9-4.032-9-9s4.032-9 9-9 9 4.032 9 9a8.96 8.96 0 0 1-1.969 5.617zm-2.006-.742A6.977 6.977 0 0 0 18 11c0-3.868-3.133-7-7-7-3.868 0-7 3.132-7 7 0 3.867 3.132 7 7 7a6.977 6.977 0 0 0 4.875-1.975l.15-.15z">
                        </path>
                    </svg></button>
                <ul class="resultOfLiveSearch" style="display:none"></ul>
            </form>
            <div class="auth">
                <a class="noBtn" href="">Connexion</a>
                <a class="btn" href="">Inscription</a>
            </div>
        </div>
    </header>
</template>
<script setup>
/**
 * Get App categories
 */
 const categories = [
    'Immobiler',
    'Commerce',
    'Informatique',
    'Alimentation',
    'Industrie',
    'Autres'
];
/**
 * Get App informations Pages
 */
 const informationsPages = [
    'Qui sommes-nous ?',
    'Mentions légales',
    'Confidentialité',
    'Devenir Investisseur',
    'Aide & Support'
];
</script>