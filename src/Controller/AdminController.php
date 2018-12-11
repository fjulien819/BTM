<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Page;
use App\Form\ArticleType;
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
     * @Route("admin/pages", name="adminPages")
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
    public function page(Page $page = null, Request $request, PageRepository $pageRepository)
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

        return $this->redirectToRoute('adminPages');
    }

    /**
     * @Route("admin/articles", name="adminArticles")
     */
    public function adminArticles()
    {
        $repository = $this->getDoctrine()->getRepository(Article::class);
        $articles = $repository->findAll();

        return $this->render('admin/articles.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("admin/article/new", name="newArticle")
     * @Route("admin/article/update/{slug}", name="updateArticle")
     */
    public function article(Article $article = null, Request $request)
    {
        if(!$article)
        {
            $article = new Article;
        }

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $article = $form->getData();

            if (!$article->getId())
            {
                $article->setCreatedAt(new \DateTime());
            }

            $article->setLastUpdate(new \DateTime());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('adminHomepage');

        }
        return $this->render('admin/article.html.twig', [
            'formArticle' => $form->createView(),
            'editMode' => $article->getId() !== null
        ]);

    }

    /**
     * @Route("admin/article/delete/{slug}", name="deleteArticle")
     */
    public function deleteArticle(Article $article)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($article);
        $entityManager->flush();

        return $this->redirectToRoute('adminArticles');
    }

}
