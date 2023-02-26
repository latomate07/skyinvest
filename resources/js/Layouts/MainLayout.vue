<template>
    <div class="container">
        <GuestHeader />
        <div v-if="isHome" class="main">
            <div class="left">
                <slot name="left-content" />
            </div>
            <div class="middle-block">
                <slot name="center-content" />
            </div>
            <div class="right">
                <slot name="right-content" />
            </div>
        </div>
        <slot v-else name="pageBody" />
    </div>
    <div id="overlay"></div>
</template>
<script setup>
import GuestHeader from "@/Partials/Guest/Header.vue";
import AuthenticatedHeader from "@/Partials/Authenticated/Header.vue";
const props = defineProps({
    user: Object,
    isHome: Boolean
});
</script>