<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TracksPlaylistUserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiFilter;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass=TracksPlaylistUserRepository::class)
 * @ApiFilter(SearchFilter::class, properties={"id": "exact","track": "exact", "playlistId": "exact", "publication_date": "exact"})
 */
class TracksPlaylistUser
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=PlaylistUser::class, inversedBy="trackPlaylistUsers")
     */
    private $playlistId;

    /**
     * @ORM\ManyToOne(targetEntity=Track::class, inversedBy="tracksPlaylistUsers")
     */
    private $track;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $publicationDate;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlaylistId(): ?PlaylistUser
    {
        return $this->playlistId;
    }

    public function setPlaylistId(?PlaylistUser $playlistId): self
    {
        $this->playlistId = $playlistId;

        return $this;
    }

    public function getTrack(): ?Track
    {
        return $this->track;
    }

    public function setTrack(?Track $track): self
    {
        $this->track = $track;

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
