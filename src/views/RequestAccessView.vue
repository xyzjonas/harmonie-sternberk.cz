<template>
<div class="container">

<section class="hero">
  <div class="hero-body pt-5 pb-0">
    <p class="title">Jsem člen orchestru</p>
    <p class="subtitle">Vytvořit nový účet</p>
  </div>
</section>

<section v-if="!submitted" class="section pt-5">
  <UserForm
    :loading="loading"
    :error="error"
    @submit="send"
    @cancel="$router.push({name: 'home'})"
  />
</section>
<section v-else class="hero is-large has-text-centered mt-5">
  <div class="hero-body">
    <div class="">
      <p class="title">
        Žádost o přístup odeslána
        <span class="icon ml-2 has-text-success">
          <i class="fa-regular fa-circle-check"></i>
        </span>
      </p>
    </div>
  </div>
</section>

  
</div>
</template>

<script>
import axios from 'axios';
import UserForm from '../components/UserForm.vue';

export default {

  components: { UserForm },

  data() {
    return {
      loading: false,
      submitted: false,
      error: false,
    }
  },

  methods: {

    send(userData) {
      this.loading = true;
      axios.post("/php/user_request.php", userData)
           .then(res => this.submitted = true)
           .catch(err => {
             console.log(err);
             this.error = "Ups... Chybka se vloudila, zkus to, prosím, později."
           })
           .finally(() => this.loading = false)
    }

  }

}
</script>

<style>

</style>