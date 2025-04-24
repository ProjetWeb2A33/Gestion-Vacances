<?php
require_once "../../../Controller/planVacanceC.php";
require_once "../../../Controller/HotelC.php";

// Initialize the controller objects
$planC = new PlanVacanceC();
$hotelC = new HotelC();

// Get all plans initially
$plans = $planC->listPlans();

// Handle the search functionality
if (isset($_GET['search']) && !empty($_GET['search'])) {
  $search = $_GET['search'];
  // Use $planC instead of $planVacanceC to call the search function
  $plans = $planC->searchPlansByIdentifiant($search); 
} else {
  $plans = []; // Ensure $plans is an empty array if no search is performed
}
?>


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
  
    .vacation-table {
      width: 100%;
      border-collapse: collapse;
      margin: 2rem 0;
      box-shadow: 0 1px 3px rgba(0,0,0,0.12);
    }
    
    .vacation-table th,
    .vacation-table td {
      padding: 1rem;
      text-align: left;
      border-bottom: 1px solid #dee2e6;
    }
    
    .vacation-table th {
      background-color: #0a1d37;
      color: white;
      font-weight: 500;
    }
    
    .vacation-table tr:hover {
      background-color: #f8f9fa;
    }
    
    .action-buttons .btn {
      margin: 0 0.25rem;
      padding: 0.375rem 0.75rem;
    }
    
    .add-plan-btn {
      margin: 1.5rem 0;
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
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
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
          <a href="listPlansVacancefront.php" class="dropdown-item">
            <i class="bi bi-list-task"></i>
            Accéder à mon plan
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
    <!-- Main Content Section -->
    <section class="section">
  <div class="container" data-aos="fade-up">
    <div class="row">
      <div class="col-12">
        <div class="container" data-aos="fade-up">
          
          <!-- Formulaire de recherche -->
          <div class="search-container mb-4">
            <form method="GET" class="d-flex w-100">
              <div class="input-group">
                <input type="text" 
                       name="search" 
                       class="form-control search-input" 
                       placeholder="Veuillez saisir votre identifiant..." 
                       value="<?= htmlspecialchars($search ?? '') ?>" 
                       aria-label="Rechercher par identifiant">
                <button type="submit" class="btn btn-primary search-btn">
                  <i class="bi bi-search"></i> comfirmer
                </button>
              </div>
            </form>
          </div>

          <!-- Message d'erreur si aucun résultat trouvé -->
          <?php if (isset($search) && !empty($search) && empty($plans)): ?>
            <div class="alert alert-danger mt-3">
              Aucune correspondance trouvée pour "<strong><?= htmlspecialchars($search) ?></strong>".
            </div>
          <?php endif; ?>

          <!-- Affichage des résultats -->
          <div class="row">
            <div class="col-12">
              <table class="vacation-table">
                <?php if (!empty($plans)): ?>
                    <!-- Your table structure to show the results -->
                <?php endif; ?>
              </table>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</section>




            <table class="vacation-table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Identifiant</th>
                  <th>Utilisateur</th>
                  <th>Départ</th>
                  <th>Retour</th>
                  <th>Transport</th>
                  <th>Location voiture</th>
                  <th>Besoin parking</th>
                  <th>Hôtel</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($plans as $plan): 
                  $hotel = $hotelC->showHotel($plan['id_hotel']);
                ?>
                <tr>
                  <td><?= $plan['id_plan'] ?></td>
                  <td><?= $plan['identifiant'] ?></td>
                  <td><?= htmlspecialchars($plan['nom_utilisateur']) ?></td>
                  <td><?= $plan['date_depart'] ?></td>
                  <td><?= $plan['date_retour'] ?></td>
                  <td><?= ucfirst($plan['type_transport']) ?></td>
                  <td><?= ucfirst($plan['location_voiture']) ?></td>
                  <td><?= ucfirst($plan['besoin_parking']) ?></td>
                  <td>
                    <?= $hotel['nom_hotel'] ?? 'Inconnu' ?>
                    <?php if(isset($hotel['ville'])): ?>
                      <small class="text-muted">(<?= $hotel['ville'] ?>)</small>
                    <?php endif; ?>
                  </td>
                  <td class="action-buttons">
                    <form method="POST" action="updateplanVacance.php" class="d-inline">
                      <input type="hidden" name="id" value="<?= $plan['id_plan'] ?>">
                      <button type="submit" class="btn btn-sm btn-warning">
                        <i class="bi bi-pencil"></i>
                      </button>
                    </form>
                    <button type="button" 
        class="btn btn-sm btn-danger" 
        data-bs-toggle="modal" 
        data-bs-target="#deleteModal" 
        data-plan-id="<?= $plan['id_plan'] ?>">
  <i class="bi bi-trash"></i>
</button>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
    
<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirmation de suppression</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Êtes-vous sûr de vouloir supprimer ce plan de vacances ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <a id="confirmDeleteBtn" href="#" class="btn btn-danger">Supprimer</a>
      </div>
    </div>
  </div>
</div>
    


</main>

<footer id="footer" class="footer dark-background">

  <div class="container footer-top">
    <div class="row gy-4">
      <div class="col-lg-5 col-md-12 footer-about">
        <a href="about.html" class="logo d-flex align-items-center">
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
<script>
  // Gestion de la modal de suppression
  document.addEventListener('DOMContentLoaded', function() {
    var deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget;
      var planId = button.getAttribute('data-plan-id');
      var deleteLink = 'deletePlanVacance.php?id=' + planId;
      document.getElementById('confirmDeleteBtn').setAttribute('href', deleteLink);
    });
  });
</script>
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
