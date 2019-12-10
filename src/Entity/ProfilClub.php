<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProfilClubRepository")
 */
class ProfilClub
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nameClub;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cityClub;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $logoClub;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionClub;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameClub(): ?string
    {
        return $this->nameClub;
    }

    public function setNameClub(string $nameClub): self
    {
        $this->nameClub = $nameClub;

        return $this;
    }

    public function getCityClub(): ?string
    {
        return $this->cityClub;
    }

    public function setCityClub(string $cityClub): self
    {
        $this->cityClub = $cityClub;

        return $this;
    }

    public function getLogoClub(): ?string
    {
        return $this->logoClub;
    }

    public function setLogoClub(string $logoClub): self
    {
        $this->logoClub = $logoClub;

        return $this;
    }

    public function getDescriptionClub(): ?string
    {
        return $this->descriptionClub;
    }

    public function setDescriptionClub(?string $descriptionClub): self
    {
        $this->descriptionClub = $descriptionClub;

        return $this;
    }
}
