import { IdData } from '.'

export default class EquipeModel extends IdData<number> {
  libelle: string | null = null
  division: string | null = null
  lienDivision: string | null = null
  phase: string | null = null
  classement: string | null = null
}
