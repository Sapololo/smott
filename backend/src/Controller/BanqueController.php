<?php
namespace App\Controller;

use App\Entity\Banque;
use App\Repository\BanqueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class BanqueController extends ApiController
{
  /**
   * @Rest\View()
   * @Rest\Get("/api/releves")
   */
  public function releves(BanqueRepository $banqueRepository)
  {
    $banques = $banqueRepository->transformAll();
    return $this->respond($banques);
  }
}