<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Success - TR Rental</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>/public/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <style>
        :root { --primary: #5B2D8E; }
        * { font-family: 'Segoe UI', sans-serif; }
        body { background: #EAE4F3; min-height: 100vh; display: flex; align-items: center; }
        .success-card {
            background: #fff;
            border-radius: 20px;
            padding: 50px 40px;
            text-align: center;
            box-shadow: 0 8px 30px rgba(91,45,142,.15);
        }
        .icon-circle {
            width: 90px; height: 90px;
            background: #f3eeff;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 25px;
        }
        .icon-circle i { font-size: 2.5rem; color: var(--primary); }
        h3 { font-weight: 800; color: #1a1a1a; margin-bottom: 12px; }
        p { color: #777; font-size: .95rem; line-height: 1.6; }
        .btn-home {
            background: var(--primary);
            color: #fff;
            border-radius: 25px;
            padding: 12px 35px;
            font-weight: 600;
            border: none;
            margin-top: 25px;
            display: inline-block;
            text-decoration: none;
            transition: all .3s;
        }
        .btn-home:hover {
            background: #7B4DB8;
            color: #fff;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="success-card">
                <div class="icon-circle">
                    <i class="fas fa-check"></i>
                </div>
                <h3>Booking Successful!</h3>
                <p>Thank you! Your booking has been received. Our team will contact you via WhatsApp shortly to confirm your rental.</p>
                <a href="<?= BASE_URL ?>" class="btn-home">
                    <i class="fas fa-home mr-2"></i> Back to Home
                </a>
            </div>
        </div>
    </div>
</div>
</body>
</html>