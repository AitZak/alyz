<?php

namespace App\Entity;

use App\Repository\ChartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChartRepository::class)
 */
class Chart
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=PlatformMusic::class, inversedBy="charts")
     */
    private $platformMusicId;

    /**
     * @ORM\ManyToMany(targetEntity=Country::class, inversedBy="charts")
     */
    private $countryId;

    /**
     * @ORM\OneToMany(targetEntity=TracksChart::class, mappedBy="chartId")
     */
    private $tracksCharts;

    public function __construct()
    {
        $this->countryId = new ArrayCollection();
        $this->tracksCharts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlatformMusicId(): ?PlatformMusic
    {
        return $this->platformMusicId;
    }

    public function setPlatformMusicId(?PlatformMusic $platformMusicId): self
    {
        $this->platformMusicId = $platformMusicId;

        return $this;
    }

    /**
     * @return Collection|Country[]
     */
    public function getCountryId(): Collection
    {
        return $this->countryId;
    }

    public function addCountryId(Country $countryId): self
    {
        if (!$this->countryId->contains($countryId)) {
            $this->countryId[] = $countryId;
        }

        return $this;
    }

    public function removeCountryId(Country $countryId): self
    {
        if ($this->countryId->contains($countryId)) {
            $this->countryId->removeElement($countryId);
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
            $tracksChart->setChartId($this);
        }

        return $this;
    }

    public function removeTracksChart(TracksChart $tracksChart): self
    {
        if ($this->tracksCharts->contains($tracksChart)) {
            $this->tracksCharts->removeElement($tracksChart);
            // set the owning side to null (unless already changed)
            if ($tracksChart->getChartId() === $this) {
                $tracksChart->setChartId(null);
            }
        }

        return $this;
    }
}
