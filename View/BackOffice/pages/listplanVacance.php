<?php
require_once "../../../Controller/planVacanceC.php"; 
require_once __DIR__ . '/../../../Controller/planVacanceC.php';

$c = new PlanVacanceC();
$hotelC = new HotelC();

// Initialize the search variable
$search = isset($_GET['search']) ? $_GET['search'] : ''; // Get search value from GET

// If search value is provided, filter the results
if (!empty($search)) {
    $tab = $c->searchPlansByIdentifiant($search); // Retourne un tableau
} else {
    $tab = $c->listPlans(); // Retourne un tableau
}

// Check if sort request is made
if (isset($_GET['sort']) && $_GET['sort'] == 'date_depart') {
  usort($tab, function($a, $b) {
      return strtotime($a['date_depart']) - strtotime($b['date_depart']);
  });
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/easyparki.png">
  <title>EasyParki - Plans de Vacance</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
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
      color: red;
      margin-bottom: 15px;
    }

    
    .custom-table {
      background: white;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }
    
    .custom-table th {
      background-color: var(--accent-blue) !important;
      color: white !important;
      padding: 1rem;
    }
    
    .custom-table td {
      vertical-align: middle;
      padding: 1rem;
    }

    .bg-gradient-primary {
        background: linear-gradient(195deg, #EC407A 0%, #D81B60 100%);
        border: none;
    }

    .bg-gradient-primary:hover {
        background: linear-gradient(195deg, #D81B60 0%, #EC407A 100%);
    }
    .bg-gradient-blue {
  background: linear-gradient(87deg, #1e3c72 0%, #2a5298 100%);
  color: white !important;
}

    /* PDF Export Button Styles */
    .pdf-export-btn {
        background: linear-gradient(45deg, #4a00e0, #8e2de2);
        border: none;
        border-radius: 50px;
        color: white;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        box-shadow: 0 4px 15px rgba(74, 0, 224, 0.4);
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
        padding: 12px 24px;
    }
    
    .pdf-export-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(74, 0, 224, 0.6);
    }
    
    .pdf-export-btn .btn-content {
        position: relative;
        z-index: 1;
    }
    
    .pdf-export-btn .btn-effect {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255,255,255,0.2);
        transform: translateX(-100%) skewX(-15deg);
        transition: all 0.6s ease;
    }
    
    .pdf-export-btn:hover .btn-effect {
        transform: translateX(0) skewX(-15deg);
    }
    
    /* Sort Button Styles */
    .sort-btn {
        background: linear-gradient(45deg,rgb(40, 85, 80),rgb(40, 85, 80));
        border: none;
        border-radius: 50px;
        color: white;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        box-shadow: 0 4px 15px rgba(0, 176, 155, 0.4);
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
        padding: 12px 24px;
        margin-right: 10px;
    }
    
    .sort-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(40, 85, 80);
    }
    
    .sort-btn .btn-content {
        position: relative;
        z-index: 1;
    }
    
    .sort-btn .btn-effect {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255,255,255,0.2);
        transform: translateX(-100%) skewX(-15deg);
        transition: all 0.6s ease;
    }
    
    .sort-btn:hover .btn-effect {
        transform: translateX(0) skewX(-15deg);
    }
    .custom-title {
    color:rgb(10, 50, 107) !important;
    font-family: 'Inter', sans-serif;
    font-weight: 700;
}

