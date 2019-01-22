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

    /**
     * @param $entity
     */
    public function updateEntity($entity)
    {
        if (method_exists($entity, 'setLastUpdate')) {
            $entity->setLastUpdate(new \DateTime('now', new \DateTimeZone(POST::DATE_TIME_ZONE)));
        }
        parent::updateEntity($entity);
    }

    /**
     * @param object $entity
     */
    public function persistEntity($entity)
    {
        if (method_exists($entity, 'setAuthor')) {
            $entity->setAuthor($this->getUser());
        }
        parent::persistEntity($entity);
    }




}
