<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>EasyParki - EasyParki Bootstrap Template</title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <style>
    /* Dropdown styling */
    .nav-item.dropdown {
      position: relative;
    }
  
    .dropdown-menu {
      display: none;
      position: absolute;
      top: 100%;
      left: 0;
      min-width: 220px;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.15);
      padding: 10px 0;
      opacity: 0;
      transform: translateY(10px);
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      z-index: 1000;
    }
  
    .nav-item.dropdown:hover .dropdown-menu {
      display: block;
      opacity: 1;
      transform: translateY(0);
    }
  
    .dropdown-item {
      padding: 12px 20px;
      color: #0a1d37 !important;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 10px;
      transition: all 0.2s ease;
      position: relative;
      overflow: hidden;
    }
  
    .dropdown-item:before {
      content: '';
      position: absolute;
      left: -100%;
      top: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, #4da6ff33 0%, #0a1d3733 100%);
      transition: all 0.3s ease;
      z-index: -1;
    }
  
    .dropdown-item:hover {
      padding-left: 25px;
      color: #0a1d37 !important;
    }
  
    .dropdown-item:hover:before {
      left: 0;
    }
  
    .dropdown-item i {
      color: #4da6ff;
      font-size: 1.2em;
      transition: all 0.3s ease;
    }
  
    .dropdown-item:hover i {
      transform: scale(1.1);
    }
    /* Add custom card styles */
    .hotel-cards {
      padding: 50px 0;
    }

    .hotel-card {
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.1);
      transition: all 0.3s ease;
      margin-bottom: 30px;
      overflow: hidden;
    }

    .hotel-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 32px rgba(0,0,0,0.15);
    }

    .card-header {
      background: #0a1d37;
      color: #fff;
      padding: 20px;
      position: relative;
    }

    .card-category {
      position: absolute;
      top: 15px;
      right: 15px;
      background: #4da6ff;
      padding: 5px 15px;
      border-radius: 20px;
      font-size: 0.9em;
    }

    .card-body {
      padding: 25px;
    }

    .hotel-info {
      margin-bottom: 15px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .hotel-info i {
      color: #4da6ff;
      font-size: 1.2em;
      width: 25px;
      text-align: center;
    }

    .parking-status {
      display: flex;
      justify-content: space-between;
      background: #f8f9fa;
      padding: 15px;
      border-radius: 10px;
      margin-top: 20px;
    }

    .available-spaces {
      color: #28a745;
      font-weight: 600;
    }
  </style>

  <!-- Favicons -->
  <link href="assets/img/logoo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

</head>

<body class="Transport public-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
    <a href="about.php" class="logo d-flex align-items-center me-auto">
        <h1 class="sitename">EasyParki</h1>
      </a>

      <nav id="navmenu" class="navmenu">
  <ul>
    <li><a href="index.html">Home</a></li>
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
            List Plans Vacances
          </a>
        </li>
      </ul>
    </li>
    <li><a href="Covoiturage.html">Covoiturage</a></li>
    <li><a href="Recharge.html">Service</a></li>
    <li><a href="Evenement.html">Evenement</a></li>
    <li><a href="contact.html">Contact</a></li>
  </ul>
  <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
</nav>

      <a class="btn-getstarted" href="get-a-quote.html">Créer un compte</a>

    </div>
  </header>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/44.jpeg);">
      <div class="container position-relative">
      <h1>Réservez votre hôtel de rêve</h1>
      <p>Parcourez notre collection d'hôtels soigneusement sélectionnés pour répondre à toutes vos envies, du charme authentique au luxe contemporain.</p>
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Vacances</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->
    <?php
    include "../../../Controller/HotelC.php";
    $c = new HotelC();
    $tab = $c->listHotels();
    ?>

    <section class="hotel-cards">
      <div class="container" data-aos="fade-up">
        <div class="row">
          <?php foreach ($tab as $hotel) { ?>
            <div class="col-lg-4 col-md-6">
              <div class="hotel-card">
                <div class="card-header">
                  <h3><?= $hotel['nom_hotel'] ?></h3>
                  <span class="card-category"><?= $hotel['categorie'] ?> Stars</span>
                </div>
                <div class="card-body">
                  <div class="hotel-info">
                    <i class="bi bi-geo-alt"></i>
                    <div>
                      <p class="mb-0"><?= $hotel['adresse'] ?></p>
                      <p class="mb-0 text-muted"><?= $hotel['ville'] ?></p>
                    </div>
                  </div>

                  <div class="parking-status">
                    <div>
                      <p class="mb-0 small text-muted">Total Parking</p>
                      <p class="mb-0"><?= $hotel['nombre_places_parking'] ?> Spaces</p>
                    </div>
                    <div>
                      <p class="mb-0 small text-muted">Available Now</p>
                      <p class="mb-0 available-spaces"><?= $hotel['places_parking_disponibles'] ?> Spaces</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
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
        <p>EasyParki est une plateforme intelligente et centralisée qui facilite la mobilité urbaine durable en offrant des solutions intégrées pour le stationnement, le covoiturage, les transports publics, la recharge électrique et la gestion d’événements.</p>
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
      <!-- Tous les liens dans le footer doivent rester intacts. -->
      <!-- Vous pouvez supprimer les liens uniquement si vous avez acheté la version pro. -->
      <!-- Informations sur la licence : https://bootstrapmade.com/license/ -->
      <!-- Achetez la version pro avec un formulaire de contact PHP/AJAX fonctionnel : [buy-url] -->
      Designé par <a href="https://bootstrapmade.com/">Asteria</a>
    </div>
  </div>

</footer>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

<!-- Main JS File -->
<script src="assets/js/main.js"></script>

</body>

</html>
