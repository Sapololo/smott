<?php

namespace App\Repository;

use App\Entity\Badge;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Badge|null find($id, $lockMode = NULL, $lockVersion = NULL)
 * @method Badge|null findOneBy(array $criteria, array $orderBy = NULL)
 * @method Badge[]    findAll()
 * @method Badge[]    findBy(array $criteria, array $orderBy = NULL, $limit = 5)
 *   NULL, $offset = NULL)
 */
class BadgeRepository extends ServiceEntityRepository {

  public function __construct(RegistryInterface $registry) {
    parent::__construct($registry, Badge::class);
  }

}
