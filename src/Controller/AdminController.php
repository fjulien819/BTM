<?php

namespace App\Controller;

use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;

class AdminController extends EasyAdminController
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
