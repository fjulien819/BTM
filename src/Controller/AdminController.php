<?php

namespace App\Controller;

use App\Entity\Page;
use App\Form\PageType;
use App\Repository\PageRepository;
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

        return $this->render('admin/index.html.twig', [
        ]);
    }

    /**
     * @Route("admin/pages", name="adminHomepage")
     */
    public function adminPages()
    {
        $repository = $this->getDoctrine()->getRepository(Page::class);
        $pages = $repository->findAll();

        return $this->render('admin/pages.html.twig', [
            'pages' => $pages,
        ]);
    }

    /**
     * @Route("admin/page/new", name="newPage")
     * @Route("admin/page/update/{slug}", name="updatePage")
     */
    public function Page(Page $page = null, Request $request, PageRepository $pageRepository)
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

            if (!$pageRepository->findBy(array('slug' => Page::SLUG_HOMEPAGE )))
            {
                $page->setSlug(page::SLUG_HOMEPAGE);
            }

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
     * @Route("admin/page/delete/{slug}", name="deletePage")
     */
    public function deletePage(Page $page)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($page);
        $entityManager->flush();

        return $this->redirectToRoute('adminHomepage');
    }
}
