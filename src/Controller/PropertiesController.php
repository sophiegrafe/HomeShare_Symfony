<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Form\SearchFormType;
use App\Repository\CityRepository;
use App\Repository\CountryRepository;
use App\Repository\PropertyRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PropertiesController extends AbstractController
{
    #[Route('/properties', name: 'properties')]
    public function properties(
        PropertyRepository $propertyRepository,
        CountryRepository $countryRepository,
        CityRepository $cityRepository,
        PaginatorInterface $paginator,
        Request $request
        ): Response
    {
        $data = new SearchData();
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
        
        return $this->render('properties/properties.html.twig', [
            'form' => $form->createView(),
            'propertiesResult' => $propertiesResult
        ]);
    }
}
