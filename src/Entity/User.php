<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $voornaam = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tussenvoegsel = null;

    #[ORM\Column(length: 255)]
    private ?string $achternaam = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adres = null;

    #[ORM\Column(length: 255)]
    private ?string $woonplaats = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $postcode = null;

    #[ORM\OneToMany(mappedBy: 'User', targetEntity: Mededelingen::class)]
    private Collection $mededelingens;

    #[ORM\OneToMany(mappedBy: 'Instructeur', targetEntity: Rijles::class)]
    private Collection $rijles;

    #[ORM\OneToMany(mappedBy: 'Klant', targetEntity: Rijles::class)]
    private Collection $Rijles2;

    public function __construct()
    {
        $this->mededelingens = new ArrayCollection();
        $this->rijles = new ArrayCollection();
        $this->Rijles2 = new ArrayCollection();
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getVoornaam(): ?string
    {
        return $this->voornaam;
    }

    public function setVoornaam(string $voornaam): self
    {
        $this->voornaam = $voornaam;

        return $this;
    }

    public function getTussenvoegsel(): ?string
    {
        return $this->tussenvoegsel;
    }

    public function setTussenvoegsel(?string $tussenvoegsel): self
    {
        $this->tussenvoegsel = $tussenvoegsel;

        return $this;
    }

    public function getAchternaam(): ?string
    {
        return $this->achternaam;
    }

    public function setAchternaam(string $achternaam): self
    {
        $this->achternaam = $achternaam;

        return $this;
    }

    public function getAdres(): ?string
    {
        return $this->adres;
    }

    public function setAdres(?string $adres): self
    {
        $this->adres = $adres;

        return $this;
    }

    public function getWoonplaats(): ?string
    {
        return $this->woonplaats;
    }

    public function setWoonplaats(string $woonplaats): self
    {
        $this->woonplaats = $woonplaats;

        return $this;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(?string $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * @return Collection<int, Mededelingen>
     */
    public function getMededelingens(): Collection
    {
        return $this->mededelingens;
    }

    public function addMededelingen(Mededelingen $mededelingen): self
    {
        if (!$this->mededelingens->contains($mededelingen)) {
            $this->mededelingens->add($mededelingen);
            $mededelingen->setUser($this);
        }

        return $this;
    }

    public function removeMededelingen(Mededelingen $mededelingen): self
    {
        if ($this->mededelingens->removeElement($mededelingen)) {
            // set the owning side to null (unless already changed)
            if ($mededelingen->getUser() === $this) {
                $mededelingen->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Rijles>
     */
    public function getRijles(): Collection
    {
        return $this->rijles;
    }

    public function addRijle(Rijles $rijle): self
    {
        if (!$this->rijles->contains($rijle)) {
            $this->rijles->add($rijle);
            $rijle->setInstructeur($this);
        }

        return $this;
    }

    public function removeRijle(Rijles $rijle): self
    {
        if ($this->rijles->removeElement($rijle)) {
            // set the owning side to null (unless already changed)
            if ($rijle->getInstructeur() === $this) {
                $rijle->setInstructeur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Rijles>
     */
    public function getRijles2(): Collection
    {
        return $this->Rijles2;
    }

    public function addRijles2(Rijles $rijles2): self
    {
        if (!$this->Rijles2->contains($rijles2)) {
            $this->Rijles2->add($rijles2);
            $rijles2->setKlant($this);
        }

        return $this;
    }

    public function removeRijles2(Rijles $rijles2): self
    {
        if ($this->Rijles2->removeElement($rijles2)) {
            // set the owning side to null (unless already changed)
            if ($rijles2->getKlant() === $this) {
                $rijles2->setKlant(null);
            }
        }

        return $this;
    }
}
