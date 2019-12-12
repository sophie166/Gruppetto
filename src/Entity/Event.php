<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 */
class Event
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
    private $nameEvent;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $levelEvent;

    /**
     * @ORM\Column(type="date")
     */
    private $dateEvent;

    /**
     * @ORM\Column(type="time")
     */
    private $timeEvent;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $participantLimit;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $placeEvent;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Sport", inversedBy="events")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sport;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="event")
     */
    private $comments;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\profilSolo", inversedBy="events")
     */
    private $createurSolo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ProfilClub", inversedBy="events")
     */
    private $createurClub;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ProfilSolo", inversedBy="eventParticipants")
     */
    private $profilSolo;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->profilSolo = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameEvent(): ?string
    {
        return $this->nameEvent;
    }

    public function setNameEvent(string $nameEvent): self
    {
        $this->nameEvent = $nameEvent;

        return $this;
    }

    public function getLevelEvent(): ?int
    {
        return $this->levelEvent;
    }

    public function setLevelEvent(?int $levelEvent): self
    {
        $this->levelEvent = $levelEvent;

        return $this;
    }

    public function getDateEvent(): ?\DateTimeInterface
    {
        return $this->dateEvent;
    }

    public function setDateEvent(\DateTimeInterface $dateEvent): self
    {
        $this->dateEvent = $dateEvent;

        return $this;
    }

    public function getTimeEvent(): ?\DateTimeInterface
    {
        return $this->timeEvent;
    }

    public function setTimeEvent(\DateTimeInterface $timeEvent): self
    {
        $this->timeEvent = $timeEvent;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getParticipantLimit(): ?int
    {
        return $this->participantLimit;
    }

    public function setParticipantLimit(int $participantLimit): self
    {
        $this->participantLimit = $participantLimit;

        return $this;
    }

    public function getPlaceEvent(): ?string
    {
        return $this->placeEvent;
    }

    public function setPlaceEvent(string $placeEvent): self
    {
        $this->placeEvent = $placeEvent;

        return $this;
    }

    public function getSport(): ?Sport
    {
        return $this->sport;
    }

    public function setSport(?Sport $sport): self
    {
        $this->sport = $sport;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setEvent($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getEvent() === $this) {
                $comment->setEvent(null);
            }
        }

        return $this;
    }

    public function getCreateurSolo(): ?profilSolo
    {
        return $this->createurSolo;
    }

    public function setCreateurSolo(?profilSolo $createurSolo): self
    {
        $this->createurSolo = $createurSolo;

        return $this;
    }

    public function getCreateurClub(): ?ProfilClub
    {
        return $this->createurClub;
    }

    public function setCreateurClub(?ProfilClub $createurClub): self
    {
        $this->createurClub = $createurClub;

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
