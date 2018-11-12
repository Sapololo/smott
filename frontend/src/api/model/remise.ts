import { IdData } from '.'
import EcrRubriqueModel from './EcrRubrique'

export default class RemiseModel extends IdData<number> {
  dtecr?: string | null = null
  paiementId?: number | null = null
  titulaire?: string | null = null
  titulaireBanque?: string | null = null
  numChq?: number | null = null
  montant?: number | null = null
}
