<?php

namespace App\Controller\Admin;

use App\Entity\Enfant;
use App\Entity\User;
use App\Form\ParentEnfantType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EnfantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Enfant::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addPanel('User Details'),
            IdField::new('id')->onlyOnDetail(),
            TextField::new('nom'),
            TextField::new('prenom'),
            DateField::new('dateDeNaissance')->setFormat(DateTimeField::FORMAT_SHORT),
            ImageField::new('photo'),
            FormField::addPanel('User Details'),
            CollectionField::new('parentEnfants')->setEntryType(ParentEnfantType::class),

        ];
    }

}
