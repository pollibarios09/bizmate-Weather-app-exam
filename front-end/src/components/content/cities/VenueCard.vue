<template>
  <v-card
    class="mx-auto"
    max-width="800"
    outlined
  >
    <v-list-item three-line>
      <v-list-item-content>

        <v-list-item-title class="headline mb-1">
          {{name}}
        </v-list-item-title>
        <v-list-item-subtitle>{{location.address}}, {{location.city}}, {{location.country}}</v-list-item-subtitle>
      </v-list-item-content>

      <v-list-item-avatar
        tile
        size="80"
        color="grey"
      ></v-list-item-avatar>
    </v-list-item>

  </v-card>
</template>

<script>
export default {
    name: "VenueCard",
    props: [
        'name',
        'location',
        'id'
    ]
}
</script>