<?php
namespace App\Controller;

use App\Entity\Carte;
use App\Repository\CarteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class CarteController extends ApiController {

  /**
   * @Rest\View()
   * @Rest\Get("/api/cartes")
   */
  public function index(CarteRepository $carteRepository)
  {
    $cartes = $carteRepository->transformAll();
    return $this->respond($cartes);
  }

  /**
   * @Rest\View()
   * @Rest\Post("/api/carte/{clubId}")
   */
  public function show($clubId, CarteRepository $carteRepository)
  {
    return $this->respond($carteRepository->findByClubId($clubId));
  }
}