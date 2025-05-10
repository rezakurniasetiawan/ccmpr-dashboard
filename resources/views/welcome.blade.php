<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LCC MPR RI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        body {
            background-image: url('background tema LCC.jpg');
            background-size: cover;
            background-position: center;
        }

        .tablet-frame {
            width: 600px;
            height: 360px;
            background: #000;
            border: 16px solid #333;
            border-radius: 2rem;
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.4);
            overflow: hidden;
            position: relative;
        }

        .tablet-frame::before {
            content: '';
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 6px;
            background: #444;
            border-radius: 3px;
        }

        .tablet-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* Background dimming effect */
        .backdrop {
            position: fixed;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 40;
            display: none;
        }

        /* Modal with glass effect */
        .modal {
            position: fixed;
            inset: 0;
            z-index: 50;
            display: none;
            justify-content: center;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 1rem;
            padding: 2rem;
            width: 80%;
            max-width: 500px;
            position: relative;
            color: #000;
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
        }

        /* Animasi untuk tombol */
        @keyframes button-click-animation {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(0.9);
            }

            100% {
                transform: scale(1);
            }
        }

        .button-animate {
            animation: button-click-animation 0.3s ease;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center px-4 py-16">

    <div class="max-w-5xl w-full relative">

        <!-- Konten dan Tablet -->
        <div
            class="relative backdrop-blur-md bg-white/20 border border-white/30 p-10 rounded-3xl shadow-2xl text-center text-white overflow-visible z-10">

            <!-- Logo -->
            <img src="logo-LCC-MPR.png" alt="Logo LCC MPR RI" class="mx-auto mb-6 w-32 md:w-40 drop-shadow-lg">

            <!-- Judul -->
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 drop-shadow-lg text-white">LCC MPR RI</h1>
            <p class="text-lg md:text-xl font-medium mb-6 drop-shadow">
                Website Resmi Lomba Cerdas Cermat MPR RI
            </p>

            <!-- Informasi Tambahan -->
            <div class="text-sm md:text-base mb-6 space-y-1 font-light">
                <p><strong>Event:</strong> Lomba Cerdas Cermat Tingkat Nasional</p>
                <p><strong>Diselenggarakan oleh:</strong> Majelis Permusyawaratan Rakyat Republik Indonesia</p>
                <p><strong>Periode:</strong> 2025</p>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center mt-8">
                <a href="javascript:void(0);" onclick="toggleModal(true); animateButton(this);"
                    class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold py-3 px-6 rounded-full shadow-lg transition">
                    <i class="ph ph-download-simple mr-2"></i>Download Aplikasi
                </a>
                <a href="/dashboard"
                    class="bg-white hover:bg-gray-200 text-black font-semibold py-3 px-6 rounded-full shadow-lg transition">
                    <i class="ph ph-sign-in mr-2"></i>Login ke Dashboard
                </a>
            </div>

        </div>
    </div>

    <!-- Backdrop dimming layer -->
    <div id="backdrop" class="backdrop"></div>

    <!-- Modal -->
    <div id="downloadModal" class="modal">
        <div class="modal-content">
            <!-- Tombol close -->
            <button onclick="toggleModal(false)"
                class="absolute top-4 right-4 text-black hover:text-yellow-400 text-2xl">
                <i class="ph ph-x"></i>
            </button>

            <!-- Header -->
            <div class="flex items-center gap-4 mb-4">
                <img src="logo-LCC-MPR.png" alt="Logo App" class="w-16 h-16 rounded-xl shadow-md" />
                <div>
                    <h2 class="text-xl font-bold text-white/80">LCC MPR RI</h2>
                    <p class="text-sm text-white/80">by Kurnia Dev</p>
                    <div class="flex items-center text-sm mt-1">
                        ⭐⭐⭐⭐⭐ <span class="ml-2 text-white/60">(5/5)</span>
                    </div>
                </div>
            </div>

            <!-- Preview -->
            <div class="mb-4">
                <img src="preview-app.jpg" alt="Preview" class="w-full rounded-lg border border-white/20" />
            </div>

            <!-- Deskripsi -->
            <p class="text-sm mb-6 text-white/80">
                Aplikasi resmi Lomba Cerdas Cermat Majelis Permusyawaratan Rakyat Republik Indonesia. Download
                sekarang.
            </p>

            <!-- Tombol unduh -->
            <a href="app-release.apk" download
                onclick="toggleModal(true); animateButton(this);"
                class="w-full bg-yellow-400 hover:bg-yellow-500 text-black font-bold py-3 rounded-full text-center block transition">
                <i class="ph ph-download-simple mr-2"></i>Unduh APK Sekarang
            </a>
        </div>
    </div>

    <script>
        function toggleModal(show) {
            const modal = document.getElementById('downloadModal');
            const backdrop = document.getElementById('backdrop');
            if (show) {
                modal.classList.add('active');
                backdrop.style.display = 'block';
            } else {
                modal.classList.remove('active');
                backdrop.style.display = 'none';
            }
        }

        function animateButton(button) {
            button.classList.add('button-animate');
            setTimeout(() => {
                button.classList.remove('button-animate');
            }, 300); // Durasi animasi 0.3 detik
        }
    </script>


</body>

</html>
