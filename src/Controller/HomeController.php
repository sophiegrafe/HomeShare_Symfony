<?php

namespace App\Controller;


use App\Repository\BlogpostRepository;
use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(
        PropertyRepository $propertyRepository,
        BlogpostRepository $blogpostRepository
    ): Response {
       
        return $this->render('home/index/index.html.twig', [
            'properties' => $propertyRepository->getLastTen(),
            'blogposts' => $blogpostRepository->getLastFive()
        ]);
    }
        

    #[Route('/about', name: 'about')]
    public function about(): Response
    {
        return $this->render('home/about/about.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }    

    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('home/contact/contact.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

}