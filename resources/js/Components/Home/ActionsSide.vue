<template>
    <aside class="aside-block">
        <div v-if="isLogin && user?.role == 'Investisseur'" class="card calltoaction">
            <h2 class="subtitle">Bonjour, <span class="colorThis">{{ user?.investor_username }}</span></h2>
            <p class="content">Alors, on investi dans quoi aujourd'hui ?</p>
            <div class="calltoaction">
                <a class="btn" href="#">Commencer</a>
            </div>
        </div>
        <div  v-if="isLogin && user?.role == 'Entreprise'" class="card calltoaction">
            <h2 class="subtitle">Bonjour, <span class="colorThis">{{ user?.enterprise_name }}</span></h2>
            <p class="content">Alors, quel projet souhaitez-vous réaliser aujourd'hui ?</p>
            <div class="calltoaction">
                <a class="btn" href="">Commencer</a>
            </div>
        </div>
        <div v-if="! isLogin" class="card calltoaction">
            <h2 class="subtitle"><span class="colorThis">TahirouTest</span> est une communauté qui ne vise que la réussite ! </h2>
            <p class="content">Nous sommes le premier réseau social dédié à l'investissement.</p>
            <div class="calltoaction">
                <a class="btn" href="">S'inscrire</a>
                <a class="noBtn" href="">Se connecter</a>
            </div>
        </div>
        <div class="aside-block card">
            <h2 class="subtitle">Nos secteurs</h2>
            <ul class="catList">
                <li v-for="(categorie, index) in categories" :key="index">
                    <a class="listItem" href="#">
                        <i class="fa fa-igloo" style="font-size:20px; margin-right:5px;"></i>
                        {{ categorie }}
                    </a>
                </li>
            </ul>
            <h2 class="subtitle forUsefulLinks">Informations & Aide</h2>
            <ul class="usefulLinks">
                <li v-for="(informationsPage, index) in informationsPages" :key="index">
                    <a class="listItem" href="#">
                        <i class="fa fa-arrow-right" style="font-size:20px; margin-right:5px;"></i>
                        {{ informationsPage }}
                    </a>
                </li>
            </ul>
        </div>
    </aside>
</template>

<script setup>
const props = defineProps({
    isLogin: {
        type: Boolean,
        default: false,
        required: true
    },
    user: {
        type: Object
    }
});
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