import { IdData } from '.'

export default class CarteModel extends IdData<number> {
  id?: number | null = null
  latitude?: number | null = null
  longitude?: number | null = null
  clubId?: number | null = null
  slug?: string | null = null
  nom?: string | null = null
  email?: string | null = null
}
