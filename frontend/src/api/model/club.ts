import { IdData } from '.'

export default class ClubModel extends IdData<number> {
  numero: number
  nom?: string | null = null
  dateValidation?: string | null = null
}
