import { IdData } from '.'

export default class EquipePouleModel extends IdData<number> {
  classement: number
  nomEquipe: string
  matchJouees: number
  points: number
  numero: string
  victoires: number
  defaites: number
  idEquipe: number
  idCLub: string
  nom?: string | null = null
  latitude?: number | null = null
  longitude?: number | null = null
}
