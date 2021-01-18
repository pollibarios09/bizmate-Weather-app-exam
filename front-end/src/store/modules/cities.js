import axios from 'axios'

const state = {
    cities: [],
    city: null
}


const getters = {
    allCities: state => state.cities,
    cityDetails: state => state.city
}

const actions = {
    async fetchCities({commit}, query) {
        const response = await axios.get(`http://localhost:8000/api/cities?name=${query}`)
        commit('setCities', response.data);
    },
    async getCity({commit}, id) {
        const response = await axios.get(`http://localhost:8000/api/cities/${id}`)

        commit('setCityDetails', response.data);
    }
}

const mutations = {
    setCities: (state, cities) => (
        state.cities = cities.data
    ),
    setCityDetails: (state, city) => (
        state.city = city.data
    )
}

export default {
    getters,
    state,
    actions,
    mutations
}
