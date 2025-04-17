<?php
require __DIR__ . '/../config.php';

class HotelC
{
    public function listHotels()
    {
        $sql = "SELECT * FROM hotel";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteHotel($id)
    {
        $db = config::getConnexion();
        
        try {
            // First delete related plan_vacance entries
            $sql_plan = "DELETE FROM plan_vacance WHERE id_hotel = :id";
            $req_plan = $db->prepare($sql_plan);
            $req_plan->bindValue(':id', $id);
            $req_plan->execute();
    
            // Then delete the hotel
            $sql_hotel = "DELETE FROM hotel WHERE id_hotel = :id";
            $req_hotel = $db->prepare($sql_hotel);
            $req_hotel->bindValue(':id', $id);
            $req_hotel->execute();
            
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addHotel($hotel)
    {
        $sql = "INSERT INTO hotel 
        VALUES (NULL, :nom, :adresse, :ville, :npp, :ppd, :categorie)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $hotel->getNomHotel(),
                'adresse' => $hotel->getAdresse(),
                'ville' => $hotel->getVille(),
                'npp' => $hotel->getNombrePlacesParking(),
                'ppd' => $hotel->getPlacesParkingDisponibles(),
                'categorie' => $hotel->getCategorie()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function showHotel($id)
    {
        $sql = "SELECT * from hotel where id_hotel = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $hotel = $query->fetch();
            return $hotel;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updateHotel($hotel, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE hotel SET 
                    nom_hotel = :nom, 
                    adresse = :adresse,
                    ville = :ville,
                    nombre_places_parking = :npp,
                    places_parking_disponibles = :ppd,
                    categorie = :categorie
                WHERE id_hotel = :id'
            );
            
            $query->execute([
                'id' => $id,
                'nom' => $hotel->getNomHotel(),
                'adresse' => $hotel->getAdresse(),
                'ville' => $hotel->getVille(),
                'npp' => $hotel->getNombrePlacesParking(),
                'ppd' => $hotel->getPlacesParkingDisponibles(),
                'categorie' => $hotel->getCategorie()
            ]);
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}