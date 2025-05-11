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
            // Vérifier si le parking existe
            $checkParking = $db->prepare('SELECT COUNT(*) FROM parking WHERE ID_Parking = :ID_Parking');
            $checkParking->execute(['ID_Parking' => $ID_Parking]);
            if ($checkParking->fetchColumn() == 0) {
                throw new Exception("Le parking avec l'ID $ID_Parking n'existe pas.");
            }

            // Mettre à jour l'état du parking à 'supprimé'
            $updateParking = $db->prepare('UPDATE parking SET etat = "supprimé" WHERE ID_Parking = :ID_Parking');
            $updateParking->execute(['ID_Parking' => $ID_Parking]);

            return true; // Retourne true si la suppression logique a réussi
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

    
    public function getParkingsSupprimes() {
        $db = config::getConnexion();

        try {
            // Récupérer les parkings avec l'état "supprimé"
            $sql = "SELECT * FROM parking WHERE etat = 'supprimé'";
            $query = $db->prepare($sql);
            $query->execute();

            return $query->fetchAll(); // Retourne tous les résultats sous forme de tableau
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

   
    public function getParkingsActifs() {
        $db = config::getConnexion();

        try {
            // Récupérer uniquement les parkings avec l'état "actif"
            $sql = "SELECT * FROM parking WHERE etat = 'actif'";
            $query = $db->prepare($sql);
            $query->execute();

            return $query->fetchAll(); // Retourne tous les résultats sous forme de tableau
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    
    public function restaurerParking($id) {
        $db = config::getConnexion();
        
        try {
            // Mettre à jour l'état du parking à "actif"
            $sql = "UPDATE parking SET etat = 'actif' WHERE ID_Parking = :id";
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    
    public function supprimerParkingDefinitivement($id) {
        $db = config::getConnexion();
    
        try {
            // Supprimer définitivement le parking de la base de données
            $sql = "DELETE FROM parking WHERE ID_Parking = :id";
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    

    
       
}

?>
