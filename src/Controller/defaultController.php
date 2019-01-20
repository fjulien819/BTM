<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Page;
use App\Entity\Search;
use App\Form\SearchType;
use App\Repository\PostRepository;
use App\Repository\PageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class defaultController extends AbstractController
{


    /**
     * @param Request $request
     * @param PostRepository $postRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchForm(Request $request, PostRepository $postRepository)
    {

        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($search);
            $entityManager->flush();

            $results = $postRepository->searchPostByTerm($search->getSearchTerm());


            return $this->render('page/searchResultView.html.twig', ['searchResults' => $results]);
        }
        return $this->render('form/searchForm.html.twig', ['searchForm' => $form->createView()]);
    }

    /**
     * @Route("/articles", name="allArticles")
     * @param PostRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function allArticle(PostRepository $repository)
    {
        return $this->render('article/all_articles.html.twig',
            [
                'articles' => $repository->findBy(['published' => true])
            ]);
    }


    /**
     * @Route("/", name="homepage")
     */
    public function homepage(Request $request)
    {
        return $this->render('base.html.twig');
    }
    /*
        /**
         * @Route("/{slug}", name="showPage")
         * @param Page $page
         * @param PageRepository $repository
         * @return \Symfony\Component\HttpFoundation\Response
         */
    /*
        public function showPage(Page $page, PageRepository $repository)
        {
            $pages = $repository->findAll();

            return $this->render('page/showPage.html.twig', [
                'pages' => $pages,
                'page' => $page

            ]);
        }
    */
    /**
     * @Route("/articles/{slug}", name="showArticle")
     * @param Page $page
     * @param PageRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showArticle(Post $article, PostRepository $repository)
    {
        return $this->render('article/showArticle.html.twig', [
            'article' => $article,

        ]);
    }


}
