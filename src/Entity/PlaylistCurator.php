<?php

namespace App\Entity;

use App\Repository\PlaylistCuratorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlaylistCuratorRepository::class)
 */
class PlaylistCurator
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
     * @ORM\Column(type="string", length=255)
     */
    private $idInPlatform;

    /**
     * @ORM\Column(type="integer")
     */
    private $curatorId;

    /**
     * @ORM\OneToMany(targetEntity=TracksPlaylistCurator::class, mappedBy="playlistCuratorId")
     */
    private $tracksPlaylistCurators;

    public function __construct()
    {
        $this->tracksPlaylistCurators = new ArrayCollection();
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

    public function getIdInPlatform(): ?string
    {
        return $this->idInPlatform;
    }

    public function setIdInPlatform(string $idInPlatform): self
    {
        $this->idInPlatform = $idInPlatform;

        return $this;
    }

    public function getCuratorId(): ?int
    {
        return $this->curatorId;
    }

    public function setCuratorId(int $curatorId): self
    {
        $this->curatorId = $curatorId;

        return $this;
    }

    /**
     * @return Collection|TracksPlaylistCurator[]
     */
    public function getTracksPlaylistCurators(): Collection
    {
        return $this->tracksPlaylistCurators;
    }

    public function addTracksPlaylistCurator(TracksPlaylistCurator $tracksPlaylistCurator): self
    {
        if (!$this->tracksPlaylistCurators->contains($tracksPlaylistCurator)) {
            $this->tracksPlaylistCurators[] = $tracksPlaylistCurator;
            $tracksPlaylistCurator->setPlaylistCuratorId($this);
        }

        return $this;
    }

    public function removeTracksPlaylistCurator(TracksPlaylistCurator $tracksPlaylistCurator): self
    {
        if ($this->tracksPlaylistCurators->contains($tracksPlaylistCurator)) {
            $this->tracksPlaylistCurators->removeElement($tracksPlaylistCurator);
            // set the owning side to null (unless already changed)
            if ($tracksPlaylistCurator->getPlaylistCuratorId() === $this) {
                $tracksPlaylistCurator->setPlaylistCuratorId(null);
            }
        }

        return $this;
    }
}
