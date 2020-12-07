<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TrackRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass=TrackRepository::class)
 */
class Track
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $isrc;

    /**
     * @ORM\OneToMany(targetEntity=TracksPlaylistCurator::class, mappedBy="trackId")
     */
    private $tracksPlaylistCurators;

    /**
     * @ORM\OneToMany(targetEntity=TracksChart::class, mappedBy="trackId")
     */
    private $tracksCharts;

    /**
     * @ORM\OneToMany(targetEntity=Sing::class, mappedBy="trackId")
     */
    private $sings;

    /**
     * @ORM\OneToMany(targetEntity=TracksPlaylistUser::class, mappedBy="track")
     */
    private $tracksPlaylistUsers;


    public function __construct()
    {
        $this->tracksPlaylistCurators = new ArrayCollection();
        $this->tracksCharts = new ArrayCollection();
        $this->sings = new ArrayCollection();
        $this->tracksPlaylistUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getIsrc(): ?string
    {
        return $this->isrc;
    }

    public function setIsrc(string $isrc): self
    {
        $this->isrc = $isrc;

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
            $tracksPlaylistCurator->addTrackId($this);
        }

        return $this;
    }

    public function removeTracksPlaylistCurator(TracksPlaylistCurator $tracksPlaylistCurator): self
    {
        if ($this->tracksPlaylistCurators->contains($tracksPlaylistCurator)) {
            $this->tracksPlaylistCurators->removeElement($tracksPlaylistCurator);
            $tracksPlaylistCurator->removeTrackId($this);
        }

        return $this;
    }

    /**
     * @return Collection|TracksChart[]
     */
    public function getTracksCharts(): Collection
    {
        return $this->tracksCharts;
    }

    public function addTracksChart(TracksChart $tracksChart): self
    {
        if (!$this->tracksCharts->contains($tracksChart)) {
            $this->tracksCharts[] = $tracksChart;
            $tracksChart->setTrackId($this);
        }

        return $this;
    }

    public function removeTracksChart(TracksChart $tracksChart): self
    {
        if ($this->tracksCharts->contains($tracksChart)) {
            $this->tracksCharts->removeElement($tracksChart);
            // set the owning side to null (unless already changed)
            if ($tracksChart->getTrackId() === $this) {
                $tracksChart->setTrackId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Sing[]
     */
    public function getSings(): Collection
    {
        return $this->sings;
    }

    public function addSing(Sing $sing): self
    {
        if (!$this->sings->contains($sing)) {
            $this->sings[] = $sing;
            $sing->setTrackId($this);
        }

        return $this;
    }

    public function removeSing(Sing $sing): self
    {
        if ($this->sings->contains($sing)) {
            $this->sings->removeElement($sing);
            // set the owning side to null (unless already changed)
            if ($sing->getTrackId() === $this) {
                $sing->setTrackId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TracksPlaylistUser[]
     */
    public function getTracksPlaylistUsers(): Collection
    {
        return $this->tracksPlaylistUsers;
    }

    public function addTracksPlaylistUser(TracksPlaylistUser $tracksPlaylistUser): self
    {
        if (!$this->tracksPlaylistUsers->contains($tracksPlaylistUser)) {
            $this->tracksPlaylistUsers[] = $tracksPlaylistUser;
            $tracksPlaylistUser->setTrack($this);
        }

        return $this;
    }

    public function removeTracksPlaylistUser(TracksPlaylistUser $tracksPlaylistUser): self
    {
        if ($this->tracksPlaylistUsers->removeElement($tracksPlaylistUser)) {
            // set the owning side to null (unless already changed)
            if ($tracksPlaylistUser->getTrack() === $this) {
                $tracksPlaylistUser->setTrack(null);
            }
        }

        return $this;
    }

}
