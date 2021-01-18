<template>
  <v-app>
    <v-main>
      <SearchBar/>
      <router-view :key="$route.path"></router-view>
    </v-main>
  </v-app>
</template>

<script>
import SearchBar from './components/SearchBar';


export default {
  name: 'App',

  components: {
    SearchBar
  },

  data: () => ({
    //
  }),
};
</script>
