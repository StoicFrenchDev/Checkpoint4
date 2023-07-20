<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Cat;
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



    #[Route('/removeCat/{idCat}', name: '_remove_cat')]
    public function removeCatProfile(int $idCat, CatRepository $catRepository): Response
    {
        if ($this->isGranted('ROLE_USER')) {
            /** @var User $user */
            $user = $this->getUser();
            $userId = $user->getId();

            $cat = $catRepository->findOneBy([
                'id' => $idCat,
                'owner' => $userId
            ]);

            if (is_null($cat)) {
                $this->addFlash('danger', 'Seul l\'auteur d\'une idée peut la supprimer');
                return $this->redirectToRoute('home');
            }

            $catRepository->remove($cat, true);
            return new Response(status: 200);
        }

        return new Response(status: 403);
    }
}
