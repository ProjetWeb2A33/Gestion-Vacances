<?php
session_start();

// Check if we have success data in the session
if (!isset($_SESSION['plan_success']) || !$_SESSION['plan_success']) {
    // Redirect to the form page if no success data
    header('Location: addplanVacancefront.php');
    exit;
}

// Get the email from session
$email = $_SESSION['plan_email'] ?? '';

// Clear the session data after displaying it
$_SESSION['plan_success'] = false;
$_SESSION['plan_email'] = '';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>EasyParki - Succès</title>
  <meta name="description" content="Planifiez vos vacances en toute simplicité avec EasyParki">
  <meta name="keywords" content="vacances, hôtels, réservation, voyage, planification">

  <!-- Favicons -->
  <link href="assets/img/logoo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <style>
    :root {
      --primary-color: #0d3f72;
      --primary-dark: #08284d;
      --secondary-color: #0a1d37;
      --accent-color: #3a5cb3;
      --light-color: #f8fafc;
      --dark-color: #2d3748;
      --text-color: #4a5568;
      --section-bg: #f5f7fa;
      --card-bg: #ffffff;
      --border-color: rgba(0,0,0,0.08);
      --gradient: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
    }

    .success-container {
      padding: 100px 0;
      text-align: center;
    }

    .success-card {
      background: white;
      border-radius: 15px;
      padding: 40px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
      max-width: 600px;
      margin: 0 auto;
    }

    .success-icon {
      font-size: 5rem;
      color: #28a745;
      margin-bottom: 20px;
      animation: bounce 1s ease;
    }

    .success-title {
      font-size: 2rem;
      color: var(--secondary-color);
      margin-bottom: 20px;
    }

    .success-message {
      color: var(--text-color);
      margin-bottom: 30px;
    }

    .success-btn {
      background: var(--gradient);
      color: white;
      padding: 12px 30px;
      border-radius: 50px;
      text-decoration: none;
      font-weight: 600;
      display: inline-block;
      transition: all 0.3s ease;
    }

    .success-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    @keyframes bounce {
      0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
      40% {transform: translateY(-30px);}
      60% {transform: translateY(-15px);}
    }
  </style>
</head>

<body>
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
      <a href="about.php" class="logo d-flex align-items-center me-auto">
        <h1 class="sitename">EasyParki</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.html">Accueil</a></li>
          <li><a href="Stationnement.html">Stationnement</a></li>
          <li class="dropdown">
            <a href="transport public.html" class="active">Vacances</a>
            <ul class="dropdown-menu">
              <li>
                <a href="listHotelsfront.php" class="dropdown-item">
                  <i class="bi bi-building"></i>
                  Voir Les Hôtels
                </a>
              </li>
              <li>
                <a href="addplanVacancefront.php" class="dropdown-item">
                  <i class="bi bi-calendar-plus"></i>
                  Planifier Vacance
                </a>
              </li>
              <li>
                <a href="listplansVacancefront.php" class="dropdown-item">
                  <i class="bi bi-list-task"></i>
                 Accéder à mon plan
                </a>
              </li>
            </ul>
          </li>
          <li><a href="Covoiturage.html">Covoiturage</a></li>
          <li><a href="Recharge.html">Service</a></li>
          <li><a href="Evenement.html">Événement</a></li>
          <li><a href="contact.html">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="get-a-quote.html">Créer un compte</a>
    </div>
  </header>

  <main class="main">
    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/55.png);">
      <div class="container position-relative">
        <h1>Succès</h1>
        <p>Votre plan de vacances a été créé avec succès</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li><a href="addplanVacancefront.php">Vacances</a></li>
            <li class="current">Succès</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <section class="success-container">
      <div class="container">
        <div class="success-card">
          <i class="bi bi-check-circle-fill success-icon"></i>
          <h2 class="success-title">Félicitations!</h2>
          <div class="success-message">
            <p>Votre plan de vacances a été créé avec succès!</p>
            <?php if (!empty($email)): ?>
            <p>Un email de confirmation a été envoyé à l'adresse <strong><?php echo htmlspecialchars($email); ?></strong>.</p>
            <?php endif; ?>
            <p>Vous pouvez consulter les détails de votre plan dans la section "Accéder à mon plan".</p>
          </div>
          <div class="mt-4">
            <a href="listplansVacancefront.php" class="success-btn me-2">
              <i class="bi bi-list-check me-2"></i>Voir mon plan
            </a>
            <a href="about.php" class="success-btn">
              <i class="bi bi-house me-2"></i>Accueil
            </a>
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer id="footer" class="footer dark-background">
    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">EasyParki</span>
          </a>
          <p>EasyParki est une plateforme intelligente et centralisée qui facilite la mobilité urbaine durable en offrant des solutions intégrées pour le stationnement, le covoiturage, les transports publics, la recharge électrique et la gestion d'événements.</p>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Liens utiles</h4>
          <ul>
            <li><a href="#">Accueil</a></li>
            <li><a href="#">À propos de nous</a></li>
            <li><a href="#">Nos services</a></li>
            <li><a href="#">Conditions d'utilisation</a></li>
            <li><a href="#">Politique de confidentialité</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Nos services</h4>
          <ul>
            <li><a href="#">Stationnement</a></li>
            <li><a href="#">Vacances</a></li>
            <li><a href="#">Covoiturage</a></li>
            <li><a href="#">Recharges électriques</a></li>
            <li><a href="#">Evenement</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Contactez-nous</h4>
          <p>18, rue de l'Usine </p>
          <p> ZI Aéroport Charguia II 2035 Ariana</p>
          <p>Tunisie</p>
          <p class="mt-4"><strong>Téléphone :</strong> <span>+216 50 084 004</span></p>
          <p><strong>Email :</strong> <span>contact@easyparki.com</span></p>
        </div>
      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">EasyParki</strong> <span>Tous droits réservés</span></p>
      <div class="credits">
        Designé par <a href="https://bootstrapmade.com/">Asteria</a>
      </div>
    </div>
  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>
</body>
</html>
