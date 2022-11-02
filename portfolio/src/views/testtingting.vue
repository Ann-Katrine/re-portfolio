<template>
    <div>
        <h3 id="first">halløøøøøøøøøøøøøøøøøøøøøøøjsa</h3>
        <div id="hello">
            <h1>hello1</h1>
        </div>
        <button @click="test()">her</button>
        <div class="backgrundImg stolteProjektBoks" id="stolteProjekt">
            <h2 class="slideOverskrifter">Mest stolte Projekt</h2>
            <img :src="faroriteProjekt.images[1]" :alt="faroriteProjekt.images[0]" class="stolteProjektImages">  
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    name: "test1",
    data(){
        return{
            faroriteProjekt: [],
            windowswidth: 0
        }
    },
    created(){
        this.getFavoriteProject()
    },
    mounted(){
      this.$nextTick(function() {
        window.addEventListener('resize', this.getWindowWidth);
        //Init
        //this.getWindowWidth()
      })
    },
    updated(){
        this.getWindowWidth()
    },
    methods:{
        getFavoriteProject(){
        axios
          .get('http://localhost/re-portfolio/API/index.php/api/projekt/favorit',{
            headers: {
              'Accept': 'application/json'
            }
          })
          .then(Response => {
            this.faroriteProjekt = Response.data
            console.log(this.faroriteProjekt)
          })
          .catch(err => {
            console.log(err.toString());
          })
      },
        test(){
            // let first = document.getElementById("first")
            let plads1 = document.getElementById("hello")
            // let tal = 0
            let tal1 = 0
            // tal = first.offsetTop
            this.getOffSetTop(plads1);
            console.log(this.getOffSetTop(plads1))
            console.log("her nu");
            tal1 = plads1.offsetTop
            // console.log(tal)
            console.log(tal1)
        },
        getOffSetTop(element){
            let offsetTop = 0;
            while(element) {
                offsetTop += element.offsetTop;
                element = element.offsetParent;
            }
            return offsetTop;
        },
        getWindowWidth(event) {
        this.windowswidth = window.innerWidth;
        this.test()
      }

    }
}
</script>

<style>
    #hello{
        width: 100%;
    height: 31em;
    padding: 0;
    padding-bottom: 5%;
    }
    h3{
        font-size: 4em;
        margin-bottom: 5em;
    }
</style>

