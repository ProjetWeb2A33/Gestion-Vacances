<?php
require_once __DIR__ . '/../../../Controller/planVacanceC.php';
require_once __DIR__ . '/../../../Model/planVacance.php';
require_once __DIR__ . '/../../../Controller/HotelC.php';

$error = "";
$planC = new PlanVacanceC();
$hotelC = new HotelC();
$hotels = $hotelC->listHotels();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Debug POST data
    echo "<!-- Debug POST data: " . print_r($_POST, true) . " -->";

    if (
        !empty($_POST['identifiant']) &&
        !empty($_POST['nom_utilisateur']) &&
        !empty($_POST['email']) &&
        !empty($_POST['date_depart']) &&
        !empty($_POST['date_retour']) &&
        !empty($_POST['type_transport']) &&
        !empty($_POST['location_voiture']) &&
        !empty($_POST['besoin_parking']) &&
        !empty($_POST['id_hotel'])
    ) {
        if (strtotime($_POST['date_retour']) > strtotime($_POST['date_depart'])) {
            // Debug form validation passed
            echo "<!-- Debug: Form validation passed -->";

            $plan = new PlanVacance(
                null,
                $_POST['identifiant'],
                $_POST['nom_utilisateur'],
                $_POST['email'],
                $_POST['date_depart'],
                $_POST['date_retour'],
                $_POST['type_transport'],
                $_POST['location_voiture'],
                $_POST['besoin_parking'],
                $_POST['id_hotel']
            );

            // Try to add the plan and capture the result
            $result = $planC->addPlan($plan);

            if ($result) {
                // Success message is now handled by the Controller class
                // which also handles the email notification

                // Don't redirect immediately so we can see the success message
                // Uncomment the line below if you want to redirect after successful submission
                // header('Location: listplanVacance.php');
            } else {
                echo "<div style='background-color: #f8d7da; color: #721c24; padding: 10px; margin: 10px 0; border-radius: 5px;'>
                        Une erreur s'est produite lors de l'ajout du plan de vacances. Veuillez réessayer.
                      </div>";
            }
        } else {
            $error = "La date de retour doit être après la date de départ";
        }
    } else {
        $error = "Informations manquantes";
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
  <title>EasyParki - Ajouter un Plan de Vacances</title>

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
    .form-feedback {
    font-size: 0.875rem;
    margin-top: 0.25rem;
    height: 20px;
    animation: fadeIn 0.3s ease;
}
.form-feedback.error {
    color: #dc3545;
}
.form-feedback.success {
    color: #28a745;
}
  </style>
</head>

<body class="g-sidenav-show bg-gray-100">
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
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-5">Comptes</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/profile.html">
            <i class="material-symbols-rounded opacity-5">person</i>
            <span class="nav-link-text ms-1">Profil</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/sign-in.html">
            <i class="material-symbols-rounded opacity-5">login</i>
            <span class="nav-link-text ms-1">Connexion</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/sign-up.html">
            <i class="material-symbols-rounded opacity-5">assignment</i>
            <span class="nav-link-text ms-1">Inscription</span>
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
        <h2>Ajouter un Plan de Vacances</h2>
        <?php if($error): ?>
          <div class="error-message animate__animated animate__shakeX"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" id="planForm">
          <div class="row">
            <div class="col-md-6 mb-4">
              <label class="form-label">Nom Utilisateur:</label>
              <input type="text" class="form-control" name="nom_utilisateur" id="nom_utilisateur" placeholder="Entrez le nom d'utilisateur">
              <div class="form-feedback" id="nom_utilisateurFeedback"></div>
            </div>

            <div class="col-md-6 mb-4">
              <label class="form-label">Identifiant Utilisateur:</label>
              <input type="text" class="form-control" name="identifiant" id="identifiant" placeholder="Entrez l'identifiant">
              <div class="form-feedback" id="identifiantFeedback"></div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 mb-4">
              <label class="form-label">Email:</label>
              <input type="email" class="form-control" name="email" id="email" placeholder="Entrez l'adresse email">
              <div class="form-feedback" id="emailFeedback"></div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-4">
              <label class="form-label">Date Départ:</label>
              <input type="date" class="form-control" name="date_depart" id="date_depart">
              <div class="form-feedback" id="date_departFeedback"></div>
            </div>

            <div class="col-md-6 mb-4">
              <label class="form-label">Date Retour:</label>
              <input type="date" class="form-control" name="date_retour" id="date_retour">
              <div class="form-feedback" id="date_retourFeedback"></div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-4">
              <label class="form-label">Type Transport:</label>
              <select class="form-select" name="type_transport" id="type_transport">
                <option value="">Sélectionner un type</option>
                <option value="voiture">Voiture</option>
                <option value="taxi">Taxi</option>
                <option value="bus">Bus</option>
              </select>
              <div class="form-feedback" id="type_transportFeedback"></div>
            </div>

            <div class="col-md-6 mb-4">
              <label class="form-label">Hotel:</label>
              <select class="form-select" name="id_hotel" id="id_hotel">
                <option value="">Sélectionner un hôtel</option>
                <?php foreach ($hotels as $hotel): ?>
                  <option value="<?= $hotel['id_hotel'] ?>">
                    ID: <?= $hotel['id_hotel'] ?> - <?= $hotel['nom_hotel'] ?> (<?= $hotel['ville'] ?>)
                  </option>
                <?php endforeach; ?>
              </select>
              <div class="form-feedback" id="id_hotelFeedback"></div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-4">
              <label class="form-label">Location Voiture:</label>
              <div class="d-flex gap-4">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="location_voiture"
                         id="oui_voiture" value="oui">
                  <label class="form-check-label text-success" for="oui_voiture">
                    Oui
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="location_voiture"
                         id="non_voiture" value="non">
                  <label class="form-check-label text-danger" for="non_voiture">
                    Non
                  </label>
                </div>
              </div>
              <div class="form-feedback" id="location_voitureFeedback"></div>
            </div>

            <div class="col-md-6 mb-4">
              <label class="form-label">Besoin Parking:</label>
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
              <div class="form-feedback" id="besoin_parkingFeedback"></div>
            </div>
          </div>
      <div class="d-flex justify-content-between mt-4">
        <a href="listplanVacance.php" class="btn btn-secondary animate__animated animate__fadeInLeft">
          <i class="fas fa-list me-2"></i> Liste des Plans
        </a>
        <button type="submit" class="btn btn-primary animate__animated animate__fadeInRight">
          <i class="fas fa-plus-circle me-2"></i> Ajouter
        </button>
      </div>
    </form>
  </div>
</div>
</main>

<script>
// Fonction pour afficher les messages de feedback
function showFeedback(elementId, message, isError) {
    const feedbackElement = document.getElementById(elementId);
    feedbackElement.textContent = message;
    feedbackElement.className = 'form-feedback ' + (isError ? 'error' : 'success');

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
function validateNomUtilisateur() {
    const nom = document.getElementById('nom_utilisateur').value.trim();
    if (!nom) {
        showFeedback('nom_utilisateurFeedback', 'Le nom est requis', true);
        return false;
    } else if (nom.length > 8) {
        showFeedback('nom_utilisateurFeedback', 'Max 8 caractères', true);
        return false;
    }
    showFeedback('nom_utilisateurFeedback', 'Valide', false);
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

function validateEmail() {
    const email = document.getElementById('email').value.trim();
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Simple email validation

    if (!email) {
        showFeedback('emailFeedback', 'L\'email est requis', true);
        return false;
    } else if (!regex.test(email)) {
        showFeedback('emailFeedback', 'Format d\'email invalide', true);
        return false;
    }
    showFeedback('emailFeedback', 'Valide', false);
    return true;
}

function validateDates() {
    const today = new Date().toISOString().split('T')[0];
    const depart = document.getElementById('date_depart').value;
    const retour = document.getElementById('date_retour').value;
    let isValid = true;

    if (!depart) {
        showFeedback('date_departFeedback', 'Date requise', true);
        isValid = false;
    } else if (depart < today) {
        showFeedback('date_departFeedback', 'Date dans le passé', true);
        isValid = false;
    } else {
        showFeedback('date_departFeedback', 'Valide', false);
    }

    if (!retour) {
        showFeedback('date_retourFeedback', 'Date requise', true);
        isValid = false;
    } else if (retour <= depart) {
        showFeedback('date_retourFeedback', 'Doit être après départ', true);
        isValid = false;
    } else {
        showFeedback('date_retourFeedback', 'Valide', false);
    }

    return isValid;
}

function validateTransport() {
    const transport = document.getElementById('type_transport').value;
    if (!transport) {
        showFeedback('type_transportFeedback', 'Sélection requise', true);
        return false;
    }
    showFeedback('type_transportFeedback', 'Valide', false);
    return true;
}

function validateHotel() {
    const hotel = document.getElementById('id_hotel').value;
    if (!hotel) {
        showFeedback('id_hotelFeedback', 'Sélection requise', true);
        return false;
    }
    showFeedback('id_hotelFeedback', 'Valide', false);
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

    const isNomValid = validateNomUtilisateur();
    const isIdentifiantValid = validateIdentifiant();
    const isEmailValid = validateEmail();
    const areDatesValid = validateDates();
    const isTransportValid = validateTransport();
    const isHotelValid = validateHotel();
    const isLocationValid = validateRadio('location_voiture', 'location_voitureFeedback');
    const isParkingValid = validateRadio('besoin_parking', 'besoin_parkingFeedback');

    if (isNomValid && isIdentifiantValid && isEmailValid && areDatesValid && isTransportValid &&
        isHotelValid && isLocationValid && isParkingValid) {
        // Disable form validation to allow direct submission
        document.getElementById('planForm').noValidate = true;
        document.getElementById('planForm').submit();
    }
}

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    // Validation en temps réel
    document.getElementById('nom_utilisateur').addEventListener('input', validateNomUtilisateur);
    document.getElementById('identifiant').addEventListener('input', validateIdentifiant);
    document.getElementById('email').addEventListener('input', validateEmail);
    document.getElementById('date_depart').addEventListener('change', validateDates);
    document.getElementById('date_retour').addEventListener('change', validateDates);
    document.getElementById('type_transport').addEventListener('change', validateTransport);
    document.getElementById('id_hotel').addEventListener('change', validateHotel);

    // Gestion des radios
    document.querySelectorAll('input[name="location_voiture"]').forEach(radio => {
        radio.addEventListener('change', () => validateRadio('location_voiture', 'location_voitureFeedback'));
    });
    document.querySelectorAll('input[name="besoin_parking"]').forEach(radio => {
        radio.addEventListener('change', () => validateRadio('besoin_parking', 'besoin_parkingFeedback'));
    });

    // Soumission du formulaire
    document.getElementById('planForm').addEventListener('submit', validateForm);

    // Définir la date minimale pour les champs de date
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('date_depart').min = today;

    document.getElementById('date_depart').addEventListener('change', function() {
        document.getElementById('date_retour').min = this.value;
    });
});
</script>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Succès</h5>
      </div>
      <div class="modal-body">
        <div class="text-center mb-3">
          <i class="fas fa-check-circle fa-4x text-success animate__animated animate__bounceIn"></i>
        </div>
        <p class="text-center">Le plan de vacance a été ajouté avec succès!</p>
        <p class="text-center">Un email de confirmation a été envoyé à l'adresse <strong><?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?></strong>.</p>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="window.location.href='listplanVacance.php'">
          <i class="fas fa-thumbs-up me-2"></i>OK
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>

<?php if(isset($_POST["nom_utilisateur"]) && $result): ?>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var myModal = new bootstrap.Modal(document.getElementById('successModal'));
    myModal.show();
  });
</script>
<?php endif; ?>

</body>
</html>
