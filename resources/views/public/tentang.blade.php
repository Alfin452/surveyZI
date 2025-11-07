{{-- Menggunakan komponen layout guest.blade.php --}}
<x-guest-layout title="Tentang Kami - Survei UIN Antasari">

    {{-- Kita tambahkan ID 'tentang' agar link navigasi bisa aktif --}}
    <main id="tentang" class="section-nav container mx-auto px-4 sm:px-6 lg:px-8 py-12 mt-10">
        <div class="bg-white rounded-2xl shadow-xl p-8 sm:p-12">
            <div class="prose prose-lg max-w-none prose-indigo">

                {{-- Tambahkan kelas 'section-title-anim' untuk animasi fade-in --}}
                <h1 class="section-title-anim text-4xl font-extrabold text-gray-900 tracking-tight">Tentang Aplikasi Survei Ini</h1>

                <p class="section-title-anim" style="animation-delay: 0.1s;">Selamat datang di Aplikasi Survei Kepuasan Layanan UIN Antasari Banjarmasin. Platform ini dirancang untuk menjembatani suara Anda dengan para pengambil kebijakan di universitas.</p>

                <h2 class="section-title-anim" style="animation-delay: 0.2s;">Misi Kami</h2>
                <p class="section-title-anim" style="animation-delay: 0.3s;">Misi kami adalah menyediakan alat yang transparan, efisien, dan mudah diakses bagi seluruh civitas akademika dan masyarakat umum untuk memberikan masukan yang konstruktif. Kami percaya bahwa partisipasi aktif dari responden adalah kunci untuk peningkatan kualitas layanan yang berkelanjutan.</p>

                <h2 class="section-title-anim" style="animation-delay: 0.4s;">Arsitektur Aplikasi</h2>
                <p class="section-title-anim" style="animation-delay: 0.5s;">Aplikasi ini dibangun menggunakan arsitektur "Survei Terpusat" yang efisien:</p>
                <ul class="section-title-anim" style="animation-delay: 0.6s;">
                    <li><strong>Program Survei (Wadah):</strong> Dikelola oleh Super Admin, program ini (seperti "Survei Zona Integritas") menetapkan tema, target unit kerja, dan **semua pertanyaan** secara terpusat.</li>
                    <li><strong>Admin Unit Kerja (Analis):</strong> Admin di setiap unit kerja tidak lagi membuat survei, melainkan bertugas untuk **memantau dan menganalisis hasil** jawaban yang masuk khusus untuk unit mereka.</li>
                    <li><strong>Responden (Anda):</strong> Anda dapat memilih program yang diminati, memilih unit layanan yang ingin Anda nilai, dan memberikan masukan langsung pada pertanyaan-pertanyaan yang telah disiapkan secara terpusat.</li>
                </ul>

                <h2 class="section-title-anim" style="animation-delay: 0.7s;">Privasi Anda</h2>
                <p class="section-title-anim" style="animation-delay: 0.8s;">Kami menjamin kerahasiaan data pribadi Anda. Jawaban yang Anda berikan akan dianalisis secara agregat (keseluruhan) dan tidak akan pernah ditampilkan dalam bentuk data individual. Kejujuran Anda sangat kami hargai.</p>
            </div>
        </div>
    </main>

</x-guest-layout>