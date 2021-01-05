<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SingRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiFilter;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass=SingRepository::class)
 * @ApiFilter(SearchFilter::class, properties={"id": "exact", "artistId": "exact", "trackId": "exact"})
 */
class Sing
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue"name": "partial"
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @ORM\Column(type="integer")
     */
    private $role;

    /**
     * @ORM\ManyToOne(targetEntity=Artist::class, inversedBy="sings")
     */
    private $artistId;

    /**
     * @ORM\ManyToOne(targetEntity=Track::class, inversedBy="sings")
     */
    private $trackId;



    public function getId(): ?int
    {
        return $this->id;
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

    public function getArtistId(): ?artist
    {
        return $this->artistId;
    }

    public function setArtistId(?artist $artistId): self
    {
        $this->artistId = $artistId;

        return $this;
    }

    public function getTrackId(): ?track
    {
        return $this->trackId;
    }

    public function setTrackId(?track $trackId): self
    {
        $this->trackId = $trackId;

        return $this;
    }
}
