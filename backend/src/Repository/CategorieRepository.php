<?php

namespace App\Repository;

use App\Entity\Categorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Categorie|null find($id, $lockMode = NULL, $lockVersion = NULL)
 * @method Categorie|null findOneBy(array $criteria, array $orderBy = NULL)
 * @method Categorie[]    findAll()
 * @method Categorie[]    findBy(array $criteria, array $orderBy = NULL, $limit = 5)
 *   NULL, $offset = NULL)
 */
class CategorieRepository extends ServiceEntityRepository {

  public function __construct(RegistryInterface $registry) {
    parent::__construct($registry, Categorie::class);
  }

}
