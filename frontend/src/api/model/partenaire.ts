import { IdData } from '.'

export default class PartenaireModel extends IdData<number> {
  id?: number
  categoryId?: number
  titre?: string | null = null
  image: string
  imageLarge: string
  contenu?: string | null = null
  contenuMeta?: string | null = null
  lien?: string | null = null
  enLigne?: boolean | null = null
  taille?: number
  lat?: number
  lng?: number
}
