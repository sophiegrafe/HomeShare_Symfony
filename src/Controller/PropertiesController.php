<?php

namespace App\Controller;

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
        $data = $propertyRepository->findAll();
        $properties = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            12
        );
        return $this->render('properties/properties.html.twig', [
            'properties' => $properties,
            'countries' => $countryRepository->findAll(),
            'cities' => $cityRepository->findAll(),
        ]);
    }
}
