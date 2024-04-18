<?php

namespace App\Entity;

use App\Repository\MeldingRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MeldingRepository::class)]
class Melding
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    public ?int $melding_id = null;

    #[ORM\ManyToOne(targetEntity: AppUser::class)]
    #[ORM\JoinColumn(name:"user_id")]
    public ?AppUser $user = null;

    #[ORM\Column(length: 255)]
    public ?string $type_melding = null;

    #[ORM\Column(type: 'text')]
    public ?string $inhoud = null;

    #[ORM\Column(type: 'datetime')]
    public ?\DateTimeInterface $datum_tijd = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Url]
    public ?string $afbeelding_url = null;

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
    public function getUser(): AppUser
    {
        return $this->user;
    }

    public function setUser(AppUser $user): self
    {
        $this->user = $user;

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

    // Getter and setter for afbeelding_url
    public function getAfbeeldingUrl(): ?string
    {
        return $this->afbeelding_url;
    }

    public function setAfbeeldingUrl(?string $afbeelding_url): self
    {
        $this->afbeelding_url = $afbeelding_url;

        return $this;
    }
}
