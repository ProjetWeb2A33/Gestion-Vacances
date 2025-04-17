<?php
require __DIR__ . '/../config.php'; 
// Corrected Model directory case
require_once __DIR__ . '/../Model/Hotel.php'; 
// Corrected Controller directory case
require_once __DIR__ . '/../Controller/HotelC.php'; 

class PlanVacanceC
{
    public function listPlans()
    {
        $sql = "SELECT * FROM plan_vacance";
        $db = config::getConnexion();
        try {
            return $db->query($sql);
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deletePlan($id)
    {
        $sql = "DELETE FROM plan_vacance WHERE id_plan = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);
        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addPlan($plan)
    {
        $sql = "INSERT INTO plan_vacance 
        VALUES (NULL, :nu, :dd, :dr, :tt, :lv, :bp, :ih)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nu' => $plan->getNomUtilisateur(),
                'dd' => $plan->getDateDepart(),
                'dr' => $plan->getDateRetour(),
                'tt' => $plan->getTypeTransport(),
                'lv' => $plan->getLocationVoiture(),
                'bp' => $plan->getBesoinParking(),
                'ih' => $plan->getIdHotel()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function showPlan($id)
    {
        $sql = "SELECT * from plan_vacance where id_plan = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetch();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updatePlan($plan, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE plan_vacance SET 
                    nom_utilisateur = :nu,
                    date_depart = :dd,
                    date_retour = :dr,
                    type_transport = :tt,
                    location_voiture = :lv,
                    besoin_parking = :bp,
                    id_hotel = :ih
                WHERE id_plan = :id'
            );
            
            $query->execute([
                'id' => $id,
                'nu' => $plan->getNomUtilisateur(),
                'dd' => $plan->getDateDepart(),
                'dr' => $plan->getDateRetour(),
                'tt' => $plan->getTypeTransport(),
                'lv' => $plan->getLocationVoiture(),
                'bp' => $plan->getBesoinParking(),
                'ih' => $plan->getIdHotel()
            ]);
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}