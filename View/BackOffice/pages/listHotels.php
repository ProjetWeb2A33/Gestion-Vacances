<?php
include "../../../controller/HotelC.php";
$c = new HotelC();
$tab = $c->listHotels();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/easyparki.png">
  <title>EasyParki - Hotels List</title>
  
  <!-- Fonts and icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap" />
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
      --gradient-primary: linear-gradient(195deg, #EC407A 0%, #D81B60 100%);
      --gradient-secondary: linear-gradient(45deg, #4a00e0, #8e2de2);
      --gradient-success: linear-gradient(45deg, #00b09b, #96c93d);
    }
    
    body {
      background-color: #f8f9fa !important;
      font-family: 'Inter', sans-serif;
    }

    /* Sidebar Enhancements */
    .sidenav {
      background-color: var(--primary-dark) !important;
      box-shadow: 2px 0 20px rgba(0, 0, 0, 0.1);
    }
    
    .sidenav .nav-link,
    .sidenav .nav-link-text,
    .sidenav .navbar-brand span,
    .sidenav .material-symbols-rounded {
      color: white !important;
      transition: all 0.3s ease;
    }
    
    .sidenav .nav-link:hover {
      background: rgba(255, 255, 255, 0.1);
      transform: translateX(5px);
    }
    
    .sidenav .navbar-brand {
      padding: 1rem 1.5rem;
    }
    
    /* Submenu Enhancements */
    .nav-item.has-submenu {
      position: relative;
    }
    
    .submenu {
      position: absolute;
      left: 0;
      top: 100%;
      min-width: 240px;
      background: var(--primary-dark);
      border-radius: 8px;
      padding: 10px 0;
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
      transform: translateY(-10px);
      z-index: 1000;
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
      border: 1px solid rgba(255,255,255,0.1);
    }
    
    .nav-item.has-submenu:hover .submenu {
      opacity: 1;
      visibility: visible;
      transform: translateY(0);
    }
    
    .submenu-item {
      padding: 12px 24px;
      color: white !important;
      text-decoration: none;
      display: flex;
      align-items: center;
      transition: all 0.3s ease;
      font-weight: 500;
    }
    
    .submenu-item:hover {
      background: rgba(255,255,255,0.15);
      padding-left: 28px;
    }
    
    .submenu-item i {
      margin-right: 12px;
      font-size: 16px;
      width: 20px;
      text-align: center;
    }

    /* Main Content Styling */
    .main-content {
      background-color: #f5f7fa;
    }
    
    .container-fluid {
      padding: 2rem;
    }
    
    /* Table Enhancements */
    .custom-table {
      background: white;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 6px 30px rgba(0,0,0,0.05);
      border: none;
    }
    
    .custom-table th {
      background-color: var(--primary-dark) !important;
      color: white !important;
      padding: 1.25rem;
      font-weight: 600;
      text-transform: uppercase;
      font-size: 0.75rem;
      letter-spacing: 0.5px;
    }
    
    .custom-table td {
      vertical-align: middle;
      padding: 1.25rem;
      border-bottom: 1px solid #f0f0f0;
    }
    
    .custom-table tr:last-child td {
      border-bottom: none;
    }
    
    .custom-table tr:hover td {
      background-color: #f9f9f9;
    }

    /* Header Styling */
    .table-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 2rem;
      padding: 0 0.5rem;
    }
    
    .table-header h2 {
      color: var(--primary-dark);
      font-weight: 700;
      margin: 0;
      font-size: 1.75rem;
    }

    /* Button Styling */
    .btn-primary {
      background: var(--gradient-primary);
      border: none;
      box-shadow: 0 4px 15px rgba(216, 27, 96, 0.3);
      transition: all 0.3s ease;
      font-weight: 600;
      letter-spacing: 0.5px;
      padding: 0.75rem 1.5rem;
    }
    
    .btn-primary:hover {
      background: linear-gradient(195deg, #D81B60 0%, #EC407A 100%);
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(216, 27, 96, 0.4);
    }
    
    .btn-info {
      background: linear-gradient(45deg, #00c6ff, #0072ff);
      border: none;
      color: white;
      box-shadow: 0 4px 15px rgba(0, 114, 255, 0.3);
    }
    
    .btn-danger {
      background: linear-gradient(45deg, #ff416c, #ff4b2b);
      border: none;
      box-shadow: 0 4px 15px rgba(255, 75, 43, 0.3);
    }
    
    .btn-sm {
      padding: 0.5rem 1rem;
      font-size: 0.875rem;
    }

    /* Action Buttons */
    .action-buttons {
      display: flex;
      gap: 0.75rem;
    }
    
    .action-buttons .btn {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      min-width: 90px;
    }

    /* PDF Export Button */
    .pdf-export-btn {
      background: var(--gradient-secondary);
      border: none;
      border-radius: 50px;
      color: white;
      font-weight: 600;
      letter-spacing: 0.5px;
      text-transform: uppercase;
      box-shadow: 0 4px 15px rgba(74, 0, 224, 0.3);
      position: relative;
      overflow: hidden;
      transition: all 0.3s ease;
      padding: 0.75rem 1.5rem;
    }
    
    .pdf-export-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(74, 0, 224, 0.4);
    }
    
    .pdf-export-btn .btn-content {
      position: relative;
      z-index: 1;
      display: flex;
      align-items: center;
      gap: 0.5rem;
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
    
    /* Sort Button */
    .sort-btn {
      background: var(--gradient-success);
      border: none;
      border-radius: 50px;
      color: white;
      font-weight: 600;
      letter-spacing: 0.5px;
      text-transform: uppercase;
      box-shadow: 0 4px 15px rgba(0, 176, 155, 0.3);
      position: relative;
      overflow: hidden;
      transition: all 0.3s ease;
      padding: 0.75rem 1.5rem;
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
      gap: 0.5rem;
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
    
    /* Button container */
    .button-container {
      display: flex;
      justify-content: center;
      gap: 1.5rem;
      margin-top: 2.5rem;
      flex-wrap: wrap;
    }
    
    /* Animations */
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
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
      .table-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
      }
      
      .button-container {
        flex-direction: column;
        gap: 1rem;
      }
      
      .action-buttons {
        flex-direction: column;
        gap: 0.5rem;
      }
      
      .action-buttons .btn {
        width: 100%;
      }
    }
    
    /* Modal Enhancements */
    .modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0,0,0,0.7);
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 1050;
      backdrop-filter: blur(5px);
    }
    
    .modal-content {
      background: white;
      padding: 2rem;
      border-radius: 12px;
      width: 450px;
      max-width: 95%;
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
      text-align: center;
      animation: modalFadeIn 0.3s ease-out;
    }
    
    @keyframes modalFadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    
    .modal-content h4 {
      margin-top: 0;
      color: var(--primary-dark);
      font-weight: 700;
    }
    
    .modal-content p {
      color: #666;
      margin-bottom: 1.5rem;
    }
    
    .modal-buttons {
      display: flex;
      justify-content: center;
      gap: 1rem;
      margin-top: 1.5rem;
    }
    
    .modal-buttons .btn {
      min-width: 100px;
      padding: 0.75rem;
      border-radius: 8px;
      font-weight: 600;
      transition: all 0.3s ease;
    }
    
    .modal-buttons .btn-secondary {
      background: #f0f0f0;
      color: #333;
    }
    
    .modal-buttons .btn-secondary:hover {
      background: #e0e0e0;
    }
    
    .modal-buttons .btn-danger {
      background: var(--gradient-danger);
      color: white;
    }
    
    /* Loading spinner */
    .fa-spinner {
      animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
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
        <span class="ms-1 text-white font-weight-bold">EasyParki</span>
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
        <div class="table-header">
          <h2>Liste des Hôtels</h2>
          <a href="addHotel.php" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Ajouter Hôtel
          </a>
        </div>
        
        <table class="table table-striped align-middle" id="hotelsTable">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nom</th>
              <th>Adresse</th>
              <th>Ville</th>
              <th>Places parking</th>
              <th>Places disponibles</th>
              <th>Catégorie</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($tab as $hotel): ?>
            <tr>
              <td><?= htmlspecialchars($hotel['id_hotel']) ?></td>
              <td><?= htmlspecialchars($hotel['nom_hotel']) ?></td>
              <td><?= htmlspecialchars($hotel['adresse']) ?></td>
              <td><?= htmlspecialchars($hotel['ville']) ?></td>
              <td><?= htmlspecialchars($hotel['nombre_places_parking']) ?></td>
              <td><?= htmlspecialchars($hotel['places_parking_disponibles']) ?></td>
              <td><?= htmlspecialchars($hotel['categorie']) ?></td>
              <td>
                <div class="action-buttons">
                  <form method="POST" action="updateHotel.php" class="m-0">
                    <input type="hidden" name="id" value="<?= $hotel['id_hotel'] ?>">
                    <button type="submit" class="btn btn-sm btn-info">
                      <i class="fas fa-edit"></i> Modifier
                    </button>
                  </form>
                  <a href="deleteHotel.php?id=<?= $hotel['id_hotel'] ?>" 
                     onclick="confirmDelete(event, <?= $hotel['id_hotel'] ?>)" 
                     class="btn btn-sm btn-danger">
                    <i class="fas fa-trash"></i> Supprimer
                  </a>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        
        <!-- Buttons Container -->
        <div class="button-container">
          <button id="sortByNameBtn" class="sort-btn">
            <span class="btn-content">
              <i class="fas fa-sort-alpha-down me-2" id="sortIcon"></i> Trier par Nom
            </span>
            <span class="btn-effect"></span>
          </button>
          
          <button id="exportPdfBtn" class="pdf-export-btn">
            <span class="btn-content">
              <i class="fas fa-file-pdf me-2"></i> Exporter en PDF
            </span>
            <span class="btn-effect"></span>
          </button>
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
            <div class="modal-overlay">
                <div class="modal-content">
                    <h4>Confirmer la suppression</h4>
                    <p>Êtes-vous sûr de vouloir supprimer cet hôtel ? Cette action est irréversible.</p>
                    <div class="modal-buttons">
                        <button onclick="this.closest('.modal-overlay').remove()" 
                                class="btn btn-secondary">
                            Annuler
                        </button>
                        <a href="deleteHotel.php?id=${id}" 
                           class="btn btn-danger">
                            Confirmer
                        </a>
                    </div>
                </div>
            </div>
        `;
        
        document.body.insertAdjacentHTML('beforeend', modal);
    }

    // Sort functionality
    document.addEventListener('DOMContentLoaded', function() {
        const sortBtn = document.getElementById('sortByNameBtn');
        const sortIcon = document.getElementById('sortIcon');
        const table = document.getElementById('hotelsTable');
        const tbody = table.querySelector('tbody');
        let isSorted = false;
        
        sortBtn.addEventListener('click', function() {
            // Add animation to icon
            sortIcon.classList.add('rotate-icon');
            
            // Get all rows
            const rows = Array.from(tbody.querySelectorAll('tr'));
            
            // Sort rows by hotel name (column index 1)
            rows.sort((a, b) => {
                const nameA = a.cells[1].textContent.trim().toLowerCase();
                const nameB = b.cells[1].textContent.trim().toLowerCase();
                
                if (!isSorted) {
                    return nameA.localeCompare(nameB);
                } else {
                    return nameB.localeCompare(nameA);
                }
            });
            
            // Toggle sort direction for next click
            isSorted = !isSorted;
            
            // Update icon based on sort direction
            if (isSorted) {
                sortIcon.classList.remove('fa-sort-alpha-down');
                sortIcon.classList.add('fa-sort-alpha-up');
            } else {
                sortIcon.classList.remove('fa-sort-alpha-up');
                sortIcon.classList.add('fa-sort-alpha-down');
            }
            
            // Remove all rows from table
            while (tbody.firstChild) {
                tbody.removeChild(tbody.firstChild);
            }
            
            // Add fade-in animation class and re-append sorted rows
            rows.forEach((row, index) => {
                row.classList.add('table-row-animate');
                row.style.animationDelay = `${index * 0.05}s`;
                tbody.appendChild(row);
                
                // Remove animation class after animation completes
                setTimeout(() => {
                    row.classList.remove('table-row-animate');
                    row.style.animationDelay = '';
                }, 500 + (index * 50));
            });
            
            // Remove rotation class after animation completes
            setTimeout(() => {
                sortIcon.classList.remove('rotate-icon');
            }, 500);
        });
        
        // PDF Export Functionality
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
            document.querySelectorAll('.custom-table thead th').forEach((th, index) => {
                if (index < 7) { // Only take first 7 columns
                    headers.push(th.textContent.trim());
                }
            });
            
            // Get rows data
            document.querySelectorAll('.custom-table tbody tr').forEach(tr => {
                const row = [];
                tr.querySelectorAll('td').forEach((td, index) => {
                    if (index < 7) { // Only take first 7 columns
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
                    doc.setFont('helvetica', 'bold');
                    doc.setFontSize(20);
                    doc.setTextColor(10, 29, 55); // Primary dark color
                    doc.text('Liste des Hôtels - EasyParki', 40, 50);
                    
                    // Add date
                    doc.setFont('helvetica', 'normal');
                    doc.setFontSize(10);
                    doc.setTextColor(100);
                    doc.text('Généré le: ' + new Date().toLocaleDateString('fr-FR'), 40, 70);
                    
                    // Add logo
                    const logo = new Image();
                    logo.src = '../assets/img/easyparki.png';
                    doc.addImage(logo, 'PNG', 450, 30, 50, 50);
                    
                    // Add table if data exists
                    if (rows.length > 0) {
                        doc.autoTable({
                            head: [headers],
                            body: rows,
                            startY: 90,
                            theme: 'grid',
                            headStyles: {
                                fillColor: [10, 29, 55], // Primary dark color
                                textColor: 255,
                                fontStyle: 'bold',
                                fontSize: 10
                            },
                            bodyStyles: {
                                fontSize: 9
                            },
                            alternateRowStyles: {
                                fillColor: [245, 247, 250] // Light gray
                            },
                            margin: { left: 40, right: 40 },
                            styles: {
                                cellPadding: 8,
                                overflow: 'linebreak',
                                halign: 'center'
                            },
                            columnStyles: {
                                0: { halign: 'center', cellWidth: 40 }, // ID
                                1: { cellWidth: 'auto' }, // Name
                                2: { cellWidth: 'auto' }, // Address
                                3: { cellWidth: 'auto' }, // City
                                4: { halign: 'center', cellWidth: 60 }, // Parking spaces
                                5: { halign: 'center', cellWidth: 60 }, // Available spaces
                                6: { halign: 'center', cellWidth: 60 } // Category
                            }
                        });
                    } else {
                        doc.setFontSize(12);
                        doc.text('Aucun hôtel à afficher', 40, 90);
                    }
                    
                    // Add footer
                    const pageCount = doc.internal.getNumberOfPages();
                    for(let i = 1; i <= pageCount; i++) {
                        doc.setPage(i);
                        doc.setFontSize(8);
                        doc.setTextColor(150);
                        doc.text('Page ' + i + ' sur ' + pageCount, doc.internal.pageSize.width - 50, doc.internal.pageSize.height - 20);
                        doc.text('© EasyParki ' + new Date().getFullYear(), 40, doc.internal.pageSize.height - 20);
                    }
                    
                    // Save the PDF
                    doc.save('liste_hotels_easyparki_' + new Date().toISOString().slice(0, 10) + '.pdf');
                    
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
  </script>
</body>
</html>