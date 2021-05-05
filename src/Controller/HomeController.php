<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/home/about', name: 'about')]
    public function about(): Response
    {
        return $this->render('home/about/about.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/home/blogposts', name: 'blogposts')]
    public function blogposts(): Response
    {
        return $this->render('home/blogposts/blogposts.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/home/properties', name: 'properties')]
    public function properties(): Response
    {
        return $this->render('home/properties/properties.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/home/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('home/contact/contact.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

}
