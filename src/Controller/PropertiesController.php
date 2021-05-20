<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Form\SearchType;
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
        PropertyRepository $res,        
        PaginatorInterface $paginator,
        Request $request
        ): Response
    {
        $data = new SearchData();
        $form = $this->createForm(
            SearchType::class,
            $data
        );
        $data->numeroPage = $request->get('page', 1);
        $form->handleRequest($request);

        $tinyHomeResult = [];

        if ($form->isSubmitted()) {
            //if submited -> return search results
            $tinyHomeResult = $res->getTinyHomeSearchResult($data);
        } else {
            //if not submited -> return all properties
            $tinyHomeResult = $res->findAll();
        }
        
        return $this->render('properties/properties.html.twig', [
            'form' => $form->createView(),
            'tinyHomeResult' => $tinyHomeResult
        ]);
    }
}
