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
