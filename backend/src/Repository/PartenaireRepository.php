<?php

namespace App\Repository;

use App\Entity\Partenaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Partenaire|null find($id, $lockMode = NULL, $lockVersion = NULL)
 * @method Partenaire|null findOneBy(array $criteria, array $orderBy = NULL)
 * @method Partenaire[]    findAll()
 * @method Partenaire[]    findBy(array $criteria, array $orderBy = NULL,
 * $limit = 5
 *   NULL, $offset = NULL)
 */
class PartenaireRepository extends ServiceEntityRepository {

  public function __construct(RegistryInterface $registry) {
    parent::__construct($registry, Partenaire::class);
  }

  public function transform(Partenaire $partenaire) {
    return [
      'id' => (int) $partenaire->getId(),
      'titre' => (string) $partenaire->getTitre(),
      'image' => (string) $partenaire->getImage(),
    ];
  }

  public function transformAllFields(Partenaire $partenaire) {
    return [
      'id' => (int) $partenaire->getId(),
      'categoryId' => (int) $partenaire->getCategorieId(),
      'titre' => (string) $partenaire->getTitre(),
      'image' => (string) $partenaire->getImage(),
      'imageLarge' => (string) $partenaire->getImageLarge(),
      'contenu' => (string) $partenaire->getContenu(),
      'lien' => (string) $partenaire->getLien(),
      'taille' => (string) $partenaire->getTaille(),
      'enLigne' => (bool) $partenaire->getEnLigne(),
      'lat' => (float) $partenaire->getLat(),
      'lng' => (float) $partenaire->getLng(),
      //      'creation' => (string) \DateTime::createFromFormat('d/m/y', $partenaire->getCreation()),
    ];
  }

  public function transformAll(Array $partenaires) {
    $partenairesArray = [];

    foreach ($partenaires as $partenaire) {
      $partenairesArray[] = $this->transformAllFields($partenaire);
    }

    return $partenairesArray;
  }

}
