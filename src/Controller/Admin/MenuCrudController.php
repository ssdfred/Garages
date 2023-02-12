<?php

namespace App\Controller\Admin;

use App\Entity\Menu;
use DateTimeInterface;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use phpDocumentor\Reflection\Types\Callable_;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Validator\Constraints\DivisibleBy;

class MenuCrudController extends AbstractCrudController
{
    public const ACTION_DUPLICATE = 'duplicate';
    public const  MENU_BASE_PATH = 'uploads/menu';
    public const  MENU_UPLOAD_DIR = 'public/uploads/menu';
    public static function getEntityFqcn(): string
    {
        return Menu::class;
    }

        //permet d'ajouter à la page d'édition la duplication
        public function configureActions(Actions $actions): Actions
        {
            $duplicate = Action::new(self::ACTION_DUPLICATE)
                ->linkToCrudAction('duplicateMenu')
                ->setCssClass('btn btn-info');
            return $actions
            ->add(Crud::PAGE_EDIT, $duplicate);
        }
    
    
        public function configureFields(string $pageName): iterable
        {
            return [
    
                IdField::new('id')->hideOnForm(),
                TextField::new('title', 'Nom'),
                TextEditorField::new('description'),
                MoneyField::new('price', 'Prix')->setCurrency('EUR'),
                ImageField::new('photo')->setBasePath(self::MENU_BASE_PATH)
                ->setUploadDir(self::MENU_UPLOAD_DIR)
            ];
        }
    
    
        public function duplicateMenu(AdminContext $context, EntityManagerInterface $em, AdminUrlGenerator $adminUrlGenerator): RedirectResponse
        {
    
            /** @var Menu $menu */
            $menu =$context->getEntity()->getInstance();
    
            $duplicateMenu = clone $menu;
    
            parent::persistEntity($em, $duplicateMenu);
    
            $url = $adminUrlGenerator->setController(self::class)
                ->setAction(Action::DETAIL)
                ->setEntityId($duplicateMenu->getId())
                ->generateUrl();
    
            return $this->redirect($url);
        }
    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
