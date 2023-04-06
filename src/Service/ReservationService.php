<?php

namespace App\Service;
use APP\Entity\Restaurant;
use App\Entity\Reservation;
use Doctrine\ORM\EntityManagerInterface;

class ReservationService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getPlacesRestantes(): int
    {
        $reservations = $this->entityManager->getRepository(Reservation::class, Restaurant::class)->findAll();

        $nb_couverts = 50;
        $nb_personnes = 0;

        foreach ($reservations as $reservation) {
            $nb_personnes += $reservation->getNbPersonnes();
        }

        return $nb_couverts - $nb_personnes;
    }
public function updatePlacesRestantes(Reservation $reservation): void
{
    $nb_personnes = $reservation->getNbPersonnes();
    $nb_couverts = 50;

    $reservations = $this->entityManager->getRepository(Reservation::class)->findAll();

    foreach ($reservations as $r) {
        if ($r->getId() === $reservation->getId()) {
            continue;
        }

        $nb_personnes+= $r->getNbPersonnes();
    }

    $placesRestantes = $nb_couverts - $nb_personnes;

    if ($placesRestantes < 0) {
        $placesRestantes = 0;
    }

    $reservation->setPlaceRestante($placesRestantes);

    $this->entityManager->persist($reservation);
    $this->entityManager->flush();
}

}
