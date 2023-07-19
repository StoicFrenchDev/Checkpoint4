<?php

namespace App\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use App\Repository\CatRepository;

#[AsTwigComponent('recentCats')]
class RecentProfilesComponent
{
    private CatRepository $catRepository;

    public function __construct(CatRepository $catRepository)
    {
        $this->catRepository = $catRepository;
    }

    public function getRecentCats(): array
    {
        return $this->catRepository->findBy([], ['id' => 'DESC']);
    }
}
