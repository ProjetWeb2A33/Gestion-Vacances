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
          <li><a href="Recharge.html">Recharge</a></li>
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
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/ey.png);">
      <div class="container position-relative">
        <h1>Vacances</h1>
        <p>Gérez vos vacances en toute simplicité : consultez les destinations, planifiez vos activités et optimisez vos séjours pour une expérience inoubliable.</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Vacances</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- About Section -->
<section id="about" class="about section">

  <div class="container">

    <div class="row gy-4">

      <div class="col-lg-6 position-relative align-self-start order-lg-last order-first" data-aos="fade-up" data-aos-delay="200">
        <img src="assets/img/locc.png" class="img-fluid" alt="Transport Public">
      </div>
      <div class="col-lg-6 content order-last order-lg-first" data-aos="fade-up" data-aos-delay="100">
  <h3>À propos de notre Service de vacances</h3>
  <p>
    Nous proposons une solution de transport intelligente et personnalisée pour vos déplacements durant vos vacances. Notre objectif est d'assurer une expérience de transport fluide, pratique et écologique, tout en vous offrant une gestion facile et optimisée de vos réservations.
  </p>
  <ul>
    <li>
      <i class="bi bi-diagram-3"></i>
      <div>
        <h5>Accessibilité et Flexibilité pour Tous</h5>
        <p>Nous offrons des options de transport disponibles pour toutes les zones touristiques et les points d'intérêt, adaptées aux besoins spécifiques des voyageurs, y compris des solutions accessibles pour les personnes à mobilité réduite.</p>
      </div>
    </li>
    <li>
      <i class="bi bi-fullscreen-exit"></i>
      <div>
        <h5>Innovation et Suivi en Temps Réel</h5>
        <p>Grâce à la technologie de suivi en temps réel et à l'optimisation des trajets, nous vous garantissons des déplacements plus rapides, plus fiables, et une réduction de l'empreinte écologique tout en profitant de vacances sereines.</p>
      </div>
    </li>
    <li>
      <i class="bi bi-broadcast"></i>
      <div>
        <h5>Réservation Simplifiée et Garantie de Confort</h5>
        <p>Réservez facilement votre transport en ligne en quelques clics. Notre plateforme de réservation vous permet de planifier vos trajets de manière rapide, avec la garantie d'un service ponctuel et adapté à vos besoins durant vos vacances.</p>
      </div>
    </li>
  </ul>
</div>

</div>

</div>

</section><!-- /About Section -->

  <!-- Stats Section -->
<section id="stats" class="stats section">

<div class="container" data-aos="fade-up" data-aos-delay="100">

  <div class="row gy-4">

    <div class="col-lg-3 col-md-6">
      <div class="stats-item text-center w-100 h-100">
        <span data-purecounter-start="0" data-purecounter-end="1500" data-purecounter-duration="1" class="purecounter"></span>
        <p>Réservations Effectuées</p>
      </div>
    </div><!-- End Stats Item -->

    <div class="col-lg-3 col-md-6">
      <div class="stats-item text-center w-100 h-100">
        <span data-purecounter-start="0" data-purecounter-end="320" data-purecounter-duration="1" class="purecounter"></span>
        <p>Transports Disponibles</p>
      </div>
    </div><!-- End Stats Item -->

    <div class="col-lg-3 col-md-6">
      <div class="stats-item text-center w-100 h-100">
        <span data-purecounter-start="0" data-purecounter-end="220" data-purecounter-duration="1" class="purecounter"></span>
        <p>Réservations Confirmées</p>
      </div>
    </div><!-- End Stats Item -->

    <div class="col-lg-3 col-md-6">
      <div class="stats-item text-center w-100 h-100">
        <span data-purecounter-start="0" data-purecounter-end="24" data-purecounter-duration="1" class="purecounter"></span>
        <p>Transport Utilisé Aujourd'hui</p>
      </div>
    </div><!-- End Stats Item -->

  </div>

</div>

</section>
<!-- End Stats Section -->

</section><!-- /Stats Section -->
<section id="team" class="team section">
  <div class="container section-title" data-aos="fade-up">
    <span>Nos transports<br></span>
    <h2>Nos transports</h2>
    <p>Choisissez le transport qui vous convient.</p>
  </div>

  <div class="container">
    <div class="row">

    

    </div>

   
    </div>

  </div>
</section>
<script>
  function showForm(type) {
    const form = document.getElementById('reservation-form');
    const typeText = document.getElementById('transport-type');
    form.style.display = 'block';
    typeText.textContent = type.charAt(0).toUpperCase() + type.slice(1);
    form.scrollIntoView({ behavior: 'smooth' });
  }
</script>

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section dark-background">

     

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              }
            }
          </script>
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="assets/img/ee.png" class="testimonial-img" alt="">
                <h3>Emna Ben Hassine</h3>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Une expérience inoubliable avec la gestion des vacances. Le système est très facile à utiliser et la planification des trajets pendant les vacances a été un vrai gain de temps. Une approche moderne et efficace.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="assets/img/ss.png" class="testimonial-img" alt="">
                <h3>Sarah Jardak</h3>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>En tant que responsable des vacances, je trouve que le système de gestion des déplacements pendant les vacances est parfait. Le service est rapide, accessible et contribue à rendre nos déplacements plus agréables.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="assets/img/hh.png" class="testimonial-img" alt="">
                <h3>Habiba Eya</h3>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Le système de gestion des vacances nous a facilité la tâche. L'interface est moderne et conviviale, et la possibilité de gérer nos trajets et réservations rapidement est un grand plus. Je recommande vivement !</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="assets/img/mm.png" class="testimonial-img" alt="">
                <h3>Mariem Ben Mustapha</h3>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>La gestion des vacances et des trajets n'a jamais été aussi simple. Grâce à cette plateforme, tout est bien organisé et optimisé. Un service efficace qui a transformé ma manière de planifier mes déplacements durant mes vacances.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="c:\Users\user\Downloads\wetransfer_template-front_2025-04-07_1901\template front\Logis\assets\img\Capture d'écran 2025-04-09 025307.png" class="testimonial-img" alt="">
                <h3>Emna Karray</h3>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Le service de gestion des vacances a simplifié la réservation et la gestion de nos déplacements. La plateforme est intuitive, et j'ai pu planifier mes trajets de manière optimale. Une solution innovante pour des vacances sans stress.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>

            </div><!-- End testimonial item -->
            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="assets/img/oo.png" class="testimonial-img" alt="">
                <h3>Omar Cherif</h3>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Le service est très pratique et facile à utiliser. Réserver et suivre mes trajets en temps réel pendant les vacances est un véritable avantage. Je suis ravi de l'impact que cela a eu sur mes déplacements.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>

    </section><!-- /Testimonials Section -->

    <!-- Faq Section -->
