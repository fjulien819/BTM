<?php

namespace App\Repository;

use App\Entity\ImgArticle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ImgArticle|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImgArticle|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImgArticle[]    findAll()
 * @method ImgArticle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImgArticleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ImgArticle::class);
    }

    // /**
    //  * @return ImgArticle[] Returns an array of ImgArticle objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ImgArticle
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
