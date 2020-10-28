<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PlaylistUserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass=PlaylistUserRepository::class)
 */
class PlaylistUser
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
     * @ORM\Column(type="integer")
     */
    private $idInPlatform;

    /**
     * @ORM\OneToMany(targetEntity=TracksPlaylistUser::class, mappedBy="playlistId")
     */
    private $trackPlaylistUsers;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="playlistUsers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userId;

    public function __construct()
    {
        $this->trackPlaylistUsers = new ArrayCollection();
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

    public function getIdInPlatform(): ?int
    {
        return $this->idInPlatform;
    }

    public function setIdInPlatform(int $idInPlatform): self
    {
        $this->idInPlatform = $idInPlatform;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(?User $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @return Collection|TracksPlaylistUser[]
     */
    public function getTracksPlaylistUsers(): Collection
    {
        return $this->trackPlaylistUsers;
    }

    public function addTracksPlaylistUser(TracksPlaylistUser $trackPlaylistUser): self
    {
        if (!$this->trackPlaylistUsers->contains($trackPlaylistUser)) {
            $this->trackPlaylistUsers[] = $trackPlaylistUser;
            $trackPlaylistUser->setPlaylistId($this);
        }

        return $this;
    }

    public function removeTracksPlaylistUser(TracksPlaylistUser $trackPlaylistUser): self
    {
        if ($this->trackPlaylistUsers->contains($trackPlaylistUser)) {
            $this->trackPlaylistUsers->removeElement($trackPlaylistUser);
            // set the owning side to null (unless already changed)
            if ($trackPlaylistUser->getPlaylistId() === $this) {
                $trackPlaylistUser->setPlaylistId(null);
            }
        }

        return $this;
    }
}
