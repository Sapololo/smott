/**
 * Traductions des réponses de l'API .
 */

const translations: { [original: string]: string } = {
  'Bad credentials': 'Vous n\'êtes pas connecté pour accéder à cette page !',
  'Unauthorized': 'Accès refusé',
  'Internal Server Error': 'Erreur interne du serveur',
  'The credentials were changed from another session.': 'Les identifiants ont changés depuis une autre session.',
  'The presented password cannot be empty.': 'Le mot de passe saisi est vide.',
  'The presented password is invalid.': 'Mot de passe erroné, veuillez recommencer.',
  'User account is disabled.': 'Votre compte est désactivé. Pour le réactiver, veuillez envoyer<br/>un mail à assistance.oison@afbiodiversite.fr.',
  'Invalid datetime \" \", expected format Y-m-d.': 'Le format de la date est invalide.'
}

const reTranslations: { re: RegExp, replace: string }[] = [
  { re: /Username \"(.*?)\" does not exist\./g, replace: 'E-mail $1 inconnu, veuillez réessayer.' },
  { re: /Request failed with status code (\d+)/g, replace: 'La requête à échouée avec le code de status $1.' },
  {
    re: /^[\s\S]*.*?update or delete on table \"(.*?)\"[\s\S]*.*?on table \"(.*?)\"[\s\S]*$/gim,
    replace: 'Impossible de supprimer un élément $1 qui a une ou des $2.'
  }
]

export default function (s: string) {
  if (s in translations) {
    return translations[s]
  }
  for (const reTranslation of reTranslations) {
    if (reTranslation.re.test(s)) {
      return s.replace(reTranslation.re, reTranslation.replace)
    }
  }
  return s
}
