<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 23/01/2019
 * Time: 10:17
 */

namespace App\Service;

use App\Entity\Post;
use App\Form\SearchPostType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class FormSearch
{
    private $form;

    private $router;

    private $formFactory;

    public function __construct(UrlGeneratorInterface $router, FormFactoryInterface $formFactory)
    {
        $this->router = $router;
        $this->formFactory = $formFactory;

        $this->form = $this->formFactory->create(SearchPostType::class, null, [
            'attr' => ['action' => $this->router->generate('handleSearchForm', ['url_page_post' => Post::URL_PAGE_POST])]
        ]);
    }

    public function getForm() {
        return $this->form;
    }
}