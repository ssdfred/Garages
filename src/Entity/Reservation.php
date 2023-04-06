<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
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

    #[ORM\Column(type: 'integer')]
    private ?int $place_restante = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTime $date = null;

    #[ORM\Column(type: 'time')]
    #[Assert\NotBlank]
    #[Assert\Time]
    private  ?\DateTime $reservation_heure;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $allergie = null;

    #[ORM\ManyToOne(targetEntity: Restaurant::class , inversedBy: 'reservations')]
    private ?Restaurant $restaurant;

    #[ORM\Column(type: 'integer')]
    private ?int $nb_couverts;

    public function __construct()
    {
        $this->reservation_heure = new \DateTime();
    }

    public function getRestaurant(): ?Restaurant
    {
        return $this->restaurant;
    }

    public function setRestaurant(?Restaurant $restaurant): self
    {
        $this->restaurant = $restaurant;

        return $this;
    }

    public function getNbCouverts(): ?int
    {
        return $this->nb_couverts;
    }

    public function setNbCouverts(int $nb_couverts): self
    {
        $this->nb_couverts = $nb_couverts;

        return $this;
    }

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

    public function getPlaceRestante(): ?int
    {
        return $this->place_restante;
    }

    public function setPlaceRestante(?int $place_restante): self
    {
        $this->place_restante = $place_restante;

        return $this;
    }

    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function setDate(?\DateTime $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getReservationHeure(): ?\DateTimeInterface
    {
        return $this->reservation_heure;
    }

    /**
     * Get the value of allergie
     */ 
    public function getAllergie()
    {
        return $this->allergie;
    }

   

    /**
     * Set the value of allergie
     *
     * @return  self
     */ 
    public function setAllergie($allergie)
    {
        $this->allergie = $allergie;

        return $this;
    }
}