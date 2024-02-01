<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\CatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
#[Route('/admin', name: 'admin')]
class AdminController extends AbstractController
{
    #[Route('/', name: '_page')]
    public function index(CatRepository $catRepository): Response
    {
        $cats = $catRepository->findAll();

        return $this->render('admin/index.html.twig', [
            'cats' => $cats
        ]);
    }
}