.custom-subtitle {
    color: #000 !important;
    font-family: 'Inter', sans-serif;
    font-weight: 400;
}
    /* Button container */
    .button-container {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 20px;
        flex-wrap: wrap;
    }
    
    /* Animation for sorting */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .table-row-animate {
        animation: fadeIn 0.5s ease forwards;
    }
    
    /* Rotate icon when sorting */
    .rotate-icon {
        animation: rotate 0.5s ease;
    }
    
    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    .search-btn {
        background-color:rgb(18, 55, 96); /* Bleu Bootstrap */
        border-color:rgb(18, 55, 96);
        color: white;
    }
    .search-btn:hover {
        background-color:rgb(18, 55, 96); /* Bleu un peu plus foncé au survol */
        border-color:rgb(18, 55, 96);
    }
    #statsChartContainer {
    display: none; /* Masque le conteneur par défaut */
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1000;
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    width: 80%;
    max-width: 600px;
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
        <a class="nav-link active bg-gradient-blue text-white" href="javascript:;">
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
        <div class="card shadow-lg">
            <div class="card-header bg-white border-0 pb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0 custom-title">Liste des Plans de Vacances</h3>
                        <p class="mb-0 custom-subtitle">Gestion complète des plans de vacances</p>
                    </div>
                    <a href="addplanVacance.php" class="btn" style="background-color: #1a5d1a; color: white; border-radius: 4px; border: none; padding: 10px 20px; font-weight: 500;">
                        <i class="fas fa-plus me-2"></i>Ajouter un Plan
                    </a>
                </div>
            </div>
            
            <div class="card-body px-0 pt-0">
                <!-- Search form -->
                <div class="px-4 pt-3">
                    <form method="GET" class="d-flex w-100">
                        <div class="input-group">
                            <input type="text" 
                                   name="search" 
                                   class="form-control search-input" 
                                   placeholder="Rechercher par identifiant..." 
                                   value="<?= htmlspecialchars($search ?? '') ?>" 
                                   aria-label="Rechercher par identifiant">
                                   <button type="submit" class="btn btn-primary search-btn">
                                  <i class="fas fa-search me-2"></i> Rechercher
                              </button>
                        </div>
                    </form>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="plansTable">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Identifiant</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Utilisateur</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Départ</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Retour</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Transport</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Location</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Parking</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hôtel</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tab as $plan): 
                              $hotel = $hotelC->showHotel($plan['id_hotel']);
                            ?>
                            <tr>
                                <td class="ps-4">
                                    <span class="text-xs font-weight-bold"><?= $plan['id_plan'] ?></span>
                                </td>
                                <td>
                                    <span class="text-xs font-weight-bold"><?= $plan['identifiant'] ?></span>
                                </td>
                                <td>
                                    <span class="text-xs font-weight-normal"><?= $plan['nom_utilisateur'] ?></span>
                                </td>
                                <td>
                                    <span class="text-xs font-weight-bold"><?= $plan['date_depart'] ?></span>
                                </td>
                                <td>
                                    <span class="text-xs font-weight-bold"><?= $plan['date_retour'] ?></span>
                                </td>
                                <td>
                                    <span class="badge badge-sm" style="background-color: #515b8a; color: white;">
                                        <?= ucfirst($plan['type_transport']) ?>
                                    </span>
                                </td>
                                <td>
                                <span class="badge badge-sm" style="background-color: <?= $plan['location_voiture'] == 'oui' ? '#1e8449' : '#922b21' ?>; color: white;">
    <?= ucfirst($plan['location_voiture']) ?>
