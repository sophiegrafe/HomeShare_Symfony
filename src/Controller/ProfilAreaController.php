<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// Base route of this Controller & restricted access
#[Route('/profil', name: 'profil_')] 
class ProfilAreaController extends AbstractController
{   
    // Specific route of this action.
    // name: will be concat with route's name of the controller
    // like this: profil_index
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('profil_area/index.html.twig', [
            'controller_name' => 'ProfilAreaController',
        ]);
    }

    // List the properties added by the user in the current session
    #[Route('/properties', name: 'properties')]
    public function properties(PropertyRepository $propertyRepository){
        return $this->render('profil_area/properties.html.twig', [
            'properties' => $propertyRepository->findAll(),
        ]);
    }

    #[Route('/addProperty', name: 'addProperty')]
    public function addProperty()
    {
        return $this->render('profil_area/addProperty.html.twig', [          
        ]);
    }

}
