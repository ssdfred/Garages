<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;


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

    /**
     * @Assert\Type("\DateTime")
     * @Assert\DateTime(format="d-M-Y)
     */
    #[ORM\Column(Types::STRING)]
    private ?\DateTime $date = null;


    #[ORM\Column]
    private ?\DateTime $reservation_heure = null;

    /**
     * @return DateTime|null
     */
    public function getReservationHeure(): ?DateTime
    {
        return $this->reservation_heure;

    }


    public function setReservationHeure(?DateTime $reservation_heure): self
    {
        $this->reservation_heure = $reservation_heure;
        return $this;
    }


    #[ORM\Column(length: 255, nullable: true)]
    private ?string $allergie = null;


    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }


    /**
     *
     * @return \DateTime|null
     */
    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    /**
     *
     * @param string  $date
     * @return self
     */
    public function setDate(?\DateTime $date): self
    {
        $this->date = $date;
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
