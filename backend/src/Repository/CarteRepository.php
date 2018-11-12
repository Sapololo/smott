<?php

namespace App\Repository;

use App\Entity\Carte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Carte|null find($id, $lockMode = NULL, $lockVersion = NULL)
 * @method Carte|null findOneBy(array $criteria, array $orderBy = NULL)
 * @method Carte[]    findAll()
 * @method Carte[]    findBy(array $criteria, array $orderBy = NULL, $limit = 5)
 *   NULL, $offset = NULL)
 */
class CarteRepository extends ServiceEntityRepository {

  public function __construct(RegistryInterface $registry) {
    parent::__construct($registry, Carte::class);
  }

  public function transform(Carte $carte) {
    return [
      'id' => (int) $carte->getId(),
      'latitude' => (float) $carte->getLatitude(),
      'longitude' => (float) $carte->getLongitude(),
      'clubId' => (string) $carte->getClubId(),
      'nom' => (string) $carte->getNom()
    ];
  }

  public function transformAllFields(Carte $carte) {
    return [
      'id' => (int) $carte->getId(),
      'latitude' => (float) $carte->getLatitude(),
      'longitude' => (float) $carte->getLongitude(),
      'clubId' => (string) $carte->getClubId(),
      'slug' => (string) $carte->getSlug(),
      'nom' => (string) $carte->getNom(),
      'email' => (string) $carte->getEmail(),
      'contenu' => (string) $carte->getContenu(),
      'lien' => (string) $carte->getLien(),
      'nomsalle' => (string) $carte->getNomsalle(),
      'adressesalle1' => (string) $carte->getAdressesalle1(),
      'adressesalle2' => (string) $carte->getAdressesalle2(),
      'adressesalle3' => (string) $carte->getAdressesalle3(),
      'codepsalle' => (string) $carte->getCodepsalle(),
      'villesalle' => (string) $carte->getVillesalle()
    ];
  }

  public function transformAll() {
    $cartes = $this->findAll();
    $cartesArray = [];

    foreach ($cartes as $carte) {
      $cartesArray[] = $this->transformAllFields($carte);
    }

    return $cartesArray;
  }

  public function findByClubId($clubId) {
    $carte = $this->findOneBy(['clubId' => $clubId]);
    $carte = $this->transform($carte);
    return $carte;
  }
}
