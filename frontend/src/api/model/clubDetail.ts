import { IdData } from '.'

export default class ClubDetailModel extends IdData<number> {
  numero: number
  nom?: string | null = null
  nomSalle?: string | null = null
  adresseSalle1?: string | null = null
  adresseSalle2?: string | null = null
  adresseSalle3?: string | null = null
  codePostaleSalle?: string | null = null
  villeSalle?: string | null = null
  siteWeb?: string | null = null
  nomCoordo?: string | null = null
  prenomCoordo?: string | null = null
  mailCoordo?: string | null = null
  telCoordo?: string | null = null
  latitude?: any | null = null
  longitude?: any | null = null
}
