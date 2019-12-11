<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
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
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ProfilSolo", inversedBy="user", cascade={"persist", "remove"})
     */
    private $profilSolo;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ProfilClub", inversedBy="users")
     */
    private $profilClub;

    public function __construct()
    {
        $this->profilClub = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getProfilSolo(): ?ProfilSolo
    {
        return $this->profilSolo;
    }

    public function setProfilSolo(?ProfilSolo $profilSolo): self
    {
        $this->profilSolo = $profilSolo;

        return $this;
    }

    /**
     * @return Collection|ProfilClub[]
     */
    public function getProfilClub(): Collection
    {
        return $this->profilClub;
    }

    public function addProfilClub(ProfilClub $profilClub): self
    {
        if (!$this->profilClub->contains($profilClub)) {
            $this->profilClub[] = $profilClub;
        }

        return $this;
    }

    public function removeProfilClub(ProfilClub $profilClub): self
    {
        if ($this->profilClub->contains($profilClub)) {
            $this->profilClub->removeElement($profilClub);
        }

        return $this;
    }
}
