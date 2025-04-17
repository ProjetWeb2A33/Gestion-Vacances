<?php
require_once '../../../Controller/planVacanceC.php';
require_once '../../../Model/planVacance.php';
require_once '../../../Controller/HotelC.php';

$error = "";
$planC = new PlanVacanceC();
$hotelC = new HotelC();
$hotels = $hotelC->listHotels();

if (isset($_POST["id"])) {
    $plan = $planC->showPlan($_POST["id"]);
    
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
                $updatedPlan = new PlanVacance(
                    $_POST['id'],
                    $_POST['nom_utilisateur'],
                    $_POST['date_depart'],
                    $_POST['date_retour'],
                    $_POST['type_transport'],
                    $_POST['location_voiture'],
                    $_POST['besoin_parking'],
                    $_POST['id_hotel']
                );
                $planC->updatePlan($updatedPlan, $_POST['id']);
                header('Location: listplanVacance.php');
            } else {
                $error = "La date de retour doit être après la date de départ";
            }
        } else {
            $error = "Veuillez remplir tous les champs";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/easyparki.png">
  <title>EasyParki - Modifier Plan Vacance</title>
  
  <!-- Fonts and icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
  
  <style>
    :root {
      --primary-dark: #0a1d37;
      --accent-blue: #4da6ff;
    }
    
    body {
      background-color: #f8f9fa !important;
    }
    .nav-item.has-submenu {
      position: relative;
    }
    
    .submenu {
      position: absolute;
      left: 0;
      top: 100%;
      min-width: 220px;
      background: var(--primary-dark);
      border-radius: 8px;
      padding: 10px 0;
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s ease;
      transform: translateY(-10px);
      z-index: 1000;
      box-shadow: 0 8px 24px rgba(0,0,0,0.15);
    }
    
    .nav-item.has-submenu:hover .submenu {
      opacity: 1;
      visibility: visible;
      transform: translateY(0);
    }
    
    .submenu-item {
      padding: 12px 20px;
      color: white !important;
      text-decoration: none;
      display: flex;
      align-items: center;
      transition: all 0.2s ease;
    }
    
    .submenu-item:hover {
      background: rgba(255,255,255,0.1);
      padding-left: 25px;
    }
    
    .submenu-item i {
      margin-right: 12px;
      font-size: 18px;
    }


    .form-container {
      background: white;
      border-radius: 12px;
      padding: 25px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.05);
      margin: 30px auto;
      max-width: 600px;
    }
    
    .sidenav {
      background-color: var(--primary-dark) !important;
    }
    
    .sidenav .nav-link,
    .sidenav .nav-link-text,
    .sidenav .navbar-brand span,
    .sidenav .material-symbols-rounded {
      color: white !important;
    }


    .form-container {
      background: white;
      border-radius: 12px;
      padding: 25px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.05);
      margin: 30px auto;
      max-width: 600px;
    }
    
    .error-message {
      color: red;
      margin-bottom: 15px;
    }
    
    .form-group label {
      font-weight: 500;
      color: var(--primary-dark);
    }
    
    .form-control {
      border-radius: 8px;
      padding: 10px 15px;
      border: 1px solid #dee2e6;
      transition: all 0.3s ease;
    }
    
    .form-control:focus {
      border-color: var(--accent-blue);
      box-shadow: 0 0 0 3px rgba(77, 166, 255, 0.25);
    }
  </style>
</head>

<body class="g-sidenav-show bg-gray-100">
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 fixed-start" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0" href="tables.html">
  <img src="../assets/img/easyparki.png" class="navbar-brand-img" width="50">
  <span class="ms-1 text-white">EasyParki</span>
