<template>
  <v-form @submit.prevent="submit" v-model="valid" ref="form" lazy-validation>
    <v-textarea
        label="Name"
        v-model="name"
        :rules="[
    v => !!v || 'Le nom est obligatoire',
    v => v.length <= 10 || 'Le nom doit faire plus de 10 charactéres'
  ]"
        :counter="10"
        required
    ></v-textarea>
    <v-textarea
        label="E-mail"
        v-model="email"
        :rules="[
    v => !!v || 'E-mail est obligatoire',
    v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail doit être valide'
  ]"
        required
    ></v-textarea>

  </v-form>

</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator'

@Component
export default class Contact extends Vue {
  valid: boolean = false
  name: string = ''
  email: string = ''
}
</script>
