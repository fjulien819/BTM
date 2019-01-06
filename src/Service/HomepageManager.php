<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 06/01/2019
 * Time: 14:50
 */

namespace App\Service;


use App\Entity\Page;
use Doctrine\ORM\EntityManagerInterface;

class HomepageManager
{
    private $entityManger;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManger = $entityManager;
    }

    public function checkHomepage(Page $page)
    {
        $pageRepository = $this->entityManger->getRepository(Page::class);

        if (!$pageRepository->findBy(array('slug' => Page::SLUG_HOMEPAGE )))
        {
            $page->setSlug(page::SLUG_HOMEPAGE);
        }
    }
}