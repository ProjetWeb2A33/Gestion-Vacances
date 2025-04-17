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
                header('Location: listplanVacancefront.php');
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
  <title>Modifier Plan Vacance</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f1f1f1;
      padding: 20px;
    }
    .form-container {
      background: white;
      border-radius: 8px;
      padding: 20px;
      max-width: 600px;
      margin: auto;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .form-group {
      margin-bottom: 15px;
    }
    label {
      font-weight: bold;
    }
    input, select {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    .radio-group label {
      margin-right: 15px;
    }
    .btn {
      padding: 8px 15px;
      margin-top: 10px;
      cursor: pointer;
    }
    .btn-primary {
      background-color: #007bff;
      color: white;
      border: none;
    }
    .btn-secondary {
      background-color: #6c757d;
      color: white;
      border: none;
    }
    .error {
      color: red;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>

<div class="form-container">
  <?php if (!empty($error)): ?>
    <div class="error"><?= $error ?></div>
  <?php endif; ?>

  <?php if (isset($_POST['id'])): 
    $planData = $planC->showPlan($_POST['id']);
  ?>
  <h2>Modifier le Plan de Vacance</h2>
  <form method="POST" onsubmit="return validateForm()">
    <input type="hidden" name="id" value="<?= $planData['id_plan'] ?>">

    <div id="errorMessage" class="error"></div>

    <div class="form-group">
      <label>Nom Utilisateur</label>
      <input type="text" name="nom_utilisateur" value="<?= $planData['nom_utilisateur'] ?>">
    </div>

    <div class="form-group">
      <label>Date Départ</label>
      <input type="date" name="date_depart" value="<?= $planData['date_depart'] ?>">
    </div>

    <div class="form-group">
      <label>Date Retour</label>
      <input type="date" name="date_retour" value="<?= $planData['date_retour'] ?>">
    </div>

    <div class="form-group">
      <label>Type Transport</label>
      <select name="type_transport">
        <option value="">Choisir...</option>
        <?php $transports = ['voiture', 'taxi', 'bus', 'plane']; ?>
        <?php foreach ($transports as $t): ?>
          <option value="<?= $t ?>" <?= ($t == $planData['type_transport']) ? 'selected' : '' ?>><?= ucfirst($t) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="form-group">
      <label>Location Voiture</label><br>
      <label><input type="radio" name="location_voiture" value="oui" <?= ($planData['location_voiture'] == 'oui') ? 'checked' : '' ?>> Oui</label>
      <label><input type="radio" name="location_voiture" value="non" <?= ($planData['location_voiture'] == 'non') ? 'checked' : '' ?>> Non</label>
    </div>

    <div class="form-group">
      <label>Besoin Parking</label><br>
      <label><input type="radio" name="besoin_parking" value="oui" <?= ($planData['besoin_parking'] == 'oui') ? 'checked' : '' ?>> Oui</label>
      <label><input type="radio" name="besoin_parking" value="non" <?= ($planData['besoin_parking'] == 'non') ? 'checked' : '' ?>> Non</label>
    </div>

    <div class="form-group">
      <label>Hôtel</label>
      <select name="id_hotel">
        <option value="">Choisir un hôtel</option>
        <?php foreach ($hotels as $hotel): ?>
          <option value="<?= $hotel['id_hotel'] ?>" <?= ($hotel['id_hotel'] == $planData['id_hotel']) ? 'selected' : '' ?>>
            Hôtel #<?= $hotel['id_hotel'] ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Mettre à jour</button>
    <a href="listplansVacance.php" class="btn btn-secondary">Annuler</a>
  </form>
  <?php endif; ?>
</div>

<script>
function validateForm() {
  const today = new Date().toISOString().split('T')[0];
  const errorMessage = document.getElementById('errorMessage');
  let errors = [];

  const nomUtilisateur = document.getElementsByName('nom_utilisateur')[0].value.trim();
  const dateDepart = document.getElementsByName('date_depart')[0].value;
  const dateRetour = document.getElementsByName('date_retour')[0].value;
  const typeTransport = document.getElementsByName('type_transport')[0].value;
  const locationVoiture = document.querySelector('input[name="location_voiture"]:checked');
  const besoinParking = document.querySelector('input[name="besoin_parking"]:checked');
  const idHotel = document.getElementsByName('id_hotel')[0].value;

  if (!nomUtilisateur) errors.push("Le nom d'utilisateur est requis");
  else if (nomUtilisateur.length > 8) errors.push("Le nom d'utilisateur ne doit pas dépasser 8 caractères");

  if (!dateDepart) errors.push("La date de départ est requise");
  else if (dateDepart < today) errors.push("La date de départ ne peut pas être dans le passé");

  if (!dateRetour) errors.push("La date de retour est requise");
  else if (dateRetour <= dateDepart) errors.push("La date de retour doit être après la date de départ");

  if (!typeTransport) errors.push("Le type de transport est requis");
  if (!locationVoiture) errors.push("Choisissez la location de voiture");
  if (!besoinParking) errors.push("Choisissez le besoin de parking");
  if (!idHotel) errors.push("Sélectionnez un hôtel");

  if (errors.length > 0) {
    errorMessage.innerHTML = errors.join('<br>');
    return false;
  }
  return true;
}
</script>

</body>
</html>
