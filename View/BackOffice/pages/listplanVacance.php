<?php
require_once "../../../Controller/planVacanceC.php"; 
require_once __DIR__ . '/../../../Controller/planVacanceC.php';

$c = new PlanVacanceC();
$hotelC = new HotelC();

// Initialize the search variable
$search = isset($_GET['search']) ? $_GET['search'] : ''; // Get search value from GET

// If search value is provided, filter the results
if (!empty($search)) {
    // Call the search function in PlanVacanceC to search by identifiant
    $stmt = $c->searchPlansByIdentifiant($search);
} else {
    // If no search, fetch all plans
    $stmt = $c->listPlans();
}

// Fetch all results as an array
$tab = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if sort request is made
if (isset($_GET['sort']) && $_GET['sort'] == 'date_depart') {
    // Sort the array by date_depart
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
        background: linear-gradient(45deg, #00b09b, #96c93d);
        border: none;
        border-radius: 50px;
        color: white;
        font-weight: 600;
        letter-spacing: 1px;
        padding: 12px 24px;
        text-transform: uppercase;
        box-shadow: 0 4px 15px rgba(0, 176, 155, 0.3);
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        margin-left: 10px;
    }
    
    .sort-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 176, 155, 0.4);
    }
    
    .sort-btn .btn-content {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
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
    
    .sort-btn i {
        margin-right: 8px;
        transition: transform 0.3s ease;
    }
    
    .sort-btn.active i {
        transform: rotate(180deg);
    }
    
    .sort-btn.pulse {
        animation: pulse 1s infinite;
    }
    
    @keyframes pulse {
        0% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(0, 176, 155, 0.7);
        }
        70% {
            transform: scale(1.05);
            box-shadow: 0 0 0 10px rgba(0, 176, 155, 0);
        }
        100% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(0, 176, 155, 0);
        }
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
      <div class="table-responsive custom-table">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h2>Liste des Plans de Vacance</h2>
          <div>
            <a href="addplanVacance.php" class="btn btn-primary me-2">
              <i class="fas fa-plus me-2"></i>Ajouter un Plan
            </a>

          </div>
        </div>
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
                       placeholder="Rechercher par identifiant..." 
                       value="<?= htmlspecialchars($search ?? '') ?>" 
                       aria-label="Rechercher par identifiant">
                <button type="submit" class="btn btn-primary search-btn">
                  <i class="bi bi-search"></i> Rechercher
                </button>
              </div>
            </form>
          </div>

          <!-- Message d'erreur si aucun résultat trouvé -->
          

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

        <table class="table table-striped align-middle">
          <thead>
            <tr>
              <th>ID</th>
              <th>identifiant</th>
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
            <?php foreach ($tab as $plan): 
              $hotel = $hotelC->showHotel($plan['id_hotel']);
            ?>
            <tr>
              <td><?= $plan['id_plan'] ?></td>
              <td><?= $plan['identifiant'] ?></td>
              <td><?= $plan['nom_utilisateur'] ?></td>
              <td><?= $plan['date_depart'] ?></td>
              <td><?= $plan['date_retour'] ?></td>
              <td><?= ucfirst($plan['type_transport']) ?></td>
              <td><?= ucfirst($plan['location_voiture']) ?></td>
              <td><?= ucfirst($plan['besoin_parking']) ?></td>
              <td><?= $hotel['nom_hotel'] ?? 'Inconnu' ?> (<?= $hotel['ville'] ?? '' ?>)</td>
              <td>
                <div class="d-flex gap-2">
                  <form method="POST" action="updateplanVacance.php" class="m-0">
                    <input type="hidden" name="id" value="<?= $plan['id_plan'] ?>">
                    <button type="submit" class="btn btn-sm btn-info">
                      <i class="fas fa-edit"></i> Modifier
                    </button>
                  </form>
                  <a href="deletePlanVacance.php?id=<?= $plan['id_plan'] ?>" class="btn btn-sm btn-danger">
                    <i class="fas fa-trash"></i> Supprimer
                  </a>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <button id="exportPdfBtn" class="pdf-export-btn">
              <span class="btn-content">
                <i class="fas fa-file-pdf me-2"></i> Exporter en PDF
              </span>
              <span class="btn-effect"></span>
            </button>
            <a href="?sort=date_depart" class="sort-btn <?= isset($_GET['sort']) ? 'active' : '' ?>">
              <span class="btn-content">
                <i class="fas fa-calendar-alt"></i>
                Trier par Date de Départ
              </span>
              <span class="btn-effect"></span>
            </a>
      </div>
    </div>
  </main>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>
  <!-- PDF Export Libraries -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
  
  <script>
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
            
            // Get headers (skip Actions column - last column)
            document.querySelectorAll('.custom-table thead th').forEach((th, index) => {
                if (index < 9) { // Only take first 9 columns (skip Actions)
                    headers.push(th.textContent.trim());
                }
            });
            
            // Get rows data
            document.querySelectorAll('.custom-table tbody tr').forEach(tr => {
                const row = [];
                tr.querySelectorAll('td').forEach((td, index) => {
                    if (index < 9) { // Only take first 9 columns (skip Actions)
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
                    doc.autoTable({
                        startY: 90
                    });
                    <?php endif; ?>
                    
                    // Add table if data exists
                    if (rows.length > 0) {
                        doc.autoTable({
                            head: [headers],
                            body: rows,
                            startY: <?php echo !empty($search) ? 90 : 80 ?>,
                            theme: 'grid',
                            headStyles: {
                                fillColor: [74, 0, 224],
                                textColor: 255,
                                fontStyle: 'bold'
                            },
                            alternateRowStyles: {
                                fillColor: [240, 240, 240]
                            },
                            margin: { left: 40 },
                            pageBreak: 'auto',
                            tableWidth: 'wrap'
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
                               class="btn btn-danger" 
                               style="padding: 8px 20px">
                                Confirmer
                            </a>
                        </div>
                    </div>
                </div>
            `;
            
            document.body.insertAdjacentHTML('beforeend', modal);
        }

        // Attach delete confirmation to all delete buttons
        document.querySelectorAll('a[href*="deletePlanVacance.php"]').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const id = this.getAttribute('href').split('id=')[1];
                confirmDelete(e, id);
            });
        });
        
        // Add animation to sort button when clicked
        const sortBtn = document.querySelector('.sort-btn');
        if (sortBtn) {
            sortBtn.addEventListener('click', function(e) {
                // Add pulse animation
                this.classList.add('pulse');
                
                // Remove animation after 1 second
                setTimeout(() => {
                    this.classList.remove('pulse');
                }, 1000);
            });
        }
    });
  </script>
</body>
</html>