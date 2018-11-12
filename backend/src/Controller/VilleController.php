<?php
namespace App\Controller;

use App\Dto\VilleDto;
use App\Entity\Ville;
use App\Repository\VilleRepository;
use App\Service\VilleService;
use FOS\RestBundle\Controller\Annotations as Rest;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class VilleController extends ApiController {

  /** @var VilleService */
  private $villeService;

  /** @var ObjectManager */
  private $em;

  /**
   * CatalogueController constructor.
   * @param VilleService $villeService
   */
  public function __construct(ObjectManager $em, VilleService $villeService)
  {
    $this->em = $em;
    $this->villeService = $villeService;
  }

  /**
   * @Rest\View()
   * @Rest\Get("/api/villes")
   */
  public function index(VilleRepository $villeRepository)
  {
    $villes = $villeRepository->transformAll();
    return $this->respond($villes);
  }

  /**
   * @Rest\View()
   * @Rest\Post("/api/ville/{id}")
   */
  public function show($id, VilleRepository $villeRepository)
  {
    return $this->respond($villeRepository->findOneBy(array('id' => $id)));
  }
}