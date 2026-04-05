<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>/public/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #5B2D8E;
            --primary-light: #7B4DB8;
            --primary-bg: #EAE4F3;
            --accent: #7B4DB8;
        }
        * { font-family: 'Segoe UI', sans-serif; }
        body { background: #fff; overflow-x: hidden; }

        /* Navbar */
        .navbar { background: #fff; box-shadow: 0 2px 10px rgba(0,0,0,.08); padding: 12px 0; }
        .navbar-brand img { height: 45px; }
        .nav-link { color: #333 !important; font-weight: 500; }
        .nav-link.active, .nav-link:hover { color: var(--primary) !important; }
        .btn-nav-active {
            background: var(--primary); color: #fff !important;
            border-radius: 25px; padding: 8px 24px !important;
        }
        .btn-nav-active:hover { background: var(--primary-light); }

        /* Hero */
        .hero {
            background: #EAE4F3;
            padding: 80px 0 0 0;
            min-height: 500px;
            position: relative;
            overflow: hidden;
        }
        .hero h1 { font-size: 2.8rem; font-weight: 800; color: #1a1a1a; line-height: 1.2; }
        .hero p { color: #555; font-size: 1.05rem; margin: 20px 0 30px; }
        .btn-explore {
            background: var(--primary); color: #fff;
            border-radius: 25px; padding: 12px 30px;
            font-weight: 600; border: none;
            transition: all .3s;
        }
        .btn-explore:hover { background: var(--primary-light); color: #fff; transform: translateY(-2px); }
        .hero-img { max-height: 380px; }

        /* About Section */
        .section-about {
            background: var(--primary);
            color: #fff;
            padding: 60px 0;
        }
        .section-about h2 { font-weight: 800; font-size: 2rem; }
        .section-about p { opacity: .9; }
        .section-about a { color: #fff; font-style: italic; text-decoration: underline; }

        /* How It Works */
        .how-it-works { padding: 70px 0; background: #EAE4F3; }
        .how-it-works h2 { font-weight: 800; text-align: center; margin-bottom: 50px; }
        .step-card {
            background: #fff;
            border-radius: 16px;
            padding: 30px 25px;
            height: 100%;
            box-shadow: 0 4px 15px rgba(91,45,142,.1);
        }
        .step-number {
            width: 45px; height: 45px;
            background: var(--primary);
            color: #fff; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: 800; font-size: 1.2rem;
            margin-bottom: 15px;
        }
        .step-card h5 { font-weight: 700; }
        .step-card p { color: #777; font-size: .9rem; }

        /* Why Us */
        .why-us { padding: 70px 0; }
        .why-us h2 { font-weight: 800; font-size: 2rem; }
        .why-card {
            background: var(--primary);
            color: #fff;
            border-radius: 16px;
            padding: 25px 20px;
            height: 100%;
            transition: transform .2s;
        }
        .why-card:hover { transform: translateY(-5px); }
        .why-card i { font-size: 1.8rem; margin-bottom: 12px; }
        .why-card h6 { font-weight: 700; font-size: 1rem; }
        .why-card p { font-size: .85rem; opacity: .9; margin: 0; }

        /* FAQ */
        .faq-section { padding: 70px 0; background: #EAE4F3; }
        .faq-section h2 { font-weight: 800; text-align: center; margin-bottom: 40px; }
        .faq-item {
            background: #fff;
            border-radius: 12px;
            margin-bottom: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,.06);
        }
        .faq-question {
            padding: 18px 20px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .faq-answer { padding: 0 20px 18px; color: #666; display: none; }
        .faq-toggle {
            width: 30px; height: 30px;
            background: var(--primary);
            color: #fff; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        /* Reviews */
        .reviews-section { padding: 70px 0; }
        .reviews-section h2 { font-weight: 800; text-align: center; margin-bottom: 40px; }
        .review-box {
            background: var(--primary);
            border-radius: 16px;
            padding: 30px;
            color: #fff;
        }
        .review-item { margin-bottom: 20px; }
        .review-item:last-child { margin-bottom: 0; }
        .stars { color: #FFD700; font-size: 1.1rem; margin-bottom: 5px; }
        .review-text { font-style: italic; opacity: .95; }
        .review-author { font-weight: 600; margin-top: 5px; opacity: .85; font-size: .9rem; }
        .btn-write-review {
            background: #fff; color: var(--primary);
            border-radius: 25px; padding: 8px 20px;
            font-weight: 600; border: none;
            float: right; margin-bottom: 20px;
        }

        /* Footer */
        footer {
            background: #1a1a1a;
            color: #aaa;
            padding: 25px 0;
            text-align: center;
        }
        footer .social-icons a { color: #aaa; margin: 0 8px; font-size: 1.2rem; }
        footer .social-icons a:hover { color: #fff; }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="<?= BASE_URL ?>">
            <img src="<?= BASE_URL ?>/public/assets/img/logo.png" alt="TR Rental">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ml-auto align-items-center">
                <li class="nav-item"><a class="nav-link" href="#about">About Us</a></li>
                <li class="nav-item ml-2">
                    <a class="nav-link btn-nav-active" href="<?= BASE_URL ?>/home/products">Products</a>
                </li>
                <li class="nav-item ml-2"><a class="nav-link" href="#contact">Contact Us</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero -->
<section class="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1>Easy Motorbike & Car Rental in Bali</h1>
                <p>Rent motorbikes and cars easily and explore Bali with comfort and flexibility — all in one platform. Find the vehicle you need, choose your rental dates, and book in just a few simple steps.</p>
                <a href="<?= BASE_URL ?>/home/products" class="btn btn-explore">
                    Explore Categories &rarr;
                </a>
            </div>
            <div class="col-lg-6 text-center mt-4 mt-lg-0">
                <img src="<?= BASE_URL ?>/public/assets/img/hero.png"
                    class="img-fluid hero-img" alt="TR Rental">
            </div>
        </div>
    </div>
</section>

<!-- About -->
<section class="section-about" id="about">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4 text-center mb-4 mb-md-0">
                <img src="<?= BASE_URL ?>/public/assets/img/about.png"
                    class="img-fluid" style="max-height:280px" alt="About">
            </div>
            <div class="col-md-8">
                <h2>Your Bali Motorbike & Car Rental in One Place</h2>
                <p class="mt-3">Our platform makes motorbike and car rental in Bali simple and convenient. Browse vehicles, choose your rental dates, and book easily online. You can choose delivery to your location or pickup at our office, and receive a downloadable invoice after booking.</p>
                <a href="#">Simple Booking. Flexible Rental. Explore Bali with Ease.</a>
            </div>
        </div>
    </div>
</section>

<!-- How It Works -->
<section class="how-it-works">
    <div class="container">
        <h2>How It Works</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <h5>Choose Your Motorbike</h5>
                    <p>Browse available motorbikes and select the one that suits your needs.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="step-card">
                    <div class="step-number">2</div>
                    <h5>Set Your Rental Schedule</h5>
                    <p>Choose pickup date and return date easily through the booking form.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="step-card">
                    <div class="step-number">3</div>
                    <h5>Confirm Your Booking</h5>
                    <p>Download your invoice and wait for confirmation via WhatsApp.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Us -->
<section class="why-us">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-md-6">
                <h2>Why Rent with TRrental?</h2>
                <p class="text-muted">We make motorbike rental in Bali simple, safe, and convenient. Book your ride easily and explore Bali with confidence.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="why-card">
                    <i class="fas fa-check-circle"></i>
                    <h6>Verified Motorbikes</h6>
                    <p>All motorbikes on our platform are checked to ensure they are in good condition and ready for a safe ride.</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="why-card">
                    <i class="fas fa-tags"></i>
                    <h6>Transparent Pricing</h6>
                    <p>No hidden fees. Compare rental prices and choose the motorbike that fits your budget.</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="why-card">
                    <i class="fab fa-whatsapp"></i>
                    <h6>Fast WhatsApp Confirmation</h6>
                    <p>After booking, our team will quickly confirm your rental through WhatsApp.</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="why-card">
                    <i class="fas fa-map-marker-alt"></i>
                    <h6>Flexible Pickup Options</h6>
                    <p>Choose between motorbike delivery to your location or pickup at our rental office.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="faq-section">
    <div class="container">
        <h2>Need to Know</h2>
        <div class="col-lg-8 mx-auto px-0">
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    Do I need a passport?
                    <span class="faq-toggle"><i class="fas fa-plus"></i></span>
                </div>
                <div class="faq-answer">Yes, a passport is required as a rental deposit during the rental period.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    Can you deliver the motorbike?
                    <span class="faq-toggle"><i class="fas fa-plus"></i></span>
                </div>
                <div class="faq-answer">Yes, we offer delivery to your hotel or location in Bali for an additional fee.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    How do I confirm my booking?
                    <span class="faq-toggle"><i class="fas fa-plus"></i></span>
                </div>
                <div class="faq-answer">After submitting the booking form, our team will contact you via WhatsApp to confirm.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    Where can I pick up the motorbike?
                    <span class="faq-toggle"><i class="fas fa-plus"></i></span>
                </div>
                <div class="faq-answer">You can pick up at our office or request delivery to your location.</div>
            </div>
        </div>
    </div>
</section>

<!-- Reviews -->
<section class="reviews-section">
    <div class="container">
        <h2>Customer Reviews</h2>
        <div class="col-lg-8 mx-auto px-0">
            <div class="review-box">
                <button class="btn-write-review">Write Review</button>
                <div class="clearfix"></div>
                <div class="review-item">
                    <div class="stars">★★★★★</div>
                    <div class="review-text">"Very easy booking and the motorbike was in great condition."</div>
                    <div class="review-author">— Daniel, Australia</div>
                </div>
                <div class="review-item">
                    <div class="stars">★★★★★</div>
                    <div class="review-text">"Very easy booking and the motorbike was in great condition."</div>
                    <div class="review-author">— Daniel, Australia</div>
                </div>
                <div class="review-item">
                    <div class="stars">★★★★★</div>
                    <div class="review-text">"Very easy booking and the motorbike was in great condition."</div>
                    <div class="review-author">— Daniel, Australia</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer id="contact">
    <div class="container">
        <div class="social-icons mb-2">
            <a href="#"><i class="fas fa-envelope"></i></a>
            <a href="#"><i class="fab fa-whatsapp"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
        <p class="mb-0 small">Copyright &copy; <?= date('Y') ?> TR Rental</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
function toggleFaq(el) {
    const answer = el.nextElementSibling;
    const icon   = el.querySelector('.faq-toggle i');
    const isOpen = answer.style.display === 'block';
    // tutup semua
    document.querySelectorAll('.faq-answer').forEach(a => a.style.display = 'none');
    document.querySelectorAll('.faq-toggle i').forEach(i => {
        i.classList.remove('fa-minus');
        i.classList.add('fa-plus');
    });
    if (!isOpen) {
        answer.style.display = 'block';
        icon.classList.remove('fa-plus');
        icon.classList.add('fa-minus');
    }
}
</script>
</body>
</html>