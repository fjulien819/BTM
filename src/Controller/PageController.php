<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    /**
     * @Route("/{id}", name="page")
     */
    public function index($id)
    {
        return $this->render('page/index.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }

    /**
     * @Route("/addPage", name="addPage")
     */
    public function add()
    {
        return $this->render('page/index.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }

    /**
     * @Route("/updatePage", name="updatePage")
     */
    public function update()
    {
        return $this->render('page/index.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }

    /**
     * @Route("/deletePage", name="deletePage")
     */
    public function delete()
    {
        return $this->render('page/index.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }


}
