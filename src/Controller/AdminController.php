<?php

namespace App\Controller;

use App\Entity\Page;
use App\Form\PageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class AdminController extends AbstractController
{
    /**
     * @Route("admin", name="adminHomepage")
     */
    public function adminHomepage()
    {
        $repository = $this->getDoctrine()->getRepository(Page::class);
        $pages = $repository->findAll();

        return $this->render('admin/index.html.twig', [
            'pages' => $pages,
        ]);
    }

    /**
     * @Route("admin/newPage", name="newPage")
     * @Route("admin/updatePage/{slug}", name="updatePage")
     */
    public function Page(Page $page = null, Request $request)
    {
        if(!$page)
        {
            $page = new Page;
        }

        $form = $this->createForm(PageType::class, $page);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $page = $form->getData();

            if (!$page->getId())
            {
                $page->setCreatedAt(new \DateTime());
            }

            $page->setLastUpdate(new \DateTime());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($page);
            $entityManager->flush();

            return $this->redirectToRoute('adminHomepage');

        }
            return $this->render('admin/page.html.twig', [
                'formPage' => $form->createView(),
                'editMode' => $page->getId() !== null
            ]);

    }


    /**
     * @Route("admin/deletePage/{slug}", name="deletePage")
     */
    public function deletePage(Page $page)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($page);
        $entityManager->flush();

        return $this->redirectToRoute('adminHomepage');
    }
}
