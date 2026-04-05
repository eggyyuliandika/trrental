<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login - TR Rental</title>
    <link href="<?= BASE_URL ?>/public/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>/public/assets/css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        body { background: #4e73df; }
        .card-login { border-radius: 1rem; }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-xl-5 col-lg-6 col-md-8">
            <div class="card shadow-lg card-login">
                <div class="card-body p-5">

                    <div class="text-center mb-4">
                        <h1 class="h3 text-gray-900 font-weight-bold">🚗 TR Rental</h1>
                        <p class="text-muted">Silakan login untuk melanjutkan</p>
                    </div>

                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger text-center">
                            <i class="fas fa-exclamation-circle"></i> <?= $error ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?= BASE_URL ?>/auth/login">
                        <div class="form-group">
                            <label>Username</label>
                            <div class="input-group">
                                <input type="text" name="username" class="form-control form-control-lg"
                                    placeholder="Masukkan username" required autofocus>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control form-control-lg"
                                    placeholder="Masukkan password" required>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg btn-block mt-4">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= BASE_URL ?>/public/assets/vendor/jquery/jquery.min.js"></script>
<script src="<?= BASE_URL ?>/public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>