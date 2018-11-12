import { IdData } from '.'

export default class UnValidatedPartieModel extends IdData<number> {
  isVictoire: boolean
  isForfait: boolean
  epreuve: string
  date: Date
  point: number
  adversaireNom: string
  adversairePrenom: string
  adversaireClassement: number
}
