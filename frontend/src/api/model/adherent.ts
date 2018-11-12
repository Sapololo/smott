import { IdData } from '.'
import VilleModel from '@/api/model/ville'
import UserModel from '@/api/model/user'

export default class AdherentModel extends IdData<number> {
  id: number | null = null
  licenceId?: string | null = null
  nom?: string | null = null
  prenom?: string | null = null
  classement?: string | null = null
  type?: string | null = null
  isHomme?: boolean | null = null
  pointsLicence?: string | null = null
  pointsMensuel?: string | null = null
  pointsVirtuel?: string | null = null
  classVirtuel?: string | null = null
  ville?: VilleModel | null = null
  numero?: string | null = null
  voie?: string | null = null
  rue?: string | null = null
  perso?: string | null = null
  portable?: string | null = null
  prof?: string | null = null
  resp?: string | null = null
  prof1?: string | null = null
  prof2?: string | null = null
  user?: UserModel | null = null
  lat?: number | null = null
  lng?: number | null = null
}
