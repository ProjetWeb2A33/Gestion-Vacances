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
        // Handle image upload
        $image_name = null;
        if (isset($_FILES['hotel_image']) && $_FILES['hotel_image']['error'] == 0) {
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];
            $filename = $_FILES['hotel_image']['name'];
            $file_ext = pathinfo($filename, PATHINFO_EXTENSION);

            // Check if the file extension is allowed
            if (in_array(strtolower($file_ext), $allowed)) {
                // Generate unique filename
                $new_filename = uniqid('hotel_') . '.' . $file_ext;
                $upload_path = '../../../uploads/hotels/' . $new_filename;

                // Move the uploaded file
                if (move_uploaded_file($_FILES['hotel_image']['tmp_name'], $upload_path)) {
                    $image_name = $new_filename;
                } else {
                    $error = "Failed to upload image";
                }
            } else {
                $error = "Invalid file type. Allowed types: " . implode(', ', $allowed);
            }
        }

        if (empty($error)) {
            $hotel = new Hotel(
                null,
                $_POST['nom'],
                $_POST['adresse'],
                $_POST['ville'],
                $_POST['npp'],
                $_POST['ppd'],
                $_POST['categorie'],
                $image_name
            );
            $hotelC->addHotel($hotel);
            header('Location:listHotels.php');
        }
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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800" />
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />

  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />

  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

  <style>
    :root {
      --primary-dark: #0a1d37;
      --accent-blue: #4da6ff;
      --accent-green: #4caf50;
      --accent-red: #f44336;
      --light-gray: #f8f9fa;
      --dark-gray: #343a40;
    }

    body {
      background-color: var(--light-gray) !important;
      font-family: 'Poppins', sans-serif;
    }

    /* Sidebar styles */
    .sidenav {
      background: linear-gradient(195deg, var(--primary-dark) 0%, #0c2461 100%) !important;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    .sidenav .nav-link,
    .sidenav .nav-link-text,
    .sidenav .navbar-brand span,
    .sidenav .material-symbols-rounded {
      color: white !important;
      transition: all 0.3s ease;
    }

    .sidenav .nav-link:hover {
      background-color: rgba(255,255,255,0.1);
      transform: translateX(5px);
    }

    /* Submenu styles */
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

    /* Form container */
    .form-container {
      background: white;
      border-radius: 16px;
      padding: 30px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.08);
      margin: 30px auto;
      max-width: 700px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .form-container:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 35px rgba(0,0,0,0.12);
    }

    .form-container h2 {
      color: var(--primary-dark);
      font-weight: 600;
      margin-bottom: 25px;
      position: relative;
      padding-bottom: 10px;
    }

    .form-container h2::after {
      content: '';
      position: absolute;
      left: 0;
      bottom: 0;
      width: 60px;
      height: 4px;
      background: var(--accent-blue);
      border-radius: 2px;
    }

    /* Form elements */
    .form-label {
      font-weight: 500;
      color: var(--dark-gray);
      margin-bottom: 8px;
      display: block;
    }

    .form-control, .form-select {
      border-radius: 8px;
      padding: 12px 15px;
      border: 1px solid #e0e0e0;
      transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
      border-color: var(--accent-blue);
      box-shadow: 0 0 0 3px rgba(77, 166, 255, 0.2);
    }

    .form-control.is-invalid {
      border: 1px solid var(--accent-red) !important;
    }

    .form-control.is-valid {
      border: 1px solid var(--accent-green) !important;
    }

    /* Buttons */
    .btn {
      border-radius: 8px;
      padding: 10px 20px;
      font-weight: 500;
      transition: all 0.3s ease;
      letter-spacing: 0.5px;
    }

    .btn-primary {
      background-color: var(--accent-blue);
      border-color: var(--accent-blue);
    }

    .btn-primary:hover {
      background-color: #3a8de0;
      border-color: #3a8de0;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(77, 166, 255, 0.3);
    }

    .btn-secondary {
      background-color: #6c757d;
      border-color: #6c757d;
    }

    .btn-secondary:hover {
      background-color: #5a6268;
      border-color: #5a6268;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
    }

    /* Feedback messages */
    .error-message {
      color: var(--accent-red);
      margin-bottom: 20px;
      padding: 12px;
      background-color: rgba(244, 67, 54, 0.1);
      border-radius: 8px;
      border-left: 4px solid var(--accent-red);
      animation: fadeIn 0.5s ease;
    }

    .success-message {
      color: var(--accent-green);
      margin-bottom: 20px;
      padding: 12px;
      background-color: rgba(76, 175, 80, 0.1);
      border-radius: 8px;
      border-left: 4px solid var(--accent-green);
      animation: fadeIn 0.5s ease;
    }

    .form-feedback {
      font-size: 0.875rem;
      margin-top: 0.25rem;
      height: 20px;
      animation: fadeIn 0.3s ease;
    }

    .form-feedback.error {
      color: var(--accent-red);
    }

    .form-feedback.success {
      color: var(--accent-green);
    }

    /* Modal styles */
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
      backdrop-filter: blur(5px);
    }

    .confirmation-modal.active {
      opacity: 1;
      visibility: visible;
    }

    .modal-content {
      background: white;
      border-radius: 16px;
      padding: 30px;
      width: 450px;
      max-width: 90%;
      box-shadow: 0 15px 35px rgba(0,0,0,0.2);
      text-align: center;
      transform: scale(0.9);
      transition: transform 0.3s ease;
      animation: modalFadeIn 0.4s ease forwards;
    }

    .confirmation-modal.active .modal-content {
      transform: scale(1);
    }

    .modal-content h3 {
      color: var(--primary-dark);
      margin-bottom: 20px;
      font-weight: 600;
    }

    .modal-content p {
      color: #555;
      margin-bottom: 25px;
    }

    .modal-buttons {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin-top: 20px;
    }

    /* Animations */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes modalFadeIn {
      from { opacity: 0; transform: translateY(-20px) scale(0.95); }
      to { opacity: 1; transform: translateY(0) scale(1); }
    }

    /* Floating animation for success elements */
    .floating {
      animation: floating 3s ease-in-out infinite;
    }

    @keyframes floating {
      0% { transform: translateY(0px); }
      50% { transform: translateY(-10px); }
      100% { transform: translateY(0px); }
    }

    /* Input focus effect */
    .input-group {
      position: relative;
      margin-bottom: 25px;
    }

    .input-group label {
      position: absolute;
      top: -10px;
      left: 15px;
      background: white;
      padding: 0 5px;
      font-size: 0.8rem;
      color: var(--accent-blue);
      font-weight: 500;
      z-index: 1;
      opacity: 0;
      transition: all 0.3s ease;
    }

    .form-control:focus ~ label {
      opacity: 1;
      transform: translateY(0);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
      .form-container {
        padding: 20px;
        margin: 20px 15px;
      }

      .modal-buttons {
        flex-direction: column;
      }

      .btn {
        width: 100%;
        margin-bottom: 10px;
      }
    }

    /* Custom checkbox and radio */
    .form-check-input:checked {
      background-color: var(--accent-blue);
      border-color: var(--accent-blue);
    }

    /* Star rating for category */
    .star-rating {
      display: flex;
      gap: 5px;
      margin-top: 5px;
    }

    .star-rating i {
      color: #ddd;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .star-rating i.active {
      color: #ffc107;
    }
  </style>
