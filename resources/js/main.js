document.addEventListener("DOMContentLoaded", () => {
    gsap.registerPlugin(ScrollTrigger);

    const wrapper = document.querySelector(".jukebox-wrapper");
    const player = document.querySelector(".player");

    // Movimiento horizontal de la jukebox
    gsap.to(wrapper, {
        x: () => -wrapper.scrollWidth + window.innerWidth,
        ease: "none",
        scrollTrigger: {
            trigger: ".jukebox",
            start: "top top",
            end: () => `+=${wrapper.scrollWidth}`,
            scrub: 1,
            pin: true,
            onUpdate: (self) => {
                if (self.progress > 0.9) {
                    gsap.to(player, {
                        opacity: 1,
                        bottom: "20px",
                        duration: 1,
                        ease: "power2.out"
                    });
                }
            }
        }
    });

    gsap.to(".artist", {
        backgroundPosition: "center 100%", // Esto moverá la imagen de fondo mientras se desplaza
        ease: "none",
        scrollTrigger: {
            trigger: ".artist",
            start: "top top",
            end: "bottom top",
            scrub: true,  // Hace que se mueva con el scroll
        }
    });

    // Animación para la tipografía
    gsap.fromTo(".artist h1", {
        x: -500,  // Empieza fuera de la pantalla
        opacity: 0,
    }, {
        x: 0,  // Se mueve a su posición normal
        opacity: 1,
        scrollTrigger: {
            trigger: ".artist",
            start: "top 60%",
            end: "bottom 40%",
            scrub: 1,  // Hace que la animación siga el scroll
        }
    });
    gsap.to(".info-artist", {
        y: -100, // Se mueve 100px hacia arriba
        opacity: 1, // Aparece al hacer scroll
        ease: "power2.out", // Easing para suavizar la animación
        scrollTrigger: {
            trigger: ".info-artist", // El trigger será el propio elemento
            start: "top 80%", // Empieza cuando el 80% del elemento está en la vista
            end: "top 30%", // Termina cuando el 30% del elemento está en la vista
            scrub: 1, // La animación sigue el scroll
        }
    });
    // Configuración de Lenis
    const lenis = new Lenis({
        duration: 1.5,
        easing: (t) => 1 - Math.pow(1 - t, 3),
        smooth: true,
        smoothTouch: 0.1,
        direction: "vertical"
    });

    lenis.on("scroll", ScrollTrigger.update);

    function raf(time) {
        lenis.raf(time);
        requestAnimationFrame(raf);
    }

    requestAnimationFrame(raf);

    gsap.from(".image-card", {
        opacity: 0,
        x: "100%", // Empieza fuera de la pantalla
        stagger: 0.2,
        ease: "power2.out",
        scrollTrigger: {
            trigger: ".image-gallery",
            start: "top 80%",
            end: "top 30%",
            scrub: 1,
        }
    });
});
