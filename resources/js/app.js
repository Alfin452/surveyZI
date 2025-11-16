import "./bootstrap";

import Alpine from "alpinejs";
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import { ScrollToPlugin } from "gsap/ScrollToPlugin";

gsap.registerPlugin(ScrollTrigger, ScrollToPlugin);
window.Alpine = Alpine;
Alpine.start();

window.GSAPAnimations = {
    initHeroTimeline() {
        const tl = gsap.timeline({ defaults: { ease: "power2.out" } });

        tl.from(".header-anim", { yPercent: -100, duration: 0.8 })
            .to(
                ".fade-down-anim",
                { opacity: 1, y: 0, duration: 0.6, stagger: 0.1 },
                "-=0.4"
            )
            .from(
                ".hero-title-anim",
                { opacity: 0, y: 30, duration: 0.6 },
                "-=0.4"
            )
            .from(
                ".hero-subtitle-anim",
                { opacity: 0, y: 20, duration: 0.5 },
                "-=0.3"
            )
            .from(
                ".hero-button-anim",
                { opacity: 0, scale: 0.8, duration: 0.5 },
                "-=0.3"
            )
            .to(
                ".card-anim",
                {
                    opacity: 1,
                    y: 0,
                    scale: 1,
                    duration: 0.5,
                    stagger: 0.1,
                    onStart: () => {
                        gsap.utils
                            .toArray(".stat-number")
                            .forEach((counter) => {
                                const target =
                                    parseInt(counter.dataset.target) || 0;
                                counter.innerText = "0";
                                this.animateCounter(counter, target, 2);
                            });
                    },
                },
                "-=0.3"
            )
            .from(
                ".hero-image-anim",
                { opacity: 0, scale: 0.9, duration: 1, ease: "power3.out" },
                "-=0.5"
            );

        return tl;
    },

    staggerCards(selector = ".card-anim", delay = 0.1) {
        gsap.from(selector, {
            opacity: 0,
            y: 50,
            scale: 0.95,
            stagger: delay,
            duration: 0.6,
            ease: "power2.out",
        });
    },

    fadeIn(selector, direction = "up", delay = 0) {
        const directions = {
            up: { y: 50 },
            down: { y: -50 },
            left: { x: -50 },
            right: { x: 50 },
            scale: { scale: 0.8 },
        };
        gsap.from(selector, {
            opacity: 0,
            ...directions[direction],
            duration: 0.8,
            delay: delay,
            ease: "power2.out",
        });
    },

    animateFormFields(formSelector = ".form-field-anim") {
        gsap.from(formSelector, {
            opacity: 0,
            y: 20,
            stagger: 0.1,
            duration: 0.5,
            ease: "power2.out",
        });
    },

    initScrollTrigger(
        selector = ".section-title-anim, .feature-card-anim, .survey-item-anim, .fade-left-anim, .fade-right-anim, .scale-anim, .form-field-anim, .list-item-anim, .program-card"
    ) {
        gsap.utils.toArray(selector).forEach((elem) => {
            gsap.to(elem, {
                opacity: 1,
                transform: "none",
                duration: 0.7,
                ease: "power2.out",
                scrollTrigger: {
                    trigger: elem,
                    start: "top 85%",
                    toggleActions: "play none none none",
                },
            });
        });
    },

    scrollTo(target, offsetY = 80) {
        gsap.to(window, {
            duration: 1.2,
            scrollTo: { y: target, offsetY: offsetY },
            ease: "power3.inOut",
        });
    },

    initSmoothNav() {
        const navLinks = gsap.utils.toArray(".nav-link-anim");
        const sections = gsap.utils.toArray(".section-nav");

        navLinks.forEach((link) => {
            link.addEventListener("click", (e) => {
                e.preventDefault();
                const targetId = e.target.getAttribute("href");
                if (targetId && targetId.startsWith("#")) {
                    this.scrollTo(targetId, 80);
                }
            });
        });

        sections.forEach((section) => {
            ScrollTrigger.create({
                trigger: section,
                start: "top center",
                end: "bottom center",
                onToggle: (self) => {
                    const targetLink = document.querySelector(
                        `a[href="#${section.id}"]`
                    );
                    if (targetLink) {
                        if (self.isActive) {
                            targetLink.classList.add("nav-active");
                        } else {
                            targetLink.classList.remove("nav-active");
                        }
                    }
                },
            });
        });
    },

    pageTransition(callback) {
        const tl = gsap.timeline({
            onComplete: () => {
                if (callback) callback();
            },
        });

        tl.to("body", {
            opacity: 0,
            duration: 0.3,
            ease: "power2.inOut",
        }).to("body", {
            opacity: 1,
            duration: 0.3,
            ease: "power2.inOut",
        });

        return tl;
    },

    showMessage(selector, type = "success") {
        const colors = {
            success: "#10b981", // green-500 - tetap untuk success
            error: "#ef4444", // red-500 - tetap untuk error
            info: "#14b8a6", // teal-600 - DIUBAH dari blue (#3b82f6)
        };

        gsap.fromTo(
            selector,
            { opacity: 0, y: -20, backgroundColor: colors[type] },
            { opacity: 1, y: 0, duration: 0.5, ease: "back.out(1.7)" }
        );

        gsap.to(selector, {
            opacity: 0,
            y: -20,
            duration: 0.3,
            delay: 3,
            ease: "power2.in",
        });
    },

    showLoading(show = true) {
        const overlay = document.querySelector(".loading-overlay");
        if (!overlay) return;

        if (show) {
            gsap.to(overlay, { opacity: 1, display: "flex", duration: 0.3 });
        } else {
            gsap.to(overlay, {
                opacity: 0,
                duration: 0.3,
                onComplete: () => {
                    overlay.style.display = "none";
                },
            });
        }
    },

    animateCounter(element, endValue, duration = 2) {
        if (!element) return;

        const startValue = parseFloat(element.textContent) || 0;
        const obj = { value: startValue };

        gsap.to(obj, {
            value: endValue,
            duration: duration,
            ease: "power1.out",
            onUpdate: () => {
                element.textContent = Math.round(obj.value);
            },
        });
    },

    animateProgressBar(selector = ".progress-bar-anim", progress = 100) {
        gsap.to(selector, {
            opacity: 1,
            scaleX: progress / 100,
            duration: 1,
            ease: "power2.out",
        });
    },

    transitionSurveyQuestion(nextQuestionSelector, prevQuestionSelector) {
        const tl = gsap.timeline();

        if (prevQuestionSelector) {
            tl.to(prevQuestionSelector, {
                opacity: 0,
                x: -50,
                duration: 0.4,
                ease: "power2.in",
            });
        }

        tl.fromTo(
            nextQuestionSelector,
            { opacity: 0, x: 50 },
            { opacity: 1, x: 0, duration: 0.5, ease: "power2.out" }
        );

        return tl;
    },

    staggerSurveyItems(selector = ".survey-item-anim", delay = 0.15) {
        gsap.from(selector, {
            opacity: 0,
            y: 30,
            stagger: delay,
            duration: 0.6,
            ease: "power2.out",
        });
    },
};

document.addEventListener("DOMContentLoaded", function () {
    if (document.querySelector(".hero-title-anim")) {
        window.GSAPAnimations.initHeroTimeline();
    }

    window.GSAPAnimations.initScrollTrigger();

    if (document.querySelector(".nav-link-anim")) {
        window.GSAPAnimations.initSmoothNav();
    }

    if (document.querySelector(".survey-item-anim")) {
        window.GSAPAnimations.staggerSurveyItems();
    }

    if (document.querySelector(".progress-bar-anim")) {
        const progress =
            document.querySelector(".progress-bar-anim").dataset.progress || 0;
        window.GSAPAnimations.animateProgressBar(
            ".progress-bar-anim",
            progress
        );
    }

    setTimeout(() => {
        window.GSAPAnimations.showLoading(false);
    }, 500);
});

window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;
