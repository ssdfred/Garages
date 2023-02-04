<?php

namespace App\Controller;
use App\Repository\MenuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    #[Route( '/menu', name: 'menu')]
    public function menu( MenuRepository $repository): Response
    {
      //  $search = $request->request->get("search"); // $_MENU["search"]
      //  $menu = $repository->findAll(); // SELECT * FROM `menu`;
      //  if ($search) {
      //      $menus = $repository->findBySearch($search); // SELECT * FROM `menu` WHERE title LIKE :search;
      //  }

        return $this->render('menu/index.html.twig', [
            'menus' => $repository->findBy([], [])
        ]);
    }
}
