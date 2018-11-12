import { IdData } from '.'

export default class EmailModel extends IdData<number> {
  name?: string | null = null
  email?: string | null = null
  sujet?: string | null = null
  message?: string | null = null
}
