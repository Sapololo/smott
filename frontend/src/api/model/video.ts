import { IdData } from '.'

export default class VideoModel extends IdData<number> {
  id?: number
  categoryId?: number
  userId?: number
  titre?: string | null = null
  slug?: string | null = null
  lien?: string | null = null
  enLigne?: boolean | null = null
  important?: boolean | null = null
  creation?: string | null = null
  modification?: string | null = null
}
