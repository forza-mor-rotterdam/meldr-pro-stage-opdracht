<?php

namespace App\Entity;

use App\Repository\MeldingRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MeldingRepository::class)]
class Melding
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    public ?int $melding_id = null;

    #[ORM\Column]
    public ?int $user_id = null;

    #[ORM\Column(length: 255)]
    public ?string $type_melding = null;

    #[ORM\Column(type: Types::TEXT)]
    public ?string $inhoud = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    public ?\DateTimeInterface $datum_tijd = null;

    // Getter and setter for melding_id
    public function getMeldingId(): ?int
    {
        return $this->melding_id;
    }

    public function setMeldingId(int $melding_id): self
    {
        $this->melding_id = $melding_id;

        return $this;
    }

    // Getter and setter for user_id
    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    // Getter and setter for type_melding
    public function getTypeMelding(): ?string
    {
        return $this->type_melding;
    }

    public function setTypeMelding(string $type_melding): self
    {
        $this->type_melding = $type_melding;

        return $this;
    }

    // Getter and setter for inhoud
    public function getInhoud(): ?string
    {
        return $this->inhoud;
    }

    public function setInhoud(string $inhoud): self
    {
        $this->inhoud = $inhoud;

        return $this;
    }

    // Getter and setter for datum_tijd
    public function getDatumTijd(): ?\DateTimeInterface
    {
        return $this->datum_tijd;
    }

    public function setDatumTijd(\DateTimeInterface $datum_tijd): self
    {
        $this->datum_tijd = $datum_tijd;

        return $this;
    }
}
