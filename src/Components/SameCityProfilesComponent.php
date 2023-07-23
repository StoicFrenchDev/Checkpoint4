<?php

namespace App\Components;

use App\Entity\User;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use App\Repository\CatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[AsTwigComponent('closeCats')]
class SameCityProfilesComponent extends AbstractController
{
    private CatRepository $catRepository;

    public function __construct(CatRepository $catRepository)
    {
        $this->catRepository = $catRepository;
    }

    public function getCloseCats(): array
    {
        /** @var User $user */
        $user = $this->getUser();
        $userId = $user->getId();

        $residenceId = $user->getResidence()->getId();

        return $this->catRepository->getSameCityCats($residenceId, $userId);
    }
}
