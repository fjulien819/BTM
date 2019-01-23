<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\ContactType;
use App\Repository\PostRepository;
use App\Service\ContactNotification;
use App\Service\FormSearch;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{


    /**
     * @Route("/{url_page_post}/results", name="handleSearchForm", requirements={"url_page_post"=Post::URL_PAGE_POST})
     * @Method({"POST"})
     * @param FormSearch $formSearch
     * @param Request $request
     * @param PostRepository $postRepository
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function handleSearchForm(FormSearch $formSearch, Request $request,PostRepository $postRepository)
    {

       $form = $formSearch->getForm();

       $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

           $search = $form->getData();

           $results = $postRepository->searchPostByTerm($search->getSearchTerm());

            return $this->render('pages/posts.html.twig', ['posts' => $results]);
        }

        return $this->redirectToRoute("posts", ['url_page_post' => Post::URL_PAGE_POST ]);
    }

    /**
     * @Route("/{url_page_post}", name="posts", requirements={"url_page_post"=Post::URL_PAGE_POST})
     * @param PostRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function posts(PostRepository $repository)
    {
        return $this->render('pages/posts.html.twig',
            [
                'posts' => $repository->findBy(['published' => true])
            ]);
    }

    /**
     * @Route("/{url_page_post}/{slug}", name="post",  requirements={"url_page_post"=Post::URL_PAGE_POST})
     * @param Post $post
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function post(Post $post)
    {
        return $this->render('pages/post.html.twig', [
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
     * @param Request $request
     * @param ContactNotification $contactNotification
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
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

        return $this->render('pages/contact.html.twig', ['formContact' => $form->createView()]);
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
