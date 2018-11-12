import { IdData } from '.'

export default class PartieModel extends IdData<number> {
  isVictoire?: string | null = null
  journee?: string | null = null
  date?: Date | null = null
  pointsObtenus: number = 0
  coefficient: number = 0
  adversaireLicence?: string | null = null
  adversaireIsHomme?: string | null = null
  adversaireNom?: string | null = null
  adversairePrenom?: string | null = null
  adversaireClassement?: string | null = null
}
