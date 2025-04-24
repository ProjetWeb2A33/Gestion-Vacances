<?php
include '../../../Controller/planVacanceC.php';
$planC = new PlanVacanceC();
$planC->deletePlan($_GET["id"]);
header('Location: listplansVacancefront.php');