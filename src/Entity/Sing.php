<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SingRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass=SingRepository::class)
 */
class Sing
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Artist::class, inversedBy="sings")
     */
    private $artistId;

    /**
     * @ORM\ManyToOne(targetEntity=Track::class, inversedBy="sings")
     */
    private $trackId;

    /**
     * @ORM\Column(type="integer")
     */
    private $role;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArtistId(): ?Artist
    {
        return $this->artistId;
    }

    public function setArtistId(?Artist $artistId): self
    {
        $this->artistId = $artistId;

        return $this;
    }

    public function getTrackId(): ?Track
    {
        return $this->trackId;
    }

    public function setTrackId(?Track $trackId): self
    {
        $this->trackId = $trackId;

        return $this;
    }

    public function getRole(): ?int
    {
        return $this->role;
    }

    public function setRole(int $role): self
    {
        $this->role = $role;

        return $this;
    }
}
