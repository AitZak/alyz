<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User
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
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity=PlaylistUser::class, mappedBy="userId")
     */
    private $playlistUsers;

    public function __construct()
    {
        $this->playlistUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection|PlaylistUser[]
     */
    public function getPlaylistUsers(): Collection
    {
        return $this->playlistUsers;
    }

    public function addPlaylistUser(PlaylistUser $playlistUser): self
    {
        if (!$this->playlistUsers->contains($playlistUser)) {
            $this->playlistUsers[] = $playlistUser;
            $playlistUser->setUserId($this);
        }

        return $this;
    }

    public function removePlaylistUser(PlaylistUser $playlistUser): self
    {
        if ($this->playlistUsers->contains($playlistUser)) {
            $this->playlistUsers->removeElement($playlistUser);
            // set the owning side to null (unless already changed)
            if ($playlistUser->getUserId() === $this) {
                $playlistUser->setUserId(null);
            }
        }

        return $this;
    }
}
