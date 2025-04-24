<?php 
require_once __DIR__ . '/../../../Controller/planVacanceC.php';
require_once __DIR__ . '/../../../Model/planVacance.php';
require_once __DIR__ . '/../../../Controller/HotelC.php';

$error = "";
$showSuccessMessage = false;
$planC = new PlanVacanceC();
$hotelC = new HotelC();
$hotels = $hotelC->listHotels();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (  !empty($_POST['identifiant']) &&
        !empty($_POST['nom_utilisateur']) &&
       
        !empty($_POST['date_depart']) &&
        !empty($_POST['date_retour']) &&
        !empty($_POST['type_transport']) &&
        !empty($_POST['location_voiture']) &&
        !empty($_POST['besoin_parking']) &&
        !empty($_POST['id_hotel'])
    ) {
        if (strtotime($_POST['date_retour']) > strtotime($_POST['date_depart'])) {
            $plan = new PlanVacance(
                null,
                $_POST['identifiant'],
                $_POST['nom_utilisateur'],
                $_POST['date_depart'],
                $_POST['date_retour'],
                $_POST['type_transport'],
                $_POST['location_voiture'],
                $_POST['besoin_parking'],
                $_POST['id_hotel']
            );
            $planC->addPlan($plan);
            $showSuccessMessage = true;
        } else {
            $error = "La date de retour doit être après la date de départ";
        }
    } else {
        $error = "Informations manquantes";
    }
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
    #custom-message {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: #1e90ff;
  color: white;
  padding: 20px 30px;
  border-radius: 12px;
  font-size: 18px;
  z-index: 9999;
  opacity: 0;
  transition: opacity 0.6s ease-in-out, transform 0.6s ease-in-out;
  box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

.message-shown {
  opacity: 1;
  transform: translate(-50%, -50%) scale(1.05);
}

