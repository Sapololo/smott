import { IdData } from '.'

export default class PartieRencontreModel extends IdData<number> {
  adversaireA?: string | null = null
  adversaireB?: string | null = null
  scoreA?: string | null = null
  scoreB?: string | null = null
}
