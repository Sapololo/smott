<?php
namespace App\Controller;

use App\Entity\Partenaire;
use App\Repository\PartenaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
//use Symfony\Component\HttpFoundation\JsonResponse;

class PartenaireController extends ApiController
{
  /**
   * @Rest\View()
   * @Rest\Get("/api/partenaires")
   */
  public function index(PartenaireRepository $partenaireRepository)
  {
    $partenaires = $partenaireRepository->transformAll();
    return $this->respond($partenaires);
  }

  /**
   * @Rest\View()
   * @Rest\Post("/api/partenaire/{id}")
   */
  public function show($id, PartenaireRepository $partenaireRepository)
  {
    $partenaire = $partenaireRepository->find($id);

    if (! $partenaire) {
      return $this->respondNotFound();
    }

    $partenaire = $partenaireRepository->transformAllFields($partenaire);
    return $this->respond($partenaire);
  }

  /**
   * @Rest\View()
   * @Rest\Post("/api/partenaires/category/{categoryId}")
   */
  public function category($categoryId, PartenaireRepository $partenaireRepository)
  {
    $partenaires = $partenaireRepository->findBy(['categoryId' => $categoryId, 'enLigne' => '1']);

    if (! $partenaires) {
      return $this->respondNotFound();
    }

    $partenaires = $partenaireRepository->transformAll($partenaires);
    return $this->respond($partenaires);
  }
}