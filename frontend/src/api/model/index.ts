export class IdData<T> {
  id?: T | null = null
}

export class AbstractData extends IdData<number> {
}

export class User {
  id: string | null = null
  username: string | null = null
  firstName: string | null = null
  name: string | null = null
}
