import { IdData } from '.'
import CategorieModel from '@/api/model/categorie'
import BadgeModel from '@/api/model/badge'

export default class EventModel extends IdData<number> {
  id: number
  image: string | null = null
  titre: string | null = null
  categorie: CategorieModel | null = null
  badge: BadgeModel | null = null
  dtdebut: Date | null = null
}

export class EventDetailModel extends EventModel {
  userId?: number | null = null
  contenu?: string | null = null
  contenuMeta?: string | null = null
  slug?: string | null = null
  lien?: string | null = null
  enLigne?: boolean | null = null
  dtfin?: Date | null = null
}
