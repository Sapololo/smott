import { IdData } from '.'

export default class HistoriqueModel extends IdData<number> {
  anneeDebut?: number | null = null
  anneeFin?: number | null = null
  phase: number = 0
  points?: number | null = null
}
