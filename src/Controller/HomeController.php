<?php

namespace App\Controller;

use App\Entity\City;
use App\Entity\Country;
use App\Entity\Blogpost;
use App\Data\SearchData;
use App\Form\SearchFormType;
//use App\Repository\CountryRepository;
use App\Repository\CityRepository;
use App\Repository\CountryRepository;
use App\Repository\BlogpostRepository;
use App\Repository\PropertyRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(
        PropertyRepository $propertyRepository,
        BlogpostRepository $blogpostRepository,
        CountryRepository $countryRepository,
        CityRepository $cityRepository,
        PaginatorInterface $paginator,
        Request $request): Response
    {
    
        $data = new SearchData(); // c'est une classe qui représente le form, pas une entité
        // on aurait pu utiliser un form indépendant aussi au lieu d'une classe
        $form = $this->createForm(
            SearchFormType::class,
            $data
        );
        $data->numeroPage = $request->get('page', 1); 
        $form->handleRequest($request);

        $propertiesResult = [];

        if ($form->isSubmitted()) {
            //if submited -> return search results
            $propertiesResult = $propertyRepository->getSearchResult($data);
        } else {
            //if not submited -> return all properties
            $propertiesResult = $propertyRepository->findAll();
        }

        $vars = [
            'properties' => $propertyRepository->getLastTen(),
            'blogposts' => $blogpostRepository->getLastFive(),            
            'form' => $form->createView(),
            'propertiesResult' => $propertiesResult];

        return $this->render('home/index/index.html.twig', $vars);
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