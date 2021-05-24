<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\Property;
use App\Form\AddressType;
use App\Form\PropertyType;
use App\Repository\AddressRepository;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\MockObject\Rule\Parameters;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

// Base route of this Controller & restricted access
#[Route('/profil', name: 'profil_')] 
class ProfilAreaController extends AbstractController
{    
    /**
     * @var Security
     */
    private $security;   
    private $em;

    public function __construct(EntityManagerInterface $em, Security $security)
    {       
        $this->em = $em;
        $this->security = $security;
    }
    
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

    // I know this is wrong in many levels, but it works for now.
    // Need to work out a way to use forms collection or any other way to bind to forms on the same page.
    // I could've made it simpler using html input's tags but I wanted to use FormType to have the lines code ready for later changes.
    #[Route('/addProperty_step1', name: 'addProperty_step1')]
    public function addProperty_step1(Request $request): Response
    {   
        // Generate form to set the address
        $address = new Address();
        $Addressform = $this->createForm(
            AddressType::class,
            $address);
        $Addressform->handleRequest($request);
        
        // First, persist and flush address
        if ($Addressform->isSubmitted() && $Addressform->isValid()) {
            $this->em->persist($address);
            $this->em->flush();           
            
            return $this->redirectToRoute("profil_addProperty_step2");
        }
        

        return $this->render('profil_area/addProperty_step1.html.twig', [
            'Addressform' => $Addressform->createView(),            
        ]);
    }

    #[Route('/addProperty_step2', name: 'addProperty_step2')]
    public function addProperty_step2(Request $request, AddressRepository $addressRepository): Response
    {
        // Retrive the id of this address
        // It 's a bad idea to do this here, if there is some traffic and to
        // many poeple enter a new property at the same time,
        // there's a high risk that by the time the user finish to complete the form,
        // the last address entry won't be the one the user entered at step 1.
        $lastAddresses = $addressRepository->getLastEntry();
        $lastAddress = $lastAddresses[0];       
        
        // Generate form to set the property
        $property = new Property();
        $Propertyform = $this->createForm(
            PropertyType::class,
            $property
        );        
        $Propertyform->handleRequest($request);
        
        // Set the missing properties to persite the new property in DB
        if ($Propertyform->isSubmitted() && $Propertyform->isValid()) {            
            
            $property->setAddress($lastAddress);
            // need to slug the title
            $property->setSlug('slug-the-title');
            $property->setOwner($this->security->getUser());
            $this->em->persist($property);
            $this->em->flush();
            return $this->redirectToRoute("profil_properties");
        }
        
        return $this->render('profil_area/addProperty_step2.html.twig', [            
            'Propertyform' => $Propertyform->createView(),
        ]);
    }
}
