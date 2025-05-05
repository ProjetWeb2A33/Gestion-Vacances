<?php

class Reservation
{
    private int $idParking;
    private int $idClient;
    private string $nom_client;
    private string $horaire_d;
    private string $horaire_f;
    private string $statut;
    private string $prolongation;
    private string $payment;
    private int $disponibilite;
    private string $email; 
    

    public function __construct(
        int $idParking,
        int $idClient,
        string $nom_client,
        string $horaire_d,
        string $horaire_f,
        string $statut,
        string $prolongation,
        string $payment,
        int $disponibilite,
        string $email
        

    ) {
        $this->idParking = $idParking;
        $this->idClient = $idClient;
        $this->nom_client = $nom_client;
        $this->horaire_d = $horaire_d;
        $this->horaire_f = $horaire_f;
        $this->statut = $statut;
        $this->prolongation = $prolongation;
        $this->payment = $payment;
        $this->disponibilite = $disponibilite;
        $this->email = $email; // Initialisation de l'email
        

    }

    // Getters
    
    public function getIdParking(): int
    {
        return $this->idParking;
    }

    public function getIdClient(): int
    {
        return $this->idClient;
    }
    public function getNomClient(): string
    {
        return $this->nom_client;
    }
    public function getHoraireD(): string
    {
        return $this->horaire_d;
    }

    public function getHoraireF(): string
    {
        return $this->horaire_f;
    }

    public function getStatut(): string
    {
        return $this->statut;
    }

    public function getProlongation(): string
    {
        return $this->prolongation;
    }

    public function getPayment(): string
    {
        return $this->payment;
    }

    public function getDisponibilite(): int
    {
        return $this->disponibilite;
    }
    public function getEmail() {
        return $this->email; // Getter pour l'email
    }


    // Setters
    

    public function setIdParking(int $idParking): void
    {
        $this->idParking = $idParking;
    }

    public function setIdClient(int $idClient): void
    {
        $this->idClient = $idClient;
    }

    public function setHoraireD(string $horaire_d): void
    {
        $this->horaire_d = $horaire_d;
    }

    public function setHoraireF(string $horaire_f): void
    {
        $this->horaire_f = $horaire_f;
    }

    public function setStatut(string $statut): void
    {
        $this->statut = $statut;
    }

    public function setProlongation(string $prolongation): void
    {
        $this->prolongation = $prolongation;
    }

    public function setPayment(string $payment): void
    {
        $this->payment = $payment;
    }

    public function setDisponibilite(int $disponibilite): void
    {
        $this->disponibilite = $disponibilite;
    }

    public function setNomClient(int $nom_client): void
    {
        $this->nom_client = $nom_client;
    }
    
    public function setEmail($email) {
        $this->email = $email; // Setter pour l'email
    }
    
    
}
