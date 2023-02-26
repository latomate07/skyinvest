<template>
    <div class="navigationTab">
        <div class="tab">
            <h4><a @click="fetchProjects('all', $event)" class="thirdtitle nav-titles active">Accueil</a></h4>
        </div>
        <div class="tab">
            <h4><a @click="fetchProjects('recent', $event)" class="thirdtitle nav-titles">Récent</a></h4>
        </div>
        <div class="tab">
            <h4><a @click="fetchProjects('liked', $event)" class="thirdtitle nav-titles">Favoris</a></h4>
        </div>
    </div>
    <div v-for="project in projects" :key="project.id" class="project">
        <div class="topContent">
            <div class="left">
                <a href="#" class="userLink">
                    <img :src="projectCompanyLogo(project)" alt="logo-entreprise" style="width:50px; height:50px" class="userLogo">
                </a>
                <div class="usersInformation">
                    <h3 class="username">
                        {{ project.user.enterprise_name }}
                    </h3>
                    <p class="publishdate">Publié le :
                        {{ (new Date(project.created_at)).toLocaleDateString('fr-FR') }}
                    </p>
                </div>
            </div>
            <div class="right">
                <h5 class="viewProfil"><a class="btn" href="">Voir le profil</a></h5>
            </div>
        </div>
        <div class="projectContent">
            <div class="left oncomputer">
                <h3 class="title">
                    {{ project.name }}
                </h3>
                <p class="content">
                    {{ project.description }}
                </p>
                <div class="progress">
                    <div class="bar">
                        <div class="progressBar"></div>
                    </div>
                    <h6 class="stats" style="margin-top:5px;">70% de l'objectif atteint</h6>
                </div>
            </div>
            <div class="right">
                <img class="projectImage" :src="projectThumbnail(project)">
            </div>
            <div class="left onmobile" style="display: none">
                <h3 class="title">
                    {{ project.name }}
                </h3>
                <p class="content">
                    {{ project.description }}
                </p>
                <div class="progress">
                    <div class="bar">
                        <div class="progressBar"></div>
                    </div>
                    <h6 class="stats" style="margin-top:5px;">70% de l'objectif atteint</h6>
                </div>
            </div>
        </div>
        <hr> <!-- Separateur -->
        <div class="projectInfo">
            <div class="item">
                <h5 class="item-info">Montant Souhaité :
                    {{ project.amount }} <span class="currency">€</span>
                </h5>
            </div>
            <div class="item">
                <h5 class="item-info">Intérêt :
                    {{ project.profits_percentage }} %
                </h5>
            </div>
            <div class="item">
                <h5 class="item-info">Versement du ROI par :
                    {{ project.type_return_on_investissment }}
                </h5>
            </div>
        </div>
        <div class="reaction">
            <div class="like">
                <p><a :id="project.id" class="reactionBtn likeProject"><i class="fa fa-thumbs-up"
                            style="margin-right:5px"></i>J'aime</a></p>
            </div>
            <div class="investir">
                <p><a class="reactionBtn" href="}"><i class="fa fa-chart-pie"
                            style="margin-right:5px"></i>Voir plus</a></p>
            </div>
            <div class="discuss">
                <p><a class="reactionBtn" href=""><i
                            class="fa fa-comments-dollar" style="margin-right:5px;"></i>Contacter</a></p>
            </div>
        </div>
    </div>
    <div v-if="projectsNotFound">
        <lottie-player src="https://assets8.lottiefiles.com/packages/lf20_awc77jfz.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px; margin: 0 auto;"  loop  autoplay></lottie-player>    
        <p style="text-align: center; margin-top: 50px">Oups ! Aucun projet n'a été trouvé.</p>  
    </div>
</template>
<script setup>
import { onMounted, computed } from 'vue';
import { router } from '@inertiajs/vue3';

/******************* DATA *******************/
const props = defineProps({
    projects: {
        type: Object,
        default: null
    }
});
/******************* LIFECYCLE *******************/
onMounted(() => {
});
/******************* METHODS *******************/
const projectsNotFound = computed(() => props.projects === null);

/**
 * Get company logo
 * 
 * @param Object project
 */
const projectCompanyLogo = (project) => {
    const defaultLogo = "/assets/client/logos/default.png";
    if(project.user.medias === null) {
        return defaultLogo;
    }

    const companyLogo = "assets/client/logos/" + project.user.medias.url;
    return companyLogo;
};  
/**
 * Get project thumbnail
 * 
 * @param Object project
 */
 const projectThumbnail = (project) => {
    const defaultThumbnail = "assets/images/defaultProjectImage.jpeg";
    if(project.medias.length < 1) {
        return defaultThumbnail;
    }

    const thumbnail = "assets/client/images/" + project.medias.url;
    return thumbnail;
};  

/**
 * Fetch projects
 * 
 */
const fetchProjects = (need, event) => {
    const data = {
        need: need
    };
    router.get('/', data, {
        preserveScroll: true,
        preserveState: true,
        only: ['projects']
    });

    // Handle active navigation
    document.querySelectorAll('.navigationTab a').forEach(function(tab) {
        tab.classList.remove('active');
    });

    if(! event.target.classList.contains('active')) {
        event.target.classList.add('active');
    }
};
</script>