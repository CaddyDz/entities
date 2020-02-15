import Vuex from 'vuex'
import Vue from 'vue'
Vue.use(Vuex)

export const store = new Vuex.Store({
    state: {
        entities: [],
        openBranches: []
    },
    getters: {
        isOpen: (state) => (id) => {
            return state.openBranches.some(el => el == id);
        }
    },
    mutations: {
        initEntities(state, entities) {
            state.entities = entities;
        },
        addOpenBranch(state, id) {
            state.openBranches.push(id);
        },
        removeOpenBranch(state, id) {
            _.pull(state.openBranches, id);
        },
        addEntity(state, entity) {
            if (entity.parent_id == null) {
                state.entities.unshift(entity); // Push to front
            }
        }
    }
})
