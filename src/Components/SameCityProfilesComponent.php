<?php

namespace App\Components;

use App\Entity\User;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use App\Repository\CatRepository;
use App\Entity\Cat;
use App\Form\CatType;
use App\Service\FileUploader;
use App\Service\ImageVerification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

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

        $residenceId = $user->getResidence()->getId();

        return $this->catRepository->getSameCityCats($residenceId);
    }
}
