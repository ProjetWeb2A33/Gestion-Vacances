<?php

class Parking
{
    private string $nomParking;
    private string $adresse;
    private int $capacite;
    private int $nombreDispo;
    private string $horaireOuv;
    private string $horaireFerm;
    private string $abonnement;
    private string $tarification;
    private string $etat;

    public function __construct(
        string $nomParking,
        string $adresse,
        int $capacite,
        int $nombreDispo,
        string $horaireOuv,
        string $horaireFerm,
        string $abonnement,
        string $tarification,
        string $etat = 'actif'
    ) {
        $this->nomParking = $nomParking;
        $this->adresse = $adresse;
        $this->capacite = $capacite;
        $this->nombreDispo = $nombreDispo;
        $this->horaireOuv = $horaireOuv;
        $this->horaireFerm = $horaireFerm;
        $this->abonnement = $abonnement;
        $this->tarification = $tarification;
        $this->etat = $etat;

    }

    // Getters
    public function getNomParking(): string
    {
        return $this->nomParking;
    }

    public function getAdresse(): string
    {
        return $this->adresse;
    }

    public function getCapacite(): int
    {
        return $this->capacite;
    }

    public function getNombreDispo(): int
    {
        return $this->nombreDispo;
    }

    public function getHoraireOuv(): string
    {
        return $this->horaireOuv;
    }

    public function getHoraireFerm(): string
    {
        return $this->horaireFerm;
    }

    public function getAbonnement(): string
    {
        return $this->abonnement;
    }

    public function getTarification(): string
    {
        return $this->tarification;
    }

    public function getEtat(): string
    {
        return $this->etat;
    }

    // Setters
    public function setNomParking(string $nomParking): void
    {
        $this->nomParking = $nomParking;
    }

    public function setAdresse(string $adresse): void
    {
        $this->adresse = $adresse;
    }

    public function setCapacite(int $capacite): void
    {
        $this->capacite = $capacite;
    }

    public function setNombreDispo(int $nombreDispo): void
    {
        $this->nombreDispo = $nombreDispo;
    }

    public function setHoraireOuv(string $horaireOuv): void
    {
        $this->horaireOuv = $horaireOuv;
    }

    public function setHoraireFerm(string $horaireFerm): void
    {
        $this->horaireFerm = $horaireFerm;
    }

    public function setAbonnement(string $abonnement): void
    {
        $this->abonnement = $abonnement;
    }

    public function setTarification(string $tarification): void
    {
        $this->tarification = $tarification;
    }

    public function setEtat(string $etat): void
    {
        $this->etat = $etat;
    }
}
