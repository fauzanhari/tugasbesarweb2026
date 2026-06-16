<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Sistem Peningkatan Prestasi</title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .register-container {
            max-width: 500px;
            margin-top: 50px;
            margin-bottom: 50px;
        }
    </style>
</head>
<body>

    <div class="container register-container">
        <div class="card border-0 shadow-sm p-4">
            <div class="text-center mb-4">
                <h3 class="fw-bold text-primary">Buat Akun Baru</h3>
                <p class="text-muted">Daftar untuk mengakses sistem</p>
            </div>

            <!-- Menampilkan pesan error jika ada -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Register -->
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Input Nama -->
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required autofocus>
                </div>

                <!-- Input Email -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email Aktif</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                </div>

                <!-- Input Password -->
                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" required>
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i class="fa-solid fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                <!-- Input Konfirmasi Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirmation">
                            <i class="fa-solid fa-eye" id="eyeIconConfirmation"></i>
                        </button>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg">Daftar Sekarang</button>
                </div>
                
                <div class="text-center mt-3">
                    <a href="{{ route('login') }}" class="text-decoration-none">Sudah punya akun? Masuk di sini</a>
                </div>
            </form>
        </div>
        
        <div class="text-center mt-3">
            <a href="/" class="text-decoration-none text-secondary">Kembali ke Beranda</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function setupPasswordToggle(toggleBtnId, inputId, iconId) {
            const toggleBtn = document.querySelector(toggleBtnId);
            const inputField = document.querySelector(inputId);
            const eyeIcon = document.querySelector(iconId);

            if(toggleBtn && inputField && eyeIcon) {
                toggleBtn.addEventListener('click', function () {
                    const type = inputField.getAttribute('type') === 'password' ? 'text' : 'password';
                    inputField.setAttribute('type', type);
                    
                    if (type === 'password') {
                        eyeIcon.classList.remove('fa-eye-slash');
                        eyeIcon.classList.add('fa-eye');
                    } else {
                        eyeIcon.classList.remove('fa-eye');
                        eyeIcon.classList.add('fa-eye-slash');
                    }
                });
            }
        }

        setupPasswordToggle('#togglePassword', '#password', '#eyeIcon');
        setupPasswordToggle('#togglePasswordConfirmation', '#password_confirmation', '#eyeIconConfirmation');
    </script>
</body>
</html>
