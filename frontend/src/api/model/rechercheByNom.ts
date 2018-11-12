import { IdData } from '.'

export default class RechercheByNomModel extends IdData<number> {
  nom?: string | null = null
  prenom?: string | null = null
}
