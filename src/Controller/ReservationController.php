<?php

namespace App\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Restaurant;
use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{

    #[Route('/reservation/new', name: 'reservation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager ): Response
    {
        // Récupérer le restaurant de la réservation depuis l'objet Event
       // $restaurant = $entityManager->getRestaurant();
       // $reservation = $entityManager->getRepository(Reservation::class)->find(1);
        $reservation = new Reservation();
       // $reservation->setRestaurant($name);
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Ajouter ici la logique pour calculer la place restante
    
            $entityManager->persist($reservation);
            $entityManager->flush();
    
            return $this->redirectToRoute('reservation_show', ['id' => $reservation->getId()]);
        }
    
        return $this->render('reservation/new.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/reservation/{id}', name: 'reservation_show', methods: ['GET'])]
    public function show(Reservation $reservation): Response
    {
        return $this->render('reservation/show.html.twig', [
            'reservation' => $reservation,
        ]);
    }

    /**
     * @Route("/reservation/{id}/calcul", name="reservation_calcul")
     */
    public function calcul(Request $request, Reservation $reservation)
    {
        $restaurant = $reservation->getRestaurant();
        $nbCouverts = $reservation->getNbCouverts();
        $date = $reservation->getDate();
        $heure = $reservation->getReservationHeure();

        // Récupérer toutes les réservations pour le même restaurant, à la même date et la même heure
        $reservations = $this->getDoctrine()->getRepository(Reservation::class)->findBy([
            'restaurant' => $restaurant,
            'date' => $date,
            'reservationHeure' => $heure,
        ]);

        // Calculer le nombre total de personnes pour ces réservations
        $totalPersonnes = 0;
        foreach ($reservations as $r) {
            $totalPersonnes += $r->getNbPersonnes();
        }

        // Calculer le nombre de places restantes
        $placesRestantes = $restaurant->getCapacite() - $totalPersonnes;
        $placesRestantes -= $nbCouverts; // Soustraire les couverts de la réservation en cours

        // Si le nombre de places restantes est suffisant, afficher un message de confirmation
        if ($placesRestantes >= 0) {
            $message = "Il reste $placesRestantes places disponibles pour votre réservation.";
        } else {
            $message = "Malheureusement, il n'y a pas assez de places disponibles pour votre réservation.";
        }
        $form = $this->createFormBuilder()
            ->add('message', null, ['label' => false, 'data' => $message, 'attr' => ['readonly' => true]])
            ->add('submit', SubmitType::class, ['label' => 'Valider la réservation'])
            ->getForm();

        $form->handleRequest($request);

       


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reservation);
            $entityManager->flush();

            return $this->redirectToRoute('reservation_show', ['id' => $reservation->getId()]);
        }

        return $this->render('reservation/calcul.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
}


