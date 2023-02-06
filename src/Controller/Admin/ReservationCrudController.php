<?php

namespace App\Controller\Admin;

use App\Entity\Reservation;
use DateTime;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;


class ReservationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reservation::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            Field::new('name'),
            Field::new('nb_personnes', label: 'nombre de personnes'),
            Field::new( 'date'),
            Field::new('reservation_heure')
        ];
    }



}
