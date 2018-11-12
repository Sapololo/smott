<?php

namespace App\Controller;

use App\Dto\EmailDto;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Service\MailerService;

class EmailController extends ApiController {

  /** @var MailerService */
  private $mailerService;

  /**
   * EmailController constructor.
   *
   * @param MailerService $mailerService
   *
   */
  public function __construct(MailerService $mailerService) {
    $this->mailerService = $mailerService;
  }

  /**
   * @Rest\View()
   * @Rest\Post("/api/email")
   *
   * @ParamConverter("data", converter="fos_rest.request_body")
   *
   * @param EmailDto $data
   */
  public function index(EmailDto $data) {
    //    $message = (new \Swift_Message('Quelqu\'un vous a contactez par l\'intermédaire de votre site !'))
    //      ->setFrom('stmarceau.tt@free.fr')
    //      ->setTo('stmarceau.tt@free.fr')
    //      ->setBody(
    //        $this->renderView(
    //        // templates/emails/contact.html.twig
    //          'emails/contact.html.twig',
    //          array('nom' => $objectMessage->nom, 'sujet' => $objectMessage->sujet, 'message' => $objectMessage->message, 'email' => $objectMessage->email)
    //        ),
    //        'text/html'
    //      );

    //    $transport = (new Swift_SmtpTransport('ssl0.ovh.net', 465))
    //      ->setUsername('contact@stmarceautt.fr')
    //      ->setPassword('tnujr5z19')
    //    ;
    //
    //    $mailer = new Swift_Mailer($transport);

    //    $message = (new Swift_Message('Quelqu\'un vous a contactez par l\'intermédaire de votre site !'))
    //      ->setFrom(['stmarceau.tt@free.fr' => 'Saint Marceau Orléans Tennis de Table'])
    //      ->setTo(['stmarceau.tt@free.fr'])
    //      ->setBody('Here is the message itself')
    //    ;

    $result = $this->mailerService->sendEmail($data->getEmail(), $data->getMessage(), $data->getName(), $data->getMessage());
    return $this->respond($result);
  }

  /**
   * @Rest\View()
   * @Rest\Post("/api/emailRecoit")
   *
   * @ParamConverter("data", converter="fos_rest.request_body")
   *
   * @param EmailDto $data
   */
  public function emailRecoit(EmailDto $data) {
    $result = $this->mailerService->recoitEmail($data->getEmail(), $data->getName(), $data->getSujet());
    return $this->respond($result);
  }
}
