<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CuratorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiFilter;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass=CuratorRepository::class)
 * @ApiFilter(SearchFilter::class, properties={"id": "exact","name": "partial", "countryId" : "exact", "platformMusicId": "exact"})
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

    /**
     * @ORM\OneToMany(targetEntity=PlaylistCurator::class, mappedBy="curatorId")
     */
    private $playlists;

    public function __construct()
    {
        $this->playlists = new ArrayCollection();
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

    public function getPlatformMusicId(): ?PlatformMusic
    {
        return $this->platformMusicId;
    }

    public function setPlatformMusicId(?PlatformMusic $platformMusicId): self
    {
        $this->platformMusicId = $platformMusicId;

        return $this;
    }

    /**
     * @return Collection|PlaylistCurator[]
     */
    public function getPlaylists(): Collection
    {
        return $this->playlists;
    }

    public function addPlaylist(PlaylistCurator $playlist): self
    {
        if (!$this->playlists->contains($playlist)) {
            $this->playlists[] = $playlist;
            $playlist->setCuratorId($this);
        }

        return $this;
    }

    public function removePlaylist(PlaylistCurator $playlist): self
    {
        if ($this->playlists->removeElement($playlist)) {
            // set the owning side to null (unless already changed)
            if ($playlist->getCuratorId() === $this) {
                $playlist->setCuratorId(null);
            }
        }

        return $this;
    }
}
