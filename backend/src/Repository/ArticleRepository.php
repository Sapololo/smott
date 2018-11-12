<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Article|null find($id, $lockMode = NULL, $lockVersion = NULL)
 * @method Article|null findOneBy(array $criteria, array $orderBy = NULL)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL)
 */
class ArticleRepository extends ServiceEntityRepository {

  public function __construct(RegistryInterface $registry) {
    parent::__construct($registry, Article::class);
  }

  /**
   * @return Article[] Returns an array of Article objects
   */
  /*
  public function findByExampleField($value)
  {
      return $this->createQueryBuilder('a')
          ->andWhere('a.exampleField = :val')
          ->setParameter('val', $value)
          ->orderBy('a.id', 'ASC')
          ->setMaxResults(10)
          ->getQuery()
          ->getResult()
      ;
  }
  */
  /*
  public function findOneBySomeField($value): ?Article
  {
      return $this->createQueryBuilder('m')
          ->andWhere('m.exampleField = :val')
          ->setParameter('val', $value)
          ->getQuery()
          ->getOneOrNullResult()
      ;
  }
  */

  public function transform(Article $article) {
    return [
      'id' => (int) $article->getId(),
      'badge' => (array) $article->getBadge(),
      'titre' => (string) $article->getTitre(),
      'image' => (string) $article->getImage(),
      'lien' => (string) $article->getLien(),
      'creation' => (string) $article->getCreation()->format('d/m/Y')
    ];
  }

  public function transformAllFields(Article $article) {
    return [
      'id' => (int) $article->getId(),
      'badge' => (array) $article->getBadge(),
      'titre' => (string) $article->getTitre(),
      'image' => (string) $article->getImage(),
      'contenu' => (string) $article->getContenu(),
      'contenuMeta' => (string) $article->getContenuMeta(),
      'lien' => (string) $article->getLien(),
      'creation' => (string) $article->getCreation()->format('d/m/Y'),
      'modification' => (string) $article->getModification()->format('d/m/Y')
    ];
  }

  public function transformAll() {
    //    $articles = $this->findAll()
    $articles = $this->findBy(array('en_ligne' => '1'), array('id' => 'DESC'));
    $articlesArray = [];

    foreach ($articles as $article) {
      $articlesArray[] = $this->transformAllFields($article);
    }

    return $articlesArray;
  }

  public function findByHome() {
    $articles = $this->createQueryBuilder('article')
      ->orderBy('article. creation', 'DESC')
      ->setMaxResults(5)
      ->getQuery()
      ->getResult();

    $articlesArray = [];

    foreach ($articles as $article) {
      $articlesArray[] = $this->transform($article);
    }

    return $articlesArray;
  }
}
