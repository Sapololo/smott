import { IdData } from '.'

export default class EcrTypeModel extends IdData<number> {
  id: number
  description?: string | null = null
}
