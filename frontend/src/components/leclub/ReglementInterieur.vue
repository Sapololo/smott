<template>
  <div class="reglement-interieur">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>
      <v-layout row wrap>
        <v-toolbar flat dense color="primary">
          <v-toolbar-title>1. Le but</v-toolbar-title>
        </v-toolbar>
        <v-flex xs12>
          <v-card>
            <v-card-text>
              Le règlement intérieur a pour but de préciser les règles de fonctionnement de l'association
              St Marceau
              Orléans TT (ci-après « le club ») dans le cadre de ses statuts (article 11).<br><i>Le
              règlement intérieur
              est consultable à la salle Harismendy et sur le site internet du club.</i></v-card-text>
          </v-card>
        </v-flex>
        <v-toolbar flat dense color="primary">
          <v-toolbar-title>2. Adhésion</v-toolbar-title>
        </v-toolbar>
        <v-flex xs12>
          <v-card>
            <v-card-text>
              <p>Le fait de s’inscrire au club constitue une acceptation de ses statuts et de son règlement
                intérieur.<br>Le
                bureau peut refuser l’adhésion d’un adhérent si son comportement, ou celui de son entourage,
                peut porter
                préjudice à la bonne marche de l’Association. Le bureau n’a pas à justifier officiellement
                ce refus.
              </p>
              <h3 class="headline">a. Généralités</h3>
              <p>Toute personne pour s’entraîner, ou jouer, en compétitions ou en loisirs, doit adhérer au
                club.<br>Les
                adhérents peuvent, sous leur responsabilité, inviter exceptionnellement des parents ou amis
                après en avoir
                avisé un entraîneur ou un membre du bureau, et dans la mesure où des tables sont
                disponibles.<br>Les
                joueurs licenciés dans d’autres clubs, peuvent être admis à s’entraîner avec les adhérents
                du club sur
                invitation d’un entraîneur ou d’un membre du bureau.<br>L’introduction dans une enceinte
                sportive de
                personnes étrangères au club, outre les parents des enfants adhérents, doit faire l’objet
                d’une
                autorisation d’un entraîneur ou d’un membre du bureau ou de la personne chargée de la
                surveillance de
                l’enceinte sportive.</p>
              <p><b><u>Pour adhérer, le joueur doit fournir :</u></b></p>
              <ul>
                <li>La fiche d’inscription dûment complétée, datée et signée. (pour les mineurs, signature
                  obligatoire du
                  tuteur légal) ;
                </li>
                <li>Un certificat médical de non contre-indication à la pratique du tennis de table délivré
                  par un
                  médecin, moins de 3 mois avant l’inscription ;
                </li>
                <li>Ses coordonnées personnelles, et une adresse mail si possible (prévenir le secrétaire en
                  cas de
                  changement de coordonnées ou d’adresse mail) ;
                </li>
                <li>Payer la cotisation complète lors de l’inscription</li>
              </ul>
              <h3 class="headline">b. La cotisation</h3>
              <p>Le paiement de la cotisation pour les adhérents est obligatoire. Elle comprend le coût de
                l’adhésion au
                club et de la licence FFTT, y compris l’assurance.<br>Le bureau pourra refuser la
                réinscription d’un
                membre qui ne serait pas à jour de ses cotisations de la précédente saison, ou qui aurait
                une dette
                quelconque vis à vis du club.</p>
              <h3 class="headline">c. Conditions exceptionnelles d’adhésion</h3><h4 class="headline">i.
              Bénévoles,
              supporters, non-joueurs
            </h4>
              <p>Les bénévoles et supporters, non-joueurs, qui désirent adhérer au club bénéficient d’une
                cotisation à
                montant réduit, déterminé chaque année par le bureau du club.</p><h4 class="headline">ii.
              Jeunes issus des
              groupes
              scolaires encadrés par nos entraîneurs</h4>
              <p>Pour les jeunes issus des groupes scolaires, qui sont encadrés par les entraineurs, le club
                peut prendre
                partiellement en charge le coût de la licence de tennis de table promotionnelle. Les
                entraineurs devront
                réclamer les certificats médicaux nécessaires pour établir la licence de ces jeunes.</p>
              <h4 class="headline">iii. Étudiants et chômeurs</h4>
              <p>Les étudiants peuvent bénéficier d’une cotisation à taux réduit, sur présentation d’un
                justificatif.</p>
              <h3 class="headline">d. Remboursement partiel de l’adhésion</h3>
              <h4 class="headline">i. Remboursement de l’adhésion lors d’une première inscription</h4>
              <p>Dans le cas d’un arrêt volontaire de la pratique, avant le 30 octobre de la saison en cours,
                il sera
                procédé à un remboursement (hors coût de la licence) au prorata du nombre de mois restant
                jusqu’à la fin
                de la saison sportive (fin mai). Après cette date, il ne sera procédé à aucun remboursement,
                sauf à
                remplir une des conditions mentionnées aux deux paragraphes suivants.</p>
              <h4 class="headline">ii. Remboursement de l’adhésion pour raison médicale ou déménagement</h4>
              <p>Dans le cas d’un arrêt de la pratique pour raison médicale ou déménagement, un remboursement
                partiel de
                la cotisation « club » (hors FFTT, licence et assurance) pourra être effectué, au prorata,
                jusqu’au 31 mai
                de la saison en cours, sur justificatif.</p>
              <h4 class="headline">iii. Remboursement de l’adhésion en cas d’exclusion</h4>
              <p>Dans le cas d’exclusion d’un joueur sur décision du bureau du club, un remboursement de
                l’adhésion pourra
                être effectué dans les mêmes conditions que ci-dessus.</p></v-card-text>
          </v-card>
        </v-flex>
        <v-toolbar flat dense color="primary">
          <v-toolbar-title>3. Responsabilité du club.</v-toolbar-title>
        </v-toolbar>
        <v-flex xs12>
          <v-card>
            <v-card-text>
              <h3 class="headline">a. Ouverture du club</h3>
              <p>Les horaires d'ouverture de la salle Harismendy et du gymnase Bernard Pellé sont consultables
                sur le site
                internet du club : http://stmarceautt.fr<br>La gestion des clés incombe au Président du
                club. Le porteur
                d'une clé s'engage à ne pas la dupliquer ou la prêter sans accord. Il devra la restituer sur
                simple
                demande du président.</p>
              <h3 class="headline">b. Responsabilité des entraineurs</h3>
              <p>Il est de la responsabilité des entraineurs de veiller au comportement moral et physique des
                adhérents
                qui leur sont confiés lors des entrainements, compétitions, stages ou animations
                diverses.<br></p>
              <p>L’entraîneur doit provisoirement exclure tout joueur qui par son comportement ou ses propos
                gênerait le
                bon déroulement d’une séance d’entraînement. Il devra reporter l’incident au Conseil
                d’administration. Ce
                dernier statuera sur les suites à lui donner.</p>
              <h3 class="headline">c. Sécurité jeunes enfants</h3>
              <p>Avant de déposer leur(s) enfant(s) au club, les parents doivent s'assurer qu'il y a bien un
                responsable
                dans la salle pour les accueillir (L’existence de lumière dans le local n’est pas
                suffisante).<br>
                Les enfants restent sous la responsabilité des parents, sauf pendant le temps des cours où
                ils sont sous
                la responsabilité de l’encadrant.<br>
                Un enfant pourra être exclu en cas de comportement anormal ou perturbant de ses parents.<br>Pour
                le bon
                déroulement des entraînements et pour éviter de déconcentrer les joueurs, il est souhaitable
                que les
                parents n’interviennent pas pendant les séances.<br>A la fin de l’entraînement, l'enfant
                attendra à
                l'intérieur de la salle que l’on vienne le chercher. Il signalera son départ en compagnie de
                la personne
                qui le prend en charge.<br>Une tenue de sport (short ou pantalon de survêtement, maillot,
                chaussures de
                sport (semelles noires exclues) est exigée aux entraînements. Pas de casquette ou autre «
                couvre-chef
                ».<br>Selon l’âge et le profil des adhérents, les entraineurs désignés par le bureau
                décident de la mise
                en place des groupes d’entrainement et de l’organisation pédagogique la mieux adaptée en
                fonction des
                objectifs fixés.</p>
              <h3 class="headline">d. Assurance - vols</h3>
              <p>Une assurance décès et invalidité permanente est incluse avec la licence. Tout adhérent a la
                possibilité
                de souscrire auprès du club, sur sa demande, une assurance complémentaire payante.<br>Le
                club ne peut être
                tenu pour responsable des vols ou dégradation d’effets personnels appartenant aux adhérents,
                compétiteurs
                ou accompagnateurs.</p>
              <h3 class="headline">e. Utilisation de l’image des adhérents licenciés</h3>
              <p>Le club se réserve le droit d’utiliser l’image des adhérents licenciés dans le cadre de la
                promotion de
                l’association tennis de table, sans contrepartie (financière notamment), sauf refus écrit de
                leur
                part.</p></v-card-text>
          </v-card>
        </v-flex>
        <v-toolbar flat dense color="primary">
          <v-toolbar-title>4. Les gymnases, le club-house, les bureaux et le matériel.</v-toolbar-title>
        </v-toolbar>
        <v-flex xs12>
          <v-card>
            <v-card-text>
              <p>Après chaque compétition ou entraînement, le gymnase Bernard Pellé doit être remis en ordre.
                L’ensemble
                du matériel sera rangé dans le local spécifique, les gradins seront vides de tous détritus
                et le local à
                droite de l’entrée sera propre.<br>Après chaque entraînement ou compétition, quel que soit
                la salle, les
                balles doivent être ramassées. Les papiers, les bouteilles d’eau etc … doivent être mis à la
                poubelle.<br>Le
                matériel doit être respecté: Tables, filets, tables de marque, marqueurs, robot,
                séparations, etc.
                (l’utilisation du robot ne se faisant qu’avec une personne autorisée).<br>Il est interdit de
                stationner
                des vélos dans l’enceinte des locaux. Des locaux spécifiques, fermés à clés, sont à
                disposition. Le
                dirigeant ou le capitaine qui a ouvert la salle informera les intéressés sur la procédure à
                suivre.</p>
              <p>Le matériel de restauration mis à la disposition des joueurs club-house (tables, chaises,
                four,
                micro-ondes, produits et matériel d’entretien) devra être nettoyé et soigneusement rangé
                après
                utilisation.<br>L'accès et l'utilisation du matériel de bureau (ordinateur, téléphone,
                archives...) sont
                strictement réservés aux membres du bureau.</p></v-card-text>
          </v-card>
        </v-flex>
        <v-toolbar flat dense color="primary">
          <v-toolbar-title>5. Les compétitions des jeunes et des adultes.</v-toolbar-title>
        </v-toolbar>
        <v-flex xs12>
          <v-card>
            <v-card-text>
              <h3 class="headline">a. Engagement des équipes</h3>
              <p>Le bureau décide chaque année, sur proposition des entraîneurs, du nombre d’équipes engagées
                dans les
                différents championnats.</p>
              <h3 class="headline">b. Constitution des équipes pour les compétitions</h3>
              <p>La constitution des équipes pour les compétitions et leurs éventuelles modifications en cours
                de saison
                sont du ressort du bureau sur proposition des entraîneurs. Dans la mesure du possible, la
                constitution des
                équipes tient compte des classements, des affinités des joueurs, des problèmes de
                transport.</p>
              <h3 class="headline">c. Participation des joueurs, parents, spectateurs et entraîneurs</h3>
              <p>Le joueur doit:</p>
              <p>Consulter le plus souvent possible sur le site internet du club, les informations d’ordre
                général, les
                compétitions, les stages, etc.… qui le concernent.</p>
              <p>Participer aux compétitions pour lesquelles il s’est inscrit en début de saison (calendrier
                disponible
                sur le site internet du club).</p>
              <p>Informer le responsable le plus tôt possible en cas d’absence.</p>
              <p>Respecter les règles du tennis de table et garder l’esprit sportif en toute occasion.</p>
              <p>Donner une bonne image du club (accueil, sportivité, respect de l’adversaire, de l’arbitre,
                de ses
                coéquipiers, etc) …</p>
              <p>Le capitaine d’équipe doit</p>
              <ul>
                <li>Veiller au montage et démontage des aires de jeux pour les matches de son équipe.</li>
                <li>Établir la feuille de match, payer les frais d’arbitrage s’il y a lieu</li>
                <li>Tenir le décompte des frais de déplacements (frais d’arbitrage, transports et
                  exceptionnellement,
                  repas) de son équipe.
                </li>
              </ul>
              <br>Les amendes dues à des manquements au règlement fédéral sont à la charge des joueurs
              (forfait non
              justifié, défaut de maillot, feuille de match etc...).<p></p>
              <p>Les parents et spectateurs doivent :<br>Ne pas perturber la partie en cours ou les autres
                parties se
                déroulant dans la même salle par des encouragements bruyants excessifs. Les encouragements
                doivent être
                courtois, et s’interdire d’être désobligeants vis à vis de(s) joueur(s) de l’équipe adverse.
              </p>
              <p>Veiller à ne pas exercer une pression psychologique excessive sur les joueurs, notamment sur
                les plus
                jeunes.</p>
              <p>Les entraîneurs veilleront à :</p>
              <ul>
                <li>Donner des conseils au(x) joueur(s) lors des interruptions de jeu légales.</li>
              </ul>
              <p></p>
              <p>Éviter toute intervention directe de tiers (parents, amis ou autre joueur) auprès d’un
                joueur. Dans
                l’éventualité contraire, un entraîneur, le capitaine d’équipe ou son accompagnateur sera
                fondé de demander
                à la personne enfreignant cette règle de quitter la salle.</p>
              <p>Le règlement institué par les instances du tennis de table pour les compétitions fait
                obligation aux
                parents de suivre leurs enfants depuis les tribunes, et non dans l’aire de jeu. Seul
                l'entraîneur, s’il
                est présent, peut rester autour des aires de jeu et conseiller le joueur pendant les
                matches.</p>
              <h3 class="headline">d. Tenue</h3>
              <p>En compétition et à l’entraînement, une tenue sportive est obligatoire (short, tee-shirt,
                jogging,
                chaussures de sport d’intérieur (semelles noires exclues), pas de couvre-chef.<br>En
                compétition par
                équipe le short noir et le maillot du club sont obligatoires.<br>Le tarif d’achat du
                matériel et de la
                tenue du club est identique pour les compétiteurs ou les loisirs.<br>Afin de respecter
                l'intimité de
                chacun, il est obligatoire de se changer dans les vestiaires du club.</p>
              <h3 class="headline">e. Règles pour les déplacements</h3>
              i. Généralités
              <p>Les déplacements se font dans un (ou des) véhicule(s) personnel(s).<br>Le conducteur du
                véhicule doit
                avoir le permis de conduire en état de validité. Il est responsable du respect des règles de
                circulation
                et doit supporter seul les éventuelles conséquences (amendes et retrait de points).<br></p>
              <p>Dans la mesure du possible, les joueurs d’une équipe assureront à tour de rôle le transport
                de leurs
                partenaires. Le capitaine de l’équipe est chargé de veiller à la bonne gestion de cette
                règle.<br>Chaque
                parent dont le ou les enfants font des compétitions, s'engage à :<br>Accompagner leur(s)
                enfant(s)
                mineur(s) ou se mettre d’accord avec d’autres parents pour faire du covoiturage. Prévoir
                plusieurs
                déplacements dans la saison<br>Assurer la surveillance des enfants du club engagés dans la
                même
                compétition<br>A noter : pour les déplacements, tous les contrats d’assurance auto
                garantissent
                obligatoirement tous les passagers transportés (seule la garantie du conducteur est en
                option). De plus,
                l’assurance du club pourra, en cas d’accident responsable ou non, prendre en charge une
                partie des débours
                non remboursés par l’assurance du véhicule.</p>
              <h4 class="headline">ii. Remboursement des frais de déplacement</h4>
              <p>Les remboursements de frais de déplacements n’ont lieu que sur présentation de justificatifs
                (factures,
                tickets de caisse ou de péage).<br>L’abandon des frais kilométriques donnera lieu à la
                remise d’une
                attestation qui permettra au conducteur de bénéficier d’une remise d’impôts.
                Exceptionnellement, si un
                joueur ou un accompagnateur justifiait qu’il ne peut bénéficier de la remise d’impôts, les
                frais
                kilométriques lui seraient remboursés par le club. Une attestation n’est attribuée que pour
                la présence de
                2 joueurs minimum dans la voiture.<br>Exceptionnellement, pour des déplacements de longue
                distance (trajet
                simple supérieur à 1h45 ou 150 km) chaque joueur peut se voir attribuer une participation
                aux frais de
                repas d’un montant maximum de 10 € sur présentation d’une facture d’un montant égal ou
                supérieur à ce
                montant.</p></v-card-text>
          </v-card>
        </v-flex>
        <v-toolbar flat dense color="primary">
          <v-toolbar-title>6. Sécurité, hygiène et santé.</v-toolbar-title>
        </v-toolbar>
        <v-flex xs12>
          <v-card>
            <v-card-text>
              <p>La prévention des risques d’accident est impérative dans les gymnases. Elle exige de chacun
                le respect
                total de toutes les prescriptions en matière d’hygiène et de sécurité.</p>
              <h3 class="headline">a. Hygiène et santé</h3>
              <h4 class="headline">i. Vestiaires et douches</h4>
              <p>Les vestiaires et douches mis à la disposition pour les adhérents ou les personnes venant
                jouer en
                compétition doivent être conservés dans un constant état de propreté.<br>Aucune personne en
                état d’ébriété
                ne peut être admise dans les enceintes sportives.<br>Il est interdit aux adhérents
                d’introduire des
                boissons alcoolisées dans l’enceinte des gymnases. Seuls les membres du bureau sont
                autorisés à
                approvisionner des boissons alcoolisées pour les besoins de réception des équipes adverses
                ou des
                festivités exceptionnelles.<br>Chaque adhérent doit veiller à ce que des boissons
                alcoolisées ne soient
                servies à des mineurs.</p>
              <h4 class="headline">ii. Drogue</h4>
              <p>Il est interdit à toute personne de pénétrer dans les gymnases en possession de drogues ou
                produits
                stupéfiants et, a fortiori, sous l’emprise d’une drogue quelconque. Tout adhérent qui
                contrevient à cette
                règle sera exclu.</p>
              <h4 class="headline">iii. Tabac</h4>
              <p>Il est interdit de fumer dans l’enceinte sportive et dans tous les lieux à usage collectif.
                Le club est
                engagé dans la lutte contre le tabagisme qui est contraire à sa politique d’amélioration du
                bien-être et
                de la santé des joueurs.</p>
            </v-card-text>
          </v-card>
        </v-flex>
        <v-toolbar flat dense color="primary">
          <v-toolbar-title>7. Discipline.</v-toolbar-title>
        </v-toolbar>
        <v-flex xs12>
          <v-card>
            <v-card-text>
              <h3 class="headline">a. Objets personnels</h3>
              <p>Il est interdit d’introduire sur les lieux de l’enceinte sportive des objets personnels dont
                le port et
                la détention sont interdits par les textes légaux.</p>
              <h3 class="headline">b. Matériel de propagande ou de publicité</h3>
              <p>La diffusion ou l’affichage dans les enceintes sportives de journaux, tracts, imprimés,
                brochures,
                photographies, pétitions, est soumise à l’autorisation préalable du bureau, à l’exception
                des publications
                qui concernent l’activité sportive effectuée dans ces enceintes.</p>
              <h3 class="headline">c. Introduction de personnes qui ne sont pas adhérentes au club</h3>
              <p>L’introduction dans une enceinte sportive de personnes étrangères au club, outre les parents
                des enfants
                adhérents, doit faire l’objet d’une autorisation d’un entraîneur ou d’un membre du bureau ou
                de la
                personne chargée de la surveillance de l’enceinte sportive.</p>
              <h3 class="headline">d. Manquement aux règles de discipline et de respect dans l’enceinte
                sportive</h3>
              <p>Toute personne qui remarquerait un comportement irrespectueux, irresponsable ou autre à
                l’intérieur de
                l’enceinte sportive doit en informer obligatoirement un des responsables du club présent
                lors de
                l’incident (entraîneur, membre du bureau). Si aucun responsable du club n’est présent lors
                de l’incident,
                on en référera à la personne chargée de la surveillance de l’enceinte sportive. Celui-ci a
                tous les
                pouvoirs pour régler ce type de problème (exclusion de la personne, fermeture de la salle,
                appel des
                représentants de la force publique).<br>Dans tous les cas, le conseil d’administration en
                sera informé
                afin qu’il puisse prendre les mesures qui s’imposent envers les personnes à l’origine de cet
                incident.</p>
              <h3 class="headline">e. Respect des personnes et des biens</h3>
              <p>Chaque membre adhérent est tenu de respecter les personnes et les biens du club notamment en
                s’abstenant
                :</p>
              <ul>
                <li>D’avoir à l’égard des autres membres adhérents, des membres, des personnes des autres
                  clubs venant
                  effectuer une compétition, une attitude incorrecte, agressive, injurieuse ou menaçante ;
                </li>
                <li>De dégrader ou de souiller les équipements mis à leur disposition ou les installations
                  sportives ;
                </li>
                <li>De nuire à la qualité des entrainements proposés par nos entraineurs</li>
                <li>De porter atteinte à la réputation du club ;</li>
                <li>D’entraver le déroulement des entrainements ou des compétitions.</li>
              </ul>
              <p></p>
              <h3 class="headline">f. Respect du règlement - sanctions.</h3>
              <p>Le bureau saisi le conseil d’administration pour statuer sur tout manquement aux règles du
                présent
                règlement. Ce dernier entend les explications de l’adhérent convoqué à cet effet.<br>Les
                sanctions
                éventuelles pourront aller du simple avertissement à l’exclusion temporaire ou définitive du
                club.</p>

            </v-card-text>
          </v-card>
        </v-flex>
      </v-layout>
    </div>
  </div>

</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator'
import Banner from '../Banner.vue'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'

@Component({ components: { Banner } })
export default class ReglementInterieur extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }
}
</script>
