<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormTypeInterface;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'reservation')]
    public function reservation(Request $request, ManagerRegistry $doctrine): Response
    {
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($reservation);
            $em->flush();
            return $this->redirectToRoute("accueil");
        }
        return $this->render('reservation/index.html.twig', [
            "form" => $form->createView(),
        ]);
    }
}


