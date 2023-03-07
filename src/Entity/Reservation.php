<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: 'integer')]
    private ?int $nb_personnes = null;

    /**
     * @Assert\NotNull()
     * @Assert\Type("\DateTimeInterface")
     * @ORM\Column(type: 'datetime')
     */
    private ?DateTime $date = null;

    /**
     * @Assert\NotNull()
     * @Assert\Type("\DateTimeInterface")
     * @ORM\Column(type: 'datetime')
     */
    private ?DateTime $reservation_heure = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $allergie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getNbPersonnes(): ?int
    {
        return $this->nb_personnes;
    }

    public function setNbPersonnes(?int $nb_personnes): self
    {
        $this->nb_personnes = $nb_personnes;

        return $this;
    }

    public function getDate(): ?DateTime
    {
        return $this->date;
    }

    public function setDate(?DateTime $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getReservationHeure(): ?DateTime
    {
        return $this->reservation_heure;
    }

    public function setReservationHeure(?DateTime $reservation_heure): self
    {
        $this->reservation_heure = $reservation_heure;

        return $this;
    }

    public function getAllergie(): ?string
    {
        return $this->allergie;
    }

    public function setAllergie(?string $allergie): self
    {
        $this->allergie = $allergie;

        return $this;
    }
}
