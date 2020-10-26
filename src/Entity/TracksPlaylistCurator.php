<?php

namespace App\Entity;

use App\Repository\TracksPlaylistCuratorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TracksPlaylistCuratorRepository::class)
 */
class TracksPlaylistCurator
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=PlaylistCurator::class, inversedBy="tracksPlaylistCurators")
     */
    private $playlistCuratorId;

    /**
     * @ORM\Column(type="integer")
     */
    private $position;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $publicationDate;

    /**
     * @ORM\ManyToMany(targetEntity=Track::class, inversedBy="tracksPlaylistCurators")
     */
    private $trackId;

    public function __construct()
    {
        $this->trackId = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlaylistCuratorId(): ?PlaylistCurator
    {
        return $this->playlistCuratorId;
    }

    public function setPlaylistCuratorId(?PlaylistCurator $playlistCuratorId): self
    {
        $this->playlistCuratorId = $playlistCuratorId;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getPublicationDate(): ?string
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(string $publicationDate): self
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    /**
     * @return Collection|Track[]
     */
    public function getTrackId(): Collection
    {
        return $this->trackId;
    }

    public function addTrackId(Track $trackId): self
    {
        if (!$this->trackId->contains($trackId)) {
            $this->trackId[] = $trackId;
        }

        return $this;
    }

    public function removeTrackId(Track $trackId): self
    {
        if ($this->trackId->contains($trackId)) {
            $this->trackId->removeElement($trackId);
        }

        return $this;
    }
}
