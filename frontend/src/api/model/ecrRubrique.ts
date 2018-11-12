import { IdData } from '.'

export default class EcrRubriqueModel extends IdData<number> {
  id: number
  code?: number | null = null
  titre?: string | null = null
  description?: string | null = null
}
