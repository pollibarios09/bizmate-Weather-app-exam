<template>
    <div :loading="loading">
        <v-list-item-title class="d-flex justify-center"><h1>{{cityDetails.name}}</h1></v-list-item-title>
        <WeatherInfo v-bind:id="id"/>

        <v-item-group>
            <v-list-item-title class="d-flex headline mb-1 justify-center">
               <h4>Available Venues</h4>
            </v-list-item-title>
            <v-item-item :key="venue.id" v-for="venue in cityDetails.venues">
                <div class="pb-6">
                    <VenueCard v-bind:name="venue.name" v-bind:location="venue.location" v-bind:id="id" />
                </div>
            </v-item-item>
        </v-item-group>
    </div>
    
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import VenueCard from '@/components/content/cities/VenueCard'
import WeatherInfo from '@/components/content/weather/WeatherInfo'

  
export default {
    name: "Cities",
    data () {
        return {
            loading: false
        }
    },
    components: { 
        VenueCard,
        WeatherInfo
    },
    props: [
        'id'
    ],
    methods: {
        ...mapActions(['getCity']),
        fetchCity () {
            this.loading = true
            this.getCity(this._props.id)
            console.log("here")
            console.log(this.cityDetails)
            this.loading = false
        }
    },
    computed: {
        ...mapGetters(['cityDetails'])
    },
    mounted () {
        this.fetchCity()
    }
}
</script>