</span>
                                </td>
                                <td>
                                    <span class="badge badge-sm" style="background-color: <?= $plan['besoin_parking'] == 'oui' ? '#1e8449' : '#922b21' ?>; color: white;">
                                        <?= ucfirst($plan['besoin_parking']) ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="text-xs font-weight-normal"><?= $hotel['nom_hotel'] ?? 'Inconnu' ?></span>
                                    <br>
                                    <small class="text-xs text-muted"><?= $hotel['ville'] ?? '' ?></small>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-flex justify-content-end gap-2">
                                        <form method="POST" action="updateplanVacance.php" class="m-0">
                                            <input type="hidden" name="id" value="<?= $plan['id_plan'] ?>">
                                            <button type="submit" class="btn btn-sm" style="border: 1px solid rgb(155, 32, 62); color:rgb(155, 32, 62); border-radius: 4px; padding: 6px 12px;">
                                                <i class="fas fa-edit me-1"></i> Modifier
                                            </button>
                                        </form>
                                        <a href="deletePlanVacance.php?id=<?= $plan['id_plan'] ?>" 
                                           onclick="confirmDelete(event, <?= $plan['id_plan'] ?>)" 
                                           class="btn btn-sm" style="border: 1px solid #28a745; color: #28a745; border-radius: 4px; padding: 6px 12px;">
                                            <i class="fas fa-trash me-1"></i> Supprimer
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="card-footer bg-white border-0 pt-4 pb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <a href="?sort=date_depart" class="btn btn-sm" style="border: 1px solid #0056b3; color: #0056b3; border-radius: 4px; padding: 6px 12px; margin-right: 10px;">
                            <i class="fas fa-calendar-alt me-1"></i> Trier par Date
                        </a>
                        <button id="exportPdfBtn" class="btn btn-sm" style="border: 1px solid #6c757d; color: #6c757d; border-radius: 4px; padding: 6px 12px;">
                            <i class="fas fa-file-pdf me-1"></i> Exporter en PDF
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="statsButtonContainer" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
    <button id="statsButton" class="btn btn-primary" style="border-radius: 50%; width: 60px; height: 60px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);">
        <i class="fas fa-chart-bar"></i>
    </button>
    <div class="card shadow-lg mt-4">
    <div id="statsChartContainer">
    <div class="card shadow-lg">
        <div class="card-header bg-white">
            <h5 class="card-title">Statistiques des Plans de Vacances</h5>
            <button onclick="closeStats()" class="btn btn-danger btn-sm" style="float: right;">Fermer</button>
        </div>
        <div class="card-body">
            <canvas id="barChart" width="400" height="200"></canvas>
        </div>
    </div>
