<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProfilSoloRepository")
 */
class ProfilSolo
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
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="date")
     */
    private $birthdate;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $avatar;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $emergencyContactName;

    /**
     * @ORM\Column(type="integer")
     */
    private $level;

    /**
     * @ORM\Column(type="integer")
     */
    private $sportFrequency;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $emergencyPhone;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="profilSolo")
     */
    private $comments;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Sport", inversedBy="profilSolos")
     */
    private $sport;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Friend", inversedBy="profilSolos")
     */
    private $friend;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Chat", mappedBy="profilSolo", cascade={"persist", "remove"})
     */
    private $chat;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\PrivateChatClub", mappedBy="profilSolo", cascade={"persist", "remove"})
     */
    private $privateChatClub;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", mappedBy="profilSolo", cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Event", mappedBy="createurSolo")
     */
    private $events;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Event", mappedBy="profilSolo")
     */
    private $eventParticipants;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\GeneralChatClub", mappedBy="profilSolo")
     */
    private $generalChatClub;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->sport = new ArrayCollection();
        $this->friend = new ArrayCollection();
        $this->generalChatClubs = new ArrayCollection();
        $this->events = new ArrayCollection();
        $this->eventParticipants = new ArrayCollection();
        $this->generalChatClub = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

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

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getEmergencyContactName(): ?string
    {
        return $this->emergencyContactName;
    }

    public function setEmergencyContactName(?string $emergencyContactName): self
    {
        $this->emergencyContactName = $emergencyContactName;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getSportFrequency(): ?int
    {
        return $this->sportFrequency;
    }

    public function setSportFrequency(int $sportFrequency): self
    {
        $this->sportFrequency = $sportFrequency;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(?int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmergencyPhone(): ?int
    {
        return $this->emergencyPhone;
    }

    public function setEmergencyPhone(?int $emergencyPhone): self
    {
        $this->emergencyPhone = $emergencyPhone;

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
            $comment->setProfilSolo($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getProfilSolo() === $this) {
                $comment->setProfilSolo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Sport[]
     */
    public function getSport(): Collection
    {
        return $this->sport;
    }

    public function addSport(Sport $sport): self
    {
        if (!$this->sport->contains($sport)) {
            $this->sport[] = $sport;
        }

        return $this;
    }

    public function removeSport(Sport $sport): self
    {
        if ($this->sport->contains($sport)) {
            $this->sport->removeElement($sport);
        }

        return $this;
    }

    /**
     * @return Collection|Friend[]
     */
    public function getFriend(): Collection
    {
        return $this->friend;
    }

    public function addFriend(Friend $friend): self
    {
        if (!$this->friend->contains($friend)) {
            $this->friend[] = $friend;
        }

        return $this;
    }

    public function removeFriend(Friend $friend): self
    {
        if ($this->friend->contains($friend)) {
            $this->friend->removeElement($friend);
        }

        return $this;
    }

    public function getChat(): ?Chat
    {
        return $this->chat;
    }

    public function setChat(Chat $chat): self
    {
        $this->chat = $chat;

        // set the owning side of the relation if necessary
        if ($chat->getProfilSolo() !== $this) {
            $chat->setProfilSolo($this);
        }

        return $this;
    }

    public function getPrivateChatClub(): ?PrivateChatClub
    {
        return $this->privateChatClub;
    }

    public function setPrivateChatClub(PrivateChatClub $privateChatClub): self
    {
        $this->privateChatClub = $privateChatClub;

        // set the owning side of the relation if necessary
        if ($privateChatClub->getProfilSolo() !== $this) {
            $privateChatClub->setProfilSolo($this);
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        //Erreur: Cannot call method getProfilSolo() on App\Entity\User|null.
        //Erreur: Cannot call method setProfilSolo() on App\Entity\User|null.

        // set (or unset) the owning side of the relation if necessary
        //$newProfilSolo = null === $user ? null : $this;
        //if ($user->getProfilSolo() !== $newProfilSolo) {
        //$user->setProfilSolo($newProfilSolo);
        //}

        return $this;
    }

    /**
     * @return Collection|Event[]
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
            $event->setCreateurSolo($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->contains($event)) {
            $this->events->removeElement($event);
            // set the owning side to null (unless already changed)
            if ($event->getCreateurSolo() === $this) {
                $event->setCreateurSolo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Event[]
     */
    public function getEventParticipants(): Collection
    {
        return $this->eventParticipants;
    }

    public function addEventParticipant(Event $eventParticipant): self
    {
        if (!$this->eventParticipants->contains($eventParticipant)) {
            $this->eventParticipants[] = $eventParticipant;
            $eventParticipant->addProfilSolo($this);
        }

        return $this;
    }

    public function removeEventParticipant(Event $eventParticipant): self
    {
        if ($this->eventParticipants->contains($eventParticipant)) {
            $this->eventParticipants->removeElement($eventParticipant);
            $eventParticipant->removeProfilSolo($this);
        }

        return $this;
    }

    /**
     * @return Collection|GeneralChatClub[]
     */
    public function getGeneralChatClub(): Collection
    {
        return $this->generalChatClub;
    }

    public function addGeneralChatClub(GeneralChatClub $generalChatClub): self
    {
        if (!$this->generalChatClub->contains($generalChatClub)) {
            $this->generalChatClub[] = $generalChatClub;
            $generalChatClub->setProfilSolo($this);
        }

        return $this;
    }

    public function removeGeneralChatClub(GeneralChatClub $generalChatClub): self
    {
        if ($this->generalChatClub->contains($generalChatClub)) {
            $this->generalChatClub->removeElement($generalChatClub);
            // set the owning side to null (unless already changed)
            if ($generalChatClub->getProfilSolo() === $this) {
                $generalChatClub->setProfilSolo(null);
            }
        }

        return $this;
    }
}
