import { IdData } from '.'

export default class BadgeModel extends IdData<number> {
  id?: number | null = null
  contenu?: string | null = null
  description?: string | null = null
  slug?: string | null = null
  titre?: string | null = null
}
