<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

/**
 * @method Article|null find($id, $lockMode = NULL, $lockVersion = NULL)
 * @method Article|null findOneBy(array $criteria, array $orderBy = NULL)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = NULL, $limit = 5)
 *   NULL, $offset = NULL)
 */
class EventRepository extends EntityRepository {

  public function __construct(EntityManagerInterface $em)
  {
    parent::__construct($em, $em->getClassMetadata(Event::class));
  }


  public function transform(Event $event) {
    return [
      'id' => (int) $event->getId(),
      'titre' => (string) $event->getTitre(),
      'contenu' => (string) $event->getContenu(),
      'image' => (string) $event->getImage(),
      'lien' => (string) $event->getLien(),
      'dtdebut' => $event->getDebut(),
      'dtfin' => $event->getDebut(),
    ];
  }

  public function transformAllFields(Event $event) {
    return [
      'id' => (int) $event->getId(),
      'carte' => (array) $event->getCarte(),
      'badge' => (array) $event->getBadge(),
      'categorie' => (array) $event->getCategorie(),
      'titre' => (string) $event->getTitre(),
      'contenu' => (string) $event->getContenu(),
      'contenuMeta' => (string) $event->getContenuMeta(),
      'lien' => (string) $event->getLien(),
      'slug' => (string) $event->getSlug(),
      'image' => (string) $event->getImage(),
      'dtdebut' =>  $event->getDebut(),
      'dtfin' => $event->getFin(),
      'en_ligne' => (bool) $event->getEnLigne(),
    ];
  }

  public function findById($id) {
    $qb = $this->createQueryBuilder('e');
    $query = $qb->select('e')
      ->addSelect('b', 'c', 'm')
      ->leftJoin('e.badge', 'b')
      ->leftJoin('e.categorie', 'c')
      ->leftJoin('e.carte', 'm')
      ->where('e.id = :id')
      ->setParameter('id', $id);

    $events =  $query->getQuery()->getResult();
    foreach ($events as $event) {
      $eventObject = $this->transformAllFields($event);
      return $eventObject;
    }
  }

  public function listEvents() {
    $qb = $this->createQueryBuilder('e');
    $query = $qb->select('e')
      ->addSelect('b', 'c', 'ca')
      ->leftJoin('e.badge', 'b')
      ->leftJoin('e.categorie', 'c')
      ->leftJoin('e.carte', 'ca')
      ->where('e.debut >= :date')
      ->andWhere('e.enLigne = 1')
      ->orderBy('e.debut','ASC')
      ->setParameter('date', date('Y-m-d'));

    $events =  $query->getQuery()->getResult();
//        if (! $events) {
//          return $this->respondNotFound();
//        }

    $eventsArray = [];
    foreach ($events as $event) {
      $eventsArray[] = $this->transformAllFields($event);
    }
    return $eventsArray;
  }

  public function findByHome() {
    $qb = $this->createQueryBuilder('e');
    $query = $qb->select('e')
      ->where('e.debut >= :date')
      ->andWhere('e.enLigne = 1')
      ->orderBy('e.debut','ASC')
      ->setParameter('date', date('Y-m-d'))
      ->setMaxResults(4);

    $events =  $query->getQuery()->getResult();
//    if (! $events) {
//      return $this->respondNotFound();
//    }

    $eventsArray = [];
    foreach ($events as $event) {
      $eventsArray[] = $this->transform($event);
    }
    return $eventsArray;
  }
}
