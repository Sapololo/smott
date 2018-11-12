import { IdData } from '.'

export default class OrganismeModel extends IdData<number> {
  code: string
  libelle?: string | null = null
}
