<?php

namespace App\Controller;

use App\Entity\Blogpost;
use App\Entity\Country;
use App\Entity\City;
use App\Repository\BlogpostRepository;
//use App\Repository\CountryRepository;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function index(
        PropertyRepository $propertyRepository,
        BlogpostRepository $blogpostRepository): Response
    {   
        $em = $this->getDoctrine()->getManager();
        $countryRepository = $em->getRepository(Country::class);
        $cityRepository = $em->getRepository(City::class);

        return $this->render('home/index/index.html.twig', [
            'properties' => $propertyRepository->getLastTen(),
            'blogposts' => $blogpostRepository->getLastFive(),
            'countries' => $countryRepository->findAll(),
            'cities' => $cityRepository->findAll(),
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

    // #[Route('/home/properties', name: 'properties')]
    // public function properties(): Response
    // {
    //     return $this->render('home/properties/properties.html.twig', [
    //         'controller_name' => 'HomeController',
    //     ]);
    // }

    #[Route('/home/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('home/contact/contact.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

}