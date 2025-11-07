<x-guest-layout title="Terima Kasih">

    {{-- Thank You Section - PREMIUM DESIGN --}}
    <section class="relative bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 min-h-screen flex items-center justify-center pt-24 pb-16 px-4 overflow-hidden">

        {{-- Animated Floating Shapes --}}
        <div class="absolute inset-0 overflow-hidden">
            <div class="floating-shape absolute top-20 left-10 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            <div class="floating-shape absolute top-40 right-20 w-96 h-96 bg-yellow-300/10 rounded-full blur-3xl"></div>
            <div class="floating-shape absolute bottom-20 left-1/4 w-80 h-80 bg-blue-300/10 rounded-full blur-3xl"></div>

            {{-- Animated Grid Pattern --}}
            <div class="absolute inset-0 opacity-5">
                <div class="absolute inset-0" style="background-image: linear-gradient(white 1px, transparent 1px), linear-gradient(90deg, white 1px, transparent 1px); background-size: 50px 50px;"></div>
            </div>
        </div>

        <div class="relative z-10 w-full max-w-2xl mx-auto">

            {{-- Main Card --}}
            <div class="thank-you-card bg-white rounded-3xl shadow-2xl overflow-hidden border-4 border-white/30 backdrop-blur">

                {{-- Gradient Top Bar --}}
                <div class="h-3 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>

                {{-- Card Content --}}
                <div class="p-8 sm:p-12 md:p-16 text-center">

                    {{-- Success Icon with Animation --}}
                    <div class="success-icon mb-8">
                        <div class="relative inline-block">
                            {{-- Glow Effect --}}
                            <div class="absolute inset-0 bg-gradient-to-br from-green-400 to-emerald-600 rounded-full blur-2xl opacity-50 animate-pulse"></div>

                            {{-- Icon Container --}}
                            <div class="relative bg-gradient-to-br from-green-100 to-emerald-100 text-green-600 h-24 w-24 sm:h-28 sm:w-28 rounded-full flex items-center justify-center shadow-2xl border-4 border-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 sm:h-14 sm:w-14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Title --}}
                    <h1 class="title-text text-4xl sm:text-5xl md:text-6xl font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 mb-4">
                        Terima Kasih!
                    </h1>

                    {{-- Subtitle Badge --}}
                    <div class="subtitle-badge inline-block mb-6">
                        <span class="bg-gradient-to-r from-green-100 to-emerald-100 text-green-700 px-6 py-2 rounded-full text-sm font-bold border-2 border-green-200 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Survei Berhasil Terkirim
                        </span>
                    </div>

                    {{-- Message --}}
                    <div class="message-box bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 rounded-2xl p-6 sm:p-8 mb-8 border-2 border-indigo-100">
                        @if(session('info'))
                        <p class="text-lg sm:text-xl text-gray-700 leading-relaxed font-medium">
                            {{ session('info') }}
                        </p>
                        @else
                        <p class="text-lg sm:text-xl text-gray-700 leading-relaxed font-medium">
                            Partisipasi Anda telah berhasil direkam. Masukan Anda sangat berharga untuk meningkatkan kualitas layanan kami di masa depan.
                        </p>
                        @endif
                    </div>

                    {{-- Stats Mini --}}
                    <div class="stats-mini grid grid-cols-3 gap-3 sm:gap-4 mb-8">
                        <div class="stat-item bg-white rounded-xl p-4 shadow-md border-2 border-gray-100 transform hover:scale-105 transition-all" style="opacity: 0;">
                            <div class="bg-gradient-to-br from-indigo-100 to-indigo-200 w-12 h-12 rounded-xl flex items-center justify-center mx-auto mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="text-xs sm:text-sm text-gray-600 font-semibold">Terverifikasi</div>
                        </div>
                        <div class="stat-item bg-white rounded-xl p-4 shadow-md border-2 border-gray-100 transform hover:scale-105 transition-all" style="opacity: 0;">
                            <div class="bg-gradient-to-br from-purple-100 to-purple-200 w-12 h-12 rounded-xl flex items-center justify-center mx-auto mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <div class="text-xs sm:text-sm text-gray-600 font-semibold">Diproses</div>
                        </div>
                        <div class="stat-item bg-white rounded-xl p-4 shadow-md border-2 border-gray-100 transform hover:scale-105 transition-all" style="opacity: 0;">
                            <div class="bg-gradient-to-br from-pink-100 to-pink-200 w-12 h-12 rounded-xl flex items-center justify-center mx-auto mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div class="text-xs sm:text-sm text-gray-600 font-semibold">Tersimpan</div>
                        </div>
                    </div>

                    {{-- CTA Buttons --}}
                    <div class="cta-buttons space-y-3 sm:space-y-4">
                        <a href="{{ route('home') }}" class="cta-primary block w-full bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white font-black py-4 px-8 rounded-2xl text-base sm:text-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 group" style="opacity: 0;">
                            <span class="flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                Kembali ke Halaman Utama
                                <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-6 w-6 group-hover:translate-x-2 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </span>
                        </a>

                        <a href="{{ route('home') }}#unit-layanan" class="cta-secondary block w-full bg-transparent text-indigo-600 border-2 border-indigo-600 font-bold py-4 px-8 rounded-2xl text-base hover:bg-indigo-600 hover:text-white transition-all duration-300" style="opacity: 0;">
                            Isi Survei Lainnya
                        </a>
                    </div>

                </div>

                {{-- Decorative Footer --}}
                <div class="footer-decoration bg-gradient-to-r from-gray-50 via-slate-50 to-gray-50 px-8 py-6 border-t-2 border-gray-100">
                    <p class="text-sm text-gray-600 text-center font-medium">
                        <span class="inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Data Anda tersimpan dengan aman
                        </span>
                    </p>
                </div>

            </div>

            {{-- Additional Info Cards --}}
            <div class="info-cards grid sm:grid-cols-2 gap-4 mt-8">
                <div class="info-card bg-white/10 backdrop-blur-xl rounded-2xl p-6 border border-white/20 text-center transform hover:scale-105 transition-all" style="opacity: 0;">
                    <div class="bg-yellow-300/20 w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                    </div>
                    <h3 class="text-white font-bold text-sm mb-1">Kontribusi Berharga</h3>
                    <p class="text-white/80 text-xs">Masukan Anda membantu kami berkembang</p>
                </div>
                <div class="info-card bg-white/10 backdrop-blur-xl rounded-2xl p-6 border border-white/20 text-center transform hover:scale-105 transition-all" style="opacity: 0;">
                    <div class="bg-yellow-300/20 w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-white font-bold text-sm mb-1">Peningkatan Layanan</h3>
                    <p class="text-white/80 text-xs">Kami terus berinovasi untuk Anda</p>
                </div>
            </div>

        </div>

        {{-- Decorative Elements --}}
        <div class="confetti-container absolute inset-0 pointer-events-none">
            {{-- Confetti will be added via JavaScript --}}
        </div>

    </section>

    {{-- Optimized Animations for Low-End Devices --}}
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check if GSAP is loaded
            if (typeof gsap === 'undefined') {
                console.warn('GSAP not loaded, showing elements immediately');
                document.querySelectorAll('.thank-you-card, .success-icon, .title-text, .subtitle-badge, .message-box, .stat-item, .cta-primary, .cta-secondary, .footer-decoration, .info-card').forEach(el => {
                    el.style.opacity = '1';
                });
                return;
            }

            // Reduce animations for better performance
            const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

            if (prefersReducedMotion) {
                // Show all elements immediately if user prefers reduced motion
                gsap.set('.thank-you-card, .success-icon, .title-text, .subtitle-badge, .message-box, .stat-item, .cta-primary, .cta-secondary, .footer-decoration, .info-card', {
                    opacity: 1,
                    clearProps: 'all'
                });
                return;
            }

            // === SIMPLIFIED FLOATING SHAPES (Reduced intensity) ===
            gsap.to('.floating-shape', {
                y: 20,
                x: 10,
                duration: 6,
                stagger: 1,
                repeat: -1,
                yoyo: true,
                ease: "sine.inOut"
            });

            // === SIMPLE FADE-IN TIMELINE (Faster, less intensive) ===
            const mainTL = gsap.timeline({
                defaults: {
                    ease: "power2.out",
                    duration: 0.4
                }
            });

            mainTL
                .to('.thank-you-card', {
                    opacity: 1,
                    y: 0
                })
                .to('.success-icon', {
                    opacity: 1,
                    scale: 1
                }, "-=0.2")
                .to('.title-text', {
                    opacity: 1
                }, "-=0.2")
                .to('.subtitle-badge', {
                    opacity: 1
                }, "-=0.2")
                .to('.message-box', {
                    opacity: 1
                }, "-=0.2")
                .to('.stat-item', {
                    opacity: 1,
                    stagger: 0.1
                }, "-=0.2")
                .to('.cta-primary', {
                    opacity: 1
                }, "-=0.2")
                .to('.cta-secondary', {
                    opacity: 1
                }, "-=0.2")
                .to('.footer-decoration', {
                    opacity: 1
                }, "-=0.2")
                .to('.info-card', {
                    opacity: 1,
                    stagger: 0.1
                }, "-=0.2");

            // === MINIMAL CONFETTI (Reduced count for performance) ===
            function createConfetti() {
                const colors = ['#4f46e5', '#9333ea', '#ec4899'];
                const confettiCount = 20; // Reduced from 50 to 20
                const container = document.querySelector('.confetti-container');

                if (!container) return;

                for (let i = 0; i < confettiCount; i++) {
                    const confetti = document.createElement('div');
                    confetti.style.cssText = `
                        position: absolute;
                        width: 8px;
                        height: 8px;
                        background-color: ${colors[Math.floor(Math.random() * colors.length)]};
                        top: -20px;
                        left: ${Math.random() * 100}%;
                        opacity: 0.6;
                        border-radius: 50%;
                    `;
                    container.appendChild(confetti);

                    gsap.to(confetti, {
                        y: window.innerHeight + 50,
                        x: Math.random() * 100 - 50,
                        rotation: Math.random() * 360,
                        duration: Math.random() * 2 + 2,
                        ease: "linear",
                        delay: Math.random() * 0.3,
                        onComplete: () => confetti.remove()
                    });
                }
            }

            // Trigger confetti with delay
            setTimeout(createConfetti, 600);

            // === SIMPLE ICON PULSE (Reduced intensity) ===
            gsap.to('.success-icon svg', {
                scale: 1.05,
                duration: 1.2,
                repeat: -1,
                yoyo: true,
                ease: "sine.inOut"
            });

        });
    </script>
    @endpush

</x-guest-layout>