import "./bootstrap";
import Alpine from "alpinejs";
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import { ScrollToPlugin } from "gsap/ScrollToPlugin";
import collapse from '@alpinejs/collapse'; // <--- 1. Tambahkan baris ini

// Register GSAP Plugins
gsap.registerPlugin(ScrollTrigger, ScrollToPlugin);

// Expose GSAP to window (agar bisa dipakai di inline script blade jika butuh custom)
window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;

Alpine.plugin(collapse); // <--- 2. Tambahkan baris ini
window.Alpine = Alpine;
Alpine.start();

// --- GLOBAL ANIMATION MANAGER ---
window.GSAPAnimations = {
    // Animasi Hero Section (Landing Page)
    initHero() {
        if (!document.querySelector("#beranda")) return;

        const tl = gsap.timeline({ defaults: { ease: "power3.out" } });

        tl.from(".hero-content > *", {
            y: 50,
            opacity: 0,
            duration: 1,
            stagger: 0.1,
            delay: 0.2,
        }).from(
            ".hero-image",
            {
                x: 50,
                opacity: 0,
                duration: 1.2,
            },
            "-=0.8"
        );
    },

    // Animasi Scroll Trigger Otomatis untuk elemen dengan class .animate-on-scroll
    initScrollAnimations() {
        const elements = document.querySelectorAll(".animate-on-scroll");

        elements.forEach((el) => {
            gsap.fromTo(
                el,
                { opacity: 0, y: 50 },
                {
                    opacity: 1,
                    y: 0,
                    duration: 0.8,
                    ease: "power2.out",
                    scrollTrigger: {
                        trigger: el,
                        start: "top 85%", // Mulai animasi saat elemen 85% masuk viewport
                        toggleActions: "play none none reverse",
                    },
                }
            );
        });
    },

    // Animasi Kartu Program (Stagger)
    initStaggerCards() {
        const cards = document.querySelectorAll(".program-card, .step-card");
        if (cards.length === 0) return;

        ScrollTrigger.batch(cards, {
            start: "top 85%",
            onEnter: (batch) =>
                gsap.to(batch, {
                    opacity: 1,
                    y: 0,
                    stagger: 0.15,
                    overwrite: true,
                    duration: 0.8,
                    ease: "back.out(1.7)",
                }),
            onLeaveBack: (batch) => gsap.set(batch, { opacity: 0, y: 30 }), // Reset kalau scroll balik
        });

        // Set initial state
        gsap.set(cards, { opacity: 0, y: 30 });
    },

    // Smooth Scroll untuk Link Anchor (#)
    initSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
            anchor.addEventListener("click", function (e) {
                e.preventDefault();
                const targetId = this.getAttribute("href");
                if (targetId === "#") return;

                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    gsap.to(window, {
                        duration: 0.6, // UBAH: Dari 1 menjadi 0.6 (atau 0.5 agar lebih ngebut)
                        scrollTo: { y: targetElement, offsetY: 80 },
                        ease: "power2.out", // UBAH: Gunakan 'out' agar start-nya instan/cepat
                    });
                }
            });
        });
    },
};

// Jalankan saat DOM siap
document.addEventListener("DOMContentLoaded", () => {
    window.GSAPAnimations.initHero();
    window.GSAPAnimations.initScrollAnimations();
    window.GSAPAnimations.initStaggerCards();
    window.GSAPAnimations.initSmoothScroll();
});
