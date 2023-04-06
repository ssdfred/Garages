<?php

namespace App\Repository;
use App\Entity\Restaurant;
use App\Entity\Reservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Reservation>
 *
 * @method Reservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservation[]    findAll()
 * @method Reservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservation::class);
    }

    public function save(Reservation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Reservation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

  /**
   * @return Reservation[] Returns an array of Reservation objects
   */
  public function findByReservationField($value, EntityManager $entityManager, Restaurant $restaurant,Reservation $reservations): array
  {
    $reservations = $entityManager->getRepository(Reservation::class)->findBy([
        'restaurant' => $restaurant,
    ]);
      return $this->createQueryBuilder('r')
          ->andWhere('r.reservationField = :val')
          ->setParameter('val', $value)
          ->orderBy('r.nb_personnes', 'ASC')
          ->setMaxResults(10)
          ->getQuery()
          ->getResult()
      ;
  }
  public function getPlacesDisponibles(\DateTime $date, string $reservation_heure, int $duree): int
{
    // Trouver toutes les réservations pour la date, l'heure et la durée données
    $reservations = $this->findBy([
        'date' => $date,
        'heure' => $reservation_heure,
        'duree' => $duree,
    ]);

    // Calculer le nombre total de places réservées
    $nb_places_reserves = array_reduce($reservations, function($acc, $reservation) {
        return $acc + $reservation->getNbPersonnes();
    }, 0);

    // Récupérer le nombre total de places disponibles pour ce créneau horaire
    $restaurant = $reservations[0]->getRestaurant();
    $nb_places_total = $restaurant->getNbCouverts();
    $nb_places_disponibles = $nb_places_total - $nb_places_reserves;

    return $nb_places_disponibles;
}


}
