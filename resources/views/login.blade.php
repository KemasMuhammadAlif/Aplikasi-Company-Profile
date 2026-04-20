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
      background: url(background.png) no-repeat center center/cover;
      position: relative;
    }

    /* Overlay gelap */
    body::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 51, 102, 0.6);
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
  </style>
</head>

<body>

  <!-- Header -->
  <div class="top-bar">
     <img src="logo.png" alt="logo">
        PT Berkah Alam Tabantang
  </div>

  <a href="#" class="back-home">← Back to Home</a>

  <!-- Login Card -->
  <div class="container d-flex justify-content-center align-items-center h-100">
    <div class="card login-card shadow" style="width: 400px;">
      
      <h4 class="fw-bold">PT. BERKAH ALAM TABANTANG</h4>
      <small class="text-muted mb-3 d-block">Professional Construction Services</small>

      <form>
        <div class="mb-3">
          <label class="form-label">Username</label>
          <input type="text" class="form-control" placeholder="Enter your username">
        </div>

        <div class="mb-2 d-flex justify-content-between">
          <label class="form-label">Password</label>

        </div>

        <div class="mb-3">
          <input type="password" class="form-control" placeholder="Enter your password">
        </div>

        <button type="submit" class="btn btn-primary w-100">
          Sign In →
        </button>

        <div class="text-center mt-3">
          <a href="#" class="small">Forgot Password?</a>
        </div>
      </form>

    </div>
  </div>

  <!-- Footer -->
  <div class="footer">
    © 2024 PT. BERKAH ALAM TABANTANG. All rights reserved.
  </div>

</body>
</html>