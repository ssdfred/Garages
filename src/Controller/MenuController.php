<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Repository\MenuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    #[Route( '/menu', name: 'menu')]
    public function menu( Request $request,MenuRepository $repository): Response
    {

       // $menu = new Menu();
       // $form = $this->createForm(Menu::class);
       // $form->handleRequest($request);
       // if ($form->isSubmitted() && $form->isValid()) {
       //     $em = $repository->getManager();
       //     $em->persist($menu);
       //     $em->flush();
       //     return $this->redirectToRoute("accueil");
        //}
        return $this->render('menu/index.html.twig', [
            "menus" => $repository->findAll([], []),
        ]);
      //  $search = $request->request->get("search"); // $_MENU["search"]
      //  $menu = $repository->findAll(); // SELECT * FROM `menu`;
      //  if ($search) {
      //      $menus = $repository->findBySearch($search); // SELECT * FROM `menu` WHERE title LIKE :search;
      //  }

       // return $this->render('menu/index.html.twig', [

            //'menus' => $repository->findBy([], [])
      //  ]);
    }
}

