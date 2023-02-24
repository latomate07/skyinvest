<template>
    <h1>Hello world</h1>
</template>

<script setup>
const props = defineProps({
    test: String
});

console.log(props.test);
</script>