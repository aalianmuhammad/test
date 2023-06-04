<?php

namespace App\Entity;

use App\Repository\ZiekmeldingRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ZiekmeldingRepository::class)]
class Ziekmelding
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datum_ziek = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $datum_beter = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatumZiek(): ?\DateTimeInterface
    {
        return $this->datum_ziek;
    }

    public function setDatumZiek(\DateTimeInterface $datum_ziek): self
    {
        $this->datum_ziek = $datum_ziek;

        return $this;
    }

    public function getDatumBeter(): ?\DateTimeInterface
    {
        return $this->datum_beter;
    }

    public function setDatumBeter(?\DateTimeInterface $datum_beter): self
    {
        $this->datum_beter = $datum_beter;

        return $this;
    }
}
