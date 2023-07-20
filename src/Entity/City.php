<?php

namespace App\Entity;

use App\Repository\CityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CityRepository::class)]
class City
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'residence', targetEntity: User::class, orphanRemoval: true)]
    private Collection $inhabitants;

    public function __construct()
    {
        $this->inhabitants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getInhabitants(): Collection
    {
        return $this->inhabitants;
    }

    public function addInhabitant(User $inhabitant): self
    {
        if (!$this->inhabitants->contains($inhabitant)) {
            $this->inhabitants->add($inhabitant);
            $inhabitant->setResidence($this);
        }

        return $this;
    }

    public function removeInhabitant(User $inhabitant): self
    {
        if ($this->inhabitants->removeElement($inhabitant)) {
            // set the owning side to null (unless already changed)
            if ($inhabitant->getResidence() === $this) {
                $inhabitant->setResidence(null);
            }
        }

        return $this;
    }
}