</head>

<body class="g-sidenav-show bg-gray-100">
  <!-- Sidebar -->
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 fixed-start" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0" href="tables.php">
        <img src="../assets/img/easyparki.png" class="navbar-brand-img floating" width="50">
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
          <a class="nav-link active" href="javascript:;" style="background: linear-gradient(87deg, #1e3c72 0%, #2a5298 100%);">
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
          <a class="nav-link" href="../pages/billing.html">
            <i class="material-symbols-rounded opacity-5">receipt_long</i>
            <span class="nav-link-text ms-1">Covoiturage</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/virtual-reality.html">
            <i class="material-symbols-rounded opacity-5">view_in_ar</i>
            <span class="nav-link-text ms-1">Service</span>
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
        <a class="btn btn-outline-white mt-4 w-100" href="http://localhost/ProjetWeb/View/FrontOffice/Logis/about.php">FrontOffice</a>
      </div>
    </div>
  </aside>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <div class="container-fluid py-4">
      <div class="form-container animate__animated animate__fadeIn">
        <h2>Ajouter un Hotel</h2>
        <?php if($error): ?>
          <div class="error-message animate__animated animate__shakeX"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" id="hotelForm" enctype="multipart/form-data">
          <div class="mb-4">
            <label class="form-label">Nom:</label>
            <input type="text" class="form-control" name="nom" id="nom" placeholder="Entrez le nom de l'hôtel">
            <div class="form-feedback" id="nomFeedback"></div>
          </div>

          <div class="mb-4">
            <label class="form-label">Adresse:</label>
            <input type="text" class="form-control" name="adresse" id="adresse" placeholder="Entrez l'adresse de l'hôtel">
            <div class="form-feedback" id="adresseFeedback"></div>
          </div>

          <div class="mb-4">
            <label class="form-label">Ville:</label>
            <input type="text" class="form-control" name="ville" id="ville" placeholder="Entrez la ville">
            <div class="form-feedback" id="villeFeedback"></div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-4">
              <label class="form-label">Places parking total:</label>
              <input type="number" class="form-control" name="npp" id="npp" placeholder="Nombre total de places">
              <div class="form-feedback" id="nppFeedback"></div>
            </div>

            <div class="col-md-6 mb-4">
              <label class="form-label">Places disponibles:</label>
              <input type="number" class="form-control" name="ppd" id="ppd" placeholder="Places disponibles">
              <div class="form-feedback" id="ppdFeedback"></div>
            </div>
          </div>

          <div class="mb-4">
            <label class="form-label">Catégorie:</label>
            <select class="form-select" name="categorie" id="categorie">
              <option value="">Sélectionnez une catégorie</option>
              <option value="1 étoile">1 étoile</option>
              <option value="2 étoiles">2 étoiles</option>
              <option value="3 étoiles">3 étoiles</option>
              <option value="4 étoiles">4 étoiles</option>
              <option value="5 étoiles">5 étoiles</option>
            </select>
            <div class="form-feedback" id="categorieFeedback"></div>
          </div>

          <div class="mb-4">
            <label class="form-label">Image de l'hôtel:</label>
            <input type="file" class="form-control" name="hotel_image" id="hotel_image" accept="image/*">
            <div class="form-text text-muted">Formats acceptés: JPG, JPEG, PNG, GIF. Taille max: 2MB</div>
            <div class="form-feedback" id="imageFeedback"></div>
            <div class="mt-2" id="imagePreviewContainer" style="display: none;">
              <img id="imagePreview" src="#" alt="Aperçu de l'image" style="max-width: 100%; max-height: 200px; border-radius: 8px;">
            </div>
          </div>

          <div class="d-flex justify-content-between mt-4">
            <a href="listHotels.php" class="btn btn-secondary animate__animated animate__fadeInLeft">
              <i class="fas fa-list me-2"></i> Liste des Hôtels
            </a>
            <button type="submit" class="btn btn-primary animate__animated animate__fadeInRight">
              <i class="fas fa-plus-circle me-2"></i> Ajouter
            </button>
          </div>
        </form>
      </div>
    </div>
  </main>

  <!-- Modal de confirmation -->
  <div class="confirmation-modal" id="confirmationModal">
    <div class="modal-content">
      <div class="text-center mb-4">
        <i class="fas fa-hotel fa-4x text-primary mb-3 animate__animated animate__bounceIn"></i>
        <h3>Confirmation</h3>
      </div>
      <p>Voulez-vous vraiment ajouter cet hôtel ?</p>
      <div class="modal-buttons">
        <button type="button" class="btn btn-secondary" id="cancelBtn">
          <i class="fas fa-times me-2"></i> Annuler
        </button>
        <button type="button" class="btn btn-primary" id="confirmBtn">
          <i class="fas fa-check me-2"></i> Confirmer
        </button>
      </div>
    </div>
  </div>

  <!-- Modal de Succès -->
  <div class="confirmation-modal" id="successModal">
    <div class="modal-content">
      <div class="text-center mb-4">
        <i class="fas fa-check-circle fa-4x text-success mb-3 animate__animated animate__bounceIn"></i>
        <h3>Succès</h3>
      </div>
      <p>L'hôtel a été ajouté avec succès !</p>
      <div class="modal-buttons justify-content-center">
        <button type="button" class="btn btn-success" id="okBtn">
          <i class="fas fa-thumbs-up me-2"></i> OK
        </button>
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
          feedbackElement.classList.add('animate__animated', 'animate__shakeX');
        } else {
          inputElement.classList.add('is-valid');
          inputElement.classList.remove('is-invalid');
          feedbackElement.classList.add('animate__animated', 'animate__fadeIn');
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
        showFeedback('adresseFeedback', 'L\'adresse est requise', true);
        return false;
      } else if (adresse.length > 8) {
        showFeedback('adresseFeedback', 'L\'adresse ne doit pas dépasser 8 caractères', true);
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
      const isImageValid = validateImage();

      if (isNomValid && isAdresseValid && isVilleValid &&
          isNppValid && isPpdValid && isCategorieValid && isImageValid) {
        // Animation avant d'afficher la modal
        document.querySelector('.form-container').classList.add('animate__animated', 'animate__pulse');
        setTimeout(() => {
          document.getElementById('confirmationModal').classList.add('active');
          document.querySelector('.form-container').classList.remove('animate__animated', 'animate__pulse');
        }, 500);
      }

      return false;
    }

    // Validation de l'image
    function validateImage() {
      const fileInput = document.getElementById('hotel_image');
      const feedbackElement = document.getElementById('imageFeedback');

      if (fileInput.files.length === 0) {
        // L'image est optionnelle, donc pas d'erreur si aucun fichier n'est sélectionné
        feedbackElement.textContent = '';
        feedbackElement.className = 'form-feedback';
        return true;
      }

      const file = fileInput.files[0];
      const fileSize = file.size / 1024 / 1024; // en MB
      const fileType = file.type;
      const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];

      if (!validTypes.includes(fileType)) {
        showFeedback('imageFeedback', 'Format de fichier non valide. Utilisez JPG, JPEG, PNG ou GIF.', true);
        return false;
      }

      if (fileSize > 2) {
        showFeedback('imageFeedback', 'L\'image est trop volumineuse. Taille maximale: 2MB', true);
        return false;
      }

      showFeedback('imageFeedback', 'Image valide', false);
      return true;
    }

    // Fonction pour afficher l'aperçu de l'image
    function displayImagePreview() {
      const fileInput = document.getElementById('hotel_image');
      const previewContainer = document.getElementById('imagePreviewContainer');
      const previewImage = document.getElementById('imagePreview');

      if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
          previewImage.src = e.target.result;
          previewContainer.style.display = 'block';
        }

        reader.readAsDataURL(fileInput.files[0]);
      } else {
        previewContainer.style.display = 'none';
      }
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
      document.getElementById('hotel_image').addEventListener('change', function() {
        validateImage();
        displayImagePreview();
      });

      // Soumission du formulaire
      document.getElementById('hotelForm').addEventListener('submit', validateForm);

      // Gestion de la modale de confirmation
      document.getElementById('cancelBtn').addEventListener('click', function() {
        document.getElementById('confirmationModal').classList.remove('active');
      });

      document.getElementById('confirmBtn').addEventListener('click', function() {
        document.getElementById('confirmationModal').classList.remove('active');
        document.getElementById('hotelForm').removeEventListener('submit', validateForm);

        // Animation de chargement
        const submitBtn = document.querySelector('#hotelForm button[type="submit"]');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Ajout en cours...';
        submitBtn.disabled = true;

        // Simuler un délai pour l'animation
        setTimeout(() => {
          document.getElementById('hotelForm').submit();
        }, 1500);
      });

      // Gestion de la modale de succès
      document.getElementById('okBtn').addEventListener('click', function() {
        document.getElementById('successModal').classList.remove('active');
        window.location.href = 'listHotels.php';
      });
    });

    // Si le formulaire a été soumis avec succès, afficher la modale de succès
    <?php if(isset($_POST["nom"]) && empty($error)): ?>
      document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('successModal').classList.add('active');
      });
    <?php endif; ?>
  </script>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>
</body>
</html>