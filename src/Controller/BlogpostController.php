<?php

namespace App\Controller;

use App\Repository\BlogpostRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogpostController extends AbstractController
{
    #[Route('/blogposts', name: 'blogposts')]
    public function blogposts(
        BlogpostRepository $blogpostRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response
    {
        $data = $blogpostRepository->createQueryBuilder('b')->getQuery();
        $blogposts = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            6
        );
        return $this->render('blogposts/blogposts.html.twig', [
            'blogposts' => $blogposts,
            
        ]);
    }
}
