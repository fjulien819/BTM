<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Page;
use App\Form\ArticleType;
use App\Form\PageType;
use App\Repository\PageRepository;
use App\Service\HomepageManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;

class AdminController extends BaseAdminController
{

    public function updateEntity($entity)
    {
        if (method_exists($entity, 'setLastUpdate')) {
            $entity->setLastUpdate(new \DateTime('now', new \DateTimeZone(POST::DATE_TIME_ZONE)));
        }

        parent::updateEntity($entity);
    }


    /**
     * @Route("admin/pages", name="adminPages")
     */
    public function adminPages()
    {
        $repository = $this->getDoctrine()->getRepository(Page::class);
        $pages = $repository->findAll();

        return $this->render('admin/all_pages.html.twig', [
            'pages' => $pages,
        ]);
    }

    /**
     * @Route("admin/pages/new", name="newPage")
     * @Route("admin/pages/update/{slug}", name="updatePage")
     */
    public function page(Page $page = null, Request $request, PageRepository $pageRepository, HomepageManager $homepageManager)
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
            else
            {
                $page->setLastUpdate(new \DateTime());
            }

            $homepageManager->checkHomepage($page);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($page);
            $entityManager->flush();

            return $this->redirectToRoute('adminHomepage');

        }
            return $this->render('admin/new_update_page.html.twig', [
                'formPage' => $form->createView(),
                'editMode' => $page->getId() !== null
            ]);

    }


    /**
     * @Route("admin/pages/delete/{slug}", name="deletePage")
     */
    public function deletePage(Page $page)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($page);
        $entityManager->flush();

        return $this->redirectToRoute('adminPages');
    }




}
