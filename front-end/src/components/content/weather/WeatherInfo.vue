<template>
  <v-item-group>
    <v-container>
        <v-list-item-title class="d-flex headline mb-1 justify-center">
            <h4>Weather Forecast Today</h4>
        </v-list-item-title>
        <v-row>
            <v-col
            v-for="details in weatherDetails"
            :key="details.dt"
            cols="12"
            md="4"
            >
                <v-card
                color="white"
                class="align-center"
                >
                    <v-list-item-title class="headline mb-1 d-flex">

                        <div>
                            <v-img 
                                max-height="100"
                                max-width="100"
                                :src="parseImage(details.weather)">
                            </v-img>
                        </div>
                        <v-list-item>{{parseWeather(details.weather)}}</v-list-item>
                    </v-list-item-title>
                    <v-list-item-subtitle>

                        <v-list-item><h1>{{parseTemperature(details.main)}}</h1></v-list-item>
                        <v-list-item>{{parseDate(details.dt_txt)}}</v-list-item>

                    </v-list-item-subtitle>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
  </v-item-group>
</template>


<script>

import { mapActions, mapGetters } from 'vuex'
import moment from 'moment'

export default {
    name: "WeatherInfo",
    props: [
        'id'
    ],
    created() {
        this.getWeather(this.id)
    },
    computed: {
        ...mapGetters(['weatherDetails'])
    },
    methods: {
        ...mapActions(['getWeather']),
        parseTemperature (temperature) {
            return `${temperature.temp}\u00B0 C`
        },
        parseImage (weather) {
            return `http://openweathermap.org/img/wn/${weather[0].icon}@2x.png`
        },
        parseWeather (weather) {
            return `${weather[0].description.toUpperCase()}`
        },
        parseDate (dateTime) {
            return moment(String(dateTime)).format('dddd hh:mm a');
        }
    },
}
</script>