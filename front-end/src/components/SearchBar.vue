<template>
  <v-toolbar
    dark
    color="blue"
  >
    <v-toolbar-title>
      <router-link to="/">
      Home
      </router-link>
    </v-toolbar-title>
    <v-autocomplete
      v-model="select"
      :loading="loading"
      :items="items"
      item-text="name"
      item-value="id"
      :search-input.sync="search"
      cache-items
      class="mx-4"
      flat
      hide-no-data
      hide-details
      label="Which city you are planning to visit?"
      solo-inverted
    ></v-autocomplete>
    <v-btn text color="primary" @click="submit">Search</v-btn>
  </v-toolbar>
</template>

<script>
  import { mapGetters, mapActions } from 'vuex'

  export default {
    name: 'SearchBar',
    methods: {
      ...mapActions(['fetchCities']),
      querySelections (v) {
        this.loading = true
        setTimeout(() => {
          this.fetchCities(v)
          this.items = this.allCities.map(obj => {
            return {
              name: obj.name,
              id: obj.id
            }
          })
          console.log(this.items);
          this.loading = false
        }, 100)
      },
      submit() {
        console.log(this.select)
        this.$router.push(`/city/${this.select}`)
      }
    },
    computed: {
      ...mapGetters(['allCities'])
    },
    data () {
      return {
        loading: false,
        items: [],
        search: null,
        select: {
          name: null,
          id: null
        }
      }
    },
    watch: {
      search (val) {
        val && val !== this.select && this.querySelections(val)
      },
    },
  }
</script>