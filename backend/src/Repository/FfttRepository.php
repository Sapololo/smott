<?php

namespace App\Repository;

use App\Entity\Fftt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;


class FfttRepository extends ServiceEntityRepository {

  public function __construct(RegistryInterface $registry) {
    parent::__construct($registry, Fftt::class);
  }

  public function transform(Fftt $article) {
    return [
      'id' => (int) $article->getId(),
      'titre' => (string) $article->getTitre(),
      'image' => (string) $article->getImage(),
    ];
  }

  public function transformAllClubDetailFields(Fftt $article) {
    return [
      'id' => (int) $article->getId(),
      //      'categorie' => (int) $article->getCategories(),
      'titre' => (string) $article->getTitre(),
      'image' => (string) $article->getImage(),
      'contenu' => (string) $article->getContenu(),
      'contenuMeta' => (string) $article->getContenuMeta(),
      'lien' => (string) $article->getLien(),
      'en_ligne' => (bool) $article->getEnLigne(),
      //      'creation' => (string) \DateTime::createFromFormat('d/m/y', $article->getCreation()),
    ];
  }

  public function transformAll() {
    //    $articles = $this->findAll()
    $articles = $this->findBy(array('enLigne' => '1'), array('id' => 'DESC'));
    $articlesArray = [];

    foreach ($articles as $article) {
      $articlesArray[] = $this->transformAllFields($article);
    }

    return $articlesArray;
  }

  public function findByHome() {
    $articles = $this->createQueryBuilder('article')
      //      >andWhere('article.en_ligne = ?', 1)
      ->orderBy('article.id', 'DESC')
      ->setMaxResults(5)
      ->getQuery()
      ->getResult();

    $articlesArray = [];

    foreach ($articles as $article) {
      $articlesArray[] = $this->transform($article);
    }

    return $articlesArray;
  }

  public function getPreviousFftt($value)
  {
    return $this->createQueryBuilder('m')
      ->select('m.id')
      ->andWhere('m.id < :val')
      ->setParameter('val', $value)
      ->orderBy('m.id', 'DESC')
      ->setFirstResult(0)
      ->setMaxResults(1)
      ->getQuery()
      ->getOneOrNullResult()
      ;
  }

  public function getNextFftt($value)
  {
    return $this->createQueryBuilder('m')
      ->select('m.id')
      ->andWhere('m.id > :val')
      ->setParameter('val', $value)
      ->orderBy('m.id', 'ASC')
      ->setFirstResult(0)
      ->setMaxResults(1)
      ->getQuery()
      ->getOneOrNullResult()
      ;
  }
}
