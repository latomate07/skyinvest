<template>
    <MainLayout :user="user" :is-home="true">
        <template #left-content>
            <ActionsSide :is-login="isLogin" :user="user"/>
        </template>
        <template #center-content>
            <ProjectListing :projects="projects" />
        </template>
        <template #right-content>
            <InformationsSide />
        </template>
    </MainLayout>
</template>

<script setup>
import MainLayout from "@/Layouts/MainLayout.vue"
import ActionsSide from "@/Components/Home/ActionsSide.vue";
import ProjectListing from "@/Components/Home/ProjectListing.vue";
import InformationsSide from "@/Components/Home/InformationsSide.vue";
const props = defineProps({
    isLogin: Boolean,
    user: Object,
    projects: Object
});
</script>