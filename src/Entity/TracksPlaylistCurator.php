<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TracksPlaylistCuratorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiFilter;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass=TracksPlaylistCuratorRepository::class)
 * @ApiFilter(SearchFilter::class, properties={"id": "exact","trackId": "exact", "playlistCuratorId": "exact", "publication_date": "exact"})
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
     * @ORM\ManyToOne(targetEntity=Track::class, inversedBy="tracksPlaylistCurators")
     */
    private $trackId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $publicationDate;


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


    public function getTrackId(): ?Track
    {
        return $this->trackId;
    }

    public function setTrackId(?Track $trackId): self
    {
        $this->trackId = $trackId;

        return $this;
    }

    public function getPublicationDate(): ?string
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(?string $publicationDate): self
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

}