.message-hidden {
  display: none;
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
          <a href="listPlansVacancefront.php" class="dropdown-item">
            <i class="bi bi-list-task"></i>
            Liste Plans Vacances
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
    <section id="add-plan" class="add-plan section">
  <div class="container" data-aos="fade-up">
      <div class="section-header">
          <h2>Planifier Votre Vacance</h2>
          <p>Créez votre plan de vacances personnalisé en quelques étapes simples</p>
      </div>

      <div class="row justify-content-center">
          <div class="col-lg-8">
              <?php if(!empty($error)): ?>
                  <div class="alert alert-danger"><?= $error ?></div>
              <?php endif; ?>
              
              <div class="card shadow-lg">
                  <div class="card-body">
                      <form method="POST" id="vacationForm">
                          <div class="row">
                              <div class="col-md-12 form-group">
                                  <label for="nom_utilisateur" class="form-label">Nom Utilisateur</label>
                                  <input type="text" name="nom_utilisateur" id="nom_utilisateur" class="form-control" 
                                         placeholder="Max 8 caractères" maxlength="8">
                                  <div class="form-feedback" id="nomFeedback"></div>
                              </div>
                          </div>
                          <div class="row">
    <div class="col-md-12 form-group">
        <label for="identifiant" class="form-label">Identifiant</label>
        <input type="text" name="identifiant" id="identifiant" class="form-control" 
               placeholder="Lettres et chiffres uniquement (max 8)" maxlength="8">
        <div class="form-feedback" id="identifiantFeedback"></div>
    </div>
</div>

                          <div class="row mt-3">
                              <div class="col-md-6 form-group">
                                  <label for="date_depart" class="form-label">Date de Départ</label>
                                  <input type="date" name="date_depart" id="date_depart" class="form-control">
                                  <div class="form-feedback" id="dateDepartFeedback"></div>
                              </div>
                              <div class="col-md-6 form-group">
                                  <label for="date_retour" class="form-label">Date de Retour</label>
                                  <input type="date" name="date_retour" id="date_retour" class="form-control">
                                  <div class="form-feedback" id="dateRetourFeedback"></div>
                              </div>
                          </div>

                          <div class="row mt-3">
                              <div class="col-md-6 form-group">
                                  <label class="form-label">Type de Transport</label>
                                  <select name="type_transport" id="type_transport" class="form-select">
                                      <option value="">Choisir...</option>
                                      <option value="voiture">Voiture</option>
                                      <option value="taxi">Taxi</option>
                                      <option value="bus">Bus</option>
                                  </select>
                                  <div class="form-feedback" id="transportFeedback"></div>
                              </div>
                              <div class="col-md-6 form-group">
                                <label class="form-label">Hébergement</label>
                                <select name="id_hotel" id="id_hotel" class="form-select">
                                    <option value="">Choisir un hôtel...</option>
                                    <?php foreach ($hotels as $hotel): ?>
                                    <option value="<?= $hotel['id_hotel'] ?>">
                                        <?= $hotel['nom_hotel'] ?> (<?= $hotel['ville'] ?>)
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="form-feedback" id="hotelFeedback"></div>
                            </div>
                          </div>

                          <div class="row mt-3">
                              <div class="col-md-6 form-group">
                                  <label class="form-label">Location de Voiture</label>
                                  <div class="d-flex gap-4">
                                      <div class="form-check">
                                          <input class="form-check-input" type="radio" name="location_voiture" 
                                                 id="oui_location" value="oui">
                                          <label class="form-check-label text-success" for="oui_location">
                                              Oui
                                          </label>
                                      </div>
                                      <div class="form-check">
                                          <input class="form-check-input" type="radio" name="location_voiture" 
                                                 id="non_location" value="non">
                                          <label class="form-check-label text-danger" for="non_location">
                                              Non
                                          </label>
                                      </div>
                                  </div>
                                  <div class="form-feedback" id="locationFeedback"></div>
                              </div>

                              <div class="col-md-6 form-group">
                                  <label class="form-label">Besoin de Parking</label>
                                  <div class="d-flex gap-4">
                                      <div class="form-check">
                                          <input class="form-check-input" type="radio" name="besoin_parking" 
                                                 id="oui_parking" value="oui">
                                          <label class="form-check-label text-success" for="oui_parking">
                                              Oui
                                          </label>
                                      </div>
                                      <div class="form-check">
                                          <input class="form-check-input" type="radio" name="besoin_parking" 
                                                 id="non_parking" value="non">
                                          <label class="form-check-label text-danger" for="non_parking">
                                              Non
                                          </label>
                                      </div>
                                  </div>
                                  <div class="form-feedback" id="parkingFeedback"></div>
                              </div>
                          </div>

                          <div class="text-center mt-4">
                              <button type="submit" class="btn btn-primary btn-lg">
                                  <i class="bi bi-send me-2"></i>Créer le Plan
                              </button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>

<!-- Modal de Confirmation -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
      </div>
      <div class="modal-body">
        Êtes-vous sûr de vouloir créer ce plan de vacances ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <button type="button" id="confirmSubmit" class="btn btn-primary">Confirmer</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal de Succès -->
<div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Succès</h5>
      </div>
      <div class="modal-body">
        Votre plan de vacances a été créé avec succès !
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="window.location.href='about.php'">OK</button>
      </div>
    </div>
  </div>
</div>

<style>
.form-feedback {
    font-size: 0.875rem;
    margin-top: 0.25rem;
    height: 20px;
}
.form-feedback.error {
    color: #dc3545;
}
.form-feedback.success {
    color: #28a745;
}
</style>
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
<script>
// Fonction pour afficher les messages de feedback
function showFeedback(elementId, message, isError) {
    const feedbackElement = document.getElementById(elementId);
    feedbackElement.textContent = message;
    feedbackElement.className = 'form-feedback ' + (isError ? 'error' : 'success');
}

// Fonctions de validation individuelles
function validateNom() {
    const nom = document.getElementById('nom_utilisateur').value.trim();
    if (!nom) {
        showFeedback('nomFeedback', 'Le nom est requis', true);
        return false;
    } else if (nom.length > 8) {
        showFeedback('nomFeedback', 'Max 8 caractères', true);
        return false;
    }
    showFeedback('nomFeedback', 'Valide', false);
    return true;
}

function validateIdentifiant() {
    const identifiant = document.getElementById('identifiant').value.trim();
    const regex = /^[a-zA-Z0-9]+$/; // Seulement lettres et chiffres
    
    if (!identifiant) {
        showFeedback('identifiantFeedback', 'L\'identifiant est requis', true);
        return false;
    } else if (identifiant.length > 8) {
        showFeedback('identifiantFeedback', 'Max 8 caractères', true);
        return false;
    } else if (!regex.test(identifiant)) {
        showFeedback('identifiantFeedback', 'Caractères spéciaux non autorisés', true);
        return false;
    }
    showFeedback('identifiantFeedback', 'Valide', false);
    return true;
}

function validateDates() {
    const today = new Date().toISOString().split('T')[0];
    const depart = document.getElementById('date_depart').value;
    const retour = document.getElementById('date_retour').value;
    let isValid = true;

    if (!depart) {
        showFeedback('dateDepartFeedback', 'Date requise', true);
        isValid = false;
    } else if (depart < today) {
        showFeedback('dateDepartFeedback', 'Date dans le passé', true);
        isValid = false;
    } else {
        showFeedback('dateDepartFeedback', 'Valide', false);
    }

    if (!retour) {
        showFeedback('dateRetourFeedback', 'Date requise', true);
        isValid = false;
    } else if (retour <= depart) {
        showFeedback('dateRetourFeedback', 'Doit être après départ', true);
        isValid = false;
    } else {
        showFeedback('dateRetourFeedback', 'Valide', false);
    }

    return isValid;
}

function validateTransport() {
    const transport = document.getElementById('type_transport').value;
    if (!transport) {
        showFeedback('transportFeedback', 'Sélection requise', true);
        return false;
    }
    showFeedback('transportFeedback', 'Valide', false);
    return true;
}

function validateHotel() {
    const hotel = document.getElementById('id_hotel').value;
    if (!hotel) {
        showFeedback('hotelFeedback', 'Sélection requise', true);
        return false;
    }
    showFeedback('hotelFeedback', 'Valide', false);
    return true;
}

function validateRadio(fieldName, feedbackId) {
    const selected = document.querySelector(`input[name="${fieldName}"]:checked`);
    if (!selected) {
        showFeedback(feedbackId, 'Sélection requise', true);
        return false;
    }
    showFeedback(feedbackId, 'Valide', false);
    return true;
}

// Validation globale
function validateForm(event) {
    event.preventDefault();
    
    const isNomValid = validateNom();
    const isIdentifiantValid = validateIdentifiant(); 
    const areDatesValid = validateDates();
    const isTransportValid = validateTransport();
    const isHotelValid = validateHotel();
    const isLocationValid = validateRadio('location_voiture', 'locationFeedback');
    const isParkingValid = validateRadio('besoin_parking', 'parkingFeedback');

    if (isNomValid && isIdentifiantValid && areDatesValid && isTransportValid && 
        isHotelValid && isLocationValid && isParkingValid) {
        var myModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
        myModal.show();
    }
}

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    // Validation en temps réel
    document.getElementById('nom_utilisateur').addEventListener('input', validateNom);
    document.getElementById('identifiant').addEventListener('input', validateIdentifiant);
    document.getElementById('date_depart').addEventListener('change', validateDates);
    document.getElementById('date_retour').addEventListener('change', validateDates);
    document.getElementById('type_transport').addEventListener('change', validateTransport);
    document.getElementById('id_hotel').addEventListener('change', validateHotel);
    
    // Gestion des radios
    document.querySelectorAll('input[name="location_voiture"]').forEach(radio => {
        radio.addEventListener('change', () => validateRadio('location_voiture', 'locationFeedback'));
    });
    document.querySelectorAll('input[name="besoin_parking"]').forEach(radio => {
        radio.addEventListener('change', () => validateRadio('besoin_parking', 'parkingFeedback'));
    });

    // Soumission du formulaire
    document.getElementById('vacationForm').addEventListener('submit', validateForm);

    // Confirmation
    document.getElementById('confirmSubmit').addEventListener('click', function() {
        document.getElementById('vacationForm').submit();
    });
});

<?php if ($showSuccessMessage): ?>
    window.addEventListener('DOMContentLoaded', () => {
        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
    });
<?php endif; ?>
</script>

</body>

</html>
