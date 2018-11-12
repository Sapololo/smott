import { IdData } from '.'

export default class ArticleModel extends IdData<number> {
  id: number
  image?: string | null = null
  titre?: string | null = null
  categoryId?: number | null = null
  userId?: number | null = null
  badgeTitre?: string | null = null
}

export class ArticleDetailModel extends ArticleModel {
  contenu?: string | null = null
  contenuMeta?: string | null = null
  slug?: string | null = null
  lien?: string | null = null
  pdf?: string | null = null
  page?: string | null = null
  enLigne?: boolean | null = null
  creation?: string | null = null
  modification?: string | null = null
}
