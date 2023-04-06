<?php

namespace App\Entity;

use App\Repository\RestaurantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: RestaurantRepository::class)]
class Restaurant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $nb_couverts = null;

    #[ORM\OneToMany(mappedBy: 'restaurant', targetEntity: User::class)]
    private Collection $users;

    #[ORM\OneToMany(mappedBy: 'restaurant', targetEntity: Menu::class)]
    private Collection $menu;

    /**
     * @return int|null
     */
    public function getNbCouverts(): ?int
    {
        return $this->nb_couverts;
    }

    /**
     * @param int|null $nb_couverts
     * @return Restaurant
     */
    public function setNbCouverts(?int $nb_couverts): Restaurant
    {
        $this->nb_couverts = $nb_couverts;
        return $this;
    }

    #[ORM\OneToMany(mappedBy: 'restaurant', targetEntity: Reservation::class)]
    private Collection $reservations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->menu = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

    
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setRestaurant($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->contains($reservation)) {
            $this->reservations->removeElement($reservation);
            if ($reservation->getRestaurant() === $this) {
                $reservation->setRestaurant(null);
            }
        }

        return $this;
    }

    /**
     * @param int|null $id
     */
    function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int|null
     */
    function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return Collection<int, User>
     */
    function getUsers(): Collection
    {
        return $this->users;
    }

    /**
     * @return Collection
     */
    public function getMenu(): Collection
    {
        return $this->menu;
    }

    /**
     * @param Collection $menu
     */
    public function setMenu(Collection $menu): void
    {
        $this->menu = $menu;
    }
}
