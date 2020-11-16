<?php

namespace App\Controller\Admin;

use App\Entity\Cantine;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CantineCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cantine::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        $inscriptionCantine = Action::new('inscriptionCantine', 'Inscription Cantine', 'fa fa-plus-circle')
            ->linkToRoute('inscription_cantine');


        return $actions
            ->update(Crud::PAGE_INDEX, Action::NEW, function(Action $action) {
                return $action->setIcon('fa fa-plus-circle')->linkToRoute('inscription_cantine');
            })
            ->add(Crud::PAGE_DETAIL, $inscriptionCantine);
    }
}
