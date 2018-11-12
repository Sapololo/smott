import { IdData } from '.'

export default class JoueurDetailModel extends IdData<number> {
  licence: string | null = null
  nom?: string | null = null
  prenom?: string | null = null
  numClub?: string | null = null
  nomClub?: string | null = null
  isHomme?: boolean | null = null
  type?: string | null = null
  certif?: string | null = null
  categorie?: string | null = null
  classement?: string | null = null
  validation?: string | null = null
  pointDebutSaison?: number | null = null
  pointsLicence?: number | null = null
  pointsMensuel?: number | null = null
  pointsMensuelAnciens?: number | null = null
  natio?: string | null = null
  arb?: string | null = null
  ja?: string | null = null
  tech?: string | null = null
}
