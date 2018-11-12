import { IdData } from '.'

export default class ActualiteModel extends IdData<number> {
  date?: string | null = null
  titre?: string | null = null
  description?: string | null = null
  url?: string | null = null
  photo?: string | null = null
}
