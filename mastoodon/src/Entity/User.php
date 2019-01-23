<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use DateTimeInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 *  fields={"email"},
 *  message="This email is already used")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="8", minMessage="Your password is too short, 8 characters at least required")
     */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="password", message="Les champs 'Mot de passe' et 'Confirmation' doivent être égaux")
     */
    public $confirmpassword;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ballotsNumber = 600;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastClaim;


    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isAdmin;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Collection", mappedBy="userid", orphanRemoval=true)
     */
    private $collections;

    private $power;

    private $rank = "Novice";
    

    public function __construct()
    {
        $this->collections = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

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

    public function getBallotsNumber(): ?int
    {
        return $this->ballotsNumber;
    }

    public function setBallotsNumber(?int $ballotsNumber): self
    {
        $this->ballotsNumber = $ballotsNumber;

        return $this;
    }

    public function getLastClaim(): ?\DateTimeInterface
    {
        return $this->lastClaim;
    }

    public function setLastClaim(?\DateTimeInterface $lastClaim): self
    {
        $this->lastClaim = $lastClaim;

        return $this;
    }


    public function getIsAdmin(): ?bool
    {
        return $this->isAdmin;
    }

    public function setIsAdmin(?bool $isAdmin): self
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }


    //Override UserInterface methods
    public function eraseCredentials() {}

    public function getSalt() {}

    public function getRoles() {
        
        if ($this->getIsAdmin() == 1) {
            return ['ROLE_ADMIN', 'ROLE_USER'];
        }
        else {
            return ['ROLE_USER'];
        }  
    }

    public function getUsername() {
        return $this->email;
    }

    /**
     * @return Collection|Collection[]
     */
    public function getCollections(): Collection
    {
        return $this->collections;
    }

    public function addCollection(Collection $collection): self
    {
        if (!$this->collections->contains($collection)) {
            $this->collections[] = $collection;
            $collection->setUserid($this);
        }

        return $this;
    }

    public function removeCollection(Collection $collection): self
    {
        if ($this->collections->contains($collection)) {
            $this->collections->removeElement($collection);
            // set the owning side to null (unless already changed)
            if ($collection->getUserid() === $this) {
                $collection->setUserid(null);
            }
        }

        return $this;
    }


    //Calculate Power
    public function getPower()
    {
        $power = 0;
        $collections = $this->getCollections();

        //Add Value of rarity of each card to power
        foreach ($collections as $collection) {
            $power += (int)$collection->getPoliticid()->getRarity();
        }
        return $power;
    }


    //Define Rank
    public function getRank()
    {
        $power = $this->getPower();

        //Check different ranks depending on power
        if ($power < 15)
        {
            $rank = "Novice";
        }  
        else if ($power >= 15 && $power < 30)
        {
            $rank = "Confirmé";
        }
        else if ($power >= 30 && $power < 50)
        {
            $rank = "Expert Politique";
        }
        else if ($power >= 50 && $power < 100)
        {
            $rank = "Vice Président";
        }
        else if ($power >= 100)
        {
            $rank = "Président";
        }
        return $rank;
    }
}
