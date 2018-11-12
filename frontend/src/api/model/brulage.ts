import { IdData } from '.'

export default class BrulageModel extends IdData<number> {
  nomJoueur?: string | null = null
  date?: string | null = null
  equipe?: string | null = null
  phase?: string | null = null
}
