<?php

namespace App\Controller\Admin;

use App\Entity\AnneeScolaire;
use App\Entity\Cantine;
use App\Entity\Enfant;
use App\Entity\Regime;
use App\Entity\User;
use App\Entity\Vacance;
use App\Repository\ParentEnfantRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin_dashboard")
     */
    public function index(): Response
    {
        return $this->render('Admin/index.html.twig');
    }

    /**
     * @Route("/admin-parent", name="dashboard_parent")
     */
    public function parent(ParentEnfantRepository $parentEnfantRepository): Response
    {
        $enfants = $parentEnfantRepository->findBy(['parent' => $this->getUser()->getId()]);
        return $this->render('Admin/parent.html.twig',
            [
                'enfants' => $enfants
            ]);
    }

    /**
     * @Route("/admin-admin", name="dashboard_admin")
     */
    public function admin(): Response
    {
        return $this->render('Admin/admin.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            // the name visible to end users
            ->setTitle('SIGRS')
            // you can include HTML contents too (e.g. to link to an image)
            ->setTitle('SIGRS')

            // the path defined in this method is passed to the Twig asset() function
            ->setFaviconPath('favicon.svg');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('Inscrits')->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Enfants', 'icon class', Enfant::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Parents', 'icon class', User::class)->setPermission('ROLE_ADMIN');

        yield MenuItem::section('Inscriptions')->setPermission('ROLE_PARENT');
        yield MenuItem::linkToCrud('Cantine', 'icon class', Cantine::class)->setPermission('ROLE_PARENT');
        yield MenuItem::linkToCrud('Mercredis', 'icon class', User::class)->setPermission('ROLE_PARENT');
        yield MenuItem::linkToCrud('ALSH', 'icon class', User::class)->setPermission('ROLE_PARENT');

        yield MenuItem::section('Exports')->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Cantine', 'icon class', Enfant::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Mercredis', 'icon class', User::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('ALSH', 'icon class', User::class)->setPermission('ROLE_ADMIN');

        yield MenuItem::section('Paramétrage')->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Année scolaire', 'icon class', AnneeScolaire::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Vacances', 'icon class', Vacance::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Régimes', 'icon class', Regime::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Utilisateurs', 'icon class', User::class)->setPermission('ROLE_ADMIN');
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        // Usually it's better to call the parent method because that gives you a
        // user menu with some menu items already created ("sign out", "exit impersonation", etc.)
        // if you prefer to create the user menu from scratch, use: return UserMenu::new()->...
        return parent::configureUserMenu($user)
            // use the given $user object to get the user name
            ->setName($user->getFullName())
            // use this method if you don't want to display the name of the user
            ->displayUserName(true)

            // you can return an URL with the avatar image
            ->setAvatarUrl($user->getProfileImageUrl())
            // use this method if you don't want to display the user image
            ->displayUserAvatar(true)
            // you can also pass an email address to use gravatar's service
            ->setGravatarEmail($user->getUsername())

            // you can use any type of menu item, except submenus
            ->addMenuItems([
//                MenuItem::linkToRoute('My Profile', 'fa fa-id-card', '...', ['...' => '...']),
//                MenuItem::linkToRoute('Settings', 'fa fa-user-cog', '...', ['...' => '...']),
MenuItem::section(),
//MenuItem::linkToLogout('Logout', 'fa fa-sign-out'),
            ]);
    }
}
