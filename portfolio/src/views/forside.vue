<template>
  <div class="home" >
    <div id="forside"> 
      <!-- hero sektion -->
      <div class="heroBoks" > 
        <div class="flexLeft50">
        <img src="../images/mig.png" class="heroImages">
        </div>
        <div class="flexrigth50"> 
          <h1 class="heroOverskrift"> {{ fornavn }} </h1>
          <p class="fixSize">Datateknikker med speciale i programmering</p>
        </div>
      </div>
      <!-- favorite projekt  -->
      <div class="backgrundImg stolteProjektBoks" id="stolteProjekt"> 
        <h2 class="slideOverskrifter" >Mest stolte Projekt</h2>
          <img :src="faroriteProjekt.images.sted" :alt="faroriteProjekt.images.name" class="stolteProjektImages">  
      </div>
      <!-- omkring mig  -->
      <div class="backgrund" id="aboutMe"> 
        <div class="aboutMeBoks stolteProjektBoks">
          <h2 class="slideOverskrifter">Lidt om mig</h2>
          <div class="aboutMeInnerBoks">
            <p v-for="me in profile" :key="me.id" class="aboutMeTeskt"> {{ me.tekst }} </p>
          </div>
        </div>
      </div>
      <!-- mine kvalifikationer -->
      <div class="backgrundImg" id="kvalifikation">  
        <div class="kvalifikationboks">
          <h2 class="slideOverskrifter">Kvalifikationer</h2>
          <div class="kvalifikationInnerBoks">
            <div v-for="qulifi in qulification" :key="qulifi.id" class="kvalifikationTekst">
              <p class="fixKvaliSize"> {{ qulifi.name }} </p>
            </div>
          </div>
        </div>
      </div>
      <!-- 3 nyeste projekter-->
      <div class="backgrund" id="newest3Proejkt"> 
        <h2 class="slideOverskrifter eksOverskrift">Nyeste Projekter</h2>
        <div class="newestBoks ">
          <div v-for="newest in newest3Proejkt" :key="newest.id" class="newestBoksButtom">
            <img :src="newest.images.sted" :alt="newest.images.name" class="newestImages">
            <p class="newestTekst"> {{ newest.name }}</p>
            <div class="newestTriangle"></div>
          </div>
        </div>
      </div>
      <!-- tidslinje over erhverserfæring   -->
      <div class="  backgrundImg" id="workExperiende"> 
        <h2 class="slideOverskrifter">Erhvervserfaring</h2>
        
        <div>
          <div v-for="(work, index) in workExperiende" :key="work.id">
            <div class="boksAroundTimelineBoks">
              <div class="dot"></div>
                <div class="timelineboks">
                  <div class="line"></div>
                  <div v-if="index % 2 == 0" class="boks-right">
                    <p class="timelineTekst"> {{ work.sted }} </p>
                    <p> {{ work.tittel }} </p>
                    <p> {{ fixDate(work.startDate, work.endDate) }} </p>
                  </div>
                  <div  class="boks-left" v-else>
                    <p class="timelineTekst"> {{ work.sted }} </p>
                    <p> {{ work.tittel }} </p>
                    <p> {{ fixDate(work.startDate, work.endDate) }} </p>
                  </div>
              </div>
            </div>
          </div> 
        </div>

      </div>
      <!-- tidslinje over uddannelse-->
      <div class="timelineBaggrund" id="education"> 
        <h2 class="slideOverskrifter">Uddannelse</h2>

        <div class="timelineOuterBoks">
          <div v-for="(edu, index) in education" :key="edu.id">
            <div class="boksAroundTimelineBoks">
              <div class="dot"></div>
                <div class="timelineboks">
                  <div class="line"></div>
                  <div v-if="index % 2 == 0" class="boks-right timelineColorBoks">
                    <p class="timelineTekst"> {{ edu.sted }} </p>
                    <p> {{ edu.tittel }} </p>
                    <p> {{ fixDate(edu.startDate, edu.endDate) }} </p>
                  </div>
                  <div  class="boks-left timelineColorBoks" v-else>
                    <p class="timelineTekst"> {{ edu.sted }} </p>
                    <p> {{ edu.tittel }} </p>
                    <p> {{ fixDate(edu.startDate, edu.endDate) }} </p>
                  </div>
              </div>
            </div>
          </div>
        </div>

      </div>
      <!-- mail -->
      <div class="mailBackgrundImg mailContainer" id="mail"> 
        <div class="mailItems1">
          <h2 class="mailOverskrift">Kontakt mig</h2>
          <div class="mailFlexInput">
            <input v-model="navn" class="mailInput2Bokse" placeholder="Navn">
            <input v-model="email" class="mailInput2Bokse" placeholder="Mail">
          </div>
          <div>
            <input v-model="emne" class="mailInputBokse" placeholder="Emne">
          </div>
          <div>
            <textarea v-model="besked" class="mailTextAreaBoks mailTextareaHeight" placeholder="Besked"></textarea>
          </div>
          <button class="mailButtom" @click="mail()">Send</button>
        </div>
        <div class="mailItems2">
          <h2 class="mailh2Overskrift">Ann-Katrine Thuelund Nykjær</h2>
          <h2 class="mailh2">Mobil</h2>
          <p>52 38 87 32</p>
          <h2 class="mailh2">Mail</h2>
          <p>ak.thuelund@gmail.com</p>
          <div class="iconBoks">
            <a href="https://github.com/Ann-Katrine">
              <ion-icon class="ikon github" name="logo-github" ></ion-icon>
            </a>
            <a href="https://www.linkedin.com/in/ann-katrine-nykj%C3%A6r-182056155/">
              <ion-icon class="ikon linkin" name="logo-linkedin" ></ion-icon>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import axios from 'axios'

  export default {
    name: 'forside',
    data(){
      return{
        faroriteProjekt: [],
        profile: [],
        newest3Proejkt: [],
        workExperiende: [],
        education: [],
        qulification: [],
        email: "",
        navn: "",
        besked: "",
        emne: "",
        fornavn: "Ann-Katrine Thuelund Nykjær",
        api: "http://localhost/re-portfolio/API/index.php/api",
        windowswidth: 0,
        tal: 0
      }
    },
    created(){
      this.getFavoriteProject(),
      this.getProfile(),
      this.get3NewestProejkt(),
      this.getWorkExperience(),
      this.getEducation(),
      this.getQulification(),
      this.fixfornavn()
    },
    mounted(){
      this.$nextTick(function() {
        window.addEventListener('resize', this.getWindowWidth);
        //Init
        this.getWindowWidth()
      })
      window.addEventListener('resize', this.changeNavbarColor);
      window.addEventListener('scroll', this.changeNavbarColor)
    },
    methods:{
      getFavoriteProject(){ // henter den enklente projekt der er sat til favorite 
        axios
          .get(this.api + '/projekt/favorit',{
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
      getProfile(){
        axios
          .get(this.api + '/profile',{
            headers: {
              'Accept': 'application/json'
            }
          })
          .then(Response => {
            this.profile = Response.data
            console.log(this.profile)
          })
          .catch(err => {
            console.log(err.toString());
          })
      },
      get3NewestProejkt(){ // henter de 3 nyeste projekter der er blevet lavet
        axios
          .get(this.api + '/projekt/newest-3',{
            headers: {
              'Accept': 'application/json'
            }
          })
          .then(Response => {
            this.newest3Proejkt = Response.data
            console.log(this.newest3Proejkt);
          })
          .catch(err => {
            console.log(err.toString());
          })
      },
      getWorkExperience(){ // henter det arbejdes erfaring jeg har læggende i databasen
        axios
          .get(this.api + '/work-experience',{
            headers: {
              'Accept': 'application/json'
            }
          })
          .then(Response => {
            this.workExperiende = Response.data
            console.log(this.workExperiende);
          })
          .catch(err => {
            console.log(err.toString());
          })
      },
      getEducation(){  // henter uddannelse erfarign jeg har læggende i databasen
        axios
          .get(this.api + '/education',{
            headers: {
              'Accept': 'application/json'
            }
          })
          .then(Response => {
            this.education = Response.data
            console.log(this.education);
          })
          .catch(err => {
            console.log(err.toString());
          })
      },
      getQulification(){ // henter de kvalifikationer jeg har læggende i databasen
        axios
          .get(this.api + '/qualification',{
            headers: {
              'Accept': 'application/json'
            }
          })
          .then(Response => {
            this.qulification = Response.data
            console.log(this.qulification);
          })
          .catch(err => {
            console.log(err.toString());
          })
      },
      fixDate(sDate, eDate){ // fixer hvordan datoen ser ud til hvordan jeg vil have den til at se ud
        let start = sDate.split("-");
        let end = eDate.split("-");
        let finishDate = "";

        finishDate = start[0] + " - " + end[0];
        return finishDate;
      },
      fixfornavn(){ // fixer mit navn til hvordan jeg vil have den til at se ud med hvilken skærm størrelse det er
        if( this.windowswidth > 671){
        console.log("skirfter til langt navn");

        this.fornavn = "Ann-Katrine Thuelund Nykjær";
        }
        else if( this.windowswidth < 670){
          console.log("skirfter til kort navn");

          this.fornavn = "Ann-Katrine Th. Nykjær"
        }
      },
      mail(){ // gør at jeg får en mial sendt til mig

        console.log("her er jeg")

        const mailen = {
          navn: this.navn,
          mail: this.email,
          emne: this.emne,
          besked: this.besked
        };

        console.log(mailen);


        axios
          .post('http://localhost/re-portfolio/mail.php', 
          mailen, 
          {
            headers: {
              'Accept': 'application/json'
            }
          })
          .then(Response => {
            
            console.log("sendt");
          })
          .catch(err => {
            console.log(err.toString());
          })
      },
      // skal have kigget på denne -------------------------------------------------- !
      changeNavbarColor(){ // gør at jeg får skiftet farve på min navbar efter hvor langt den er på siden med dynamisk 
        let myNav = document.getElementById('ulNavbar');
        let slide1 = 0;
        let slide2 = 0;
        let slide3 = 0;
        let slide4 = 0;
        let slide5 = 0;
        let slide6 = 0;
        let slide7 = 0;

        let plads = document.getElementById("stolteProjekt")
        let plads1 = document.getElementById("aboutMe")
        let plads2 = document.getElementById("kvalifikation")
        let plads3 = document.getElementById("newest3Proejkt")
        let plads4 = document.getElementById("workExperiende")
        let plads5 = document.getElementById("education")
        let plads6 = document.getElementById("mail")
        let nav = document.getElementById("navbar")

        slide1 = plads.offsetTop - nav.offsetHeight
        slide2 =  plads1.offsetTop - nav.offsetHeight
        slide3 =  plads2.offsetTop - nav.offsetHeight
        slide4 =  plads3.offsetTop - nav.offsetHeight
        slide5 =  plads4.offsetTop - nav.offsetHeight
        slide6 =  plads5.offsetTop - nav.offsetHeight
        slide7 =  plads6.offsetTop - nav.offsetHeight

        if(document.body.scrollTop >= slide7 || document.documentElement.scrollTop >= slide7 ){
          myNav.classList.remove('menu');
          myNav.classList.add('testNavbar');
        }
        else if(document.body.scrollTop >= slide6 || document.documentElement.scrollTop >= slide6 ){
          myNav.classList.add('menu');
          myNav.classList.remove('testNavbar');
        }
        else if(document.body.scrollTop >= slide5 || document.documentElement.scrollTop >= slide5 ){
          myNav.classList.remove('menu');
          myNav.classList.add('testNavbar');
        }
        else if(document.body.scrollTop >= slide4 || document.documentElement.scrollTop >= slide4 ){
          myNav.classList.add('menu');
          myNav.classList.remove('testNavbar');
        }
        else if(document.body.scrollTop >= slide3 || document.documentElement.scrollTop >= slide3 ){
          myNav.classList.remove('menu');
          myNav.classList.add('testNavbar');
        }
        else if(document.body.scrollTop >= slide2 || document.documentElement.scrollTop >= slide2 ){
          myNav.classList.add('menu');
          myNav.classList.remove('testNavbar');
        }
        else if(document.body.scrollTop >= slide1 || document.documentElement.scrollTop >= slide1 ){
          myNav.classList.remove('menu');
          myNav.classList.add('testNavbar');
        }
        else{
          myNav.classList.add('menu');
          myNav.classList.remove('testNavbar');
        }
      },
      getWindowWidth(event) { // for skærm størrelsen
        this.windowswidth = window.innerWidth;
        this.fixfornavn()
      }
    },
    beforeDestroy() {
      window.removeEventListener('resize', this.getWindowWidth);
      window.removeEventListener('resize', this.changeNavbarColor);
      window.removeEventListener('scroll', this.changeNavbarColor)
    }
  }
</script>

<!--     css kun til denne side       -->
<style scoped>
  input{
    margin: 0.5em;
    height: 2em;
    border: none;
    resize: none;
    border-radius: 4px;
  }

  input:focus{
    border: none;
  }

   @media screen and (max-width: 320px){
     input{
      margin: 0.3em;
    }
   }
</style>

<!--         almindelig css           -->
<style>
  .strickyForsideHeigth{
    padding-top: 4.8em;
  }

  .heroImages{
    width: 24em;
    border-radius: 100%;
    margin: 6.5em 0em 6.5em 12em;
  }

  .heroOverskrift{
    font-size: 3em;
    padding-top: 4.5em;
  }

  .heroBoks{
    display: flex;
  }

  .slideOverskrifter{
    padding: 0.5em;
    font-size: 3em;
    text-align: center;
  }

  .flexLeft50{
    flex: 50%;
  }

  .flexrigth50{
    flex: 50%;
  }

  .backgrund{
    height: 31em;
  }

  .backgrundImg{
    background-image: url("../images/backgrund.png");
    width: 100%;
    height: 31em;
    padding: 0;
    padding-bottom: 5%;
  }

  /*************************************************/
  /*             nummer to slide                   */
  /*************************************************/
  .stolteProjektBoks{
    display: flex;
    flex-flow: column wrap;
    align-items: center;
    justify-content: center;
  }

  .stolteProjektImages{
    width: 50em;

  }

  /*************************************************/
  /*                 about slide                   */
  /*************************************************/
  .slideOverSkriftAboutMe{
    padding: 0 0.5em 0.5em 0.5em;
    font-size: 3em;
    text-align: center;
  }
  
  .aboutMeBoks{
    padding: 9.8em 0 11.8em 0;
  }

  .aboutMeInnerBoks{
    display: flex;
    flex-flow: column nowrap;
    align-items: center;
  }

  .aboutMeTeskt{
    font-size: 1.3em;
  }

  /*************************************************/
  /*             Kvalifikationer slide             */
  /*************************************************/
  .kvalifikationTekst{
    font-size: 1.8em;
    padding: 0.5em;
  }

  .kvalifikationInnerBoks{
    display: flex;
    flex-flow: column nowrap;
    align-items: center;

  }

  .kvalifikationboks{
    display: flex;
    flex-flow: column nowrap;
    align-items: center;
    padding: 7.5em 0;
  }

  /*************************************************/
  /*                 newest 3 slide                */
  /*************************************************/
  .newestBoks{
    display: flex;
    flex-flow: row wrap;
    justify-content: space-evenly;
    margin: 4em 0;
  }
  
  .newestImages{
    height: 15em;
    width: 22em;
    border: 1px solid #607272;
  }

  .newestTekst{
    padding: 0.5em;
    position: absolute;
    background: #CCFFFF;
    width: 22.1em;
    text-align: center;
    margin-left: -0.9em;
    margin-top: -3.5em;
  }

  .newestTriangle{
    width: 0;
    height: 0;
    border-top: 12px solid #A3CCCC;
    border-left: 15px solid transparent;
    position: absolute;
    margin-top: -1.5em; 
    margin-left: -0.9em;
  }

  /*************************************************/
  /*                   timeline                    */
  /*************************************************/
  .boksAroundTimelineBoks{
    display: flex;
    flex-flow: column nowrap;
    align-items: center;
  }

  .timelineboks{
      display: flex;
      justify-content: center;
  }

  .dot{
    background-color: #607272;
    width: 1em;
    height: 1em;
    border-radius: 100%;
  }

  .line{
    background-color: #607272;
    width: 2px;
    height: 9em;
  }

  .boks-right{
    background-color: #fff;
    max-width: 16em;
    width: 100%;
    margin: 1em 0;
    position: absolute;
    right: 43.6em;
    padding: 0.8em;
    border-radius: 10px;
  }

  .boks-left{
    background-color: #fff;
    width: 9em;
    margin: 1em 0;
    position: absolute;
    left: 43.6em;
    padding: 0.8em;
    border-radius: 10px;
  }

  .timelineTekst{
    font-size: 1.3em;
    margin-bottom: 0.4em;
  }

  /*****************************/
  /*           education       */
  /*****************************/
  .timelineOuterBoks{
    padding-bottom: 2em;
  }

  .timelineColorBoks{
    background-color: #CCFFFF;
  }

  .timelineBaggrund{
    height: 100%;
  }

  /*************************************************/
  /*                 mail  slide                   */
  /*************************************************/
  .mailBackgrundImg{
    background-image: url("../images/backgrund.png");
    width: 100%;
    height: 100%;
    padding: 0;
    padding-bottom: 5%;
  }

  .mailOverskrift{
    font-size: 3em;
    text-align: center;
    padding: 0.5em;
  }

  .mailContainer{
    display: flex;
    flex-flow: row wrap;
  }

  .mailItems1{
    padding: 0 1.6em;
  }

  .mailItems2{
    padding: 0 1.6em;
  }

  .mailInput2Bokse{
    width: 21.8em;
    outline: none;
  }

  .mailInputBokse{
    width: 45em;
    outline: none;
  }

  .mailTextAreaBoks{
    width: 45em !important;
    outline: none;
  }

  .mailTextAreaBoks{
    margin: 0.5em;
    height: 25em;
    border: none;
    resize: none;
    border-radius: 4px;
  }

  .mailButtomBoks{
    display: flex;
    margin: 0 0.7em 0 0;
  }

  .mailButtom{
    height: 2em;
    width: 8em;
    border-radius: 4px;
    background-color: #fff;
    border: 2px solid #A3CCCC;
    outline: none;
    left: 39.8em;
    position: absolute;
  }

  .mailh2Overskrift{
    font-size: 2em;
    padding-top: 3em;
  }

  .mailh2{
    font-size: 1.5em;
    padding-top: 0.5em;
  }

  .iconBoks{
    padding-top: 0.5em;
  }

  /*************************************************/
  /*                 icons                         */
  /*************************************************/
  .ikon{
    width: 2em;
    height: 2em;
  }

  .linkin{
    color: #0a66c2;
  }

  .github{
    color: #000;
  }
</style>

<!--           media querys           -->
<style>
  /* computer */
  @media screen and (max-width: 1320px){
    .boks-right{
      right: 43.4em;
    }
    .boks-left{
      left: 43.4em;
    }
  }

  @media screen and (max-width: 1310px){
    .boks-right{
      right: 43.2em;
    }
    .boks-left{
      left: 43.2em;
    }
  }

  @media screen and (max-width: 1300px){
    .boks-right{
      right: 43em;
    }
    .boks-left{
      left: 43em;
    }
  }

  @media screen and (max-width: 1290px){
    .boks-right{
      right: 42.8em;
    }
    .boks-left{
      left: 42.8em;
    }
  }

  @media screen and (max-width: 1280px){
    .boks-right{
      right: 42.6em;
    }
    .boks-left{
      left: 42.6em;
    }
  }

  @media screen and (max-width: 1270px){
    .boks-right{
      right: 42.4em;
    }
    .boks-left{
      left: 42.4em;
    }
  }

  @media screen and (max-width: 1260px){
    .boks-right{
      right: 42.4em;
    }
    .boks-left{
      left: 42.4em;
    }
  }

  @media screen and (max-width: 1250px){
    .boks-right{
      right: 42em;
    }
    .boks-left{
      left: 42em;
    }
  }

  @media screen and (max-width: 1240px){
    .boks-right{
      right: 41.8em;
    }
    .boks-left{
      left: 41.8em;
    }
  }

  @media screen and (max-width: 1230px){
    .slideOverskrifter, .mailOverskrift, .heroOverskrift{
      font-size: 2.8em;
    }

    .kvalifikationTekst{
      font-size: 1.6em;
      padding: 0;
    }
    
    /* hero slide */
    .heroImages{
      width: 23em;
    }
    
    .boks-right{
      right: 41.6em;
    }
    .boks-left{
      left: 41.6em;
    }
  }

  @media screen and (max-width: 1220px){
    .boks-right{
      right: 41.4em;
    }
    .boks-left{
      left: 41.4em;
    }
  }

  @media screen and (max-width: 1210px){
    .boks-right{
      right: 41em;
    }
    .boks-left{
      left: 41em;
    }
  }

  @media screen and (max-width: 1200px){
    .boks-right{
      right: 40.7em;
    }
    .boks-left{
      left: 40.7em;
    }

    .flexrigth50{
      flex: 55%;
    }
    .heroImages {
      margin: 6.5em 0em 6.5em 11em;
    }
  }

  @media screen and (max-width: 1190px){
    .boks-right{
      right: 40.4em;
    }
    .boks-left{
      left: 40.4em;
    }

    .newestImages{
      height: 14em;
      width: 21em;
    }
    .newestTekst{
      width: 21.1em;
    }
    .newestTriangle{
      margin-top: -1.5em;
    }

    .eksOverskrift{
      padding: 1em 0.5em 0.5em 0.5em !important;
    }
    .newestBoks{
      margin: 1em 0 3em 0;
    }
  }

  @media screen and (max-width: 1180px){
    .boks-right{
      right: 40.1em;
    }
    .boks-left{
      left: 40.1em;
    }

    .heroImages{
      width: 22em;
    }

    .mailItems2 {
      padding: 0 1.6em 0 0;
    }
  }

  @media screen and (max-width: 1170px){
    .boks-right{
      right: 39.8em;
    }
    .boks-left{
      left: 39.8em;
    }
  }

  @media screen and (max-width: 1160px){
    .boks-right{
      right: 39.5em;
    }
    .boks-left{
      left: 39.5em;
    }
  }

  @media screen and (max-width: 1150px){
    .boks-right{
      right: 39.2em;
    }
    .boks-left{
      left: 39.2em;
    }

    .heroOverskrift{
      font-size: 2.7em;
    }
    .heroImages{
      width: 21em;
    }
  }

  @media screen and (max-width: 1140px){
    .boks-right{
      right: 38.9em;
    }
    .boks-left{
      left: 38.9em;
    }

    .newestImages{
      height: 13em;
      width: 20em;
    }
    .newestTekst{
      width: 20.1em;
    }
  }

  @media screen and (max-width: 1130px){
    .boks-right{
      right: 38.5em;
    }
    .boks-left{
      left: 38.5em;
    }
  }

  @media screen and (max-width: 1120px){
    .boks-right{
      right: 38.2em;
    }
    .boks-left{
      left: 38.2em;
    }
  }

  @media screen and (max-width: 1110px){
    .boks-right{
      right: 37.9em;
    }
    .boks-left{
      left: 37.9em;
    }

    .heroImages {
      margin: 6.5em 0em 6.5em 10em;
    }

    .mailTextAreaBoks {
      width: 44.5em !important;
    }
    .mailInputBokse {
      width: 44.5em;
    }
    .mailInput2Bokse {
      width: 21.6em;
    }
    .mailButtom {
      left: 39.3em;
    }
  }

  @media screen and (max-width: 1100px){
    .boks-right{
      right: 37.6em;
    }
    .boks-left{
      left: 37.6em;
    }

    .mailTextAreaBoks {
      width: 43.5em !important;
    }
    .mailInputBokse {
      width: 43.5em;
    }
    .mailInput2Bokse {
      width: 21em;
    }
    .mailButtom {
      left: 38.3em;
    }
  }

  @media screen and (max-width: 1090px){
    .boks-right{
      right: 37.2em;
    }
    .boks-left{
      left: 37.2em;
    }

    .heroImages{
      margin: 6.5em 0em 6.5em 10em;
    }

    .mailTextAreaBoks {
      width: 43em !important;
    }
    .mailInputBokse {
      width: 43em;
    }
    .mailInput2Bokse {
      width: 20.8em;
    }
    .mailButtom {
      left: 37.8em;
    }

    .mailTextAreaBoks {
      height: 20em;
    }
  }

  @media screen and (max-width: 1080px){
    .boks-right{
      right: 36.9em;
    }
    .boks-left{
      left: 36.9em;
    }

    .newestBoks {
      flex-flow: column wrap;
      align-items: center;
    }
    .newestImages {
      height: 20em;
      width: 33em;
    }
    .newestTekst {
      padding: 1em 0 1em 0;
      width: 34.6em;
      margin-left: -1.5em;
      margin-top: -5.5em;
      position:relative;
    }
    .newestTriangle {
      border-top: 18px solid #A3CCCC;
      border-left: 24px solid transparent;
      margin-top: 0;
      margin-left: -1.5em;
      position:relative;
    }
    .newestBoksButtom{
      padding: 0 0 3em 1.5em;
    }

    .backgrund{
      height: 100%;
    }
  }

  @media screen and (max-width: 1070px){
    .boks-right{
      right: 36.6em;
    }
    .boks-left{
      left: 36.6em;
    }
  }

  @media screen and (max-width: 1060px){
    .boks-right{
      right: 36.3em;
    }
    .boks-left{
      left: 36.3em;
    }

    .heroImages {
      margin: 6.5em 0em 6.5em 9em;
    }

    .mailInput2Bokse {
      width: 20.4em;
    }
    .mailInputBokse {
        width: 42em;
    }
    .mailTextAreaBoks {
        width: 42em !important;
    }
    .mailButtom {
        left: 36.8em;
    }
  }  

  @media screen and (max-width: 1050px){
    .boks-right{
      right: 36em;
    }
    .boks-left{
      left: 36em;
    }

    .mailInput2Bokse {
      width: 19.9em;
    }
    .mailInputBokse {
        width: 41em;
    }
    .mailTextAreaBoks {
        width: 41em !important;
    }
    .mailButtom {
        left: 35.8em;
    }
  }

  @media screen and (max-width: 1040px){
    .boks-right{
      right: 35.7em;
    }
    .boks-left{
      left: 35.7em;
    }

    .flexLeft50 {
      flex: 48%;
    }
    .heroImages {
      margin: 6.5em 0em 6.5em 8em;
    } 

    .mailInput2Bokse {
        width: 20.3em;
    }
    .mailInputBokse {
        width: 42em;
    }
    .mailTextAreaBoks {
      width: 42em !important;
    }
    .mailButtom {
      left: 36.8em;
    }

    .mailItems1 {
      padding: 0 0.5em 0 1.6em;
    }
  }
 
  @media screen and (max-width: 1030px){
    .boks-right{
      right: 35.4em;
    }
    .boks-left{
      left: 35.4em;
    }

    .flexLeft50 {
      flex: 45%;
    }
    .heroImages {
      margin: 6.5em 0em 6.5em 6em;
    }

    .mailInput2Bokse {
        width: 19.9em;
    }
    .mailInputBokse {
        width: 41em;
    }
    .mailTextAreaBoks {
      width: 41em !important;
    }
    .mailButtom {
      left: 35.8em;
    }
  }

  @media screen and (max-width: 1020px){
    .boks-right{
      right: 35em;
    }
    .boks-left{
      left: 35em;
    }

    .mailInput2Bokse {
        width: 19.4em;
    }
    .mailInputBokse {
        width: 40em;
    }
    .mailTextAreaBoks {
      width: 40em !important;
    }
    .mailButtom {
      left: 34.8em;
    }
  }

  @media screen and (max-width: 1010px){
    .boks-right{
      right: 34.7em;
    }
    .boks-left{
      left: 34.7em;
    }

    .flexLeft50 {
      flex: 42%;
    }
    .heroImages {
      margin: 6.5em 0em 6.5em 5em;
    }
  }

  @media screen and (max-width: 1000px){
    .boks-right{
      right: 34.4em;
    }
    .boks-left{
      left: 34.4em;
    }

    .mailInput2Bokse {
        width: 18.8em;
    }
    .mailInputBokse {
        width: 39em;
    }
    .mailTextAreaBoks {
      width: 39em !important;
    }
    .mailButtom {
      left: 33.8em;
    }
  }

  @media screen and (max-width: 990px){
    .boks-right{
      right: 34.1em;
    }
    .boks-left{
      left: 34.1em;
    }

    .mailItems2 {
      padding: 0;
    }
    .mailInput2Bokse {
        width: 18.4em;
    }
    .mailInputBokse {
        width: 38em;
    }
    .mailTextAreaBoks {
      width: 38em !important;
    }
    .mailButtom {
      left: 32.8em;
    }
  }

  @media screen and (max-width: 980px){
    .boks-right{
      right: 33.8em;
    }
    .boks-left{
      left: 33.8em;
    }

    .heroImages {
      margin: 6.5em 0em 6.5em 4em;
    }
  }

  @media screen and (max-width: 970px){
    .boks-right{
      right: 33.5em;
    }
    .boks-left{
      left: 33.5em;
    }

    .heroOverskrift {
      font-size: 2.5em;
      padding-top: 5em;
    }

    .stolteProjektImages {
      width: 49em;
    }
  }

  @media screen and (max-width: 960px){
    .boks-right{
      right: 33.2em;
    }
    .boks-left{
      left: 33.2em;
    }

    .stolteProjektImages {
      width: 48em;
    }

    .mailInput2Bokse {
        width: 17.4em;
    }
    .mailInputBokse {
        width: 36em;
    }
    .mailTextAreaBoks {
      width: 36em !important;
    }
    .mailButtom {
      left: 30.8em;
    }
  }

  @media screen and (max-width: 950px){
    .boks-right{
      right: 32.9em;
    }
    .boks-left{
      left: 32.9em;
    }

    .stolteProjektImages {
      width: 47em;
    }
  }

  @media screen and (max-width: 940px){
    .boks-right{
      right: 32.5em;
    }
    .boks-left{
      left: 32.5em;
    }

    .heroImages {
      width: 20.5em;
    }
    .heroOverskrift {
      padding-top: 5.1em;
    }
    
    .stolteProjektImages {
      width: 46em;
    }

    .mailContainer{
      display: flex;
      flex-flow: column wrap;
      align-items: center;
    }
    .mailBackgrundImg {  
      padding-bottom: 0;
    }
    .mailBackgrundImg{
      background-image: none;
    }
    .mailItems1{
      background-image: url(/img/backgrund.0bded25f.png);
      width: 100%;
      align-self: center;
      padding: 0 0 3em 0;
      text-align: center;
    }
    .mailItems2 {
      background-color: #fff;
      padding: 0 5em 0 0;
    }
    .mailButtom {
      left: 45.3em;
    }
    .mailh2Overskrift {
      padding-top: 0.5em;
    }
    .mailTextAreaBoks {
      height: 18em;
    }
  }

  @media screen and (max-width: 930px){
    .boks-right{
      right: 32.2em;
    }
    .boks-left{
      left: 32.2em;
    }

    .stolteProjektImages {
      width: 45em;
    }

    .mailButtom {
      left: 45em;
    }
  }

  @media screen and (max-width: 920px){
    .boks-right{
      right: 31.9em;
    }
    .boks-left{
      left: 31.9em;
    }

    .stolteProjektImages {
      width: 44em;
    }

    .mailButtom {
      left: 44.7em;
    }
  }

  @media screen and (max-width: 910px){
    .boks-right{
      right: 31.6em;
    }
    .boks-left{
      left: 31.6em;
    }

    .heroImages {
      margin: 6.5em 0em 6.5em 3em;
    }

    .stolteProjektImages {
      width: 43em;
    }

    .mailButtom {
      left: 44.4em;
    }
  }

  @media screen and (max-width: 900px){
    .boks-right{
      right: 31.3em;
    }
    .boks-left{
      left: 31.6em;
    }

    .heroOverskrift {
      font-size: 2.3em;
      padding-top: 5.6em;
    }

    .stolteProjektImages {
      width: 42em;
    }

    .mailButtom {
      left: 44.1em;
    }
  }

  @media screen and (max-width: 890px){
    .boks-right{
      right: 31em;
    }
    .boks-left{
      left: 31.3em;
    }

    .mailButtom {
      left: 43.7em;
    }
  }

  @media screen and (max-width: 880px){
    .boks-right{
      right: 30.7em;
    }
    .boks-left{
      left: 31em;
    }

    .flexrigth50 {
      flex: 52%;
    }

    .stolteProjektImages {
      width: 41em;
    }

    .mailButtom {
      left: 43.3em;
    }
  }

  @media screen and (max-width: 870px){
    .boks-right{
      right: 30.4em;
    }
    .boks-left{
      left: 30.7em;
    }

    .mailButtom {
      left: 43em;
    }
  }

  @media screen and (max-width: 860px){
    .boks-right{
      right: 30.1em;
    }
    .boks-left{
      left: 30.4em;
    }

    .mailButtom {
      left: 42.6em;
    } 
  }

  @media screen and (max-width: 850px){
    .boks-right{
      right: 29.8em;
    }
    .boks-left{
      left: 30.1em;
    }

    .stolteProjektImages {
      width: 40em;
    }

    .mailButtom {
      left: 42.2em;
    }
  }

  @media screen and (max-width: 840px){
    .boks-right{
      right: 29.5em;
    }
    .boks-left{
      left: 29.8em;
    }

    .heroImages {
      width: 19.5em;
    }
    .flexLeft50 {
      flex: 39%;
    }

    .stolteProjektImages {
      width: 39em;
    }

    .mailButtom {
      left: 41.8em;
    }
  }

  @media screen and (max-width: 830px){
    .boks-right{
      right: 29.2em;
    }
    .boks-left{
      left: 29.5em;
    }

    .mailButtom {
      left: 41.4em;
    }
  }

  @media screen and (max-width: 820px){
    .boks-right{
      right: 28.9em;
    }
    .boks-left{
      left: 29.2em;
    }

    .heroImages {
      width: 18.5em;
    }
    .heroOverskrift {
      font-size: 2.2em;
    }

    .mailButtom {
      left: 41.1em;
    }
  }

  @media screen and (max-width: 810px){
    .boks-right{
      right: 28.6em;
    }
    .boks-left{
      left: 28.9em;
    }

    .mailButtom {
      left: 40.7em;
    }
  }

  @media screen and (max-width: 800px){
    .boks-right{
      right: 28.3em;
    }
    .boks-left{
      left: 28.6em;
    }

    .heroImages {
      margin: 6.5em 0em 6.5em 2em;
    }
    .flexLeft50 {
      flex: 39%;
    }

    .mailButtom {
      left: 40.4em;
    }
  }

  @media screen and (max-width: 790px){
    .boks-right{
      right: 28em;
    }
    .boks-left{
      left: 28.3em;
    }

    .mailButtom {
      left: 40em;
    }
  }

  @media screen and (max-width: 780px){
    .boks-right{
      right: 27.7em;
    }
    .boks-left{
      left: 28em;
    }

    .heroImages {
      margin: 6.5em 0em 6.5em 1em;
    }
    .flexLeft50 {
      flex: 36%;
    }

    .mailButtom {
      left: 39.6em;
    }
  }

  @media screen and (max-width: 770px){
    .boks-right{
      right: 27.4em;
    }
    .boks-left{
      left: 27.7em;
    }

    .aboutMeInnerBoks{
      align-items: flex-start;
    }

    .kvalifikationInnerBoks{
      align-items: flex-start;
    }

    .mailButtom {
      left: 39.2em;
    }
  }

  @media screen and (max-width: 760px){
    .boks-right{
      right: 27em;
    }
    .boks-left{
      left: 27.3em;
    }

    li a {
      padding: 0.2em;
    }

    .heroOverskrift {
      font-size: 2em;
      padding-top: 5.8em;
    }

    .mailButtom {
      left: 38.8em;
    }
  }

  @media screen and (max-width: 750px){
    .boks-right{
      right: 26.6em;
    }
    .boks-left{
      left: 26.9em;
    }

    .flexLeft50 {
      flex: 38%;
    }

    .stolteProjektImages {
      width: 38em;
    }

    .mailButtom {
      left: 38.4em;
    }
  }

  @media screen and (max-width: 740px){
    .boks-right{
      right: 26.3em;
    }
    .boks-left{
      left: 26.6em;
    }

    .heroImages {
      width: 18.3em;
    }

    .aboutMeTeskt {
      font-size: 1.3em;
      padding: 0 2em;
    }

    .kvalifikationTekst{
      padding: 0 2em;
      font-size: 1.3em;
    }

    .mailButtom {
      left: 38.1em;
    }
  }

  @media screen and (max-width: 730px){
    .boks-right{
      right: 26em;
    }
    .boks-left{
      left: 26.3em;
    }

    .flexLeft50 {
      flex: 40%;
    }

    .mailButtom {
      left: 37.7em;
    }
  }

  @media screen and (max-width: 720px){
    .boks-right{
      right: 25.7em;
    }
    .boks-left{
      left: 26em;
    }

    .heroOverskrift {
      padding-top: 6em;
    }

    .heroOverskrift {
      font-size: 1.9em;
    }

    .mailButtom {
      left: 37.3em;
    }
  }

  @media screen and (max-width: 710px){
    .boks-right{
      right: 25.4em;
    }
    .boks-left{
      left: 25.7em;
    }

    .flexLeft50 {
      flex: 42%;
    }

    .mailButtom {
      left: 36.9em;
    }
  }

  @media screen and (max-width: 700px){
    .boks-right{
      right: 25.1em;
    }
    .boks-left{
      left: 25.3em;
    }

    .stolteProjektImages {
      width: 37em;
    }

    .mailButtom {
      left: 36.5em;
    }
  }

  @media screen and (max-width: 690px){
    .boks-right{
      right: 24.9em;
    }
    .boks-left{
      left: 25.1em;
    }

    .heroImages {
      width: 17.9em;
    }

    .mailButtom {
      left: 36.1em;
    }
  }

  @media screen and (max-width: 680px){
    .boks-right{
      right: 25.1em;
    }
    .boks-left{
      left: 25.3em;
    }

    .flexLeft50 {
      flex: 41%;
    }

    .heroImages {
      width: 17.5em;
    }

    .mailButtom {
      left: 35.9em;
    }
  }

  @media screen and (max-width: 670px){
    .boks-right{
      right: 24.3em;
    }
    .boks-left{
      left: 24.6em;
    }

    .flexLeft50 {
      flex: 44%;
    }

    .stolteProjektImages {
      width: 36em;
    }

    .mailButtom {
      left: 35.5em;
    }
  }

  @media screen and (max-width: 660px){
    .boks-right{
      right: 23.9em;
    }
    .boks-left{
      left: 24.1em;
    }

    .mailButtom {
      left: 35.1em;
    }
  }

  @media screen and (max-width: 650px){
    .boks-right{
      right: 23.5em;
    }
    .boks-left{
      left: 24em;
    }

    .stolteProjektImages {
      width: 35em;
    }

    .mailButtom {
      left: 34.7em;
    }
  }

  @media screen and (max-width: 640px){
    .boks-right{
      right: 23.2em;
    }
    .boks-left{
      left: 23.5em;
    }

    .flexLeft50 {
      flex: 50%;
    }

    .stolteProjektImages {
      width: 34em;
    }

    .mailButtom {
      left: 34.3em;
    }
  }

  @media screen and (max-width: 630px){
    .boks-right{
      right: 23em;
    }
    .boks-left{
      left: 23.3em;
    }

    .mailButtom {
      left: 33.9em;
    }
  }

  @media screen and (max-width: 620px){
    .boks-right{
      right: 22.7em;
    }
    .boks-left{
      left: 23em;
    }

    .heroImages {
      width: 17.3em;
    }

    .newestImages {
      height: 18em;
      width: 31em;
    }

    .newestTekst {
      width: 32.6em;
    }

    .mailButtom {
      left: 33.6em;
    }
  }

  @media screen and (max-width: 610px){
    .boks-right{
      right: 22.3em;
    }
    .boks-left{
      left: 22.6em;
    }

    .stolteProjektImages {
      width: 33em;
    }

    .mailButtom {
      left: 33.2em;
    }
  }

  @media screen and (max-width: 600px){
    .boks-right{
      right: 22.1em;
    }
    .boks-left{
      left: 22.4em;
    }

    .heroImages {
      width: 17em;
    }

    .heroOverskrift {
      font-size: 1.7em;
      padding-top: 6.3em;
    }

    .mailButtom {
      left: 32.8em;
    }
  }

  @media screen and (max-width: 590px){
    .boks-right{
      right: 21.8em;
    }
    .boks-left{
      left: 22.1em;
    }

    .stolteProjektImages {
      width: 32em;
    }

    .fixKvaliSize{
      font-size: 0.9em;
    }

    .mailButtom {
      left: 32.4em;
    }
  }

  @media screen and (max-width: 580px){
    .boks-right{
      right: 21.5em;
    }
    .boks-left{
      left: 21.8em;
    }

    .flexLeft50 {
      flex: 54%;
    }

    .heroImages {
      width: 16.8em;
    }

    .stolteProjektImages {
      width: 32em;
    }

    .mailButtom {
      left: 32em;
    }
  }

  @media screen and (max-width: 570px){
    .boks-right{
      right: 21.2em;
    }
    .boks-left{
      left: 21.5em;
    }

    .newestImages {
      height: 16em;
      width: 29em;
    }
    
    .newestTekst {
      width: 30.6em;
    }

    .newestTekst {
      width: 30.6em;
    }

    .mailButtom {
      left: 31.7em;
    }
  }

  @media screen and (max-width: 560px){
    .boks-right{
      right: 20.9em;
    }
    .boks-left{
      left: 21.2em;
    }

    .mailButtom {
      left: 31.4em;
    }
  }
  
  @media screen and (max-width: 550px){
    .boks-right{
      right: 20.6em;
    }
    .boks-left{
      left: 20.9em;
    }

    .heroImages {
      width: 15.8em;
    }

    .heroOverskrift {
      font-size: 1.5em;
      padding-top: 7em;
    }

    .stolteProjektImages {
      width: 30em;
    }

    .newestImages {
      height: 17em;
      width: 28em;
    }
    .newestTekst {
      width: 29.6em;
    }

    .mailButtom {
      left: 30.9em;
    }
  }

  @media screen and (max-width: 540px){
    .boks-right{
      right: 20.3em;
    }
    .boks-left{
      left: 20.6em;
    }
    
    .mailButtom {
      left: 30.5em;
    }
  }

  @media screen and (max-width: 530px){
    .boks-right{
      right: 20em;
    }
    .boks-left{
      left: 20.3em;
    }

    .heroImages {
      width: 15.3em;
    }

    .newestImages {
      height: 16em;
      width: 26em;
    }
    .newestTekst {
      width: 27.6em;
    }
    
    .mailTextAreaBoks {
      width: 35em !important;
    }
    .mailInputBokse {
      width: 35em;
    }
    .mailInput2Bokse {
      width: 16.8em;
    }
    .mailButtom {
      left: 29.6em;
    }
  }

  @media screen and (max-width: 520px){
    .boks-right{
      right: 19.7em;
    }
    .boks-left{
      left: 20em;
    }

    .mailButtom {
      left: 29.3em;
    }
  }

  @media screen and (max-width: 510px){
    .boks-right{
      right: 19.4em;
    }
    .boks-left{
      left: 19.7em;
    }

    .heroImages {
      width: 15em;
    }

    .stolteProjektImages {
      width: 28em;
    }

    .fixKvaliSize{
      font-size: 0.9em;
    }

    .mailInput2Bokse {
      width: 15.9em;
    }
    .mailInputBokse {
      width: 33em;
    }
    .mailTextAreaBoks {
      width: 33em !important;
    }
    .mailItems2 {
      padding: 0 3em 0 0;
    }
    .mailButtom {
      left: 27.8em;
    }
  }

  @media screen and (max-width: 500px){
    .boks-right{
      right: 19.1em;
    }
    .boks-left{
      left: 19.4em;
    }

    .mailButtom {
      left: 27.5em;
    }
  }

  @media screen and (max-width: 490px){
    .boks-right{
      right: 18.8em;
    }
    .boks-left{
      left: 19.1em;
    }

    .heroImages {
      width: 14em;  
    }
    .heroOverskrift {
      font-size: 1.4em;
      padding-top: 7.6em;
    }
    .fixSize{
      font-size: 0.9em;
    }

    .slideOverskrifter, .mailOverskrift{
      font-size: 2.5em;
    }

    .newestImages {
      height: 14em;
      width: 24em;
    }
    .newestTekst {
      width: 25.6em;
    }

    .mailButtom {
      left: 27.2em;
    }
  }

  @media screen and (max-width: 480px){
    .boks-right{
      right: 17.8em;
    }
    .boks-left{
      left: 17.8em;
    }

    .stolteProjektImages {
      width: 27em;
    }

    .mailTextAreaBoks {
      width: 31em !important;
    }
    .mailInputBokse {
      width: 31em;
    }
    .mailInput2Bokse {
      width: 14.8em;
    }
    .mailItems2 {
      padding: 0 1.3em 0 0;
    }
    .mailButtom {
      left: 25.8em;
    }
  }

  @media screen and (max-width: 470px){
    .boks-right{
      right: 17.2em;
    }
    .boks-left{
      left: 17.2em;
    }

    .heroImages {
      width: 13.8em;
    }

    .stolteProjektImages {
      width: 26em;
    }

    .mailButtom {
      left: 25.4em;
    }
  }

  @media screen and (max-width: 460px){
    .boks-right{
      right: 16.5em;
    }
    .boks-left{
      left: 16.8em;
    }

    .heroImages {
      width: 13.4em;
      margin: 6.5em 0em 6.5em 0.5em; 
    }

    .stolteProjektImages {
      width: 25em;
      height: 16em;
    }

    .newestImages {
      height: 12em;
      width: 22em;
    }
    .newestTekst {
      width: 23.6em;
    }

    .mailButtom {
      left: 26.4em;
    }
  }

  @media screen and (max-width: 450px){
    .boks-right{
      right: 16.5em;
    }
    .boks-left{
      left: 16.8em;
    }

    .mailItems1 {
      padding: 0 0em 3em 0em;
    }

    .mailButtom {
      left: 24.7em;
    }
  }

  @media screen and (max-width: 440px){
    .boks-right{
      right: 15.7em;
    }
    .boks-left{
      left: 16.8em;
    }

    .heroImages {
      width: 13.4em;
      margin: 6.5em 0em 6.5em 0.3em; 
    }

    .boks-left {
      left: 15.8em;
    }

    .mailTextAreaBoks {
      width: 30em !important;
    }
    .mailInputBokse {
      width: 30em;
    }
    .mailInput2Bokse {
      width: 14.3em;
    }
    .mailButtom {
      left: 23.7em;
    }
    .mailItems2 {
      padding: 0 1em 0 0;
    }
  }

  @media screen and (max-width: 430px){
    .boks-right{
      right: 15em;
    }
    .boks-left{
      left: 15em;
    }

    .heroImages {
      width: 12.4em;
    }
    .heroOverskrift {
      padding-top: 7em;
    }

    .aboutMeTeskt {
      font-size: 1.2em;
    }

    .mailTextAreaBoks {
      width: 29em !important;
    }
    .mailInputBokse, .mailInput2Bokse {
      width: 29em;
    }
    .mailButtom {
      left: 22.9em;
    }
    .mailItems2 {
      padding: 0 1.7em 0 0;
    }
    .mailFlexInput{
      display: flex;
      flex-flow: column nowrap;
      align-items: center;
    }
    .mailh2Overskrift {
      font-size: 1.8em;
    }
    .mailh2 {
      font-size: 1.4em;
    }
  }

  @media screen and (max-width: 420px){
    .boks-right{
      right: 14.7em;
    }
    .boks-left{
      left: 14.7em;
    }

    .stolteProjektImages {
      width: 23.5em;
      height: 16em;
    }

    .newestImages {
      height: 11em;
      width: 21em;
    }
    .newestTekst {
      width: 22.6em;
    }

    .mailButtom {
      left: 22.5em;
    }
  }

  @media screen and (max-width: 410px){
    .boks-right{
      right: 14em;
    }
    .boks-left{
      left: 14em;
    }

    .mailTextAreaBoks {
      width: 28em !important;
    }
    .mailInputBokse, .mailInput2Bokse {
      width: 28em;
    }
    .mailButtom {
      left: 21.7em;
    }
    .mailItems2 {
      padding: 0 1.5em 0 0;
    }
  }

  @media screen and (max-width: 400px){
    .boks-right{
      right: 13.2em;
    }
    .boks-left{
      left: 13.2em;
    }
    
    .flexLeft50 {
      flex: 58%;
    }

    .stolteProjektImages {
      width: 22.5em;
      height: 14em;
    }

    .mailTextAreaBoks {
      width: 26.7em !important;
    }
    .mailInputBokse, .mailInput2Bokse {
      width: 26.7em;
    }
    .mailButtom {
      left: 20.6em;
    }
    .mailItems2 {
      padding: 0;
    }
  }

  @media screen and (max-width: 390px){
    .boks-left, .boks-right {
     width: 8.7em;
    }

    .mailTextAreaBoks {
      width: 26.6em !important;
    }
    .mailInputBokse, .mailInput2Bokse {
      width: 26.6em;
    }
    .mailButtom {
      left: 20.1em;
    }
  }

  @media screen and (max-width: 380px){
    .heroImages {
      width: 11.4em;
    }
    
    .stolteProjektImages {
      width: 21.5em;
      height: 12em;
    }
    
    .newestImages {
      height: 11em;
      width: 20em;
    }
    .newestTekst {
      width: 21.6em;
      margin-top: -3.5em;
      padding: 0.5em 0 0.5em 0;
      
    }
    
    .boks-left {
     width: 7.7em;
    }
    .boks-right {
      width: 7.7em;
    }
    .timelineTekst {
      font-size: 1.2em;
    }

    .mailTextAreaBoks {
      width: 25em !important;
    }
    .mailInputBokse, .mailInput2Bokse {
      width: 25em;
    }
    .mailButtom {
      left: 19em;
    }
    .mailh2Overskrift {
      font-size: 1.6em;
    }
    .mailh2 {
      font-size: 1.3em;
    }
    .mailItems2 {
      padding: 0 1em 0 0;
    }
  }

  @media screen and (max-width: 370px){
    .boks-left, .boks-right {
      width: 7.4em;
    }

    .slideOverskrifter, .mailOverskrift {
      font-size: 2.2em;
    }
    
    .mailButtom {
      left: 18.7em;
    }
  }

  @media screen and (max-width: 360px){
    .stolteProjektImages {
      width: 20.5em;
      height: 12em;
    }

    .newestImages {
      height: 11em;
      width: 19em;
    }
    .newestTekst {
      width: 20.6em;
    }

    .boks-left{
      width: 7em;
      left: 13.2em;
    }  
    .boks-right {
      width: 7em;
      right: 13.2em;
    }

    .mailButtom {
      left: 18.3em;
    }
  }

  @media screen and (max-width: 350px){
    .heroImages {
      width: 10.9em;
    }
    
    .boks-left {
      left: 12.5em;
    }
    .boks-right {
      right: 12.5em;
    }

    .mailTextAreaBoks {
      width: 24em !important;
    }
    .mailInputBokse, .mailInput2Bokse {
      width: 24em;
    }
    .mailButtom {
      left: 17.3em;
    }
    .mailItems2 {
      padding: 0;
    }
  }

  @media screen and (max-width: 340px){
    .heroImages {
      width: 10.4em;
    }
    .flexLeft50 {
      flex: 56%;
    }

    .stolteProjektImages {
      width: 19.5em;
      height: 12em;
    }
    .newestImages {
      width: 18em;
    }
    .newestTekst {
      width: 19.6em;
    }

    .boks-left {
      left: 11.8em;
    }
    .boks-right {
      right: 11.8em;
    }

    .mailTextAreaBoks {
      width: 23em !important;
    }
    .mailInputBokse, .mailInput2Bokse {
      width: 23em;
    }
    .mailButtom {
      left: 16.5em;
    }

    .mailh2Overskrift {
      font-size: 1.5em;
    }
    .mailh2 {
      font-size: 1.2em;
    }
  }

  @media screen and (max-width: 330px){
    .heroImages {
      width: 10em;
    }
    
    .boks-left {
      left: 11.6em;
    }
    .boks-right {
      right: 11.6em;
    }
  }

  @media screen and (max-width: 320px){
    .boks-left {
      left: 11em;
    }
    .boks-right {
      right: 11em;
    }

    .mailTextAreaBoks {
      margin: 0.3em;
    }
    .mailButtom {
      left: 15.6em;
    }
  }
</style>