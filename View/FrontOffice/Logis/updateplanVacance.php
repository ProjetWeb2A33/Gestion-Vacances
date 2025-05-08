<?php
require_once '../../../Controller/planVacanceC.php';
require_once '../../../Model/planVacance.php';
require_once '../../../Controller/HotelC.php';

$error = "";
$showSuccessMessage = false;
$planC = new PlanVacanceC();
$hotelC = new HotelC();
$hotels = $hotelC->listHotels();

if (isset($_POST["id"])) {
    $plan = $planC->showPlan($_POST["id"]);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['identifiant']) &&
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
                $updatedPlan = new PlanVacance(
                    $_POST['id'],
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
                // Update the plan
                $result = $planC->updatePlan($updatedPlan, $_POST['id']);

                // Plan updated successfully
                if ($result !== false) {
                    // Just set success message flag
                }

                $showSuccessMessage = true;
            } else {
                $error = "La date de retour doit être après la date de départ";
            }
        } else {
            $error = "";
        }
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

    .vacation-table {
      width: 100%;
      border-collapse: collapse;
      margin: 2rem 0;
      box-shadow: 0 1px 3px rgba(0,0,0,0.12);
    }

    .vacation-table th,
    .vacation-table td {
      padding: 1rem;
      text-align: left;
      border-bottom: 1px solid #dee2e6;
    }

    .vacation-table th {
      background-color: #0a1d37;
      color: white;
      font-weight: 500;
    }

    .vacation-table tr:hover {
      background-color: #f8f9fa;
    }

    .action-buttons .btn {
      margin: 0 0.25rem;
      padding: 0.375rem 0.75rem;
    }

    .add-plan-btn {
      margin: 1.5rem 0;
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

<style>
    :root {
  --primary-color: #0d3f72;
  --primary-dark: #08284d;
  --secondary-color: #0a1d37;
  --accent-color: #3a5cb3;        /* Bleu vif */
  --light-color: #f8fafc;         /* Fond très légèrement bleuté */
  --dark-color: #2d3748;          /* Texte foncé doux */
  --text-color: #4a5568;          /* Texte principal */
  --section-bg: #f5f7fa;          /* Arrière-plan des sections */
  --card-bg: #ffffff;             /* Fond des cartes */
  --border-color: rgba(0,0,0,0.08); /* Bordures subtiles */
  --gradient: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
}

    /* Header & Navigation */
    .header {
      background: rgba(255, 255, 255, 0.98);
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
      backdrop-filter: blur(10px);
    }

    .sitename {
  font-family: Arial, sans-serif; /* juste changer la police */
  font-weight: 700;
  color: var(--secondary-color);
  background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}


    .navmenu ul li a {
      position: relative;
      color: var(--dark-color);
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .navmenu ul li a:hover,
    .navmenu ul li a.active {
      color: var(--primary-color);
    }

    .navmenu ul li a:after {
      content: '';
      position: absolute;
      bottom: -5px;
      left: 0;
      width: 0;
      height: 2px;
      background: var(--gradient);
      transition: width 0.3s ease;
    }

    .navmenu ul li a:hover:after,
    .navmenu ul li a.active:after {
      width: 100%;
    }

    .btn-getstarted {
      background: var(--gradient);
      border: none;
      color: white;
      font-weight: 600;
      padding: 10px 25px;
      border-radius: 50px;
      box-shadow: 0 5px 15px rgba(74, 166, 255, 0.4);
      transition: all 0.3s ease;
    }

    .btn-getstarted:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 20px rgba(74, 166, 255, 0.6);
    }

    /* Hero Section */
    .page-title {
      position: relative;
      padding: 180px 0 120px;
      background: linear-gradient(rgba(10, 29, 55, 0.85), rgba(10, 29, 55, 0.85)), url('assets/img/55.png') center/cover no-repeat;
      color: white;
      text-align: center;
    }

    .page-title h1 {
      font-family: Arial, sans-serif;
      font-size: 3.5rem;
      font-weight: 700;
      margin-bottom: 20px;
      animation: fadeInDown 1s ease;
      text-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }

    .page-title p {
      font-size: 1.2rem;
      max-width: 700px;
      margin: 0 auto 30px;
      animation: fadeInUp 1s ease;
      opacity: 0.9;
    }

    /* About Section - Redesign */
    .about {
      padding: 100px 0;
      position: relative;
      overflow: hidden;
    }

    .about::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: url('assets/img/wave-bg.svg') center/cover no-repeat;
      opacity: 0.03;
      z-index: -1;
    }

    .about h3 {
      font-family: Arial, sans-serif;
      color: var(--secondary-color);
      font-size: 2.5rem;
      margin-bottom: 30px;
      position: relative;
      display: inline-block;
    }

    .about h3:after {
      content: '';
      position: absolute;
      bottom: -15px;
      left: 0;
      width: 100px;
      height: 4px;
      background: var(--gradient);
      border-radius: 2px;
    }

    .about .features-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 30px;
      margin-top: 50px;
    }

    .feature-card {
      background: white;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
      transition: all 0.4s ease;
      border: 1px solid rgba(0,0,0,0.03);
    }

    .feature-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
    }

    .feature-icon {
      width: 70px;
      height: 70px;
      background: rgba(13, 63, 114, 0.1);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 20px;
      color: var(--primary-color);
      font-size: 1.8rem;
    }

    .feature-card h4 {
      font-weight: 600;
      margin-bottom: 15px;
      color: var(--secondary-color);
    }

    /* Stats Section - Redesign */
    .stats {
      padding: 100px 0;
      background: var(--gradient);
      color: white;
      position: relative;
      overflow: hidden;
    }

    .stats::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: url('assets/img/dots-bg.png') center/cover no-repeat;
      opacity: 0.1;
    }

    .stats-item {
      padding: 40px 30px;
      border-radius: 15px;
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(5px);
      transition: all 0.4s ease;
      text-align: center;
      border: 1px solid rgba(255,255,255,0.1);
    }

    .stats-item:hover {
      transform: translateY(-10px);
      background: rgba(255, 255, 255, 0.15);
    }

    .stats-item span {
      font-size: 3rem;
      font-weight: 700;
      display: block;
      margin-bottom: 10px;
      background: linear-gradient(to right, #fff, #e0f1ff);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    /* Testimonials - Redesign */
    .testimonials {
      padding: 120px 0;
      background: linear-gradient(135deg, #f8faff 0%, #f0f7ff 100%);
    }

    .testimonial-card {
      background: white;
      padding: 40px 30px;
      border-radius: 20px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
      transition: all 0.4s ease;
      height: 100%;
      position: relative;
      overflow: hidden;
      border: 1px solid rgba(0,0,0,0.03);
    }

    .testimonial-card::before {
      content: '"';
      position: absolute;
      top: 20px;
      right: 30px;
      font-size: 100px;
      font-family: 'Playfair Display', serif;
      color: rgba(13, 63, 114, 0.05);
      line-height: 1;
    }

    .testimonial-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
    }

    .testimonial-img {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid white;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      margin-bottom: 20px;
    }

    .stars {
      color: #ffc107;
      margin-bottom: 15px;
      font-size: 1.1rem;
    }

    /* CTA Section - Redesign */
    .cta-section {
      padding: 100px 0;
      background: url('assets/img/cta-bg.jpg') center/cover no-repeat;
      position: relative;
      text-align: center;
    }

    .cta-section::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(13, 63, 114, 0.9);
    }

    .cta-content {
      position: relative;
      z-index: 2;
    }

    .cta-btn {
      background: white;
      color: var(--primary-color);
      font-weight: 600;
      padding: 15px 40px;
      border-radius: 50px;
      transition: all 0.3s ease;
      display: inline-block;
      margin-top: 20px;
    }

    .cta-btn:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 30px rgba(255,255,255,0.3);
    }

    /* FAQ Section - Redesign */
    .faq-section {
      padding: 100px 0;
      background: #f9fbfe;
    }

    .faq-item {
      margin-bottom: 15px;
      border-radius: 12px;
      background: white;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.03);
      overflow: hidden;
      transition: all 0.3s ease;
      border: 1px solid rgba(0,0,0,0.03);
    }

    .faq-item:hover {
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    }

    .faq-item h3 {
      padding: 20px 25px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin: 0;
      font-size: 1.1rem;
      color: var(--secondary-color);
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .faq-item:hover h3 {
      color: var(--primary-color);
    }

    .faq-item.active h3 {
      color: var(--primary-color);
    }

    .faq-content {
      padding: 0 25px;
      max-height: 0;
      overflow: hidden;
      transition: all 0.4s ease;
    }

    .faq-item.active .faq-content {
      padding: 0 25px 25px;
      max-height: 500px;
    }

    .faq-toggle {
      transition: transform 0.3s ease;
    }

    .faq-item.active .faq-toggle {
      transform: rotate(180deg);
    }

    /* Footer - Redesign */
    .footer {
      background: var(--secondary-color);
      color: white;
      padding-top: 100px;
      position: relative;
    }

    .footer::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 15px;
      background: var(--gradient);
    }

    .footer-links h4 {
      font-family: Arial, sans-serif;
      margin-bottom: 25px;
      position: relative;
      display: inline-block;
    }

    .footer-links h4::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 0;
      width: 50px;
      height: 3px;
      background: var(--primary-color);
      border-radius: 3px;
    }

    .social-links a {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 45px;
      height: 45px;
      background: rgba(249, 249, 249, 0.91);
      border-radius: 50%;
      margin-right: 10px;
      color: white;
      transition: all 0.3s ease;
    }

    .social-links a:hover {
      background: white;
      color: var(--primary-color);
      transform: translateY(-3px);
    }

    /* Animations */
    @keyframes fadeInDown {
      from {
        opacity: 0;
        transform: translateY(-30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Responsive */
    @media (max-width: 768px) {
      .page-title h1 {
        font-size: 2.5rem;
      }

      .page-title p {
        font-size: 1rem;
      }

      .about h3, .section-title h2 {
        font-size: 2rem;
      }
    }

    /* Section Title */
    .section-title {
      text-align: center;
      margin-bottom: 60px;
    }

    .section-title span {
      color: var(--primary-color);
      font-size: 1rem;
      font-weight: 600;
      letter-spacing: 1px;
      display: block;
      margin-bottom: 15px;
      text-transform: uppercase;
    }

    .section-title h2 {
      font-family: Arial, sans-serif;
      color: var(--secondary-color);
      font-size: 2.5rem;
      margin-bottom: 20px;
    }

    .section-title p {
      max-width: 700px;
      margin: 0 auto;
      color: #666;
    }

    /* Dropdown styling */
    .dropdown-menu {
      display: none;
      position: absolute;
      top: 100%;
      left: 0;
      min-width: 220px;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 15px 30px rgba(0,0,0,0.1);
      padding: 10px 0;
      opacity: 0;
      transform: translateY(10px);
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      z-index: 1000;
      border: none;
    }

    .nav-item.dropdown:hover .dropdown-menu {
      display: block;
      opacity: 1;
      transform: translateY(0);
    }

    .dropdown-item {
      padding: 12px 25px;
      color: var(--secondary-color) !important;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 12px;
      transition: all 0.3s ease;
    }

    .dropdown-item:hover {
      background: rgba(13, 63, 114, 0.05);
      padding-left: 30px;
    }

    .dropdown-item i {
      color: var(--primary-color);
      font-size: 1.1em;
      width: 24px;
      text-align: center;
    }

    /* Floating Get Started Button */
    .floating-btn {
      position: fixed;
      bottom: 30px;
      right: 30px;
      z-index: 99;
      width: 60px;
      height: 60px;
      border-radius: 50%;
      background: var(--gradient);
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 10px 25px rgba(13, 63, 114, 0.3);
      transition: all 0.3s ease;
      font-size: 1.5rem;
      text-decoration: none;
    }

    .floating-btn:hover {
      transform: translateY(-5px) scale(1.1);
      box-shadow: 0 15px 30px rgba(13, 63, 114, 0.4);
    }

    /* Destination Gallery */
    .destination-gallery {
      padding: 100px 0;
      background: #f9fbfe;
    }

    .destination-card {
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      transition: all 0.4s ease;
      margin-bottom: 30px;
      position: relative;
    }

    .destination-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .destination-img {
      height: 250px;
      object-fit: cover;
      width: 100%;
      transition: transform 0.5s ease;
    }

    .destination-card:hover .destination-img {
      transform: scale(1.05);
    }

    .destination-info {
      padding: 20px;
      background: white;
      position: relative;
    }

    .destination-info h4 {
      margin-bottom: 10px;
      color: var(--secondary-color);
    }

    .destination-info p {
      color: #666;
      margin-bottom: 15px;
    }

    .price-tag {
      position: absolute;
      top: -20px;
      right: 20px;
      background: var(--gradient);
      color: white;
      padding: 8px 15px;
      border-radius: 50px;
      font-weight: 600;
      box-shadow: 0 5px 15px rgba(13, 63, 114, 0.3);
    }

    /* How It Works */
    .how-it-works {
      padding: 100px 0;
      position: relative;
      overflow: hidden;
    }

    .how-it-works::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: url('assets/img/dots-pattern.png') center/cover no-repeat;
      opacity: 0.05;
      z-index: -1;
    }

    .step-card {
      background: white;
      border-radius: 15px;
      padding: 40px 30px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
      transition: all 0.4s ease;
      height: 100%;
      text-align: center;
      position: relative;
      border: 1px solid rgba(0,0,0,0.03);
    }

    .step-number {
      width: 60px;
      height: 60px;
      background: rgba(13, 63, 114, 0.1);
      color: var(--primary-color);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      font-weight: 700;
      margin: 0 auto 20px;
      transition: all 0.3s ease;
    }

    .step-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
    }

    .step-card:hover .step-number {
      background: var(--gradient);
      color: white;
      transform: scale(1.1);
    }

    /* Newsletter */
    .newsletter {
      padding: 80px 0;
      background: var(--gradient);
      color: white;
      text-align: center;
    }

    .newsletter-form {
      max-width: 600px;
      margin: 40px auto 0;
      display: flex;
      background: white;
      border-radius: 50px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .newsletter-input {
      flex: 1;
      border: none;
      padding: 15px 25px;
      outline: none;
      font-size: 1rem;
    }

    .newsletter-btn {
      background: var(--secondary-color);
      color: white;
      border: none;
      padding: 15px 30px;
      cursor: pointer;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .newsletter-btn:hover {
      background: #08172f;
    }
    /* Effet de carte amélioré */
.destination-card {
  background: var(--card-bg);
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 15px 40px rgba(0,0,0,0.1);
  transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  position: relative;
}

.destination-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: var(--gradient);
  opacity: 0;
  transition: opacity 0.3s ease;
  z-index: 1;
}

.destination-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 25px 60px rgba(0,0,0,0.15);
}

.destination-card:hover::before {
  opacity: 0.03;
}

/* Animation du badge */
.card-badge {
  position: absolute;
  top: 20px;
  right: 20px;
  background: var(--gradient);
  color: white;
  padding: 6px 15px;
  border-radius: 50px;
  font-weight: 600;
  animation: pulse 2s infinite;
}

@keyframes pulse {
  0% { transform: scale(1); }
  50% { transform: scale(1.05); }
  100% { transform: scale(1); }
}
  </style>
</head>

<body class="vacation-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="about.php" class="logo d-flex align-items-center me-auto">
        <h1 class="sitename">EasyParki</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.html">Accueil</a></li>
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
                <a href="listplansVacancefront.php" class="dropdown-item">
                  <i class="bi bi-list-task"></i>
                 Accéder à mon plan
                </a>
              </li>
            </ul>
          </li>
          <li><a href="Covoiturage.html">Covoiturage</a></li>
          <li><a href="Recharge.html">Service</a></li>
          <li><a href="Evenement.html">Événement</a></li>
          <li><a href="contact.html">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="get-a-quote.html">Créer un compte</a>

    </div>
  </header>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/55.png);">
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

    <!-- Modal de Succès -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Succès</h5>
          </div>
          <div class="modal-body">
            <p>Votre plan de vacances a été modifié avec succès !</p>
            <p>Un email de confirmation a été envoyé à l'adresse <strong><?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?></strong>.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="window.location.href='about.php'">OK</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Start of PHP Form Content -->
    <div class="container-fluid py-4">
      <div class="form-container">
        <?php if(!empty($error)): ?>
          <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <?php if(isset($_POST['id'])):
          $planData = $planC->showPlan($_POST['id']);
        ?>
        <h3 class="mb-4">Modifier le Plan de Vacance</h3>
        <form method="POST" id="vacationForm">
          <input type="hidden" name="id" value="<?= $planData['id_plan'] ?>">

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="nom_utilisateur">Nom Utilisateur</label>
                <input type="text" name="nom_utilisateur" id="nom_utilisateur" class="form-control"
                       value="<?= $planData['nom_utilisateur'] ?>" maxlength="8">
                <div class="form-feedback" id="nomFeedback"></div>
              </div>

              <div class="form-group">
                <label for="identifiant">Identifiant</label>
                <input type="text" name="identifiant" id="identifiant" class="form-control"
                       value="<?= $planData['identifiant'] ?>" maxlength="8">
                <div class="form-feedback" id="identifiantFeedback"></div>
              </div>

              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control"
                       value="<?= $planData['email'] ?>">
                <div class="form-feedback" id="emailFeedback"></div>
              </div>

              <div class="form-group">
                <label for="date_depart">Date Départ</label>
                <input type="date" name="date_depart" id="date_depart" class="form-control"
                       value="<?= $planData['date_depart'] ?>">
                <div class="form-feedback" id="dateDepartFeedback"></div>
              </div>

              <div class="form-group">
                <label for="date_retour">Date Retour</label>
                <input type="date" name="date_retour" id="date_retour" class="form-control"
                       value="<?= $planData['date_retour'] ?>">
                <div class="form-feedback" id="dateRetourFeedback"></div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="type_transport">Type Transport</label>
                <select name="type_transport" id="type_transport" class="form-control">
                  <option value="">Sélectionner un type</option>
                  <?php $transports = ['voiture', 'taxi', 'bus']; ?>
                  <?php foreach ($transports as $t): ?>
                    <option value="<?= $t ?>" <?= ($t == $planData['type_transport']) ? 'selected' : '' ?>>
                      <?= ucfirst($t) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                <div class="form-feedback" id="transportFeedback"></div>
              </div>

              <div class="form-group">
                <label>Location Voiture</label>
                <div class="radio-group">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="location_voiture"
                           id="oui_location" value="oui" <?= ($planData['location_voiture'] == 'oui') ? 'checked' : '' ?>>
                    <label class="form-check-label text-success" for="oui_location">
                      Oui
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="location_voiture"
                           id="non_location" value="non" <?= ($planData['location_voiture'] == 'non') ? 'checked' : '' ?>>
                    <label class="form-check-label text-danger" for="non_location">
                      Non
                    </label>
                  </div>
                </div>
                <div class="form-feedback" id="locationFeedback"></div>
              </div>

              <div class="form-group">
                <label>Besoin Parking</label>
                <div class="radio-group">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="besoin_parking"
                           id="oui_parking" value="oui" <?= ($planData['besoin_parking'] == 'oui') ? 'checked' : '' ?>>
                    <label class="form-check-label text-success" for="oui_parking">
                      Oui
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="besoin_parking"
                           id="non_parking" value="non" <?= ($planData['besoin_parking'] == 'non') ? 'checked' : '' ?>>
                    <label class="form-check-label text-danger" for="non_parking">
                      Non
                    </label>
                  </div>
                </div>
                <div class="form-feedback" id="parkingFeedback"></div>
              </div>

              <div class="form-group">
                <label for="id_hotel">Hôtel</label>
                <select name="id_hotel" id="id_hotel" class="form-control">
                  <option value="">Sélectionner un hôtel</option>
                  <?php foreach ($hotels as $hotel): ?>
                    <option value="<?= $hotel['id_hotel'] ?>" <?= ($hotel['id_hotel'] == $planData['id_hotel']) ? 'selected' : '' ?>>
                      <?= htmlspecialchars($hotel['nom_hotel']) ?> - <?= htmlspecialchars($hotel['ville']) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                <div class="form-feedback" id="hotelFeedback"></div>
              </div>
            </div>
          </div>

          <div class="text-end mt-4">
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-save me-2"></i>Mettre à jour
            </button>
            <a href="listplansVacancefront.php" class="btn btn-secondary">
              <i class="fas fa-times me-2"></i>Annuler
            </a>
          </div>
        </form>
        <?php endif; ?>
      </div>
    </div>

  </main>

  <footer id="footer" class="footer dark-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">EasyParki</span>
          </a>
          <p>EasyParki est une plateforme intelligente et centralisée qui facilite la mobilité urbaine durable en offrant des solutions intégrées pour le stationnement, le covoiturage, les transports publics, la recharge électrique et la gestion d'événements.</p>
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
        const isEmailValid = validateEmail();
        const areDatesValid = validateDates();
        const isTransportValid = validateTransport();
        const isHotelValid = validateHotel();
        const isLocationValid = validateRadio('location_voiture', 'locationFeedback');
        const isParkingValid = validateRadio('besoin_parking', 'parkingFeedback');

        if (isNomValid && isIdentifiantValid && isEmailValid && areDatesValid && isTransportValid &&
            isHotelValid && isLocationValid && isParkingValid) {
            document.getElementById('vacationForm').submit();
        }
    }

    // Initialisation
    document.addEventListener('DOMContentLoaded', function() {
        // Validation en temps réel
        document.getElementById('nom_utilisateur').addEventListener('input', validateNom);
        document.getElementById('identifiant').addEventListener('input', validateIdentifiant);
        document.getElementById('email').addEventListener('input', validateEmail);
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

        // Set minimum dates for date inputs
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('date_depart').min = today;

        // Update retour min date when départ changes
        document.getElementById('date_depart').addEventListener('change', function() {
            const dateDepart = this.value;
            document.getElementById('date_retour').min = dateDepart;
        });
    });

    <?php if ($showSuccessMessage): ?>
        window.addEventListener('DOMContentLoaded', () => {
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        });
        document.getElementById('contactForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const subject = document.getElementById('subject').value.trim();
    const message = document.getElementById('message').value.trim();

    if (!name || !email || !subject || !message) {
        alert('Veuillez remplir tous les champs.');
        return;
    }

    const formData = new FormData(this);

    fetch('sendMail.php', {
        method: 'POST',
        body: formData,
    })
        .then(response => response.text())
        .then(data => {
            alert(data); // Affiche un message de succès ou d'erreur
        })
        .catch(error => {
            alert('Une erreur s\'est produite. Veuillez réessayer.');
        });
});
    <?php endif; ?>
  </script>
</body>
</html>