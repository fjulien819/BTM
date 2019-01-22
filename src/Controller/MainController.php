<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Page;
use App\Entity\Search;
use App\Form\ContactType;
use App\Form\SearchType;
use App\Repository\PostRepository;
use App\Service\ContactNotification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
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

            $results = $postRepository->searchPostByTerm($search->getSearchTerm());

            return $this->render('post/searchResultView.html.twig', ['searchResults' => $results]);
        }
        return $this->render('post/form/searchForm.html.twig', ['searchForm' => $form->createView()]);
    }

    /**
     * @Route("/{url_page_post}", name="allPosts", requirements={"url_page_post"=Post::URL_PAGE_POST})
     * @param PostRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function allPosts(PostRepository $repository)
    {
        return $this->render('post/allPosts.html.twig',
            [
                'posts' => $repository->findBy(['published' => true])
            ]);
    }

    /**
     * @Route("/{url_page_post}/{slug}", name="showPost",  requirements={"url_page_post"=Post::URL_PAGE_POST})
     * @param Page $page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showPost(Post $post)
    {
        return $this->render('post/showPost.html.twig', [
            'post' => $post,

        ]);
    }

    /**
     * @Route("/", name="homepage")
     */
    public function homepage()
    {
        return $this->render('base.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request, ContactNotification $contactNotification)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            if ($contactNotification->notify($form->getData()))
            {
                $this->addFlash("notice", "Votre message a bien été envoyé");
                return $this->redirectToRoute('contact');

            }

            $this->addFlash("notice", "Votre message n'a pas pu être envoyé");
            return $this->redirectToRoute('contact');

        }

        return $this->render('contact.html.twig', ['formContact' => $form->createView()]);
    }






    /*
        /**
         * @Route("/{slug}", name="showPage")
         * @param Page $post
         * @param PageRepository $repository
         * @return \Symfony\Component\HttpFoundation\Response
         */
    /*
        public function showPage(Page $post, PageRepository $repository)
        {
            $pages = $repository->findAll();

            return $this->render('post/showPage.html.twig', [
                'pages' => $pages,
                'post' => $post

            ]);
        }
    */



}
