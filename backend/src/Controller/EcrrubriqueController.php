<?php
namespace App\Controller;

use App\Entity\Ecrrubrique;
use App\Repository\EcrrubriqueRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class EcrrubriqueController extends ApiController
{
  /**
   * @Rest\View()
   * @Rest\Get("/ecrrubriques")
   */
  public function ecrrubriques(EcrrubriqueRepository $ecrrubriqueRepository)
  {
    $ecrrubriques = $ecrrubriqueRepository->transformAll();
    return $this->respond($ecrrubriques);
  }
}