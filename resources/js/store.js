import Vuex from 'vuex'
import Vue from 'vue'
Vue.use(Vuex)

export const store = new Vuex.Store({
    state: {
        entities: []
    },
    // getters: {
    //     entities: state => {
    //         return state.entities
    //     }
    // },
    mutations: {
        addEntity(state, entity) {
            state.entities.unshift(entity); // Push to front
        }
    }
})
