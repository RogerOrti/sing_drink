<template>
    <div>
        <h1 ref="quiSomText" class="display-1 fw-bold text-center">QUI SOM</h1>
    </div>
</template>

<script>
import { gsap } from "gsap";

export default {
    name: "GsapAnimation",
    mounted() {
        // Animación de "QUI SOM"
        gsap.from(this.$refs.quiSomText, {
            duration: 2,
            y: 100,
            opacity: 0,
            ease: "power4.out",
        });
    },
};
</script>

<style scoped>
.container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
    background-color: #f0f0f0;
    font-family: Arial, sans-serif;
}

.line {
    font-size: 2rem;
    margin: 0.5rem 0;
    overflow: hidden;
}

.line span {
    display: inline-block;
}
</style>
