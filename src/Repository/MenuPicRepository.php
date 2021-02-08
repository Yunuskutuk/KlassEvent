<?php

namespace App\Repository;

use App\Entity\MenuPicture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MenuPicture|null find($id, $lockMode = null, $lockVersion = null)
 * @method MenuPicture|null findOneBy(array $criteria, array $orderBy = null)
 * @method MenuPicture[]    findAll()
 * @method MenuPicture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MenuPicRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MenuPicture::class);
    }

    // /**
    //  * @return MenuPicture[] Returns an array of MenuPicture objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MenuPicture
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
