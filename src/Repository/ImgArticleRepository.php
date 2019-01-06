<?php

namespace App\Repository;

use App\Entity\ImgPost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ImgPost|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImgPost|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImgPost[]    findAll()
 * @method ImgPost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImgArticleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ImgPost::class);
    }

    // /**
    //  * @return ImgPost[] Returns an array of ImgPost objects
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
    public function findOneBySomeField($value): ?ImgPost
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
