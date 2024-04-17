<?php

namespace App\Entity;

use App\Repository\MeldingRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MeldingRepository::class)]
class Melding
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public ?int $id = null;

    #[ORM\Column]
    public ?int $melding_id = null;

    #[ORM\Column]
    public ?int $user_id = null;

    #[ORM\Column(length: 255)]
    public ?string $type_melding = null;

    #[ORM\Column(type: Types::TEXT)]
    public ?string $inhoud = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    public ?\DateTimeInterface $datum_tijd = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMeldingId(): ?int
    {
        return $this->melding_id;
    }

    public function setMeldingId(int $melding_id): static
    {
        $this->melding_id = $melding_id;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getTypeMelding(): ?string
    {
        return $this->type_melding;
    }

    public function setTypeMelding(string $type_melding): static
    {
        $this->type_melding = $type_melding;

        return $this;
    }

    public function getInhoud(): ?string
    {
        return $this->inhoud;
    }

    public function setInhoud(string $inhoud): static
    {
        $this->inhoud = $inhoud;

        return $this;
    }

    public function getDatumTijd(): ?\DateTimeInterface
    {
        return $this->datum_tijd;
    }

    public function setDatumTijd(\DateTimeInterface $datum_tijd): static
    {
        $this->datum_tijd = $datum_tijd;

        return $this;
    }
}
