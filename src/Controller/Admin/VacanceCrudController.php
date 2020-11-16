<?php

namespace App\Controller\Admin;

use App\Entity\Vacance;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class VacanceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Vacance::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // the labels used to refer to this entity in titles, buttons, etc.
            ->setEntityLabelInSingular('Vacance Scolaire')
            ->setEntityLabelInPlural('Vacances scolaires')
            // the Symfony Security permission needed to manage the entity
            // (none by default, so you can manage all instances of the entity)
            ->setEntityPermission('ROLE_ADMIN')
            ->setDateFormat(DateTimeField::FORMAT_SHORT)
            ->setTimeFormat(DateTimeField::FORMAT_SHORT)
            ;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnDetail(),
            AssociationField::new('anneeScolaire')->setCrudController(AnneeScolaireCrudController::class),
            TextField::new('libelle'),
            DateField::new('dateDebut')->setFormat(DateTimeField::FORMAT_SHORT),
            DateField::new('dateFin')->setFormat(DateTimeField::FORMAT_SHORT),
        ];
    }
}
