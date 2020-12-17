<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *  normalizationContext = {"groups"= {"users_read"}}
 * )
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"users_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"users_read"})
     * @Assert\NotBlank(message = "L'email est obligatoire")
     * @Assert\Email(message="Le format n'est pas valide")
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     * @Groups({"users_read"})
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"users_read"})
     * @Assert\NotBlank(message = "Le nom de famille est obligatoire")
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"users_read"})
     * @Assert\NotBlank(message = "Le prénom est obligatoire")
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message = "Le mot de passe est obligatoire")
     * @Assert\Length(
     *      min = 6,
     *      max = 16,
     *      minMessage = "Votre mot de passe doit avoir au moins {{ limit }} caractères long",
     *      maxMessage = "Votre mot de passe ne peut pas excéder {{ limit }} 16"
     * )
     */
    private $password;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"users_read"})
     */
    private $created_at;

    /**
     * @ORM\OneToMany(targetEntity=PlaylistUser::class, mappedBy="userId", orphanRemoval=true)
     */
    private $playlistUsers;

    /**
     * @ORM\ManyToMany(targetEntity=Artist::class, mappedBy="follower")
     */
    private $followed_artist;

    /**
     * @ORM\ManyToMany(targetEntity=PlatformMusic::class, mappedBy="subscriber")
     */
    private $subscribedPlatforms;

    public function __construct()
    {
        $this->roles = array('ROLE_USER');
        $this->created_at = new \DateTime('now');
        
        $this->playlistUsers = new ArrayCollection();
        $this->followed_artist = new ArrayCollection();
        $this->subscribedPlatforms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed for apps that do not check user passwords
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

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
        if ($this->playlistUsers->removeElement($playlistUser)) {
            // set the owning side to null (unless already changed)
            if ($playlistUser->getUserId() === $this) {
                $playlistUser->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Artist[]
     */
    public function getFollowedArtist(): Collection
    {
        return $this->followed_artist;
    }

    public function addFollowedArtist(Artist $followedArtist): self
    {
        if (!$this->followed_artist->contains($followedArtist)) {
            $this->followed_artist[] = $followedArtist;
            $followedArtist->addFollower($this);
        }

        return $this;
    }

    public function removeFollowedArtist(Artist $followedArtist): self
    {
        if ($this->followed_artist->removeElement($followedArtist)) {
            $followedArtist->removeFollower($this);
        }

        return $this;
    }

    /**
     * @return Collection|PlatformMusic[]
     */
    public function getSubscribedPlatforms(): Collection
    {
        return $this->subscribedPlatforms;
    }

    public function addSubscribedPlatform(PlatformMusic $subscribedPlatform): self
    {
        if (!$this->subscribedPlatforms->contains($subscribedPlatform)) {
            $this->subscribedPlatforms[] = $subscribedPlatform;
            $subscribedPlatform->addSubscriber($this);
        }

        return $this;
    }

    public function removeSubscribedPlatform(PlatformMusic $subscribedPlatform): self
    {
        if ($this->subscribedPlatforms->removeElement($subscribedPlatform)) {
            $subscribedPlatform->removeSubscriber($this);
        }

        return $this;
    }
}
