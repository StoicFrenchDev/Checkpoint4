<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\CatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
class removeCatController extends AbstractController
{
    #[Route('/removeCat/{idCat}', name: 'remove_cat')]
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


            $catRepository->remove($cat, true);
            return new Response(status: 200);
        }

        return new Response(status: 403);
    }
}
