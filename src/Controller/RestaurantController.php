<?php

namespace App\Controller;


use App\Entity\Restaurant;

use App\Form\RestaurantType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class RestaurantController extends AbstractController
{
    #[Route('/restaurant', name: 'restaurant')]
    public function new(Request $request, UserPasswordHasherInterface $userPasswordHasher, ManagerRegistry $doctrine): Response
    {

        $restaurant = new Restaurant($userPasswordHasher);
        $form = $this->createForm(RestaurantType::class, $restaurant);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($restaurant);
            $em->flush();
            return $this->redirectToRoute("accueil");
        }
        return $this->render('restaurant/index.html.twig', [
            'controller_name' => 'RestaurantController',
        ]);


    }

/*
   #[Route('/menu/new')]
    public function create(Request $request, ManagerRegistry $doctrine, SluggerInterface $slugger): Response
    {
        //denyAcces.. verifie que l'utilisateur est conecter pour avoir avoir accés à la page ou redirige
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $menu = new Menu();
        $form = $this->createForm(MenuType::class, $menu);
        //dump($post);
        $form->handleRequest($request);
        //dump($post);
        if ($form->isSubmitted() && $form->isValid()) {
            //permet d'importer l'image selon les condition decrit dabs le posType et parmatrer le service.yarl
            $image = $form->get('image')->getData();

            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();
                try {
                    $image->move(
                        $this->getParameter('uploads'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    //  dump($e);
                }
                $menu->setImage($newFilename);
            }
//permet d'envoyer le contenue en base de données et de l'afficher sur la page form
            $menu->setRestaurantId($this->getUser());
            $menu->setPublishedAt(new \DateTime());
            $em = $doctrine->getManager();
            $em->persist($menu);
            $em->flush();
            return $this->redirectToRoute("accueil");
        }
        return $this->render('restaurant/form.html.twig', [
            "form" => $form->createView()
        ]);
    }

    #[Route('/menu/edit/{id<\d+>}', name: "edit-menu")]
    public function update(Request $request, Menu $menu, ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        if ($this->getUser() !== $menu->getRestaurantId()) {
            $this->addFlash("error", "Vous ne pouvez pas modifier une publication qui ne vous appartient pas.");
            return $this->redirectToRoute("accueil");
            // throw new AccessDeniedException("Vous n'avez pas accès à cette fonctionnalité.");
        }
        $form = $this->createForm(MenuType::class, $menu);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute("accueil");
        }
        return $this->render('restaurant/form.html.twig', [
            "form" => $form->createView()
        ]);
    }

    #[Route('/menu/delete/{id<\d+>}', name: "delete-menu")]
    public function delete(Menu $menu, ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        if ($this->getUser() !== $menu->getRestaurantId()) {
            $this->addFlash("error", "Vous ne pouvez pas supprimer une publication qui ne vous appartient pas.");
            return $this->redirectToRoute("accueil");
        }
        $em = $doctrine->getManager();
        $em->remove($menu);
        $em->flush();
        return $this->redirectToRoute("accueil");
    }

 //  #[Route('/post/copy/{id<\d+>}', name: "copy-post")]
 //  public function duplicate(Post $post, ManagerRegistry $doctrine): Response
 //  {
 //      $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
 //      if ($this->getUser() !== $post->getUser()) {
 //          $this->addFlash("error", "Vous ne pouvez pas dupliquer une publication qui ne vous appartient pas.");
 //          return $this->redirectToRoute("home");
 //      }
 //      $copyPost = clone $post;
 //      $em = $doctrine->getManager();
 //      $em->persist($copyPost);
 //      $em->flush();
 //      return $this->redirectToRoute("home");
 //  }

    /* #[Route('/post/search/{search}', name: "search-post")]
    public function search(string $search): Response
    {
        dump($search);
        return new Response("");
        //return $this->redirectToRoute("home");
    } */
}
