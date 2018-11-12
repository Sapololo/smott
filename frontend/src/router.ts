import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/views/Home.vue'
import Article from '@/views/Article.vue'
import Contact from '@/views/Contact.vue'
import LeClub from '@/views/LeClub.vue'
import MonProfil from '@/components/utilisateur/MonProfil.vue'
import ModifierMotDePasse from '@/components/utilisateur/ModifierMotDePasse.vue'
import CarteLicencie from '@/components/utilisateur/CarteLicencie.vue'
import Affiches from '@/components/leclub/Affiches.vue'
import CadresSportifs from '@/components/leclub/CadresSportifs.vue'
import NosPartenaires from '@/components/leclub/Partenaires.vue'
import DevenezPartenaires from '@/components/leclub/PartenairesDevenez.vue'
import CarteDesPartenaires from '@/components/leclub/PartenairesCarte.vue'
import PingSansFrontieres from '@/components/leclub/PartenairesPSF.vue'
import Calendrier from '@/components/leclub/Calendrier.vue'
import Evenement from '@/components/leclub/Event.vue'
import Photos from '@/components/leclub/Photos.vue'
import Labels from '@/components/leclub/Labels.vue'
import LeBureau from '@/components/leclub/LeBureau.vue'
import Legendes from '@/components/leclub/Legendes.vue'
import LeMotDeLaPresidente from '@/components/leclub/LeMotDeLaPresidente.vue'
import LesCotisations from '@/components/leclub/LesCotisations.vue'
import Localisation from '@/components/leclub/Localisation.vue'
import QuiFaitQuoi from '@/components/leclub/QuiFaitQuoi.vue'
import ReglementInterieur from '@/components/leclub/ReglementInterieur.vue'
import RevueDePresse from '@/components/leclub/RevueDePresse.vue'
import Statistiques from '@/components/leclub/Statistiques.vue'
import Statuts from '@/components/leclub/Statuts.vue'
import Trombinoscope from '@/components/leclub/Trombinoscope.vue'

import Activites from '@/views/Activites.vue'

import BabyPing from '@/components/activites/BabyPing.vue'

import PendantLesVacances from '@/components/activites/PendantLesVacances.vue'
import StagesMultisports from '@/components/activites/StagesMultisports.vue'

import SoireeEntreprise from '@/components/activites/SoireeEntreprise.vue'
import CoachingPersonnalise from '@/components/activites/CoachingPersonnalise.vue'
import Famille from '@/components/activites/Famille.vue'
import DarkPing from '@/components/activites/DarkPing.vue'
import NouvellesPratiques from '@/components/activites/NouvellesPratiques.vue'
import Headis from '@/components/activites/Headis.vue'

import PingSante from '@/components/activites/PingSante.vue'
import Loisirs from '@/components/activites/Loisirs.vue'
import Handisport from '@/components/activites/Handisport.vue'
import Planning from '@/components/activites/Planning.vue'
import SectionSportive from '@/components/activites/SectionSportive.vue'
import ChangeonsDeRegard from '@/components/activites/ChangeonsDeRegard.vue'
import RentreeEnFete from '@/components/activites/RentreeEnFete.vue'
import OrleansMouv from '@/components/activites/OrleansMouv.vue'
import ChallengeInterEcoles from '@/components/activites/ChallengeInterEcoles.vue'
import Telethon from '@/components/activites/Telethon.vue'
import UrbanPing from '@/components/activites/UrbanPing.vue'
import Formations from '@/components/activites/Formations.vue'

import Competitions from '@/views/Competitions.vue'
import ArbitresEtJugeArbitres from '@/components/competition/ArbitresEtJugeArbitres.vue'
import Cadres from '@/components/competition/Cadres.vue'
import LesLicencesDuClub from '@/components/competition/LesLicencesDuClub.vue'
import Joueur from '@/components/competition/Joueur.vue'
import Recherche from '@/components/competition/Recherche.vue'
import Brulages from '@/components/competition/Brulages.vue'
import Actualites from '@/components/competition/Actualites.vue'
import Equipe from '@/components/competition/Equipe.vue'

