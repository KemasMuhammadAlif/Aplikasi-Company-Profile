<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - PT Berkah Alam Tabantang</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      height: 100vh;
      background: url(image.png) no-repeat center center/cover;
      position: relative;
    }

    body::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.6);
      z-index: 0;
    }

    .login-card {
      z-index: 1;
      position: relative;
      border-radius: 12px;
      padding: 30px;
    }

    .form-control {
      height: 45px;
      border-radius: 8px;
    }

    .btn-primary {
      border-radius: 8px;
      height: 45px;
      font-weight: 500;
    }

    .top-bar {
      position: absolute;
      top: 20px;
      left: 20px;
      color: white;
      z-index: 2;
      font-weight: bold;
    }

    .back-home {
      position: absolute;
      top: 20px;
      right: 20px;
      color: white;
      text-decoration: none;
      z-index: 2;
    }

    .footer {
      position: absolute;
      bottom: 10px;
      width: 100%;
      text-align: center;
      color: #ddd;
      font-size: 12px;
      z-index: 2;
    }

    .top-bar img {
      width: 50px;
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 576px) {
      .top-bar {
        top: 14px;
        left: 14px;
        font-size: 13px;
      }

      .top-bar img {
        width: 30px;
        height: auto;
      }

      .back-home {
        top: 14px;
        right: 14px;
        font-size: 13px;
      }

      .login-card {
        padding: 24px 20px;
        border-radius: 10px;
      }

      .login-card h4 {
        font-size: 18px;
      }

      .footer {
        font-size: 11px;
        padding: 0 16px;
      }
    }

    @media (max-width: 768px) {
      .container {
        padding: 0 16px;
      }
    }
  </style>
</head>

<body>

  <div class="top-bar">
    <img src="{{ $logoPerusahaan ? asset('storage/' . $logoPerusahaan) : asset('logo.png') }}" alt="PT BAT" style="height: 36px; width: auto;">
    PT Berkah Alam Tabantang
  </div>

  <a href= "{{ route('homepage') }}" class="back-home">← Back to Home</a>

  <div class="container d-flex justify-content-center align-items-center h-100">
    <div class="card login-card shadow" style="max-width: 400px; width: 100%;">

      <h4 class="fw-bold">PT. BERKAH ALAM TABANTANG</h4>
      <small class="text-muted mb-3 d-block">Perusahaan Konstruksi yang Profesional</small>

      {{-- Tampilkan pesan error login --}}
      @if ($errors->any())
        <div class="alert alert-danger py-2">
          {{ $errors->first() }}
        </div>
      @endif

      {{-- Tampilkan pesan sukses (opsional) --}}
      @if (session('success'))
        <div class="alert alert-success py-2">
          {{ session('success') }}
        </div>
      @endif

      {{-- PENTING: tambah method POST, action, dan @csrf --}}
      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
          <label class="form-label">Nama Pengguna</label>
          <input type="text" name="username" {{-- tambah name --}}
            class="form-control @error('username') is-invalid @enderror" placeholder="Masukan nama pengguna"
            value="{{ old('username') }}"> {{-- ingat input sebelumnya --}}
          @error('username')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-2 d-flex justify-content-between">
          <label class="form-label">Kata Sandi</label>
        </div>

        <div class="mb-3">
          <input type="password" name="password" {{-- tambah name --}}
            class="form-control @error('password') is-invalid @enderror" placeholder="Masukan kata sandi">
          @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100">
          Masuk →
        </button>

        <div class="text-center mt-3">
        </div>
      </form>

    </div>
  </div>

  <div class="footer">
    © 2024 PT. BERKAH ALAM TABANTANG. All rights reserved.
  </div>

</body>

</html>