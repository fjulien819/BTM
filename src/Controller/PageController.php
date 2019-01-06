<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Page;
use App\Repository\ArticleRepository;
use App\Repository\PageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{

    /**
     * @Route("/articles", name="allArticles")
     * @param ArticleRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function allArticle(ArticleRepository $repository)
    {
        return $this->render('article/all_articles.html.twig',
            [
                'articles' => $repository->findAll()
            ]);
    }


    /**
     * @Route("/", name="homepage")
     */
    public function homepage(PageRepository $repository)
    {
        $pages = $repository->findAll();

        return $this->render('page/showPage.html.twig', [
            'pages' => $pages,
            'page' => $repository->findOneBy(['slug' => Page::SLUG_HOMEPAGE]),

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

    /**
     * @Route("/articles/{slug}", name="showArticle")
     * @param Page $page
     * @param PageRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showArticle(Post $article, ArticleRepository $repository)
    {
        return $this->render('article/showArticle.html.twig', [
        'article' => $article,

        ]);
    }


}
