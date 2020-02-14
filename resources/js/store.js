import Vuex from 'vuex'
import Vue from 'vue'
Vue.use(Vuex)

export const store = new Vuex.Store({
    state: {
        entities: []
    },
    mutations: {
        initEntities(state, entities) {
            state.entities = entities;
        },
        addEntity(state, entity) {
            state.entities.unshift(entity); // Push to front
        }
    }
})
