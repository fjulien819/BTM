<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Page;
use App\Form\ArticleType;
use App\Form\PageType;
use App\Repository\PageRepository;
use App\Service\HomepageManager;
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

    /**
     * @Route("admin/articles", name="adminArticles")
     */
    public function adminArticles()
    {
        $repository = $this->getDoctrine()->getRepository(Post::class);
        $articles = $repository->findAll();

        return $this->render('admin/all_articles.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("admin/articles/new", name="newArticle")
     * @Route("admin/articles/update/{slug}", name="updateArticle")
     */
    public function article(Post $article = null, Request $request)
    {
        if(!$article)
        {
            $article = new Post;
        }

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $article = $form->getData();

            if (!$article->getId())
            {
                $article->setCreatedAt(new \DateTime());
            }
            else
            {
                $article->setLastUpdate(new \DateTime());
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('adminHomepage');

        }
        return $this->render('admin/new_update_article.html.twig', [
            'formArticle' => $form->createView(),
            'editMode' => $article->getId() !== null
        ]);

    }

    /**
     * @Route("admin/articles/delete/{slug}", name="deleteArticle")
     */
    public function deleteArticle(Post $article)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($article);
        $entityManager->flush();

        return $this->redirectToRoute('adminArticles');
    }

}
