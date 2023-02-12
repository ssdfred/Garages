<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;



    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $nb_personnes = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?Date $date = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?Date $reservation_heure = null;

    /**
     * @return \DateTimeInterface|null
     */
    public function getReservationHeure(): ?\DateTimeInterface
    {
        return $this->reservation_heure;
    }

    /**
     * @param \DateTimeInterface|null $reservation_heure
     */
    public function setReservationHeure(?\DateTimeInterface $reservation_heure): void
    {
        $this->reservation_heure = $reservation_heure;
    }

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $allergie = null;

    public function __construct()
    {
        $this->name = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }



    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getNbPersonnes(): ?int
    {
        return $this->nb_personnes;
    }

    public function setNbPersonnes(int $nb_personnes): self
    {
        $this->nb_personnes = $nb_personnes;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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
