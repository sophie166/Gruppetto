<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GeneralChatClubRepository")
 */
class GeneralChatClub
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateMessage;

    /**
     * @ORM\Column(type="text")
     */
    private $contentMessage;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ProfilClub", inversedBy="generalChatClub", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $profilClub;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ProfilSolo", inversedBy="generalChatClubs")
     */
    private $profilSolo;

    public function __construct()
    {
        $this->profilSolo = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateMessage(): ?\DateTimeInterface
    {
        return $this->dateMessage;
    }

    public function setDateMessage(\DateTimeInterface $dateMessage): self
    {
        $this->dateMessage = $dateMessage;

        return $this;
    }

    public function getContentMessage(): ?string
    {
        return $this->contentMessage;
    }

    public function setContentMessage(?string $contentMessage): self
    {
        $this->contentMessage = $contentMessage;

        return $this;
    }

    public function getProfilClub(): ?ProfilClub
    {
        return $this->profilClub;
    }

    public function setProfilClub(ProfilClub $profilClub): self
    {
        $this->profilClub = $profilClub;

        return $this;
    }

    /**
     * @return Collection|ProfilSolo[]
     */
    public function getProfilSolo(): Collection
    {
        return $this->profilSolo;
    }

    public function addProfilSolo(ProfilSolo $profilSolo): self
    {
        if (!$this->profilSolo->contains($profilSolo)) {
            $this->profilSolo[] = $profilSolo;
        }

        return $this;
    }

    public function removeProfilSolo(ProfilSolo $profilSolo): self
    {
        if ($this->profilSolo->contains($profilSolo)) {
            $this->profilSolo->removeElement($profilSolo);
        }

        return $this;
    }
}
