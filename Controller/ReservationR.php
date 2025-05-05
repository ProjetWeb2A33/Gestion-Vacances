<?php 

include_once __DIR__ . '/../config.php';

class ReservationR {

    
    public function ListeReservation() {
        $db = config::getConnexion();
        try {
            $query = $db->prepare("
                SELECT 
                    r.ID_Reservation,
                    r.idParking,
                    r.idClient,
                    r.nom_client,
                    r.email,
                    r.horaire_d,
                    r.horaire_f,
                    r.statut,
                    r.prolongation,
                    r.payment,
                    r.disponibilite,
                    p.Nom_Parking AS Nom_Parking
                FROM reservation r
                LEFT JOIN parking p ON r.idParking = p.ID_Parking
            ");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function DeleteReservation($ID_Reservation) {

        $db = config::getConnexion();

        try {

            $req = $db->prepare('
            DELETE FROM reservation WHERE ID_Reservation = :ID_Reservation
            ');
            $req->execute([
                'ID_Reservation' => $ID_Reservation
            ]);

        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function AjouterReservation($reservation) {
        $db = config::getConnexion();
        try {
            $req = $db->prepare('
                INSERT INTO reservation (idParking, nom_client, idClient, horaire_d, horaire_f, statut, prolongation, payment, disponibilite,email) 
                VALUES (:p, :nc, :c, :hd, :hf, :s, :pr, :py, :d, :e)
            ');
            $req->execute([
                'p'  => $reservation->getIdParking(),
                'nc' => $reservation->getNomClient(),
                'c'  => $reservation->getIdClient(),
                'hd' => $reservation->getHoraireD(),
                'hf' => $reservation->getHoraireF(),
                's'  => $reservation->getStatut(),
                'pr' => $reservation->getProlongation(),
                'py' => $reservation->getPayment(),
                'd'  => $reservation->getDisponibilite(),
                'e' =>$reservation->getEmail() 


            ]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    
    
    public function getReservationById($id) {
        $db = config::getConnexion();
        try {
            $query = $db->prepare("
                SELECT 
                    r.*,
                    p.Nom_Parking AS Nom_Parking
                FROM reservation r
                LEFT JOIN parking p ON r.idParking = p.ID_Parking
                WHERE r.ID_Reservation = :id
            ");
            $query->execute(['id' => $id]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    public function UpdateReservation($ID_Reservation, Reservation $reservation) {
        $db = config::getConnexion();

        try {
             $query = $db->prepare("UPDATE reservation SET 
                
                    idParking = :p,
                    idClient = :c,
                    nom_client = :nc, 
                    horaire_d = :hd,
                    horaire_f = :hf,
                    statut = :s,
                    prolongation = :pr,
                    payment = :py,
                    disponibilite = :d,
                    email =:e
                WHERE ID_Reservation = :id
            ");
            
            return $query->execute([
                'p'  => $reservation->getIdParking(),
                'c'  => $reservation->getIdClient(),
                'nc' => $reservation->getNomClient(),
                'hd' => $reservation->getHoraireD(),
                'hf' => $reservation->getHoraireF(),
                's'  => $reservation->getStatut(),
                'pr' => $reservation->getProlongation(),
                'py' => $reservation->getPayment(),
                'd'  => $reservation->getDisponibilite(),
                'e'  => $reservation->getEmail(),
                'id' => $ID_Reservation
            ]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function getAvailableParkings() {
        $db = config::getConnexion();
        try {
            $query = $db->prepare("SELECT ID_Parking, Nom_Parking FROM parking WHERE ID_Parking IS NOT NULL");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    
    public function getBestParking($horaire_d, $horaire_f) {
        $conn = Config::getConnexion();
        
        // Conversion exacte des heures
        $heure_debut = (float)explode(':', $horaire_d)[0];
        $heure_fin = (float)explode(':', $horaire_f)[0];
        
        try {
            // Requête SQL précise avec vérification stricte des horaires
            $query = $conn->prepare("
                SELECT 
                    p.ID_Parking,
                    p.Nom_Parking,
                    p.Adresse_Parking,
                    p.Nombre_Dispo,
                    p.Tarification,
                    p.Horaire_Ouv,
                    p.Horaire_Ferm,
                    p.Abonnement,
                    /* Calcul complet du score directement en SQL */
                    (p.Nombre_Dispo * 0.4) + 
                    (CASE 
                        WHEN p.Tarification LIKE '%basique%' THEN 30
                        WHEN p.Tarification LIKE '%standard%' THEN 20
                        ELSE 10
                    END) +
                    ((p.Horaire_Ferm - p.Horaire_Ouv) * 0.2) +
                    (CASE
                        WHEN p.Abonnement LIKE '%Premium%' THEN 10
                        WHEN p.Abonnement LIKE '%Mensuel%' THEN 7
                        ELSE 3
                    END) AS score
                FROM parking p
                WHERE p.Nombre_Dispo > 0
                AND :heure_debut >= p.Horaire_Ouv
                AND :heure_fin <= p.Horaire_Ferm
                ORDER BY score DESC
                LIMIT 1
            ");
            
            $query->execute([
                ':heure_debut' => $heure_debut,
                ':heure_fin' => $heure_fin
            ]);
            
            $result = $query->fetch(PDO::FETCH_ASSOC);
            
            if (!$result) {
                return null;
            }
            
            // Formatage du score pour l'affichage
            $result['score'] = round($result['score'], 2);
            
            return $result;
            
        } catch (PDOException $e) {
            error_log("Erreur getBestParking: ".$e->getMessage());
            return null;
        }
    }
    
    private function calculateParkingScore($parking) {
        $score = 0;
        
        // Disponibilité (40%)
        $score += $parking['Nombre_Dispo'] * 0.4;
        
        // Tarification (30%)
        $tarif = strtolower($parking['Tarification']);
        if (strpos($tarif, 'basique') !== false) $score += 30;
        elseif (strpos($tarif, 'standard') !== false) $score += 20;
        else $score += 10;
        
        // Plage horaire (20%)
        $plage = $parking['Horaire_Ferm'] - $parking['Horaire_Ouv'];
        $score += ($plage / 24) * 20;
        
        // Abonnement (10%)
        $abonnement = strtolower($parking['Abonnement']);
        if (strpos($abonnement, 'premium') !== false) $score += 10;
        elseif (strpos($abonnement, 'mensuel') !== false) $score += 7;
        else $score += 3;
        
        return round($score, 2);
    }
    
    private function timeToDecimal($time) {
        if (is_numeric($time)) return (float)$time;
        
        $parts = explode(':', $time);
        $hour = (float)$parts[0];
        $minutes = isset($parts[1]) ? (float)$parts[1]/60 : 0;
        
        return $hour + $minutes;
    }
    

}

?>

         
        


