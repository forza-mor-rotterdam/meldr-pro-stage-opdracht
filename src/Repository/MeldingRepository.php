<?php
// src/Repository/MeldingRepository.php

namespace App\Repository;

use App\Entity\Melding;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class MeldingRepository extends ServiceEntityRepository
{
public function __construct(ManagerRegistry $registry)
{
parent::__construct($registry, Melding::class);
}

public function findByTypeMelding(string $type_melding): array
{
$queryBuilder = $this->createQueryBuilder('m')
->andWhere('m.type_melding = :type_melding')
->setParameter('type_melding', $type_melding)
->getQuery();


return $queryBuilder->getResult();
}
}
