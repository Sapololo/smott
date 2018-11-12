import { IdData } from '.'

export default class CategorieModel extends IdData<number> {
  id: number | null = null
  titre: string | null = null
  description: string | null = null
  slug: string | null = null
  enLigne: string | null = null
}
