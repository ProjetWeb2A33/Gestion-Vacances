<?php
include '../../../Controller/HotelC.php';
include '../../../Model/Hotel.php';
$error = "";
$hotelC = new HotelC();

if (isset($_POST["id"])) {
    $hotel = $hotelC->showHotel($_POST["id"]);
    
    if (
        isset($_POST["nom"]) &&
        isset($_POST["adresse"]) &&
        isset($_POST["ville"]) &&
        isset($_POST["npp"]) &&
        isset($_POST["ppd"]) &&
        isset($_POST["categorie"])
    ) {
        if (
            !empty($_POST["nom"]) &&
            !empty($_POST["adresse"]) &&
            !empty($_POST["ville"]) &&
            !empty($_POST["npp"]) &&
            !empty($_POST["ppd"]) &&
            !empty($_POST["categorie"])
        ) {
            $updatedHotel = new Hotel(
                $_POST['id'],
                $_POST['nom'],
                $_POST['adresse'],
                $_POST['ville'],
                $_POST['npp'],
                $_POST['ppd'],
                $_POST['categorie']
            );
            $hotelC->updateHotel($updatedHotel, $_POST['id']);
            header('Location:listHotels.php');
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
  
  <title>EasyParki - Modifier Hôtel</title>
  
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
  <!-- Sidebar -->
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

        <?php if(isset($_POST['id'])): ?>
        <h3 class="mb-4">Modifier l'hôtel</h3>
        <form method="POST" onsubmit="return validateForm()">
          <input type="hidden" name="id" value="<?= $hotel['id_hotel'] ?>">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Nom de l'hôtel</label>
                <input type="text" name="nom" class="form-control" value="<?= $hotel['nom_hotel'] ?>">
              </div>
              
              <div class="form-group">
                <label>Adresse</label>
                <input type="text" name="adresse" class="form-control" value="<?= $hotel['adresse'] ?>">
              </div>
              
              <div class="form-group">
                <label>Ville</label>
                <input type="text" name="ville" class="form-control" value="<?= $hotel['ville'] ?>">
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-group">
                <label>Places parking totales</label>
                <input type="number" name="npp" class="form-control" value="<?= $hotel['nombre_places_parking'] ?>">
              </div>
              
              <div class="form-group">
                <label>Places disponibles</label>
                <input type="number" name="ppd" class="form-control" value="<?= $hotel['places_parking_disponibles'] ?>">
              </div>
              
              <div class="form-group">
                <label>Catégorie</label>
                <select name="categorie" class="form-control">
                  <?php $cats = ["1 étoile", "2 étoiles", "3 étoiles", "4 étoiles", "5 étoiles"]; ?>
                  <?php foreach ($cats as $cat): ?>
                    <option value="<?= $cat ?>" <?= ($cat == $hotel['categorie']) ? 'selected' : '' ?>>
                      <?= $cat ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          
          <div class="text-end mt-4">
            <div class="error-message" id="errorMessage"></div>
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-save me-2"></i>Mettre à jour
            </button>
            <a href="listHotels.php" class="btn btn-secondary">
              <i class="fas fa-times me-2"></i>Annuler
            </a>
          </div>
        </form>
        <?php endif; ?>
      </div>
    </div>
  </main>

  <!-- Validation Script -->
  <script>
    function validateForm() {
      const errorMessage = document.getElementById('errorMessage');
      let errors = [];
      
      // Get form values
      const nom = document.getElementsByName('nom')[0].value.trim();
      const adresse = document.getElementsByName('adresse')[0].value.trim();
      const ville = document.getElementsByName('ville')[0].value.trim();
      const npp = document.getElementsByName('npp')[0].value;
      const ppd = document.getElementsByName('ppd')[0].value;
      const categorie = document.getElementsByName('categorie')[0].value;

      // Validation rules
      if (!nom) errors.push("Le nom de l'hôtel est obligatoire");
      if (!adresse) errors.push("L'adresse est obligatoire");
      if (!ville) errors.push("La ville est obligatoire");
      if (!npp) errors.push("Le nombre de places totales est obligatoire");
      if (!ppd) errors.push("Le nombre de places disponibles est obligatoire");
      if (!categorie) errors.push("La catégorie est obligatoire");

      if (nom.length > 8) errors.push("Le nom ne doit pas dépasser 8 caractères");
      if (ville.length > 8) errors.push("La ville ne doit pas dépasser 8 caractères");

      if (npp && ppd) {
        const total = parseInt(npp);
        const available = parseInt(ppd);
        
        if (available > total) {
          errors.push("Les places disponibles ne peuvent pas dépasser le total des places");
        }
        if (total <= 0) errors.push("Le nombre total de places doit être positif");
        if (available < 0) errors.push("Les places disponibles ne peuvent pas être négatives");
      }

      // Display errors or submit
      if (errors.length > 0) {
        errorMessage.innerHTML = errors.join('<br>');
        return false;
      }
      
      return true;
    }
  </script>
  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>
</body>
</html>