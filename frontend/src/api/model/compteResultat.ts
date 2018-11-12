import { IdData } from '.'

export default class CompteResultatModel extends IdData<number> {
  code: string | null = null
  titre: string | null = null
  niveau: number | null = null
  montant: number | null = null
}
