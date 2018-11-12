<?php

namespace App\Repository;

use App\Entity\Ecrituretype;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class EcrituretypeRepository extends EntityRepository {

  public function __construct(EntityManagerInterface $em) {
    parent::__construct($em, $em->getClassMetadata(Ecrituretype::class));
  }

  public function transformAllFields(Ecrituretype $ecrituretype) {
    return [
      'id' => (int) $ecrituretype->getId(),
      'description' => (string) $ecrituretype->getDescription(),
    ];
  }

  public function transformAll() {
    $ecrituretypes = $this->findBy([], ['id' => 'DESC']);
//    $qb = $this->createQueryBuilder('e');
//    $query = $qb->select('e')
//      ->orderBy('e.id', 'DESC');
//
//    $ecrituretypes = $query->getQuery()->getResult();

    $ecrituretypesArray = [];

    foreach ($ecrituretypes as $ecrituretype) {
      $ecrituretypesArray[] = $this->transformAllFields($ecrituretype);
    }

    return $ecrituretypesArray;
  }
}
