<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CuratorRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass=CuratorRepository::class)
 */
class Curator
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
     * @ORM\ManyToOne(targetEntity=PlatformMusic::class, inversedBy="curators")
     */
    private $platformMusicId;

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

    public function getPlatformMusicId(): ?PlatformMusic
    {
        return $this->platformMusicId;
    }

    public function setPlatformMusicId(?PlatformMusic $platformMusicId): self
    {
        $this->platformMusicId = $platformMusicId;

        return $this;
    }
}
