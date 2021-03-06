<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use App\Repository\PlatformMusicRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;


/**
 * @ApiResource
 * @ORM\Entity(repositoryClass=PlatformMusicRepository::class)
 * @ApiFilter(SearchFilter::class, properties={"id": "exact","name": "partial"})
 */
class PlatformMusic
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
     * @ORM\OneToMany(targetEntity=Curator::class, mappedBy="platformMusicId")
     */
    private $curators;

    /**
     * @ORM\OneToMany(targetEntity=Chart::class, mappedBy="platformMusicId")
     */
    private $charts;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="subscribedPlatforms")
     */
    private $subscriber;

    public function __construct()
    {
        $this->curators = new ArrayCollection();
        $this->charts = new ArrayCollection();
        $this->subscriber = new ArrayCollection();
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

    /**
     * @return Collection|Curator[]
     */
    public function getCurators(): Collection
    {
        return $this->curators;
    }

    public function addCurator(Curator $curator): self
    {
        if (!$this->curators->contains($curator)) {
            $this->curators[] = $curator;
            $curator->setPlatformMusicId($this);
        }

        return $this;
    }

    public function removeCurator(Curator $curator): self
    {
        if ($this->curators->contains($curator)) {
            $this->curators->removeElement($curator);
            // set the owning side to null (unless already changed)
            if ($curator->getPlatformMusicId() === $this) {
                $curator->setPlatformMusicId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Chart[]
     */
    public function getCharts(): Collection
    {
        return $this->charts;
    }

    public function addChart(Chart $chart): self
    {
        if (!$this->charts->contains($chart)) {
            $this->charts[] = $chart;
            $chart->setPlatformMusicId($this);
        }

        return $this;
    }

    public function removeChart(Chart $chart): self
    {
        if ($this->charts->contains($chart)) {
            $this->charts->removeElement($chart);
            // set the owning side to null (unless already changed)
            if ($chart->getPlatformMusicId() === $this) {
                $chart->setPlatformMusicId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|user[]
     */
    public function getSubscriber(): Collection
    {
        return $this->subscriber;
    }

    public function addSubscriber(User $subscriber): self
    {
        if (!$this->subscriber->contains($subscriber)) {
            $this->subscriber[] = $subscriber;
        }

        return $this;
    }

    public function removeSubscriber(User $subscriber): self
    {
        $this->subscriber->removeElement($subscriber);

        return $this;
    }
}
