import axios from 'axios'

const state = {
    weather: [],
}

const getters = {
    weatherDetails: state => state.weather
}

const actions = {
    async getWeather({commit}, city_id) {
        const response = await axios.get(`http://localhost:8000/api/cities/${city_id}/weather`)

        commit('setWeather', response.data);
    }
}

const mutations = {
    setWeather: (state, city) => (
        state.weather = city.data
    )
}

export default {
    getters,
    state,
    actions,
    mutations
}
