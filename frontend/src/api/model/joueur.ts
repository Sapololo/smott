import { IdData } from '.'

export default class JoueurModel extends IdData<number> {
  nom?: string | null = null
  prenom?: string | null = null
  points?: string | null = null
  sexe?: string | null = null
  licence?: boolean | null = null
}
