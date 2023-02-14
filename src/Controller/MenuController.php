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

        return $this->render('menu/index.html.twig', [
            "menus" => $repository->findAll([], []),
        ]);

    }
}

