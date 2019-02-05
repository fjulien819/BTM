<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Post;
use App\Form\ContactType;
use App\Repository\PostRepository;
use App\Service\ContactNotification;
use App\Service\FormSearch;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{


    /**
     * @Route("/{url_page_post}/results", name="handleSearchForm", requirements={"url_page_post"=Post::URL_PAGE_POST})
     * @param FormSearch $formSearch
     * @param Request $request
     * @param PostRepository $postRepository
     * @param PaginatorInterface $paginator
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function handleSearchForm(FormSearch $formSearch, Request $request,PostRepository $postRepository, PaginatorInterface $paginator)
    {

       $form = $formSearch->getForm();

       $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

           $search = $form->getData();

           $results = $paginator->paginate($postRepository->getQuerySearchPostByTerm($search->getSearchTerm()), $request->query->getInt('page', 1), 3 );

            return $this->render('pages/posts.html.twig', ['posts' => $results]);
        }

        return $this->redirectToRoute("posts", ['url_page_post' => Post::URL_PAGE_POST ]);
    }


    /**
     * @Route("/{url_page_post}", name="posts", requirements={"url_page_post"=Post::URL_PAGE_POST})
     * @param PaginatorInterface $paginator
     * @param PostRepository $postRepository
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function posts(PaginatorInterface $paginator, PostRepository $postRepository, Request $request)
    {
        $posts = $paginator->paginate($postRepository->getQueryAllPostsVisible(), $request->query->getInt('page', 1), 3 );
        return $this->render('pages/posts.html.twig',
            [
                'posts' => $posts
            ]);
    }

    /**
     * @Route("/{url_page_post}/categorie/{category_name}", name="postsByCategory", requirements={"url_page_post"=Post::URL_PAGE_POST})
     * @ParamConverter("category", options={"mapping"={"category_name"="name"}})
     * @param PaginatorInterface $paginator
     * @param Category $category
     * @param PostRepository $postRepository
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postsByCategory(PaginatorInterface $paginator, Category $category, PostRepository $postRepository, Request $request)
    {
        $posts = $paginator->paginate($postRepository->getQueryPostByCategory($category), $request->query->getInt('page', 1), 3 );
        return $this->render('pages/posts.html.twig',
            [
                'posts' => $posts,
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
        return $this->render('pages/homepage.html.twig');
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

    /**
     * @Route("/service", name="service")
     */
    public function service()
    {
        return $this->render('pages/service.html.twig');
    }

    /**
     * @Route("/expertise", name="expertise")
     */
    public function expertise()
    {
        return $this->render('pages/expertise.html.twig');
    }

    /**
     * @Route("/mentions-legales", name="legalNotice")
     */
    public function legalNotice()
    {
        return $this->render('pages/mentions_legales.html.twig');
    }

}
