<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\CatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
    public function archivesIdea(int $idCat, CatRepository $catRepository): Response
    {


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


            $catRepository->save($cat, true);

            return new Response(status: 200);
    }
}
