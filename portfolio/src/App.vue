<template>
  <div>
    <navbar></navbar>
    <router-view/>
  </div>
</template>

<script>
import navbar from './components/navbar.vue'

export default {
  name: 'listeSlot',
  created(){
    this.stickNavbar();
  },
  mounted(){
    window.addEventListener('scroll', this.stickNavbar) // laver en event.
  },
  methods:{
    stickNavbar(){
      let navbar = document.getElementById("navbar");
      let forside = document.getElementById("forside");

      // Bruger eventer scroll for at se hvornår man rækker sig op eller ned på siden
      if(window.scrollY > 0){
        navbar.classList.add("sticky");
        forside.classList.add("strickyForsideHeigth");
      }
      else{
        navbar.classList.remove("sticky");
        forside.classList.remove("strickyForsideHeigth");
      }
    }
  },
  components:{
    navbar
  }
}
</script>

<style>
  a, p, h1, h2{
    color: #607272;
  }
</style>
