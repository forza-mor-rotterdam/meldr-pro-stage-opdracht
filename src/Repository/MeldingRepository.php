<?php

// src/Repository/MeldingenRepository.php

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

    // You can add custom repository methods here if needed
}
