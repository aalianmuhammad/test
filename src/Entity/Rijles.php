<?php

namespace App\Entity;

use App\Repository\RijlesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RijlesRepository::class)]
class Rijles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datum = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $tijd = null;

    #[ORM\Column(length: 255)]
    private ?string $ophaal_locatie = null;

    #[ORM\Column(length: 255)]
    private ?string $lesdoel = null;

    #[ORM\Column(length: 255)]
    private ?string $annuleren = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $annuleer_reden = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $opmerkingen_instructeur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $opmerkingen_leerling = null;

    #[ORM\ManyToOne(inversedBy: 'rijles')]
    private ?User $Instructeur = null;

    #[ORM\ManyToOne(inversedBy: 'Rijles2')]
    private ?User $Klant = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatum(): ?\DateTimeInterface
    {
        return $this->datum;
    }

    public function setDatum(\DateTimeInterface $datum): self
    {
        $this->datum = $datum;

        return $this;
    }

    public function getTijd(): ?\DateTimeInterface
    {
        return $this->tijd;
    }

    public function setTijd(\DateTimeInterface $tijd): self
    {
        $this->tijd = $tijd;

        return $this;
    }

    public function getOphaalLocatie(): ?string
    {
        return $this->ophaal_locatie;
    }

    public function setOphaalLocatie(string $ophaal_locatie): self
    {
        $this->ophaal_locatie = $ophaal_locatie;

        return $this;
    }

    public function getLesdoel(): ?string
    {
        return $this->lesdoel;
    }

    public function setLesdoel(string $lesdoel): self
    {
        $this->lesdoel = $lesdoel;

        return $this;
    }

    public function getAnnuleren(): ?string
    {
        return $this->annuleren;
    }

    public function setAnnuleren(string $annuleren): self
    {
        $this->annuleren = $annuleren;

        return $this;
    }

    public function getAnnuleerReden(): ?string
    {
        return $this->annuleer_reden;
    }

    public function setAnnuleerReden(?string $annuleer_reden): self
    {
        $this->annuleer_reden = $annuleer_reden;

        return $this;
    }

    public function getOpmerkingenInstructeur(): ?string
    {
        return $this->opmerkingen_instructeur;
    }

    public function setOpmerkingenInstructeur(?string $opmerkingen_instructeur): self
    {
        $this->opmerkingen_instructeur = $opmerkingen_instructeur;

        return $this;
    }

    public function getOpmerkingenLeerling(): ?string
    {
        return $this->opmerkingen_leerling;
    }

    public function setOpmerkingenLeerling(?string $opmerkingen_leerling): self
    {
        $this->opmerkingen_leerling = $opmerkingen_leerling;

        return $this;
    }

    public function getInstructeur(): ?User
    {
        return $this->Instructeur;
    }

    public function setInstructeur(?User $Instructeur): self
    {
        $this->Instructeur = $Instructeur;

        return $this;
    }

    public function getKlant(): ?User
    {
        return $this->Klant;
    }

    public function setKlant(?User $Klant): self
    {
        $this->Klant = $Klant;

        return $this;
    }
}