import Boutique from '@/views/Boutique.vue'
import mentionslegales from '@/views/MentionsLegales.vue'
import Videos from '@/components/leclub/Videos.vue'

// Administration
import Administration from '@/views/Administration.vue'
import Adherents from '@/components/admin/Adherents.vue'
import CompteResultat from '@/components/admin/CompteResultat.vue'
import Ecritures from '@/components/admin/Ecritures.vue'
import EcrituresAdherent from '@/components/admin/EcrituresAdherent.vue'
import ListeEmail from '@/components/admin/ListeEmail.vue'
import Releves from '@/components/admin/Releves.vue'
import Remises from '@/components/admin/Remises.vue'

import { IStateAccessData } from '@/services/access'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'Home',
      component: Home,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: '' }
    },
    {
      path: '/article/:id(-?\\d+)',
      name: 'Article',
      component: Article,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: '' }
    },
    {
      path: '/contact',
      name: 'Contact',
      component: Contact,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Nous Contacter' }
    },
    {
      path: '/leclub',
      name: 'LeClub',
      component: LeClub,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Le Club' }
    },
    {
      path: '/monprofil',
      name: 'MonProfil',
      component: MonProfil,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Mon Profil' }
    },
    {
      path: '/utilisateur/modifier-mot-de-passe/:token?',
      name: 'ModifierMotDePasse',
      component: ModifierMotDePasse,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Modifier Mot De Passe' }
    },
    {
      path: '/utilisateur/cartelicencie',
      name: 'CarteLicencie',
      component: CarteLicencie,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Carte des licenciés' }
    },
    {
      path: '/leclub/affiches',
      name: 'Affiches',
      component: Affiches,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Les Affiches' }
    },
    {
      path: '/leclub/cadressportifs',
      name: 'CadresSportifs',
      component: CadresSportifs,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Les Cadres Sportifs' }
    },
    {
      path: '/leclub/cartedespartenaires',
      name: 'CarteDesPartenaires',
      component: CarteDesPartenaires,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Carte Des Partenaires' }
    },
    {
      path: '/leclub/calendrier',
      name: 'Calendrier',
      component: Calendrier,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Le Calendrier' }
    },
    {
      path: '/leclub/evenement/:id(-?\\d+)',
      name: 'Evenement',
      component: Evenement,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Evénement' }
    },
    {
      path: '/leclub/photos',
      name: 'Photos',
      component: Photos,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Les Photos' }
    },
    {
      path: '/leclub/labels',
      name: 'Labels',
      component: Labels,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Les Labels' }
    },
    {
      path: '/leclub/lebureau',
      name: 'LeBureau',
      component: LeBureau,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Le Bureau' }
    },
    {
      path: '/leclub/legendes',
      name: 'Legendes',
      component: Legendes,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Les Légendes' }
    },
    {
      path: '/leclub/lemotdelapresidente',
      name: 'LeMotDeLaPresidente',
      component: LeMotDeLaPresidente,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Le Mot De La Présidente' }
    },
    {
      path: '/leclub/localisation',
      name: 'Localisation',
      component: Localisation,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Localisation' }
    },
    {
      path: '/leclub/lescotisations',
      name: 'LesCotisations',
      component: LesCotisations,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Les Cotisations' }
    },
    {
      path: '/leclub/nospartenaires',
      name: 'NosPartenaires',
      component: NosPartenaires,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Nos Partenaires' }
    },
    {
      path: '/leclub/devenezpartenaires',
      name: 'DevenezPartenaires',
      component: DevenezPartenaires,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Être ou devenir Partenaire' }
    },
    {
      path: '/leclub/pingsansfrontieres',
      name: 'PingSansFrontieres',
      component: PingSansFrontieres,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Ping Sans Frontieres' }
    },
    {
      path: '/leclub/quifaitquoi',
      name: 'QuiFaitQuoi',
      component: QuiFaitQuoi,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Qui Fait Quoi' }
    },
    {
      path: '/leclub/revuedepresse',
      name: 'RevueDePresse',
      component: RevueDePresse,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Revue De Presse' }
    },
    {
      path: '/leclub/statistiques/:clubId(-?\\d+)',
      name: 'Statistiques',
      component: Statistiques,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Les Statistiques' }
    },
    {
      path: '/leclub/statuts',
      name: 'Statuts',
      component: Statuts,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Les Statuts' }
    },
    {
      path: '/leclub/trombinoscope',
      name: 'Trombinoscope',
      component: Trombinoscope,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Le Trombinoscope' }
    },
    {
      path: '/leclub/videos',
      name: 'Videos',
      component: Videos,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Les Vidéos' }
    },

    {
      path: '/activites',
      name: 'Activites',
      component: Activites,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Les Activites' }
    },
    {
      path: '/activites/babyping',
      name: 'BabyPing',
      component: BabyPing,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'La Section BabyPing' }
    },
    {
      path: '/activites/pingsante',
      name: 'PingSante',
      component: PingSante,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Le Ping Santé' }
    },
    {
      path: '/activites/Loisirs',
      name: 'Loisirs',
      component: Loisirs,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Loisirs' }
    },
    {
      path: '/activites/handisport',
      name: 'Handisport',
      component: Handisport,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Handisport' }
    },
    {
      path: '/activites/planning',
      name: 'Planning',
      component: Planning,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Planning' }
    },
    {
      path: '/activites/pendant-les-vacances',
      name: 'PendantLesVacances',
      component: PendantLesVacances,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Pendant les vacances' }
    },
    {
      path: '/activites/sectionsportive',
      name: 'SectionSportive',
      component: SectionSportive,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'La Section Sportive' }
    },
    {
      path: '/activites/stagesmultisports',
      name: 'StagesMultisports',
      component: StagesMultisports,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Stages Multisports' }
    },
    {
      path: '/activites/coachingpersonnalise',
      name: 'CoachingPersonnalise',
      component: CoachingPersonnalise,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Coaching Personnalisé' }
    },
    {
      path: '/activites/soireeentreprise',
      name: 'SoireeEntreprise',
      component: SoireeEntreprise,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Soirée Entreprise' }
    },
    {
      path: '/activites/famille',
      name: 'Famille',
      component: Famille,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Famille' }
    },
    {
      path: '/activites/darkping',
      name: 'DarkPing',
      component: DarkPing,
      meta: {
        title: 'Le Dark Ping'
        // metaTags: [
        //   {
        //     name: 'description',
        //     content: 'Rythmée par une ambiance musicale, notre salle spécifique de ping sera entièrement plongée dans le noir et en grande majorité éclairée par de la lumière UV (ou lumière noire)'
        //   },
        //   {
        //     property: 'og:description',
        //     content: 'Rythmée par une ambiance musicale, notre salle spécifique de ping sera entièrement plongée dans le noir et en grande majorité éclairée par de la lumière UV (ou lumière noire)'
        //   }
        // ]
      }
    },
    {
      path: '/activites/nouvelles-pratiques',
      name: 'NouvellesPratiques',
      component: NouvellesPratiques,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'NouvellesPratiques' }
    },
    {
      path: '/activites/headis',
      name: 'Headis',
      component: Headis,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Headis' }
    },
    {
      path: '/activites/changeons-de-regard',
      name: 'ChangeonsDeRegard',
      component: ChangeonsDeRegard,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Changeons De Regard' }
    },
    {
      path: '/activites/rentree-en-fete',
      name: 'RentreeEnFete',
      component: RentreeEnFete,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Rentree En Fete' }
    },
    {
      path: '/activites/orleans-mouv',
      name: 'OrleansMouv',
      component: OrleansMouv,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Orleans Mouv' }
    },
    {
      path: '/activites/challengeInterEcoles',
      name: 'ChallengeInterEcoles',
      component: ChallengeInterEcoles,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Challenge Inter Ecoles' }
    },
    {
      path: '/activites/telethon',
      name: 'Telethon',
      component: Telethon,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Telethon' }
    },
    {
      path: '/activites/urban-ping',
      name: 'UrbanPing',
      component: UrbanPing,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Urban Ping' }
    },
    {
      path: '/activites/formations',
      name: 'Formations',
      component: Formations,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Formations' }
    },
    {
      path: '/competitions',
      name: 'Competitions',
      component: Competitions,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Les Competitions' }
    },
    {
      path: '/competitions/arbitresetjugearbitres',
      name: 'ArbitresEtJugeArbitres',
      component: ArbitresEtJugeArbitres,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'ArbitresEtJugeArbitres' }
    },
    {
      path: '/competitions/cadres',
      name: 'Cadres',
      component: Cadres,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Cadres' }
    },
    {
      path: '/competitions/recherche/:nomJoueur(-?\\d+)&:prenomJoueur(-?\\d+)',
      name: 'Recherche',
      component: Recherche,
      meta: { access: { allowedRoles: ['ROLE_USER', 'ROLE_ADMIN'] } as IStateAccessData, title: 'Recherche' }
    },
    {
      path: '/competitions/les-licences-du-club/:clubId(-?\\d+)',
      name: 'LesLicencesDuClub',
      component: LesLicencesDuClub,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Les Licences Du Club' }
    },
    {
      path: '/competitions/joueur/:licenceId(-?\\d+)',
      name: 'Joueur',
      component: Joueur,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Détail du joueur' }
    },
    {
      path: '/competitions/equipe/:num(-?\\d+)',
      name: 'Equipe',
      component: Equipe,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Equipe' }
    },
    {
      path: '/competitions/actualites',
      name: 'Actualites',
      component: Actualites,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Actualites FFTT' }
    },
    {
      path: '/competitions/brulages',
      name: 'Brulages',
      component: Brulages,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Brulages' }
    },
    {
      path: '/boutique',
      name: 'Boutique',
      component: Boutique,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Boutique' }
    },
    {
      path: '/administration',
      name: 'Administration',
      component: Administration,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Administration' }
    },
    {
      path: '/administration/adherents',
      name: 'Adherents',
      component: Adherents,
      meta: { access: { allowedRoles: ['ROLE_BUREAU', 'ROLE_ADMIN'] } as IStateAccessData, title: 'Adherents' }
    },
    {
      path: '/administration/releves',
      name: 'Releves',
      component: Releves,
      meta: { access: { allowedRoles: ['ROLE_BUREAU', 'ROLE_ADMIN'] } as IStateAccessData, title: 'Releves bancaires' }
    },
    {
      path: '/administration/ecritures/:rubrique(-?\\d+)',
      name: 'Ecritures',
      component: Ecritures,
      meta: { access: { allowedRoles: ['ROLE_ADMIN'] } as IStateAccessData, title: 'Ecritures comptables' }
    },
    {
      path: '/administration/ecrituresAdherent/:licenceId(-?\\d+)',
      name: 'EcrituresAdherent',
      component: EcrituresAdherent,
      meta: { access: { allowedRoles: ['ROLE_BUREAU', 'ROLE_ADMIN'] } as IStateAccessData, title: 'Ecritures par adherent' }
    },
    {
      path: '/administration/listeemail',
      name: 'ListeEmail',
      component: ListeEmail,
      meta: { access: { allowedRoles: ['ROLE_BUREAU', 'ROLE_ADMIN'] } as IStateAccessData, title: 'Liste des emails' }
    },
    {
      path: '/administration/remises/:dt(-?\\d+)',
      name: 'Remises',
      component: Remises,
      meta: { access: { allowedRoles: ['ROLE_BUREAU', 'ROLE_ADMIN'] } as IStateAccessData, title: 'Remises de chéques' }
    },
    {
      path: '/administration/compteresultat',
      name: 'CompteResultat',
      component: CompteResultat,
      meta: {
        access: { allowedRoles: ['ROLE_BUREAU', 'ROLE_ADMIN'] } as IStateAccessData,
        title: 'Compte de résultats'
      }
    },
    {
      path: '/mentionslegales',
      name: 'MentionsLegales',
      component: mentionslegales,
      meta: { access: { allowAnonymous: true } as IStateAccessData, title: 'Mentions Legales' }
    }
  ],
  scrollBehavior (to, from, savedPosition) {
    return { x: 0, y: 0 }
  }
})
