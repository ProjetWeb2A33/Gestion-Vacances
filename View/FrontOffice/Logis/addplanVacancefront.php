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
    if (
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

    <a href="about.html" class="logo d-flex align-items-center me-auto">
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
    <section id="add-plan" class="add-plan section">
      <div class="container" data-aos="fade-up">
          <div class="section-header">
              <h2>Planifier Votre Vacance</h2>
              <p>Créez votre plan de vacances personnalisé en quelques étapes simples</p>
          </div>
  
          <div class="row justify-content-center">
              <div class="col-lg-8">
              <?php if(!empty($error)): ?>
                <?php if ($showSuccessMessage): ?>
<div id="custom-message" class="message-shown">
    Votre plan de vacances a été ajouté avec succès !
</div>
<script>
    setTimeout(() => {
        const msg = document.getElementById('custom-message');
        msg.classList.remove('message-shown');
        msg.classList.add('message-hidden');
    }, 3000); // message disparaît après 3s
</script>
<?php endif; ?>
<?php endif; ?>
  
                  <div class="card shadow-lg">
                      <div class="card-body">
                      <form method="POST" onsubmit="return true">
                              <div class="row">
                                  <div class="col-md-12 form-group">
                                      <label for="nom_utilisateur" class="form-label">Nom Utilisateur</label>
                                      <input type="text" name="nom_utilisateur" class="form-control" 
                                             placeholder="Max 8 caractères" maxlength="8">
                                  </div>
                              </div>
  
                              <div class="row mt-3">
                                  <div class="col-md-6 form-group">
                                      <label for="date_depart" class="form-label">Date de Départ</label>
                                      <input type="date" name="date_depart" class="form-control">
                                  </div>
                                  <div class="col-md-6 form-group">
                                      <label for="date_retour" class="form-label">Date de Retour</label>
                                      <input type="date" name="date_retour" class="form-control">
                                  </div>
                              </div>
  
                              <div class="row mt-3">
                                  <div class="col-md-6 form-group">
                                      <label class="form-label">Type de Transport</label>
                                      <select name="type_transport" class="form-select">
                                          <option value="">Choisir...</option>
                                          <option value="voiture">Voiture Personnelle</option>
                                          <option value="taxi">Taxi</option>
                                          <option value="bus">Bus</option>
                                          <option value="plane">Avion</option>
                                      </select>
                                  </div>
                                  <div class="col-md-6 form-group">
                                    <label class="form-label">Hébergement</label>
                                    <select name="id_hotel" class="form-select">
                                        <option value="">Choisir un hôtel...</option>
                                        <?php foreach ($hotels as $hotel): ?>
                                        <option value="<?= $hotel['id_hotel'] ?>">
                                            <?= $hotel['nom_hotel'] ?> (<?= $hotel['ville'] ?>)
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
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
 function validateForm() {
  const today = new Date().toISOString().split('T')[0];
  const errorMessage = document.getElementById('error-messages');
  let errors = [];

  // Get form values
  const nomUtilisateur = document.getElementsByName('nom_utilisateur')[0].value.trim();
  const dateDepart = document.getElementsByName('date_depart')[0].value;
  const dateRetour = document.getElementsByName('date_retour')[0].value;
  const typeTransport = document.getElementsByName('type_transport')[0].value;
  const locationVoiture = document.querySelector('input[name="location_voiture"]:checked');
  const besoinParking = document.querySelector('input[name="besoin_parking"]:checked');
  const idHotel = document.getElementsByName('id_hotel')[0].value;

  // Validation rules (same as admin version)
  if (!nomUtilisateur) {
    errors.push("Le nom d'utilisateur est obligatoire");
  } else if (nomUtilisateur.length > 8) {
    errors.push("Le nom d'utilisateur ne doit pas dépasser 8 caractères");
  }

  if (!dateDepart) {
    errors.push("La date de départ est obligatoire");
  } else if (dateDepart < today) {
    errors.push("La date de départ ne peut pas être dans le passé");
  }

  if (!dateRetour) {
    errors.push("La date de retour est obligatoire");
  } else if (dateRetour <= dateDepart) {
    errors.push("La date de retour doit être après la date de départ");
  }

  if (!typeTransport) {
    errors.push("Le type de transport est obligatoire");
  }

  if (!locationVoiture) {
    errors.push("La location de voiture est obligatoire");
  }

  if (!besoinParking) {
    errors.push("Le besoin de parking est obligatoire");
  }

  if (!idHotel) {
    errors.push("La sélection d'un hôtel est obligatoire");
  }

  // Display errors or submit
  if (errors.length > 0) {
    errorMessage.innerHTML = errors.join('<br>');
    errorMessage.classList.remove('d-none');
    return false;
  }
  return true;
}

  </script>
 <div id="custom-message" class="message-hidden">✅ Plan de vacances créé avec succès !</div>

<script>
  <?php if ($showSuccessMessage): ?>
    window.addEventListener('DOMContentLoaded', () => {
      const messageBox = document.getElementById('custom-message');
      messageBox.classList.remove('message-hidden');
      messageBox.classList.add('message-shown');

      setTimeout(() => {
        window.location.href = 'about.php';
      }, 2500);
    });
  <?php endif; ?>
</script>



</body>

</html>
