<?php
require __DIR__ . '/../config.php'; 
require_once __DIR__ . '/../Model/Hotel.php'; 
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
            die('Error: ' . $e->getMessage());
        }
    }

    public function deletePlan($id)
    {
        $sql = "DELETE FROM plan_vacance WHERE id_plan = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);
        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function addPlan($plan)
    {
        // Debugging: Make sure plan is correctly passed
        echo "Identifiant: " . $plan->getIdentifiant(); 
        echo "Nom Utilisateur: " . $plan->getNomUtilisateur();
        
        // SQL insert statement
        $sql = "INSERT INTO plan_vacance (
                    identifiant, 
                    nom_utilisateur, 
                    date_depart, 
                    date_retour, 
                    type_transport, 
                    location_voiture, 
                    besoin_parking, 
                    id_hotel
                ) VALUES (
                    :identifiant, :nu, :dd, :dr, :tt, :lv, :bp, :ih
                )";
        
        $db = config::getConnexion();
        try {
            // Prepare and execute the query
            $query = $db->prepare($sql);
            $query->execute([
                'identifiant' => $plan->getIdentifiant(),
                'nu' => $plan->getNomUtilisateur(),
                'dd' => $plan->getDateDepart(),
                'dr' => $plan->getDateRetour(),
                'tt' => $plan->getTypeTransport(),
                'lv' => $plan->getLocationVoiture(),
                'bp' => $plan->getBesoinParking(),
                'ih' => $plan->getIdHotel()
            ]);
    
            // Optional: Check how many rows were affected
            echo "Rows inserted: " . $query->rowCount();
    
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function showPlan($id)
    {
        $sql = "SELECT * FROM plan_vacance WHERE id_plan = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();
            return $query->fetch();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function updatePlan($plan, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                "UPDATE plan_vacance SET 
                    identifiant = :identifiant,
                    nom_utilisateur = :nu,
                    date_depart = :dd,
                    date_retour = :dr,
                    type_transport = :tt,
                    location_voiture = :lv,
                    besoin_parking = :bp,
                    id_hotel = :ih
                WHERE id_plan = :id"
            );
    
            $query->execute([
                'id' => $id,
                'identifiant' => $plan->getIdentifiant(),  // Add identifiant here
                'nu' => $plan->getNomUtilisateur(),
                'dd' => $plan->getDateDepart(),
                'dr' => $plan->getDateRetour(),
                'tt' => $plan->getTypeTransport(),
                'lv' => $plan->getLocationVoiture(),
                'bp' => $plan->getBesoinParking(),
                'ih' => $plan->getIdHotel()
            ]);
    
            // Check if any rows were updated
            $rowsUpdated = $query->rowCount();
            if ($rowsUpdated > 0) {
                echo "$rowsUpdated row(s) updated.";
            } else {
                echo "No rows were updated.";
            }
    
        } catch (PDOException $e) {
            echo 'Error in updatePlan: ' . $e->getMessage();
        }
    }

    public function searchPlansByIdentifiant($identifiant)
    {
        $sql = "SELECT * FROM plan_vacance WHERE identifiant LIKE :identifiant";
        $db = config::getConnexion();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':identifiant', '%' . $identifiant . '%');
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
