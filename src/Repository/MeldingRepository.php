<?php

namespace App\Repository;

use App\Entity\Melding;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Melding>
 *
 * @method Melding|null find($id, $lockMode = null, $lockVersion = null)
 * @method Melding|null findOneBy(array $criteria, array $orderBy = null)
 * @method Melding[]    findAll()
 * @method Melding[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MeldingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Melding::class);
    }

    //    /**
    //     * @return Melding[] Returns an array of Melding objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('m.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Melding
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
