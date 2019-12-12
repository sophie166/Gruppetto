<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FriendRepository")
 */
class Friend
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ProfilSolo", mappedBy="friend")
     */
    private $profilSolos;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Chat", mappedBy="friend", cascade={"persist", "remove"})
     */
    private $chat;

    public function __construct()
    {
        $this->profilSolos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|ProfilSolo[]
     */
    public function getProfilSolos(): Collection
    {
        return $this->profilSolos;
    }

    public function addProfilSolo(ProfilSolo $profilSolo): self
    {
        if (!$this->profilSolos->contains($profilSolo)) {
            $this->profilSolos[] = $profilSolo;
            $profilSolo->addFriend($this);
        }

        return $this;
    }

    public function removeProfilSolo(ProfilSolo $profilSolo): self
    {
        if ($this->profilSolos->contains($profilSolo)) {
            $this->profilSolos->removeElement($profilSolo);
            $profilSolo->removeFriend($this);
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
        if ($chat->getFriend() !== $this) {
            $chat->setFriend($this);
        }

        return $this;
    }
}
