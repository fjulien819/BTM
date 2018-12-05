<?php

namespace App\Controller;

use App\Entity\Page;
use App\Repository\PageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{


    /**
     * @Route("/", name="homepage")
     */
    public function homepage(PageRepository $repository)
    {
        $pages = $repository->findAll();
        $page = 'homepage';

        return $this->render('page/showPage.html.twig', [
            'pages' => $pages,
            'page' => $page

        ]);
    }

    /**
     * @Route("/{slug}", name="showPage")
     * @param Page $page
     * @param PageRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showPage(Page $page, PageRepository $repository)
    {
        $pages = $repository->findAll();

        return $this->render('page/showPage.html.twig', [
            'pages' => $pages,
            'page' => $page

        ]);
    }


}
