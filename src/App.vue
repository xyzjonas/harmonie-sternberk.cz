<script>
import { computed } from 'vue';
import axios from 'axios';

import { RouterLink, RouterView } from 'vue-router'
import Navbar from './components/Navbar.vue'
import FooterMain from './components/FooterMain.vue'

export default {

  components: { Navbar, FooterMain },

  data() {
    return {
      user: null,
      events: [],
      loadingEvents: false,
      configHeaders: { "Accept": "application/json" }
    }
  },

  provide() {
    // Expose for the entire application scope:
    return {
      user: computed(() => this.user),  // logged-in user
      events: computed(() => this.events),  // queried events
      loadingEvents: computed(() => this.loadingEvents),
    }
  },

  created() {
    this.getUser();
  },

  mounted() {
    this.getEvents();
  },

  methods: {

    getUser() {
      axios
        .get('/php/login.php', { headers: this.configHeaders })
        .then(res => this.user = res.data)
        .catch(err => this.user = null)
    },

    getEvents() {
      this.loadingEvents = true
      axios
        .get('/php/events_public_get.php', { headers: this.configHeaders })
        .then(res => { this.events = res.data; })
        .catch(err => { this.events = []; console.error(err) })
        .finally(() => {
          console.info("finally...")
          this.loadingEvents = false
        })
    },

    logout() {
      axios.delete('/php/login.php');
    }

  }

}

</script>

<template>
  <div class="page-wrapper">
    
    <Navbar @logout="user=null" @login="getUser"/>
    
    <hr class="mt-0 mb-0">

    <RouterView/>

    <div class="footers">
      <FooterMain/>
    </div>

    </div>
</template>

<style>

@import './assets/mystyles.css';

html {
  height: 100%;
}

body {
  height: 100%;
}

#app {
  height: 100%;

  font-family: 'Catamaran', sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

.page-wrapper {
  min-height: 100vh;
}

.footers {
  position: sticky;
  top: calc(100vh - 50px);
  width: 100%;
}

.hr-bottom {
  border-bottom: solid 1px #ddd;
}

/*
  TRANSITIONS
  for the entire app are located here
*/

.v-enter-active {
  transition: all 0.3s ease-out;
}

.v-leave-active {
  transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}

.v-enter-from,
.v-leave-to {
  transform: translateY(10px);
  opacity: 0;
}

/* --- */

.slide-fade-leave-active,
.slide-fade-enter-active {
  transition: all 0.2s ease-out;
}

.slide-fade-enter-from {
  transform: translateX(-30px);
  opacity: 0;
}
.slide-fade-leave-to {
  transform: translateX(30px);
  opacity: 0;
}



</style>