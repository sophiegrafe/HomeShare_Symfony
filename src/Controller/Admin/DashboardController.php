<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Blogpost;
use App\Entity\Property;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Security\Permission;

class DashboardController extends AbstractDashboardController
{
    
     #[Route("/admin", name: "admin")]     
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('TinyHomeShare');            
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Blogposts', 'fas fa-newspaper', Blogpost::class);
        yield MenuItem::linkToCrud('Properties', 'fas fa-igloo', Property::class);
        yield MenuItem::linkToCrud('Users', 'fas fa-users', User::class);
    }
}
