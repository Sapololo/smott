<?php

namespace App\Repository;

use App\Entity\Ville;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class VilleRepository extends EntityRepository {

  public function __construct(EntityManagerInterface $em) {
    parent::__construct($em, $em->getClassMetadata(Ville::class));
  }

  public function transformAllFields(Ville $ville) {
    return [
      'id' => (int) $ville->getId(),
      'ville' => (string) $ville->getVille(),
    ];
  }

  public function transformAll() {
    $villes = $this->findBy([], ['id' => 'DESC']);
    $qb = $this->createQueryBuilder('v');
    $query = $qb->select('v')
      ->orderBy('v.id', 'DESC');

    $villes = $query->getQuery()->getResult();

    $villesArray = [];

    foreach ($villes as $ville) {
      $villesArray[] = $this->transformAllFields($ville);
    }

    return $villesArray;
  }
}
