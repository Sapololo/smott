import { IdData } from '.'
import EcrRubriqueModel from './EcrRubrique'
import EcrTypeModel from './EcrType'
import UserModel from './User'

export default class EcritureModel extends IdData<number> {
  id: number | null = null
  dtecr?: string | null = null
  rubrique?: EcrRubriqueModel | null = null
  type?: EcrTypeModel | null = null
  user?: UserModel | null = null
  designation?: string | null = null
  commentaire?: string | null = null
  pieceId?: number | null = null
  titulaire?: string | null = null
  titulaireBanque?: string | null = null
  numChq?: number | null = null
  montant?: number | null = null
  numDepot?: number | null = null
  numReleve?: number | null = null
  enLigne: boolean = false
  modification?: Date | null = null
}

export class EcritureCalculModel extends EcritureModel {
  debit?: number | null = null
  credit?: number | null = null
  banque?: number | null = null
  espece?: number | null = null
}
