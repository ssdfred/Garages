<?php

namespace App\Controller\Admin;

use App\Entity\Horaire;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class HoraireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Horaire::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            
            IdField::new('id'),
            TextField::new('jour'),
            dateField::new('title'),
            DateField::new('description'),
        ];
    }
    
}
