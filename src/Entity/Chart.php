<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ChartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiFilter;


/**
 * @ApiResource
 * @ORM\Entity(repositoryClass=ChartRepository::class)
 * @ApiFilter(SearchFilter::class, properties={"id": "exact","name": "partial", "countryId", "platformMusicId": "exact"})
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
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=PlatformMusic::class, inversedBy="charts")
     */
    private $platformMusicId;

    /**
     * @ORM\ManyToOne(targetEntity=Country::class, inversedBy="charts")
     */
    private $countryId;

    /**
     * @ORM\OneToMany(targetEntity=TracksChart::class, mappedBy="chartId")
     */
    private $tracksCharts;

    public function __construct()
    {
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCountryId(): ?Country
    {
        return $this->countryId;
    }

    public function setCountryId(?Country $countryId): self
    {
        $this->countryId = $countryId;

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
