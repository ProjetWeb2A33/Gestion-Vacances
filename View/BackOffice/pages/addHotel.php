<?php
include '../../../Controller/HotelC.php';
include '../../../Model/Hotel.php';

$error = "";
$hotelC = new HotelC();

if (
    isset($_POST["nom"]) &&
    isset($_POST["adresse"]) &&
    isset($_POST["ville"]) &&
    isset($_POST["npp"]) &&
    isset($_POST["ppd"]) &&
    isset($_POST["categorie"])
) {
    if (
        !empty($_POST['nom']) &&
        !empty($_POST["adresse"]) &&
        !empty($_POST["ville"]) &&
        !empty($_POST["npp"]) &&
        !empty($_POST["ppd"]) &&
        !empty($_POST["categorie"])
    ) {
        $hotel = new Hotel(
            null,
            $_POST['nom'],
            $_POST['adresse'],
            $_POST['ville'],
            $_POST['npp'],
            $_POST['ppd'],
            $_POST['categorie']
        );
        $hotelC->addHotel($hotel);
        header('Location:listHotels.php');
    } else {
        $error = "Missing information";
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
  <title>EasyParki - Add Hotel</title>
  
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
    
    .error-message {
      color: #dc3545;
      margin-bottom: 15px;
    }
    
    .success-message {
      color: #28a745;
      margin-bottom: 15px;
    }
    
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
    
    /* Modal de confirmation */
    .confirmation-modal {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0,0,0,0.5);
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 1050;
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s ease;
    }
    
    .confirmation-modal.active {
      opacity: 1;
      visibility: visible;
    }
    
    .modal-content {
      background: white;
      border-radius: 12px;
      padding: 30px;
      width: 400px;
      max-width: 90%;
      box-shadow: 0 5px 15px rgba(0,0,0,0.3);
      text-align: center;
    }
    
    .modal-buttons {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin-top: 20px;
    }
.form-control.is-invalid {
  border: 1px solid #dc3545 !important;
}

.form-control.is-valid {
  border: 1px solid #28a745 !important;
}

.form-select.is-invalid {
  border: 1px solid #dc3545 !important;
}

.form-select.is-valid {
  border: 1px solid #28a745 !important;
}

.radio-group.invalid {
  border: 1px solid #dc3545;
  padding: 10px;
  border-radius: 5px;
}


.radio-group.valid {
  border: 1px solid #28a745;
  padding: 10px;
  border-radius: 5px;
}
  </style>
</head>

<body class="g-sidenav-show bg-gray-100">
  <!-- Sidebar -->
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 fixed-start" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0" href="tables.php">
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
              Ajouter un plan de Vacances
            </a>
            <a href="listHotels.php" class="submenu-item">
              <i class="fas fa-list"></i>
              Liste des Hotels
            </a>
            <a href="listplanVacance.php" class="submenu-item">
              <i class="fas fa-clipboard-list"></i>
              Liste des Plans de Vacances
            </a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/billing.html">
            <i class="material-symbols-rounded opacity-5">receipt_long</i>
            <span class="nav-link-text ms-1">Covoiturage</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/virtual-reality.html">
            <i class="material-symbols-rounded opacity-5">view_in_ar</i>
            <span class="nav-link-text ms-1">Service</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/rtl.html">
            <i class="material-symbols-rounded opacity-5">format_textdirection_r_to_l</i>
            <span class="nav-link-text ms-1">Evenement</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/notifications.html">
            <i class="material-symbols-rounded opacity-5">notifications</i>
            <span class="nav-link-text ms-1">Notifications</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-5">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/profile.html">
            <i class="material-symbols-rounded opacity-5">person</i>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/sign-in.html">
            <i class="material-symbols-rounded opacity-5">login</i>
            <span class="nav-link-text ms-1">Sign In</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/sign-up.html">
            <i class="material-symbols-rounded opacity-5">assignment</i>
            <span class="nav-link-text ms-1">Sign Up</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0">
      <div class="mx-3">
        <a class="btn btn-outline-white mt-4 w-100" href="http://localhost/ProjetWeb/View/FrontOffice/Logis/about.php">FrontOffice</a>
      </div>
    </div>
  </aside>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <div class="container-fluid py-4">
      <div class="form-container">
        <h2>Ajouter un Hotel</h2>
        <div class="error-message" id="errorMessage"><?php echo $error; ?></div>
        
        
        <form method="POST" id="hotelForm">
          <div class="mb-3">
            <label class="form-label">Nom:</label>
            <input type="text" class="form-control" name="nom" id="nom">
            <div class="form-feedback" id="nomFeedback"></div>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Adresse:</label>
            <input type="text" class="form-control" name="adresse" id="adresse">
            <div class="form-feedback" id="adresseFeedback"></div>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Ville:</label>
            <input type="text" class="form-control" name="ville" id="ville">
            <div class="form-feedback" id="villeFeedback"></div>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Places parking total:</label>
            <input type="number" class="form-control" name="npp" id="npp">
            <div class="form-feedback" id="nppFeedback"></div>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Places disponibles:</label>
            <input type="number" class="form-control" name="ppd" id="ppd">
            <div class="form-feedback" id="ppdFeedback"></div>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Catégorie:</label>
            <select class="form-select" name="categorie" id="categorie">
              <option value="">Select category</option>
              <option value="1 étoile">1 étoile</option>
              <option value="2 étoiles">2 étoiles</option>
              <option value="3 étoiles">3 étoiles</option>
              <option value="4 étoiles">4 étoiles</option>
              <option value="5 étoiles">5 étoiles</option>
            </select>
            <div class="form-feedback" id="categorieFeedback"></div>
          </div>
          
          <div class="d-flex justify-content-between">
            <a href="listHotels.php" class="btn btn-secondary">Liste</a>
            <button type="submit" class="btn btn-primary">Ajouter</button>
          </div>
        </form>
      </div>
    </div>
  </main>

  <!-- Modal de confirmation -->
  <div class="confirmation-modal" id="confirmationModal">
    <div class="modal-content">
      <h3>Confirmation</h3>
      <p>Voulez-vous vraiment ajouter cet hôtel ?</p>
      <div class="modal-buttons">
        <button type="button" class="btn btn-secondary" id="cancelBtn">Annuler</button>
        <button type="button" class="btn btn-primary" id="confirmBtn">Confirmer</button>
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
        Votre ajout a été créé avec succès !
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="window.location.href='listHotels.php'">OK</button>
      </div>
    </div>
  </div>
</div>

  <script>
    // Fonction pour afficher les messages de feedback
    function showFeedback(elementId, message, isError) {
  const feedbackElement = document.getElementById(elementId);
  feedbackElement.textContent = message;
  feedbackElement.className = 'form-feedback ' + (isError ? 'error' : 'success');
  
  // Mettre à jour la classe de l'input/select correspondant
  const inputId = elementId.replace('Feedback', '');
  const inputElement = document.getElementById(inputId);
  
  if (inputElement) {
    if (isError) {
      inputElement.classList.add('is-invalid');
      inputElement.classList.remove('is-valid');
    } else {
      inputElement.classList.add('is-valid');
      inputElement.classList.remove('is-invalid');
    }
  }
}
    // Fonctions de validation individuelles
    function validateNom() {
      const nom = document.getElementById('nom').value.trim();
      if (!nom) {
        showFeedback('nomFeedback', 'Le nom est requis', true);
        return false;
      } else if (nom.length > 8) {
        showFeedback('nomFeedback', 'Le nom ne doit pas dépasser 8 caractères', true);
        return false;
      }
      showFeedback('nomFeedback', 'Nom valide', false);
      return true;
    }

    function validateAdresse() {
      const adresse = document.getElementById('adresse').value.trim();
      if (!adresse) {
        showFeedback('adresseFeedback', 'Ladresse est requise', true);
        return false;
      } else if (adresse.length > 8) {
        showFeedback('adresseFeedback', 'Ladresse ne doit pas dépasser 8 caractères', true);
        return false;
      }
      showFeedback('adresseFeedback', 'Adresse valide', false);
      return true;
    }

    function validateVille() {
      const ville = document.getElementById('ville').value.trim();
      if (!ville) {
        showFeedback('villeFeedback', 'La ville est requise', true);
        return false;
      } else if (ville.length > 8) {
        showFeedback('villeFeedback', 'La ville ne doit pas dépasser 8 caractères', true);
        return false;
      }
      showFeedback('villeFeedback', 'Ville valide', false);
      return true;
    }

    function validateNpp() {
      const npp = document.getElementById('npp').value;
      if (!npp) {
        showFeedback('nppFeedback', 'Le nombre total de places est requis', true);
        return false;
      } else if (parseInt(npp) <= 0) {
        showFeedback('nppFeedback', 'Le nombre total doit être positif', true);
        return false;
      }
      showFeedback('nppFeedback', 'Nombre valide', false);
      return true;
    }

    function validatePpd() {
      const ppd = document.getElementById('ppd').value;
      const npp = document.getElementById('npp').value;
      
      if (!ppd) {
        showFeedback('ppdFeedback', 'Le nombre de places disponibles est requis', true);
        return false;
      } else if (parseInt(ppd) < 0) {
        showFeedback('ppdFeedback', 'Le nombre disponible ne peut pas être négatif', true);
        return false;
      } else if (npp && parseInt(ppd) > parseInt(npp)) {
        showFeedback('ppdFeedback', 'Le nombre disponible ne peut pas dépasser le total', true);
        return false;
      }
      showFeedback('ppdFeedback', 'Nombre valide', false);
      return true;
    }

    function validateCategorie() {
      const categorie = document.getElementById('categorie').value;
      if (!categorie) {
        showFeedback('categorieFeedback', 'La catégorie est requise', true);
        return false;
      }
      showFeedback('categorieFeedback', 'Catégorie valide', false);
      return true;
    }

    // Validation globale du formulaire
    function validateForm(event) {
      if (event) event.preventDefault();
      
      const isNomValid = validateNom();
      const isAdresseValid = validateAdresse();
      const isVilleValid = validateVille();
      const isNppValid = validateNpp();
      const isPpdValid = validatePpd();
      const isCategorieValid = validateCategorie();

      if (isNomValid && isAdresseValid && isVilleValid && 
          isNppValid && isPpdValid && isCategorieValid) {
        document.getElementById('confirmationModal').classList.add('active');
      }

      return false;
    }

    // Initialisation des événements
    document.addEventListener('DOMContentLoaded', function() {
      // Validation en temps réel
      document.getElementById('nom').addEventListener('input', validateNom);
      document.getElementById('adresse').addEventListener('input', validateAdresse);
      document.getElementById('ville').addEventListener('input', validateVille);
      document.getElementById('npp').addEventListener('input', function() {
        validateNpp();
        // Valider aussi ppd car dépend de npp
        if (document.getElementById('ppd').value) validatePpd();
      });
      document.getElementById('ppd').addEventListener('input', validatePpd);
      document.getElementById('categorie').addEventListener('change', validateCategorie);

      // Soumission du formulaire
      document.getElementById('hotelForm').addEventListener('submit', validateForm);

      // Gestion de la modale
      document.getElementById('cancelBtn').addEventListener('click', function() {
        document.getElementById('confirmationModal').classList.remove('active');
      });

      document.getElementById('confirmBtn').addEventListener('click', function() {
        document.getElementById('confirmationModal').classList.remove('active');
        document.getElementById('hotelForm').removeEventListener('submit', validateForm);
        document.getElementById('hotelForm').submit();
      });

      document.getElementById('okBtn').addEventListener('click', function() {
        document.getElementById('successModal').classList.remove('active');
      });
    });

    // Fonction pour afficher la modale de succès
    function showSuccessModal() {
      document.getElementById('successModal').classList.add('active');
    }
</script>
  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>
</body>
</html>