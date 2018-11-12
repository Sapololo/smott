import { IdData } from '.'
import JoueurModel from '@/api/model/joueur'
import PartieRencontreModel from '@/api/model/partieRencontre'

export default class RencontreDetailModel extends IdData<number> {
  nomEquipeA?: string | null = null
  nomEquipeB?: string | null = null
  scoreEquipeA: number | null = null
  scoreEquipeB: number | null = null
  joueursA: JoueurModel | null = null
  joueursB: JoueurModel | null = null
  parties: PartieRencontreModel | null = null
}
