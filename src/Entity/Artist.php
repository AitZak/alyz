<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ArtistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass=ArtistRepository::class)
 */
class Artist
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Sing::class, mappedBy="artistId")
     */
    private $sings;

    public function __construct()
    {
        $this->sings = new ArrayCollection();
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
     * @return Collection|Sing[]
     */
    public function getSings(): Collection
    {
        return $this->sings;
    }

    public function addSing(Sing $sing): self
    {
        if (!$this->sings->contains($sing)) {
            $this->sings[] = $sing;
            $sing->setArtistId($this);
        }

        return $this;
    }

    public function removeSing(Sing $sing): self
    {
        if ($this->sings->contains($sing)) {
            $this->sings->removeElement($sing);
            // set the owning side to null (unless already changed)
            if ($sing->getArtistId() === $this) {
                $sing->setArtistId(null);
            }
        }

        return $this;
    }
}
