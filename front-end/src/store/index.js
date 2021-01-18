import Vuex from 'vuex'
import Vue from 'vue'
import cities from './modules/cities'
import weather from './modules/weather'


Vue.use(Vuex)

const store = new Vuex.Store({
    modules: {
      cities: cities,
      weather: weather
    }
})
export default store