import { IdData } from '.'

export default class BanqueModel extends IdData<number> {
  id: number
  dtoperation?: string | null = null
  dtvaleur?: Date | null = null
  libelle?: Date | null = null
  debit?: number | null = null
  credit?: number | null = null
  solde?: number | null = null
  ecritureId?: string | null = null
}
