<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TracksChartRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass=TracksChartRepository::class)
 */
class TracksChart
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Track::class, inversedBy="tracksCharts")
     */
    private $trackId;

    /**
     * @ORM\ManyToOne(targetEntity=Chart::class, inversedBy="tracksCharts")
     */
    private $chartId;

    /**
     * @ORM\Column(type="integer")
     */
    private $position;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $publication_date;


    public function getId(): ?int
    {
        return $this->id;
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

    public function getChartId(): ?Chart
    {
        return $this->chartId;
    }

    public function setChartId(?Chart $chartId): self
    {
        $this->chartId = $chartId;

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

    public function getPublicationDate(): ?string
    {
        return $this->publication_date;
    }

    public function setPublicationDate(?string $publication_date): self
    {
        $this->publication_date = $publication_date;

        return $this;
    }


}
