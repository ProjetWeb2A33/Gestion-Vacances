<?php 

include_once __DIR__ . '/../config.php';

class ParkingP {

    public function ListeParking () {
        
        $db = config::getConnexion();

        try {

            $liste = $db->query('SELECT * FROM parking');
            return $liste;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function DeleteParking($ID_Parking) {
        $db = config::getConnexion();

        try {
            $checkParking = $db->prepare('SELECT COUNT(*) FROM parking WHERE ID_Parking = :ID_Parking');
            $checkParking->execute(['ID_Parking' => $ID_Parking]);
            if ($checkParking->fetchColumn() == 0) {
                throw new Exception("Le parking avec l'ID $ID_Parking n'existe pas.");
            }

            $deleteReservations = $db->prepare('DELETE FROM reservation WHERE idParking = :ID_Parking');
            $deleteReservations->execute(['ID_Parking' => $ID_Parking]);

            $deleteParking = $db->prepare('DELETE FROM parking WHERE ID_Parking = :ID_Parking');
            $deleteParking->execute(['ID_Parking' => $ID_Parking]);

        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function AjouterParking($Parking) {
        $db = config::getConnexion();

        try {
            $req = $db->prepare('
                INSERT INTO parking (Nom_Parking, Adresse_Parking, Capacite_Totale, Nombre_Dispo, Horaire_Ouv, Horaire_Ferm, Abonnement, Tarification) 
                VALUES (:n, :a, :c, :nd, :ho, :hf, :ab, :t)
            ');

            $req->execute([
                'n' => $Parking->getNomParking(),
                'a' => $Parking->getAdresse(),
                'c' => $Parking->getCapacite(),
                'nd' => $Parking->getNombreDispo(),
                'ho' => $Parking->getHoraireOuv(),
                'hf' => $Parking->getHoraireFerm(),
                'ab' => $Parking->getAbonnement(),
                't' => $Parking->getTarification()
            ]);

        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function getParkingById($ID_Parking) {
        $db = config::getConnexion(); 
        try {
            $query = $db->prepare('SELECT * FROM parking WHERE ID_Parking = :id');
            $query->execute(['id' => $ID_Parking]);

            $result = $query->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return $result; 
            } else {
                return null; 
            }
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function UpdateParking($id, Parking $parking) {
        $db = config::getConnexion();
        try {
            $query = $db->prepare("UPDATE parking SET 
                Nom_Parking = :nom, 
                Adresse_Parking = :adresse, 
                Capacite_Totale = :capacite, 
                Nombre_Dispo = :dispo, 
                Horaire_Ouv = :ouv, 
                Horaire_Ferm = :ferm, 
                Abonnement = :abonnement, 
                Tarification = :tarification 
                WHERE ID_Parking = :id");
            
            return $query->execute([
                ':nom' => $parking->getNomParking(),
                ':adresse' => $parking->getAdresse(),
                ':capacite' => $parking->getCapacite(),
                ':dispo' => $parking->getNombreDispo(),
                ':ouv' => $parking->getHoraireOuv(),
                ':ferm' => $parking->getHoraireFerm(),
                ':abonnement' => $parking->getAbonnement(),
                ':tarification' => $parking->getTarification(),
                ':id' => $id
            ]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function envoyerEmailConfirmation($nomParking, $adresseParking, $tarification) {
        $destinataire = 'msellatihabiba7@gmail.com'; // Remplacez par l'email du destinataire
    
        return MailController::envoyerEmailConfirmation($nomParking, $adresseParking, $tarification, $destinataire);
    }

    
       
}

?>