</div>
</div>
</div>
  </main>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
  
  <script>
    // Delete confirmation function
    function confirmDelete(event, id) {
        event.preventDefault();
        
        const modal = `
            <div class="modal-overlay" style="
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0,0,0,0.5);
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 1000;
            ">
                <div class="modal-content" style="
                    background: white;
                    padding: 25px;
                    border-radius: 10px;
                    width: 400px;
                    max-width: 90%;
                    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
                    text-align: center;
                ">
                    <h4 style="margin-top: 0">Confirmer la suppression</h4>
                    <p>Êtes-vous sûr de vouloir supprimer ce plan de vacances ?</p>
                    <div style="display: flex; justify-content: center; gap: 15px; margin-top: 20px;">
                        <button onclick="this.closest('.modal-overlay').remove()" 
                                class="btn btn-secondary" 
                                style="padding: 8px 20px">
                            Annuler
                        </button>
                        <a href="deletePlanVacance.php?id=${id}" 
                           class="btn btn-primary" 
                           style="padding: 8px 20px; background-color: #4da6ff; border-color: #4da6ff;">
                           <i class="fas fa-check me-2"></i>Confirmer
                        </a>
                    </div>
                </div>
            </div>
        `;
        
        document.body.insertAdjacentHTML('beforeend', modal);
    }

    // PDF Export Functionality
    document.addEventListener('DOMContentLoaded', function() {
        const { jsPDF } = window.jspdf;
        const exportBtn = document.getElementById('exportPdfBtn');
        
        exportBtn.addEventListener('click', function() {
            // Show loading state
            const originalHtml = this.innerHTML;
            this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Génération en cours...';
            this.disabled = true;
            
            // Get table data
            const headers = [];
            const rows = [];
            
            // Get headers (skip Actions column)
            document.querySelectorAll('#plansTable thead th').forEach((th, index) => {
                if (index < 9) { // Only take first 9 columns
                    headers.push(th.textContent.trim());
                }
            });
            
            // Get rows data
            document.querySelectorAll('#plansTable tbody tr').forEach(tr => {
                const row = [];
                tr.querySelectorAll('td').forEach((td, index) => {
                    if (index < 9) { // Only take first 9 columns
                        row.push(td.textContent.trim());
                    }
                });
                rows.push(row);
            });
            
            // Create PDF after short delay
            setTimeout(() => {
                try {
                    const doc = new jsPDF('p', 'pt', 'a4');
                    
                    // Add title
                    doc.setFontSize(18);
                    doc.setTextColor(40);
                    doc.text('Liste des Plans de Vacances - EasyParki', 40, 40);
                    
                    // Add date and search term if applicable
                    doc.setFontSize(10);
                    doc.setTextColor(100);
                    doc.text('Généré le: ' + new Date().toLocaleDateString(), 40, 60);
                    
                    <?php if (!empty($search)): ?>
                    doc.text('Recherche: "' + <?= json_encode($search) ?> + '"', 40, 75);
                    <?php endif; ?>
                    
                    // Add table if data exists
                    if (rows.length > 0) {
                        doc.autoTable({
                            head: [headers],
                            body: rows,
                            startY: <?php echo !empty($search) ? 80 : 70 ?>,
                            theme: 'grid',
                            headStyles: {
                                fillColor: [74, 0, 224],
                                textColor: 255,
                                fontStyle: 'bold'
                            },
                            alternateRowStyles: {
                                fillColor: [240, 240, 240]
                            },
                            margin: { left: 40 }
                        });
                    } else {
                        doc.setFontSize(12);
                        doc.text('Aucun plan de vacances à afficher', 40, 80);
                    }
                    
                    // Save the PDF
                    doc.save('plans_vacances_easyparki_' + new Date().toISOString().slice(0, 10) + '.pdf');
                    
                } catch (error) {
                    console.error('PDF generation error:', error);
                    alert('Une erreur est survenue lors de la génération du PDF');
                } finally {
                    // Reset button
                    exportBtn.innerHTML = originalHtml;
                    exportBtn.disabled = false;
                }
            }, 100);
        });
    });
    document.addEventListener('DOMContentLoaded', function () {
    const statsButton = document.getElementById('statsButton');
    const statsChartContainer = document.getElementById('statsChartContainer');
    const ctx = document.getElementById('barChart').getContext('2d');
    let chartInstance; // Pour stocker l'instance du graphique

    // Fonction pour calculer les statistiques
    function calculateStats() {
        const rows = document.querySelectorAll('#plansTable tbody tr');
        const stats = {};

        rows.forEach(row => {
            const transport = row.querySelector('td:nth-child(6) span').textContent.trim(); // Colonne Transport
            if (!stats[transport]) {
                stats[transport] = 0;
            }
            stats[transport]++;
        });

        return stats;
    }

    // Fonction pour afficher le graphique
    function showStats() {
        statsChartContainer.style.display = 'block'; // Affiche le conteneur

        const stats = calculateStats();
        const labels = Object.keys(stats); // Les types de transport
        const data = Object.values(stats); // Le nombre de plans par type de transport

        // Si un graphique existe déjà, le détruire avant d'en créer un nouveau
        if (chartInstance) {
            chartInstance.destroy();
        }

        // Créer le graphique en bâtons
        chartInstance = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Nombre de Plans par Type de Transport',
                    data: data,
                    backgroundColor: [
                        '#1E88E5', // Bleu clair
                        '#1565C0', // Bleu moyen
                        '#0D47A1', // Bleu foncé
                        '#42A5F5', // Bleu pastel
                        '#90CAF9'  // Bleu très clair
                    ],
                    borderColor: '#fff',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return `${context.label}: ${context.raw} plans`;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Type de Transport'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Nombre de Plans'
                        }
                    }
                }
            }
        });
    }

    // Fonction pour masquer le graphique
    function closeStats() {
        statsChartContainer.style.display = 'none'; // Masque le conteneur
    }

    // Ajouter un événement au bouton pour afficher les statistiques
    statsButton.addEventListener('click', showStats);

    // Rendre la fonction de fermeture accessible globalement
    window.closeStats = closeStats;
});
  </script>
</body>
</html>