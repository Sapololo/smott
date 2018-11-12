<?php

namespace App\Repository;

use App\Entity\Video;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class VideoRepository extends EntityRepository {

  public function __construct(EntityManagerInterface $em)
  {
    parent::__construct($em, $em->getClassMetadata(Video::class));
  }

  public function transform(Video $video) {
    return [
      'id' => (int) $video->getId(),
      'titre' => (string) $video->getTitre(),
      'lien' => (string) $video->getLien(),
    ];
  }

  public function transformAllFields(Video $video) {
    return [
      'id' => (int) $video->getId(),
      'categorie' => (array) $video->getCategorie(),
      'titre' => (string) $video->getTitre(),
      'lien' => (string) $video->getLien(),
      'enLigne' => (bool) $video->getEnLigne(),
      //      'creation' => (string) \DateTime::createFromFormat('d/m/y', $video->getCreation()),
    ];
  }

  public function transformAll() {
//    $videos = $this->findBy(array('enLigne' => '1'), array('id' => 'DESC'));
    $qb = $this->createQueryBuilder('v');
    $query = $qb->select('v')
      ->addSelect('c')
      ->leftJoin('v.categorie', 'c')
      ->Where('v.enLigne = 1')
      ->orderBy('v.id','DESC');

    $videos =  $query->getQuery()->getResult();

    $videosArray = [];
    foreach ($videos as $video) {
      $videosArray[] = $this->transformAllFields($video);
    }

    return $videosArray;
  }
  
}
