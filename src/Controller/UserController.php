<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\CatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
#[Route('/owner', name: 'owner')]
class UserController extends AbstractController
{
    #[Route('/{id}', name: '_page')]
    public function index(User $user): Response
    {
        $cats = $user->getCats();

        return $this->render('user/index.html.twig', [
            'cats' => $cats,
            'user' => $user,
        ]);
    }
}
