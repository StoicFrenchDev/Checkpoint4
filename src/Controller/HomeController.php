<?php

namespace App\Controller;

use App\Repository\CatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(CatRepository $catRepository): Response
    {
        $cats = $catRepository->findAll();

        return $this->render('home/index.html.twig', [
            'cats' => $cats,
        ]);
    }
}
