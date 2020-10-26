<?php

namespace App\Entity;

use App\Repository\TracksPlaylistUserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TracksPlaylistUserRepository::class)
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
}