<section id="faq" class="faq section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <span>Questions fréquemment posées</span>
    <h2>Questions fréquemment posées</h2>
    <p>Réponses aux préoccupations courantes concernant notre service de vacances</p>
  </div><!-- End Section Title -->

  <div class="container">

    <div class="row justify-content-center">

      <div class="col-lg-10">

        <div class="faq-container">

        <div class="faq-item" data-aos="fade-up" data-aos-delay="200">
  <i class="faq-icon bi bi-question-circle"></i>
  <h3>Comment réserver un trajet pendant mes vacances?</h3>
  <div class="faq-content">
    <p>Pour réserver un trajet pendant vos vacances, vous pouvez simplement sélectionner votre mode de transport préféré, choisir vos stations de départ et d'arrivée, puis confirmer votre réservation en ligne. Vous recevrez un billet électronique immédiatement.</p>
  </div>
  <i class="faq-toggle bi bi-chevron-right"></i>
</div><!-- End Faq item-->

<div class="faq-item" data-aos="fade-up" data-aos-delay="300">
  <i class="faq-icon bi bi-question-circle"></i>
  <h3>Quels modes de transport sont disponibles pendant mes vacances?</h3>
  <div class="faq-content">
    <p>Nous proposons une gamme de transports adaptés à vos besoins durant vos vacances, notamment des bus, des taxis collectifs et individuels, ainsi que des options pour les déplacements entre les hôtels et les principales attractions touristiques.</p>
  </div>
  <i class="faq-toggle bi bi-chevron-right"></i>
</div><!-- End Faq item-->

<div class="faq-item" data-aos="fade-up" data-aos-delay="400">
  <i class="faq-icon bi bi-question-circle"></i>
  <h3>Comment suivre l'heure d'arrivée de mon transport pendant les vacances?</h3>
  <div class="faq-content">
    <p>Grâce à notre plateforme en ligne, vous pouvez suivre l'heure d'arrivée de votre véhicule en temps réel, que ce soit pour un taxi ou un bus. Vous recevrez des notifications pour tout changement d'horaire.</p>
  </div>
  <i class="faq-toggle bi bi-chevron-right"></i>
</div><!-- End Faq item-->

<div class="faq-item" data-aos="fade-up" data-aos-delay="500">
  <i class="faq-icon bi bi-question-circle"></i>
  <h3>Puis-je annuler ou modifier ma réservation de transport?</h3>
  <div class="faq-content">
    <p>Oui, vous pouvez annuler ou modifier votre réservation jusqu'à 30 minutes avant le départ. Pour ce faire, vous pouvez accéder à votre réservation via notre plateforme en ligne et effectuer les modifications nécessaires.</p>
  </div>
  <i class="faq-toggle bi bi-chevron-right"></i>
</div><!-- End Faq item-->

<div class="faq-item" data-aos="fade-up" data-aos-delay="600">
  <i class="faq-icon bi bi-question-circle"></i>
  <h3>Comment réserver une place de parking à l'hôtel pendant mes vacances?</h3>
  <div class="faq-content">
    <p>Lors de la réservation de votre séjour, vous pouvez également réserver une place de parking à l'hôtel. Il vous suffit de sélectionner cette option lors de la réservation en ligne. Vous recevrez une confirmation et un accès à la zone de stationnement.</p>
  </div>
  <i class="faq-toggle bi bi-chevron-right"></i>
</div><!-- End Faq item-->

<div class="faq-item" data-aos="fade-up" data-aos-delay="700">
  <i class="faq-icon bi bi-question-circle"></i>
  <h3>Les transports en commun sont-ils disponibles pour les touristes?</h3>
  <div class="faq-content">
    <p>Oui, nous offrons des options de transport public pour les touristes, avec des itinéraires spécialement adaptés aux principales attractions et hôtels. Vous pouvez consulter les horaires et réserver votre billet à l'avance via notre site web.</p>
  </div>
  <i class="faq-toggle bi bi-chevron-right"></i>
</div><!-- End Faq item-->

<div class="faq-item" data-aos="fade-up" data-aos-delay="800">
  <i class="faq-icon bi bi-question-circle"></i>
  <h3>Le transport est-il adapté aux personnes à mobilité réduite pendant mes vacances?</h3>
  <div class="faq-content">
    <p>Tous nos véhicules sont accessibles aux personnes à mobilité réduite, et nous nous assurons que des informations claires sur l'accessibilité des transports sont fournies lors de la réservation. N'hésitez pas à consulter les détails de chaque option sur notre plateforme.</p>
  </div>
  <i class="faq-toggle bi bi-chevron-right"></i>
</div><!-- End Faq item-->


</section><!-- End Faq Section -->


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
