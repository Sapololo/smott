import { IdData } from '.'

export default class RencontreModel extends IdData<number> {
  clubEquipeA: string
  clubEquipeB: string
  libelle: string
  nomEquipeA: string
  nomEquipeB: string
  scoreEquipeA: number
  scoreEquipeB: number
  lien: string
  datePrevue?: Date | null = null
  dateReelle?: Date | null = null
}