</a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="../pages/dashboard.html">
            <i class="material-symbols-rounded opacity-5">dashboard</i>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/billing.html">
            <i class="material-symbols-rounded opacity-5">receipt_long</i>
            <span class="nav-link-text ms-1">Stationnement</span>
          </a>
        </li>
        <li class="nav-item has-submenu">
          <a class="nav-link active bg-gradient-primary text-white" href="javascript:;">
            <i class="material-symbols-rounded opacity-5">directions_bus</i>
            <span class="nav-link-text ms-1">Vacances</span>
          </a>
          <div class="submenu">
            <a href="addHotel.php" class="submenu-item">
              <i class="fas fa-hotel"></i>
              Ajouter un Hotel
            </a>
            <a href="addplanVacance.php" class="submenu-item">
              <i class="fas fa-calendar-plus"></i>
              Ajouter un plan de Vacance
            </a>
            <a href="listHotels.php" class="submenu-item">
              <i class="fas fa-list"></i>
              List Hotels
            </a>
            <a href="listplanVacance.php" class="submenu-item">
              <i class="fas fa-clipboard-list"></i>
              List Plans de Vacance
            </a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/billing.html">
            <i class="material-symbols-rounded opacity-5">receipt_long</i>
            <span class="nav-link-text ms-1">Covoiturage</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/virtual-reality.html">
            <i class="material-symbols-rounded opacity-5">view_in_ar</i>
            <span class="nav-link-text ms-1">Recharge électrique</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/rtl.html">
            <i class="material-symbols-rounded opacity-5">format_textdirection_r_to_l</i>
            <span class="nav-link-text ms-1">Evenement</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/notifications.html">
            <i class="material-symbols-rounded opacity-5">notifications</i>
            <span class="nav-link-text ms-1">Notifications</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-5">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/profile.html">
            <i class="material-symbols-rounded opacity-5">person</i>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/sign-in.html">
            <i class="material-symbols-rounded opacity-5">login</i>
            <span class="nav-link-text ms-1">Sign In</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/sign-up.html">
            <i class="material-symbols-rounded opacity-5">assignment</i>
            <span class="nav-link-text ms-1">Sign Up</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0">
      <div class="mx-3">
        <a class="btn btn-outline-white mt-4 w-100" href="http://localhost/ProjetWeb/View/FrontOffice/Logis/about.html">FrontOffice</a>
      </div>
    </div>
  </aside>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <div class="container-fluid py-4">
      <div class="form-container">
        <?php if(!empty($error)): ?>
          <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <?php if(isset($_POST['id'])): 
          $planData = $planC->showPlan($_POST['id']);
        ?>
        <h3 class="mb-4">Modifier le Plan de Vacance</h3>
        <form method="POST" onsubmit="return validateForm()">
          <input type="hidden" name="id" value="<?= $planData['id_plan'] ?>">
          <div class="error-message" id="errorMessage"></div>
          
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Nom Utilisateur</label>
                <input type="text" name="nom_utilisateur" class="form-control" value="<?= $planData['nom_utilisateur'] ?>">
              </div>
              
              <div class="form-group">
                <label>Date Départ</label>
                <input type="date" name="date_depart" class="form-control" value="<?= $planData['date_depart'] ?>">
              </div>
              
              <div class="form-group">
                <label>Date Retour</label>
                <input type="date" name="date_retour" class="form-control" value="<?= $planData['date_retour'] ?>">
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-group">
                <label>Type Transport</label>
                <select name="type_transport" class="form-control">
                  <option value="">Sélectionner un type</option>
                  <?php $transports = ['voiture', 'taxi', 'bus', 'plane']; ?>
                  <?php foreach ($transports as $t): ?>
                    <option value="<?= $t ?>" <?= ($t == $planData['type_transport']) ? 'selected' : '' ?>>
                      <?= ucfirst($t) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
              
              <div class="form-group">
                <label>Location Voiture</label>
                <div class="radio-group">
                  <label>
                    <input type="radio" name="location_voiture" value="oui" <?= ($planData['location_voiture'] == 'oui') ? 'checked' : '' ?>>
                    Oui
                  </label>
                  <label>
                    <input type="radio" name="location_voiture" value="non" <?= ($planData['location_voiture'] == 'non') ? 'checked' : '' ?>>
                    Non
                  </label>
                </div>
              </div>
              
              <div class="form-group">
                <label>Besoin Parking</label>
                <div class="radio-group">
                  <label>
                    <input type="radio" name="besoin_parking" value="oui" <?= ($planData['besoin_parking'] == 'oui') ? 'checked' : '' ?>>
                    Oui
                  </label>
                  <label>
                    <input type="radio" name="besoin_parking" value="non" <?= ($planData['besoin_parking'] == 'non') ? 'checked' : '' ?>>
                    Non
                  </label>
                </div>
              </div>
              
              <div class="form-group">
                <label>Hôtel</label>
                <select name="id_hotel" class="form-control">
                  <option value="">Sélectionner un hôtel</option>
                  <?php foreach ($hotels as $hotel): ?>
                    <option value="<?= $hotel['id_hotel'] ?>" <?= ($hotel['id_hotel'] == $planData['id_hotel']) ? 'selected' : '' ?>>
                      Hôtel #<?= $hotel['id_hotel'] ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          
          <div class="text-end mt-4">
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-save me-2"></i>Mettre à jour
            </button>
            <a href="listplanVacance.php" class="btn btn-secondary">
              <i class="fas fa-times me-2"></i>Annuler
            </a>
          </div>
        </form>
        <?php endif; ?>
      </div>
    </div>
  </main>

  <script>
    function validateForm() {
      const today = new Date().toISOString().split('T')[0];
      const errorMessage = document.getElementById('errorMessage');
      let errors = [];

      // Get form values
      const nomUtilisateur = document.getElementsByName('nom_utilisateur')[0].value.trim();
      const dateDepart = document.getElementsByName('date_depart')[0].value;
      const dateRetour = document.getElementsByName('date_retour')[0].value;
      const typeTransport = document.getElementsByName('type_transport')[0].value;
      const locationVoiture = document.querySelector('input[name="location_voiture"]:checked');
      const besoinParking = document.querySelector('input[name="besoin_parking"]:checked');
      const idHotel = document.getElementsByName('id_hotel')[0].value;

      // Validation rules
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
        return false;
      }
      return true;
    }

    // Set minimum dates for date inputs
    document.addEventListener('DOMContentLoaded', function() {
      const today = new Date().toISOString().split('T')[0];
      document.getElementsByName('date_depart')[0].min = today;
      
      // Update retour min date when départ changes
      document.getElementsByName('date_depart')[0].addEventListener('change', function() {
        const dateDepart = this.value;
        document.getElementsByName('date_retour')[0].min = dateDepart;
      });
    });
  </script>
  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>
</body>
</html>