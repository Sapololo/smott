<?php

namespace App\Service;

use Doctrine\Common\Persistence\ObjectManager;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWSProvider\JWSProviderInterface;
use Swift_Message;

class MailerService {

  /** @var ObjectManager */
  private $em;

  /** @var \Swift_Mailer */
  private $mailer;

  /** @var \Twig_Environment */
  private $twig;

  /** @var JWSProviderInterface */
  private $jwsProvider;

  /**
   * MailerService constructor.
   *
   * @param ObjectManager $em
   * @Param \Swift_Mailer $mailer
   * @Param \Twig_Environment $twig
   */
  public function __construct(ObjectManager $em,
                              \Swift_Mailer $mailer,
                              \Twig_Environment $twig,
                              JWSProviderInterface $jwsProvider) {
    $this->em = $em;
    $this->mailer = $mailer;
    $this->twig = $twig;
    $this->jwsProvider = $jwsProvider;
  }

  public function sendReinitialisationMotDePasseMail(string $token, ?string $to) {
    $title = 'StMarceauOrléansTT: Réinitialisation de mot de passe';
    $message = (new \Swift_Message($title))
      //            ->setFrom($this->mailerConfig['FROM_EMAIL_ADDRESS'])
      ->setFrom(['stmarceau.tt@free.fr' => 'Saint Marceau Orléans Tennis de Table'])
      ->setTo($to)
      ->setBody(
        $this->twig->render(
          'Emails/ReinitialisationMotDePasse.html.twig',
          [
            'baseurl' => 'http://api.stmarceautt.fr/',
            'title' => $title,
            'token' => $token,
          ]
        ),
        'text/html'
      );
    $this->mailer->send($message);
    return TRUE;
  }

  public function sendEmail(string $email, ?string $message, ?string $name, ?string $sujet) {
    $title = 'StMarceauOrléansTT: Contact à partir du site internet';
    $message = (new \Swift_Message($title))
      ->setFrom(['stmarceau.tt@free.fr' => 'Saint Marceau Orléans Tennis de Table'])
      ->setTo(['stmarceau.tt@free.fr' => 'Saint Marceau Orléans Tennis de Table'])
      ->setCc($email)
      ->setBody(
        $this->twig->render(
          'Emails/Contact.html.twig',
          [
            'baseurl' => 'http://api.stmarceautt.fr/',
            'title' => $title,
            'email' => $email,
            'message' => $message,
            'name' => $name,
            'sujet' => $sujet,
          ]
        ),
        'text/html'
      );
    $this->mailer->send($message);
    return TRUE;
  }

  public function recoitEmail(string $email, ?string $message, ?string $sujet) {
    $title = 'StMarceauOrléansTT: Reçoit';
    $message = (new \Swift_Message($title))
      ->setFrom(['stmarceau.tt@free.fr' => 'Saint Marceau Orléans Tennis de Table'])
      ->setCc(['stmarceau.tt@free.fr' => 'Saint Marceau Orléans Tennis de Table'])
      ->setSubject($message.' - '.$sujet)
      ->setTo($email)
      ->setBody(
        $this->twig->render(
          'Emails/Recoit.html.twig',
          [
            'baseurl' => 'http://api.stmarceautt.fr/',
            'title' => $title,
            'sujet' => $sujet,
          ]
        ),
        'text/html'
      );
    $this->mailer->send($message);
    return TRUE;
  }
}