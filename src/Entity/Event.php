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
     * @ORM\ManyToOne(targetEntity="App\Entity\ProfilSolo", inversedBy="events")
     */
    private $creatorSolo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ProfilClub", inversedBy="events")
     */
    private $creatorClub;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RegistrationEvent", mappedBy="event")
     */
    private $registrationEvent;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Booking", mappedBy="events")
     */
    private $bookings;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->registrationEvent = new ArrayCollection();
        $this->bookings = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNameEvent()
    {
        return $this->nameEvent;
    }

    public function setNameEvent(string $nameEvent)
    {
        $this->nameEvent = $nameEvent;

        return $this;
    }

    public function getLevelEvent()
    {
        return $this->levelEvent;
    }

    public function setLevelEvent(?int $levelEvent)
    {
        $this->levelEvent = $levelEvent;

        return $this;
    }

    public function getDateEvent()
    {
        return $this->dateEvent;
    }

    public function setDateEvent(\DateTimeInterface $dateEvent)
    {
        $this->dateEvent = $dateEvent;

        return $this;
    }

    public function getTimeEvent()
    {
        return $this->timeEvent;
    }

    public function setTimeEvent(\DateTimeInterface $timeEvent)
    {
        $this->timeEvent = $timeEvent;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription(?string $description)
    {
        $this->description = $description;

        return $this;
    }

    public function getParticipantLimit()
    {
        return $this->participantLimit;
    }

    public function setParticipantLimit(int $participantLimit)
    {
        $this->participantLimit = $participantLimit;

        return $this;
    }

    public function getPlaceEvent()
    {
        return $this->placeEvent;
    }

    public function setPlaceEvent(string $placeEvent)
    {
        $this->placeEvent = $placeEvent;

        return $this;
    }

    public function getSport()
    {
        return $this->sport;
    }

    public function setSport(?Sport $sport)
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

    public function addComment(Comment $comment)
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setEvent($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment)
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

    public function getCreatorSolo()
    {
        return $this->creatorSolo;
    }

    public function setCreatorSolo(?ProfilSolo $creatorSolo)
    {
        $this->creatorSolo = $creatorSolo;

        return $this;
    }

    public function getCreatorClub(): ?ProfilClub
    {
        return $this->creatorClub;
    }

    public function setCreatorClub(?ProfilClub $creatorClub)
    {
        $this->creatorClub = $creatorClub;

        return $this;
    }

    /**
     * @return Collection|RegistrationEvent[]
     */
    public function getRegistrationEvent(): Collection
    {
        return $this->registrationEvent;
    }

    public function addRegistrationEvent(RegistrationEvent $registrationEvent)
    {
        if (!$this->registrationEvent->contains($registrationEvent)) {
            $this->registrationEvent[] = $registrationEvent;
            $registrationEvent->setEvent($this);
        }

        return $this;
    }

    public function removeRegistrationEvent(RegistrationEvent $registrationEvent)
    {
        if ($this->registrationEvent->contains($registrationEvent)) {
            $this->registrationEvent->removeElement($registrationEvent);
            // set the owning side to null (unless already changed)
            if ($registrationEvent->getEvent() === $this) {
                $registrationEvent->setEvent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Booking[]
     */
    public function getBooking(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Booking $booking)
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings[] = $booking;
            $booking->addEvent($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking)
    {
        if ($this->bookings->contains($booking)) {
            $this->bookings->removeElement($booking);
            $booking->removeEvent($this);
        }

        return $this;
    }
}
