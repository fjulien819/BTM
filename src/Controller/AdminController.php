<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("admin", name="adminHomepage")
     */
    public function adminHomepage()
    {

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route(" admin/createPage", name="createPage")
     */
    public function createPage()
    {
        return $this->render('admin/page/create.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("admin/updatePage", name="updatePage")
     */
    public function updatePage()
    {
        return $this->render('admin/page/update.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("admin/deletePage", name="deletePage")
     */
    public function deletePage()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
}
