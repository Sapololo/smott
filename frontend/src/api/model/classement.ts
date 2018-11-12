import { IdData } from '.'

export default class ClassementModel extends IdData<number> {
  date?: string | null = null
  points?: string | null = null
  anciensPoints?: string | null = null
  classement?: string | null = null
  rangNational?: string | null = null
  rangRegional?: string | null = null
  rangDepartemental?: string | null = null
  pointsOfficiels?: string | null = null
  pointsInitials?: string | null = null
}
