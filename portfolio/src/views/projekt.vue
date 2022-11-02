<template>
  <div class="about">
    <div id="projekterne">
      <div class="overksriftFlexBoks">
        <button @click="hideAndSeek()" class="btnIcons">
          <ion-icon :name="ikon"></ion-icon>
        </button>
        <h1 class="overskriftSize">Projekter</h1>
      </div>
      <div>
        <div class="OuterBoks">
          <!------------------------------------------------->
          <!--                 side menu                   -->
          <!------------------------------------------------->
          <div :style="sidemenuBoks">
            <div id="siteBar" class="hidde-site-bar">
              <div>
                <button id="hideAndSeekBtn1" @click="hideAndSeek('projektType')" class="hideAndSeekButtom">Projekt type</button>
                <div :style="projektTypeCss" >
                    <ul  class="hideAndSeekBoks">
                        <li v-for="(projektTypen, index) in projektType" :key="projektTypen.id">
                            <input :id="'proknap' + index" type="checkbox" @click="searchMenuDynamisk('projekt_type-' + projektTypen.id, 'projekt_type', ('proknap' + index))"><label> {{ projektTypen.name }} </label>
                        </li>
                    </ul>
                </div>
              </div>

              <div>
                <button id="hideAndSeekBtn2" @click="hideAndSeek('arbejdsType')" class="hideAndSeekButtom">Arbejds type</button>
                <div :style="arbejdsTypeCss" >
                    <ul  class="hideAndSeekBoks">
                        <li v-for="(arbejdsTypen, index) in arbejdsType" :key="arbejdsTypen.id">
                            <input :id="'workknap' + index" type="checkbox" @click="searchMenuDynamisk('arbejds_type-' + arbejdsTypen.id, 'arbejds_type', ('workknap' + index))"><label> {{ arbejdsTypen.name }} </label>
                        </li>
                    </ul>
                </div>
              </div>

              <div>
                <button id="hideAndSeekBtn3" @click="hideAndSeek('software')" class="hideAndSeekButtom">Software</button>
                <div :style="softwareCss" >
                    <ul  class="hideAndSeekBoks">
                        <li v-for="(softwaret, index) in software" :key="softwaret.id">
                            <input :id="'soft' + index" type="checkbox" @click="searchMenuDynamisk('software-' + softwaret.id, 'software', ('soft' + index))"><label> {{ softwaret.name }} </label>
                        </li>
                    </ul>
                </div>
              </div>

              <div>
                <button id="hideAndSeekBtn4" @click="hideAndSeek('diagram')" class="hideAndSeekButtom hideAndSeekBoks-color">Diagrammer</button>
                <div :style="diagramCss">
                    <ul  class="hideAndSeekBoks ">
                        <li  v-for="diagrammet in diagram" :key="diagrammet.id">
                            <input type="checkbox" @click="searchMenuDynamisk('diagrammer-' + diagrammet.id, 'diagram')"><label> {{ diagrammet.name }} </label>
                        </li>
                    </ul>
                </div>
              </div>

              <div>
                <button id="hideAndSeekBtn5" @click="hideAndSeek('sprog')" class="hideAndSeekButtom">sprog</button>
                <div :style="sprogCss">
                    <ul  class="hideAndSeekBoks">
                        <li v-for="sproget in sprog" :key="sproget.id">
                            <input type="checkbox" @click="searchMenuDynamisk('sprog-' + sproget.id, 'sprog')"><label> {{ sproget.name }} </label>
                        </li>
                    </ul>
                </div>
              </div>
            </div>
          </div>

          <!------------------------------------------------->
          <!--                 Projekterne                 -->
          <!------------------------------------------------->
          <div :style="projekterneBoks">

            <div v-if="windowswidth >= 770"> <!--  til hjemmesider  -->
              <div  class="OuterBoksFlex" v-if="allProjects.length > 0">
                <div :id="getId(index % 12)" v-for="(project, index) in allProjects" :key="index" :class="getClass(index % 12)">
                  <button class="boks-btn" @click="openModal(project.id)">
                    <p :id="getTekstId(index % 12)" :class="getTekstClass(index % 12)"> {{ project.name }}</p>
                    <div :id="getTriangleId(index % 12)" :class="getTriangleClass(index % 12)"></div>
                    <img :src="projectSizeImagesSted((index % 12), project, 770)" :alt="projectSizeImagesName((index % 12), project, 770)" class="imagesSize">
                  </button>
                </div>
              </div>
            </div>
            <div v-else-if="windowswidth <= 769 && windowswidth >= 426">  <!-- til tabels -->
              <div  class="OuterBoksFlex" v-if="allProjects.length > 0">
                <div :id="getId(index % 12)" v-for="(project, index) in allProjects" :key="index" :class="getClass(index % 12)">
                  <button class="boks-btn" @click="openModal(project.id)">
                    <p :id="getTekstId(index % 12)" :class="getTekstClass(index % 12)"> {{ project.name }}</p>
                    <div :id="getTriangleId(index % 12)" :class="getTriangleClass(index % 12)"></div>
                    <img :src="projectSizeImagesSted((index % 12), project, 769)" :alt="projectSizeImagesName((index % 12), project, 769)" class="imagesSize">
                  </button>
                </div>
              </div>
            </div>
            <div v-else-if="windowswidth <= 425"> <!-- til mmobil -->
              <div  class="OuterBoksFlex" v-if="allProjects.length > 0">
                <div :id="getId(index % 12)" v-for="(project, index) in allProjects" :key="index" :class="getClass(index % 12)">
                  <button class="boks-btn" @click="openModal(project.id)">
                    <p :id="getTekstId(index % 12)" :class="getTekstClass(index % 12)"> {{ project.name }}</p>
                    <div :id="getTriangleId(index % 12)" :class="getTriangleClass(index % 12)"></div>
                    <img :src="projectSizeImagesSted((index % 12), project, 425)" :alt="projectSizeImagesName((index % 12), project, 425)" class="imagesSize">
                  </button>
                </div>
              </div>
            </div>
            
            
            <!-- <div  class="OuterBoksFlex" v-else>
              <div :id="getId(0)" :class="getClass(0)">
                <button class="boks-btn" @click="openModal(0)">
                  <p :id="getTekstId(0)" :class="getTekstClass(0)"> {{ allProjects.name }}</p>
                  <div :id="getTriangleId(0)" :class="getTriangleClass(0)"></div>
                  <img :src="allProjects.name" :alt="allProjects.name" class="imagesSize">
                </button>
              </div>
            </div> -->

            <!-- <div class="OuterBoksFlex">
              <div class="boks1-100" id="boks1">
                <p class="tekst1-100" id="tekst1">hej</p>
                <div class="triangle1-100" id="triangle1"></div>
              </div>
              <div class="boks2-100" id="boks2">
                <p class="tekst2-100" id="tekst2">hej</p>
                <div class="triangle2-100" id="triangle2"></div>
              </div>
              <div class="boks3-100" id="boks3">
                <p class="tekst3-100" id="tekst3">hej</p>
                <div class="triangle3-100" id="triangle3"></div>
              </div>
              <div class="boks4-100" id="boks4">
                <p class="tekst4-100" id="tekst4">hej</p>
                <div class="triangle4-100" id="triangle4"></div>
              </div>
              <div class="boks5-100" id="boks5">
                <p class="tekst5-100" id="tekst5">hej</p>
                <div class="triangle5-100" id="triangle5"></div>
              </div>
              <div class="boks6-100" id="boks6">
                <p class="tekst6-100" id="tekst6">hej</p>
                <div class="triangle6-100" id="triangle6"></div>
              </div>
              <div class="boks7-100" id="boks7">
                <p class="tekst7-100" id="tekst7">hej</p>
                <div class="triangle7-100" id="triangle7"></div>
              </div>
              <div class="boks8-100" id="boks8">
                <p class="tekst8-100" id="tekst8">hej</p>
                <div class="triangle8-100" id="triangle8"></div>
              </div>
              <div class="boks9-100" id="boks9">
                <p class="tekst9-100" id="tekst9">hej</p>
                <div class="triangle9-100" id="triangle9"></div>
              </div>
              <div class="boks10-100" id="boks10">
                <p class="tekst10-100" id="tekst10">hej</p>
                <div class="triangle10-100" id="triangle10"></div>
                </div>
              <div class="boks11-100" id="boks11">
                <p class="tekst11-100" id="tekst11">hej</p>
                <div class="triangle11-100" id="triangle11"></div>
                </div>
              <div class="boks12-100" id="boks12">
                <p class="tekst12-100" id="tekst12">hej</p>
                <div class="triangle12-100" id="triangle12"></div>
              </div>
            </div> -->

          </div>
        </div>
      </div>
    </div>

    <ShowProject>
        <div class="modal-images-fix">
          <button class="modal-btn" @click="changeSlideBack()">
            <ion-icon name="chevron-back-outline" class="close-ikon"></ion-icon>
          </button>

          <div id="slideShow">
            <div v-show="caruselShow[0]">
              <img class="modal-img" src="https://edusde-my.sharepoint.com/personal/annx3683_edu_sde_dk/Documents/test-billeder/moderne_hjemmeside.PNG" >
            </div>
            <div v-show="caruselShow[1]">
              <img class="modal-img" src="https://edusde-my.sharepoint.com/personal/annx3683_edu_sde_dk/Documents/test-billeder/Blog.PNG" >
            </div>
            <div v-show="caruselShow[2]">
              <img class="modal-img" src="https://edusde-my.sharepoint.com/personal/annx3683_edu_sde_dk/Documents/test-billeder/moderne_hjemmeside.PNG" >
            </div>
          </div>

          <button class="modal-btn btn-next " @click="changeSlideNext()">
            <ion-icon name="chevron-forward-outline" class="close-ikon"></ion-icon>
          </button>
        </div>
        <div class="modal-circle-box" >
          <div class="modal-circles" v-for="circle in caruselShow" :key="circle.id"></div>
        </div>
        <h2 class="modal-overskrift"> {{ OnlyOneProjekt.name }}</h2>
        <div>
          <p class="modal-date"> {{ OnlyOneProjekt.startDate }} - {{OnlyOneProjekt.endDate }}</p>
        </div>
        <div class="modal-kategori-flex">
          <div class="modal-kategori pinkColor">
            <p class="modal-kategori-tekst"> {{ OnlyOneProjekt.projectType }}</p>
          </div>
          <div class="modal-kategori yellowColor">
            <p class="modal-kategori-tekst"> {{ OnlyOneProjekt.workType }}</p>
          </div>
          <div class="modal-kategori greenColor" v-for=" proLanguage in OnlyOneProjekt.language" :key="proLanguage">
            <p class="modal-kategori-tekst" > {{ proLanguage.name }}</p>
          </div>
          <div class="modal-kategori redColor" v-for=" diagramPro in OnlyOneProjekt.diagram" :key="diagramPro">
            <p class="modal-kategori-tekst" > {{ diagramPro.name }}</p>
          </div>
          <div class="modal-kategori blueColor">
            <p class="modal-kategori-tekst"> {{ OnlyOneProjekt.software }}</p>
          </div>          
        </div>
        <div class="ekstra-Tekst">
          <button class="btnModalDown" @click="showText()">
            <ion-icon name="chevron-down-outline" class="close-ikon"></ion-icon>
          </button>
        </div>
        <div v-show="showTeskt" class="modal-secret-text-bottom">
          <p> {{ OnlyOneProjekt.description }}</p>
          <!-- <p>Hey there ~(^.^)~</p>
          <p>Waow all most nothings text on this!</p>
          <p>~(^.^)~ \(O~O) ~(o.o~) ($o$) (o.O)> ~(-.^) (~.~) (ô.O)? (@.@) (x.x) (õ_õ)/ (ò.ó) (-.-) (;o;) (^o^)/ { Hurra) (=.=) (OoO)! (*.*) (^v^) (U.U) ([].[]) (-@.@-) </p>
          <p>Skulle lave en hjemmeside til en Veteranbilklub hvor man kunne se informationer om klub, om medlemmerne og hvad for nogle veteranbiler de har. Man skulle også se hvad for reservadele de hade læggende. Så kan man også lave et login så man bliver medlem.</p>
          <p>Hey there ~(^.^)~</p>
          <p>Waow all most nothings text on this!</p>
          <p>~(^.^)~ \(O~O) ~(o.o~) ($o$) (o.O)> ~(-.^) (~.~) (ô.O)? (@.@) (x.x) (õ_õ)/ (ò.ó) (-.-) (;o;) (^o^)/ { Hurra) (=.=) </p>
          <p>Skulle lave en hjemmeside til en Veteranbilklub hvor man kunne se informationer om klub, om medlemmerne og hvad for nogle veteranbiler de har. Man skulle også se hvad for reservadele de hade læggende. Så kan man også lave et login så man bliver medlem.</p>
          <p>Hey there ~(^.^)~</p>
          <p>Waow all most nothings text on this!</p>
          <p>~(^.^)~ \(O~O) ~(o.o~) ($o$) (o.O)> ~(-.^) (~.~) (ô.O)? (@.@) (x.x) (õ_õ)/ (ò.ó) (-.-) (;o;) (^o^)/ { Hurra) (=.=) </p>
          <p>Skulle lave en hjemmeside til en Veteranbilklub hvor man kunne se informationer om klub, om medlemmerne og hvad for nogle veteranbiler de har. Man skulle også se hvad for reservadele de hade læggende. Så kan man også lave et login så man bliver medlem.</p>
          <p>Hey there ~(^.^)~</p>
          <p>Waow all most nothings text on this!</p>
          <p>~(^.^)~ \(O~O) ~(o.o~) ($o$) (o.O)> ~(-.^) (~.~) (ô.O)? (@.@) (x.x) (õ_õ)/ (ò.ó) (-.-) (;o;) (^o^)/ { Hurra) (=.=) </p>
          <p>Skulle lave en hjemmeside til en Veteranbilklub hvor man kunne se informationer om klub, om medlemmerne og hvad for nogle veteranbiler de har. Man skulle også se hvad for reservadele de hade læggende. Så kan man også lave et login så man bliver medlem.</p>
          <p>Hey there ~(^.^)~</p>
          <p>Waow all most nothings text on this!</p>
          <p>~(^.^)~ \(O~O) ~(o.o~) ($o$) (o.O)> ~(-.^) (~.~) (ô.O)? (@.@) (x.x) (õ_õ)/ (ò.ó) (-.-) (;o;) (^o^)/ { Hurra) (=.=) </p>
          <p>Skulle lave en hjemmeside til en Veteranbilklub hvor man kunne se informationer om klub, om medlemmerne og hvad for nogle veteranbiler de har. Man skulle også se hvad for reservadele de hade læggende. Så kan man også lave et login så man bliver medlem.</p>
          <p>Hey there ~(^.^)~</p>
          <p>Waow all most nothings text on this!</p>
          <p>~(^.^)~ \(O~O) ~(o.o~) ($o$) (o.O)> ~(-.^) (~.~) (ô.O)? (@.@) (x.x) (õ_õ)/ (ò.ó) (-.-) (;o;) (^o^)/ { Hurra) (=.=) </p>
          <p>Skulle lave en hjemmeside til en Veteranbilklub hvor man kunne se informationer om klub, om medlemmerne og hvad for nogle veteranbiler de har. Man skulle også se hvad for reservadele de hade læggende. Så kan man også lave et login så man bliver medlem.</p> -->
        </div>
    </ShowProject>

  </div>
</template>

<script>
  import axios from 'axios'
  import ShowProject from '../components/showProject.vue'
  import eventBus from '../eventBus'

  export default {
    name: 'projekt', 
    components: {
      ShowProject
    },
    data(){
      return{
        css: "display: none;",              // til når sidebaren skal vises eller gemmes
        sidemenuBoks: "flex: 0%;",          // til størrelsen til sidebaren
        projekterneBoks: "flex: 100%;",     // til størrelsen til projekterne
        sprogCss: "display: none;",         // til når sprog-search skal vises eller gemmes 
        diagramCss: "display: none;",       // til når diagram-search skal vises eller gemmes
        softwareCss: "display: none;",      // til når software-search skal vises eller gemmes
        projektTypeCss: "display: none;",   // til når projekts type-search skal vises eller gemmes
        arbejdsTypeCss: "display: none;",   // til når arbejdes type-search skal vises eller gemmes
        ikon: "arrow-forward-outline",      // til at ikonen kan skifte form
        api: "http://localhost/re-portfolio/API/index.php/api",
        windowswidth: 0,                    // til skærmen størrelsen
        sprog: [],                          // til sprog-data fra databasen
        diagram: [],                        // til diagram-data fra databasen
        software: [],                       // til software-data fra databasen
        projektType: [],                    // til projekts type-data fra databasen
        arbejdsType: [],                    // til arbejdes type-data fra databasen
        typeArray: [],                      // til array med hvilke ting man søge efter fra sidebar søge funktionen
        allProjects: [],                    // til data om projekterne fra databasen
        OnlyOneProjekt: [],                 // til data om den bestemte projektet 
        searchMenu: [],                     // til array til api, til søge funktion
        caruselShow: [                      // midlertidig array som den ser ud lige nu til hvor mange billeder der bliver sendt med  
          true, 
          false, 
          false
        ],
        searchTempSoft: [],
        searchTempPro: [],
        searchTempWork: [],
        searchProjectKanp: [],
        searchWorkKanp: [],
        searchsoftwareKanp: [],
        showTeskt: false                    // til at teksten skal vises eller ikke
      }
    },
    created(){
      this.allProject(),
      this.getSprog(),
      this.getDiagram(),
      this.getProjektType(),
      this.getArbejdsType(),
      this.getSoftware(),
      this.imagesShiftSize()
      this.showText()
    },
    mounted(){
      window.addEventListener('scroll', this.stickNavbar) // laver en event.
      this.$nextTick(function() {
        window.addEventListener('resize', this.getWindowWidth);
        //Init
        this.getWindowWidth()
      })
    },
    methods:{
      allProject(){ // henter alle projekterne ned jeg har i databasen
        axios
          .get(this.api + '/projekt', {
            headers: {
              'Accept': 'application/json'
            }
          })
          .then(Response => {
            this.allProjects = Response.data
            console.log(this.allProjects)
          })
          .catch(err => {
            console.log(err.toString());
          })
      },
      hideAndSeek(tekst){ // gør at sidebaren kommer frem, samtidig med at den bliver delt op i to og ovent til en
        let searchBar = document.getElementById("siteBar");
        let btn1 = document.getElementById("hideAndSeekBtn1")
        let btn2 = document.getElementById("hideAndSeekBtn2")
        let btn3 = document.getElementById("hideAndSeekBtn3")
        let btn4 = document.getElementById("hideAndSeekBtn4")
        let btn5 = document.getElementById("hideAndSeekBtn5")

        switch (tekst) {
          case "projektType":
            if(this.projektTypeCss == "display: none;"){
              this.projektTypeCss = "display: block;";
            }
            else{
              this.projektTypeCss = "display: none;";
            }
            break;
          case "arbejdsType":
            if(this.arbejdsTypeCss == "display: none;"){
              this.arbejdsTypeCss = "display: block;";
            }
            else{
              this.arbejdsTypeCss = "display: none;";
            }
            break;
          case "software":
            if(this.softwareCss == "display: none;"){
              this.softwareCss = "display: block;";
            }
            else{
              this.softwareCss = "display: none;";
            }
            break;
          case "diagram":
            if(this.diagramCss == "display: none;"){
              this.diagramCss = "display: block;";
            }
            else{
              this.diagramCss = "display: none;";
            }
            break;
          case "sprog":
            if(this.sprogCss == "display: none;"){
              this.sprogCss = "display: block;";
            }
            else{
              this.sprogCss = "display: none;";
            }
            break;
          default:
            if(this.css == "display: none;"){
              this.css = "display: block;";
              searchBar.classList.add("show-site-bar")
              searchBar.classList.remove("hidde-site-bar")
              btn1.classList.add("hideAndSeekAnimation");
              btn2.classList.add("hideAndSeekAnimation");
              btn3.classList.add("hideAndSeekAnimation");
              btn4.classList.add("hideAndSeekAnimation");
              btn5.classList.add("hideAndSeekAnimation");
              this.sidemenuBoks = "flex: 20%;";
              this.projekterneBoks = "flex: 80%;";
              this.imagesShiftSize();
            }
            else{
              this.css = "display: none;";
              searchBar.classList.add("hidde-site-bar")
              searchBar.classList.remove("show-site-bar")
              btn1.classList.remove("hideAndSeekAnimation");
              btn2.classList.remove("hideAndSeekAnimation");
              btn3.classList.remove("hideAndSeekAnimation");
              btn4.classList.remove("hideAndSeekAnimation");
              btn5.classList.remove("hideAndSeekAnimation");
              this.sidemenuBoks = "flex: 0%;";
              this.projekterneBoks = "flex: 100%;";
              this.imagesShiftSize();
            }
            break;
          
        }

        if(this.ikon == "arrow-forward-outline"){
          this.ikon = "arrow-back-outline"
        }
        else{
          this.ikon = "arrow-forward-outline"
        }
      },
      getSprog(){ // henter alle data'en der ligger under sprog i databasen
        axios
          .get('http://localhost/re-portfolio/API/index.php/api/language',{
            headers: {
              'Accept': 'application/json'
            }
          })
          .then(Response => {
            this.sprog = Response.data
            console.log(this.sprog)
          })
          .catch(err => {
            console.log(err.toString());
          })
          // this.allProject()
      },
      getDiagram(){ // henter alle data'en der ligger under diagram i databasen
        axios
          .get('http://localhost/re-portfolio/API/index.php/api/diagram',{
            headers: {
              'Accept': 'application/json'
            }
          })
          .then(Response => {
            this.diagram = Response.data
          })
          .catch(err => {
            console.log(err.toString());
          })
      }, 
      getProjektType(){ // henter alle data'en der ligger under projekt typer i databasen
        axios
          .get('http://localhost/re-portfolio/API/index.php/api/projekt-type',{
            headers: {
              'Accept': 'application/json'
            }
          })
          .then(Response => {
            this.projektType = Response.data
          })
          .catch(err => {
            console.log(err.toString());
          })
      },
      getArbejdsType(){ // henter alle data'en der ligger under arbejdes typer i databasen
        axios
          .get('http://localhost/re-portfolio/API/index.php/api/work-type',{
            headers: {
              'Accept': 'application/json'
            }
          })
          .then(Response => {
            this.arbejdsType = Response.data
          })
          .catch(err => {
            console.log(err.toString());
          })
      },
      getSoftware(){ // henter alle data'en der ligger under software i databasen
        axios
          .get('http://localhost/re-portfolio/API/index.php/api/software',{
            headers: {
              'Accept': 'application/json'
            }
          })
          .then(Response => {
            this.software = Response.data
          })
          .catch(err => {
            console.log(err.toString());
          })
      },
      getOneProjekt(id){ // henter kun et projekt fra databasen der bliver sprurgt efter
         axios
          .get(this.api + '/projekt/' + id,{
            headers: {
              'Accept': 'application/json'
            }
          })
          .then(Response => {
            this.OnlyOneProjekt = Response.data

            // this.OnlyOneProjekt.language =  this.OnlyOneProjekt.language.split(",")
            // this.OnlyOneProjekt.diagram = this.OnlyOneProjekt.diagram.split(",")
            console.log(this.OnlyOneProjekt)
            console.log(this.OnlyOneProjekt[0].name)

          })
          .catch(err => {
            console.log(err.toString());
          })
      },
      // i gang her --------------------------------------------------------------------------------------------------------------------!
      searchMenuDynamisk(type, sted, knap){ // henter de bestemte projekter der bliver søgt efter i sidebaren
        let countTypeArray = this.typeArray.length
        console.log(type)

        switch (sted) {
          case "projekt_type": // virker ikke i nu
            this.searchProjectKanp.push(knap)
            let countTemp = 0 
            let countProKnap = this.searchProjectKanp.length


            if(this.typeArray.includes(type)){
              countTemp = this.searchTempPro.length

              for (let i = 0; i < countTypeArray; i++) {
                if(this.typeArray[i] == type){
                  delete this.typeArray[i]
                }
              }
              for (let l = 0; l < countTemp; l++) {
                if(this.searchTempPro[l] == type){
                  delete this.searchTempPro[l]
                }
              }
              for (let j = 0; j < countProKnap; j++) {
                if(this.searchProjectKanp[j] == knap){
                  delete this.searchProjectKanp[j]
                }
              }

              this.searchProjectKanp = this.searchProjectKanp.filter(function() {return true})
              this.searchTempPro = this.searchTempPro.filter(function() {return true})
              this.typeArray = this.typeArray.filter(function() {return true})
              console.log("ned i slette")
            }
            else{
              this.typeArray.push(type)
              this.searchTempPro.push(type)
              countTemp = this.searchTempPro.length

              if(countTemp <= 2){
                
                for (let j = 0; j < countProKnap; j++) {
                  if(this.searchProjectKanp[j] != knap){
                    document.getElementById(this.searchProjectKanp[j]).checked = false
                    delete this.searchProjectKanp[j]
                  }
                }
                for (let l = 0; l < countTemp; l++) {
                  if(this.searchTempPro[l] != type){

                    for (let i = 0; i < countTypeArray; i++) {
                      if(this.typeArray[i] == this.searchTempPro[l]){
                        delete this.typeArray[i]
                      }
                      this.typeArray = this.typeArray.filter(function() {return true})
                    }
                    delete this.searchTempPro[l]
                  }
                  this.searchTempPro = this.searchTempPro.filter(function() {return true})
                }
                this.searchProjectKanp = this.searchProjectKanp.filter(function() {return true})

              }
             
              console.log("ned i opret")
            }
            console.log(this.searchProjectKanp)
            console.log(this.searchTempPro)
            console.log(this.typeArray)
            break;
          case "arbejds_type": 
            this.searchWorkKanp.push(knap)
            let countWorkKnap = this.searchWorkKanp.length
            let countTempWork = this.searchTempWork.length
            let countWork = this.arbejdsType.length

            if(this.typeArray.includes(type)){ // for at fjene type i "typeArray"
              for (let i = 0; i < countTypeArray; i++) { // for at slette type i "typeArray"
                if(this.typeArray[i] == type){
                  delete this.typeArray[i]
                }
              }
              for (let j = 0; j < countWorkKnap; j++) { // for at slette knap i "searchSoftwateKanp"
                if(this.searchWorkKanp[j] == knap){
                  delete this.searchWorkKanp[j]
                }
              }
              for (let l = 0; l < countTempWork; l++) { // for at slette type i countTempSoft
                if(this.searchTempWork[l] == type){
                  delete this.searchTempWork[l]
                }
                this.searchTempWork = this.searchTempWork.filter(function() {return true})
              }
              this.searchWorkKanp = this.searchWorkKanp.filter(function() {return true})
              this.typeArray = this.typeArray.filter(function() {return true})
            }
            else{
              this.typeArray.push(type)
              this.searchTempWork.push(type)

              if(countWorkKnap == countWork){
                for (let j = 0; j < countWorkKnap; j++) {
                  if(this.searchWorkKanp[j] != knap){
                    document.getElementById(this.searchWorkKanp[j]).checked = false
                    delete this.searchWorkKanp[j]
                  }                  
                }
                for (let l = 0; l < countTempWork; l++) {
                  if(this.searchTempSoft[l] != type){

                    for (let i = 0; i < countTypeArray; i++) {
                      if(this.typeArray[i] == this.searchTempWork[l]){
                        delete this.typeArray[i]
                      }
                    }
                    delete this.searchTempWork[l]
                    this.typeArray = this.typeArray.filter(function() {return true})
                  }
                  this.searchTempWork = this.searchTempWork.filter(function() {return true})
                }
                this.searchWorkKanp = this.searchWorkKanp.filter(function() {return true})
              }

              console.log(this.searchWorkKanp)
              console.log(this.searchTempWork)
              console.log(this.typeArray)
            }
            break;
          case "software":
            this.searchsoftwareKanp.push(knap)
            let countSoftwareKnap = this.searchsoftwareKanp.length
            let countTempSoft = this.searchTempSoft.length
            let countSoftware = this.software.length

            if(this.typeArray.includes(type)){ // for at fjene type i "typeArray"
              for (let i = 0; i < countTypeArray; i++) { // for at slette type i "typeArray"
                if(this.typeArray[i] == type){
                  delete this.typeArray[i]
                }
              }
              for (let j = 0; j < countSoftwareKnap; j++) { // for at slette knap i "searchSoftwateKanp"
                if(this.searchsoftwareKanp[j] == knap){
                  delete this.searchsoftwareKanp[j]
                }
              }
              for (let l = 0; l < countTempSoft; l++) { // for at slette type i countTempSoft
                if(this.searchTempSoft[l] == type){
                  delete this.searchTempSoft[l]
                }
                this.searchTempSoft = this.searchTempSoft.filter(function() {return true})
              }
              this.searchsoftwareKanp = this.searchsoftwareKanp.filter(function() {return true})
              this.typeArray = this.typeArray.filter(function() {return true})
            }
            else{ // for at tilføje type til "typeArray"
              this.typeArray.push(type)
              this.searchTempSoft.push(type)

              if(countSoftwareKnap == countSoftware){
                for (let j = 0; j < countSoftwareKnap; j++) { // for at fjene checkmærket på den der allerede er checket
                  if(this.searchsoftwareKanp[j] != knap){
                    document.getElementById(this.searchsoftwareKanp[j]).checked = false
                    delete this.searchsoftwareKanp[j]
                  }
                }
                for (let l = 0; l < countTempSoft; l++) { // for at fjene den modsatte type i "searchTempSoft" og  "typeArray"
                  if(this.searchTempSoft[l] != type){

                    for (let i = 0; i < countTypeArray; i++) { // for at fjene den modsatte type i "typeArray"
                      if(this.typeArray[i] == this.searchTempSoft[l]){
                        delete this.typeArray[i]
                      }
                    }
                    delete this.searchTempSoft[l]
                    this.typeArray = this.typeArray.filter(function() {return true})
                  }
                  this.searchTempSoft = this.searchTempSoft.filter(function() {return true}) 
                }
                this.searchsoftwareKanp = this.searchsoftwareKanp.filter(function() {return true})
              }
            }


            console.log(this.searchsoftwareKanp)
            console.log(this.searchTempSoft)
            console.log(this.typeArray)
            break;
          case "diagram":
            if(this.typeArray.includes(type)){
              for (let i = 0; i < countTypeArray; i++) { // for at slette den samme værdi til databasen
                if(this.typeArray[i] == type){
                  delete this.typeArray[i]
                }                  
              }
              this.typeArray = this.typeArray.filter(function() {return true})
            }
            else{
              this.typeArray.push(type)
            }

            console.log(this.typeArray)
            break;
          case "sprog": 
            if(this.typeArray.includes(type)){
              for (let i = 0; i < countTypeArray; i++) {
                if(this.typeArray[i] == type){
                  delete this.typeArray[i]
                }
              }
              this.typeArray = this.typeArray.filter(function() {return true})
            }
            else{
              this.typeArray.push(type)
            }
            console.log(this.typeArray)
            break;
        }
        console.log(type)
        console.log(this.typeArray)


        this.searchMenu = this.typeArray.toString();


        this.allProjects = []

        this.allProjects = this.allProjects.filter(function() {return true}); 

        if(this.searchMenu == 0){
          console.log("intet på searchmenu")
          this.allProject()
        }
        else{
          console.log("noget på serachmenu")
          axios
            .get('http://localhost/re-portfolio/API/index.php/api/projekt/search-menu',{
              headers: {
                'Accept': 'application/json'
              },
              params:{
                search: this.searchMenu
              }
            })
            .then(Response => {
              this.$set(this.allProjects = Response.data)
            })
            .catch(err => {
              console.log(err.toString());
            })
        }
      },
      /*test1(id, sted){
        if(sted == 'arbejdstype'){
          let countArbejdsType = this.arbejdsType.length;
          for(let i = 0; i < countArbejdsType; i++){

            if(document.getElementById('arbejdstype' + this.arbejdsType[i].id).checked == true){
              if(this.arbejdsType[i].id != id){
                document.getElementById('arbejdstype' + this.arbejdsType[i].id).checked = false;
                this.test('arbejds_type-' + this.arbejdsType[i].id);

              }
            }
            
          }
        }
        else if(sted == 'software'){
          let countSoftware = this.software.length;
          for(let i = 0; i < countSoftware; i++){

            if(document.getElementById('software' + this.software[i].id).checked == true){
              if(this.software[i].id != id){
                document.getElementById('software' + this.software[i].id).checked = false;
                this.test('software-' + this.software[i].id);
              }
            }
          }
        }
      },*/
      stickNavbar(){ // går at navbaren liver sticky så den bliver på den plads
        let projekt = document.getElementById("projekterne");

        // Bruger eventer scroll for at se hvornår man rækker sig op eller ned på siden
        if(window.scrollY > 0){
          projekt.classList.add("strickyProjektHeigth");
        }
        else{
          projekt.classList.remove("strickyProjektHeigth");
        }
      },
      imagesShiftSize(){ // går at når sidebaren er visten at den skrifter fra boks1-100 til boks1-50 for den skal være mindre i størrelse
        let Boks1 = document.getElementById("boks1")
        let Boks2 = document.getElementById("boks2")
        let Boks3 = document.getElementById("boks3")
        let Boks4 = document.getElementById("boks4")
        let Boks5 = document.getElementById("boks5")
        let Boks6 = document.getElementById("boks6")
        let Boks7 = document.getElementById("boks7")
        let Boks8 = document.getElementById("boks8")
        let Boks9 = document.getElementById("boks9")
        let Boks10 = document.getElementById("boks10")
        let Boks11 = document.getElementById("boks11")
        let Boks12 = document.getElementById("boks12")

        let Tekst1 = document.getElementById("tekst1")
        let Tekst2 = document.getElementById("tekst2")
        let Tekst3 = document.getElementById("tekst3")
        let Tekst4 = document.getElementById("tekst4")
        let Tekst5 = document.getElementById("tekst5")
        let Tekst6 = document.getElementById("tekst6")
        let Tekst7 = document.getElementById("tekst7")
        let Tekst8 = document.getElementById("tekst8")
        let Tekst9 = document.getElementById("tekst9")
        let Tekst10 = document.getElementById("tekst10")
        let Tekst11 = document.getElementById("tekst11")
        let Tekst12 = document.getElementById("tekst12")

        let Triangle1 = document.getElementById("triangle1")
        let Triangle2 = document.getElementById("triangle2")
        let Triangle3 = document.getElementById("triangle3")
        let Triangle4 = document.getElementById("triangle4")
        let Triangle5 = document.getElementById("triangle5")
        let Triangle6 = document.getElementById("triangle6")
        let Triangle7 = document.getElementById("triangle7")
        let Triangle8 = document.getElementById("triangle8")
        let Triangle9 = document.getElementById("triangle9")
        let Triangle10 = document.getElementById("triangle10")
        let Triangle11 = document.getElementById("triangle11")
        let Triangle12 = document.getElementById("triangle12")

        if(this.windowswidth <= 769){
            Boks1.classList.add("boks1-100");
            Boks1.classList.remove("boks1-50");
            Boks2.classList.add("boks2-100");
            Boks2.classList.remove("boks2-50");
            Boks3.classList.add("boks3-100");
            Boks3.classList.remove("boks3-50");
            Boks4.classList.add("boks4-100");
            Boks4.classList.remove("boks4-50");
            Boks5.classList.add("boks5-100");
            Boks5.classList.remove("boks5-50");
            Boks6.classList.add("boks6-100");
            Boks6.classList.remove("boks6-50");
            Boks7.classList.add("boks7-100");
            Boks7.classList.remove("boks7-50");
            Boks8.classList.add("boks8-100");
            Boks8.classList.remove("boks8-50");
            Boks9.classList.add("boks9-100");
            Boks9.classList.remove("boks9-50");
            Boks10.classList.add("boks10-100");
            Boks10.classList.remove("boks10-50");
            Boks11.classList.add("boks11-100");
            Boks11.classList.remove("boks11-50");
            Boks12.classList.add("boks12-100");
            Boks12.classList.remove("boks12-50");

            Tekst1.classList.add("tekst1-100");
            Tekst1.classList.remove("tekst1-50");
            Tekst2.classList.add("tekst2-100");
            Tekst2.classList.remove("tekst2-50");
            Tekst3.classList.add("tekst3-100");
            Tekst3.classList.remove("tekst3-50");
            Tekst4.classList.add("tekst4-100");
            Tekst4.classList.remove("tekst4-50");
            Tekst5.classList.add("tekst5-100");
            Tekst5.classList.remove("tekst5-50");
            Tekst6.classList.add("tekst6-100");
            Tekst6.classList.remove("tekst6-50");
            Tekst7.classList.add("tekst7-100");
            Tekst7.classList.remove("tekst7-50");
            Tekst8.classList.add("tekst8-100");
            Tekst8.classList.remove("tekst8-50");
            Tekst9.classList.add("tekst9-100");
            Tekst9.classList.remove("tekst9-50");
            Tekst10.classList.add("tekst10-100");
            Tekst10.classList.remove("tekst10-50");
            Tekst11.classList.add("tekst11-100");
            Tekst11.classList.remove("tekst11-50");
            Tekst12.classList.add("tekst12-100");
            Tekst12.classList.remove("tekst12-50");

            Triangle1.classList.add("triangle1-100");
            Triangle1.classList.remove("triangle1-50");
            Triangle2.classList.add("triangle2-100");
            Triangle2.classList.remove("triangle2-50");
            Triangle3.classList.add("triangle3-100");
            Triangle3.classList.remove("triangle3-50");
            Triangle4.classList.add("triangle4-100");
            Triangle4.classList.remove("triangle4-50");
            Triangle5.classList.add("triangle5-100");
            Triangle5.classList.remove("triangle5-50");
            Triangle6.classList.add("triangle6-100");
            Triangle6.classList.remove("triangle6-50");
            Triangle7.classList.add("triangle7-100");
            Triangle7.classList.remove("triangle7-50");
            Triangle8.classList.add("triangle8-100");
            Triangle8.classList.remove("triangle8-50");
            Triangle9.classList.add("triangle9-100");
            Triangle9.classList.remove("triangle9-50");
            Triangle10.classList.add("triangle10-100");
            Triangle10.classList.remove("triangle10-50");
            Triangle11.classList.add("triangle11-100");
            Triangle11.classList.remove("triangle11-50");
            Triangle12.classList.add("triangle12-100");
            Triangle12.classList.remove("triangle12-50");
        }
        else{
          if(this.css == "display: none;"){
            Boks1.classList.add("boks1-100");
            Boks1.classList.remove("boks1-50");
            Boks2.classList.add("boks2-100");
            Boks2.classList.remove("boks2-50");
            Boks3.classList.add("boks3-100");
            Boks3.classList.remove("boks3-50");
            Boks4.classList.add("boks4-100"); /// her
            Boks4.classList.remove("boks4-50");
            Boks5.classList.add("boks5-100");
            Boks5.classList.remove("boks5-50");
            Boks6.classList.add("boks6-100");
            Boks6.classList.remove("boks6-50");
            Boks7.classList.add("boks7-100");
            Boks7.classList.remove("boks7-50");
            Boks8.classList.add("boks8-100");
            Boks8.classList.remove("boks8-50");
            Boks9.classList.add("boks9-100");
            Boks9.classList.remove("boks9-50");
            Boks10.classList.add("boks10-100");
            Boks10.classList.remove("boks10-50");
            Boks11.classList.add("boks11-100");
            Boks11.classList.remove("boks11-50");
            Boks12.classList.add("boks12-100");
            Boks12.classList.remove("boks12-50");

            Tekst1.classList.add("tekst1-100");
            Tekst1.classList.remove("tekst1-50");
            Tekst2.classList.add("tekst2-100");
            Tekst2.classList.remove("tekst2-50");
            Tekst3.classList.add("tekst3-100");
            Tekst3.classList.remove("tekst3-50");
            Tekst4.classList.add("tekst4-100");
            Tekst4.classList.remove("tekst4-50");
            Tekst5.classList.add("tekst5-100");
            Tekst5.classList.remove("tekst5-50");
            Tekst6.classList.add("tekst6-100");
            Tekst6.classList.remove("tekst6-50");
            Tekst7.classList.add("tekst7-100");
            Tekst7.classList.remove("tekst7-50");
            Tekst8.classList.add("tekst8-100");
            Tekst8.classList.remove("tekst8-50");
            Tekst9.classList.add("tekst9-100");
            Tekst9.classList.remove("tekst9-50");
            Tekst10.classList.add("tekst10-100");
            Tekst10.classList.remove("tekst10-50");
            Tekst11.classList.add("tekst11-100");
            Tekst11.classList.remove("tekst11-50");
            Tekst12.classList.add("tekst12-100");
            Tekst12.classList.remove("tekst12-50");

            Triangle1.classList.add("triangle1-100");
            Triangle1.classList.remove("triangle1-50");
            Triangle2.classList.add("triangle2-100");
            Triangle2.classList.remove("triangle2-50");
            Triangle3.classList.add("triangle3-100");
            Triangle3.classList.remove("triangle3-50");
            Triangle4.classList.add("triangle4-100");
            Triangle4.classList.remove("triangle4-50");
            Triangle5.classList.add("triangle5-100");
            Triangle5.classList.remove("triangle5-50");
            Triangle6.classList.add("triangle6-100");
            Triangle6.classList.remove("triangle6-50");
            Triangle7.classList.add("triangle7-100");
            Triangle7.classList.remove("triangle7-50");
            Triangle8.classList.add("triangle8-100");
            Triangle8.classList.remove("triangle8-50");
            Triangle9.classList.add("triangle9-100");
            Triangle9.classList.remove("triangle9-50");
            Triangle10.classList.add("triangle10-100");
            Triangle10.classList.remove("triangle10-50");
            Triangle11.classList.add("triangle11-100");
            Triangle11.classList.remove("triangle11-50");
            Triangle12.classList.add("triangle12-100");
            Triangle12.classList.remove("triangle12-50");
          }
          else{
            Boks1.classList.remove("boks1-100");
            Boks1.classList.add("boks1-50");
            Boks2.classList.remove("boks2-100");
            Boks2.classList.add("boks2-50");
            Boks3.classList.remove("boks3-100");
            Boks3.classList.add("boks3-50");
            Boks4.classList.remove("boks4-100");
            Boks4.classList.add("boks4-50");
            Boks5.classList.remove("boks5-100");
            Boks5.classList.add("boks5-50");
            Boks6.classList.remove("boks6-100");
            Boks6.classList.add("boks6-50");
            Boks7.classList.remove("boks7-100");
            Boks7.classList.add("boks7-50");
            Boks8.classList.remove("boks8-100");
            Boks8.classList.add("boks8-50");
            Boks9.classList.remove("boks9-100");
            Boks9.classList.add("boks9-50");
            Boks10.classList.remove("boks10-100");
            Boks10.classList.add("boks10-50");
            Boks11.classList.remove("boks11-100");
            Boks11.classList.add("boks11-50");
            Boks12.classList.remove("boks12-100");
            Boks12.classList.add("boks12-50");

            Tekst1.classList.remove("tekst1-100");
            Tekst1.classList.add("tekst1-50");
            Tekst2.classList.remove("tekst2-100");
            Tekst2.classList.add("tekst2-50");
            Tekst3.classList.remove("tekst3-100");
            Tekst3.classList.add("tekst3-50");
            Tekst4.classList.remove("tekst4-100"); //her
            Tekst4.classList.add("tekst4-50");
            Tekst5.classList.remove("tekst5-100");
            Tekst5.classList.add("tekst5-50");
            Tekst6.classList.remove("tekst6-100");
            Tekst6.classList.add("tekst6-50");
            Tekst7.classList.remove("tekst7-100");
            Tekst7.classList.add("tekst7-50");
            Tekst8.classList.remove("tekst8-100");
            Tekst8.classList.add("tekst8-50");
            Tekst9.classList.remove("tekst9-100");
            Tekst9.classList.add("tekst9-50");
            Tekst10.classList.remove("tekst10-100");
            Tekst10.classList.add("tekst10-50");
            Tekst11.classList.remove("tekst11-100");
            Tekst11.classList.add("tekst11-50");
            Tekst12.classList.remove("tekst12-100");
            Tekst12.classList.add("tekst12-50");

            Triangle1.classList.remove("triangle1-100");
            Triangle1.classList.add("triangle1-50");
            Triangle2.classList.remove("triangle2-100");
            Triangle2.classList.add("triangle2-50");
            Triangle3.classList.remove("triangle3-100");
            Triangle3.classList.add("triangle3-50");
            Triangle4.classList.remove("triangle4-100");
            Triangle4.classList.add("triangle4-50");
            Triangle5.classList.remove("triangle5-100");
            Triangle5.classList.add("triangle5-50");
            Triangle6.classList.remove("triangle6-100");
            Triangle6.classList.add("triangle6-50");
            Triangle7.classList.remove("triangle7-100");
            Triangle7.classList.add("triangle7-50");
            Triangle8.classList.remove("triangle8-100");
            Triangle8.classList.add("triangle8-50");
            Triangle9.classList.remove("triangle9-100");
            Triangle9.classList.add("triangle9-50");
            Triangle10.classList.remove("triangle10-100");
            Triangle10.classList.add("triangle10-50");
            Triangle11.classList.remove("triangle11-100");
            Triangle11.classList.add("triangle11-50");
            Triangle12.classList.remove("triangle12-100");
            Triangle12.classList.add("triangle12-50");
          }
        }
      },
      projectSizeImagesSted(index, project, windowsPlace){ 
        if(windowsPlace == 425){
          return project.images[3].sted
        }
        else{
          if(index === 0){
            if(windowsPlace == 770){
              return project.images[1].sted
            }
            else{
              return project.images[1].sted
            }
          }
          else if(index === 1){
            if(windowsPlace == 770){
              return project.images[1].sted
            }
            else{
              return project.images[1].sted
            }
          }
          else if(index === 2){
            if(windowsPlace == 770){
              return project.images[2].sted
            }
            else{
              return project.images[3].sted
            }
          }
          else if(index === 3){
            if(windowsPlace == 770){
              return project.images[3].sted
            }
            else{
              return project.images[2].sted
            }
          }
          else if(index === 4){
            if(windowsPlace == 770){
              return project.images[1].sted
            }
            else{
              return project.images[1].sted
              
            }
          }
          else if(index === 5){
            if(windowsPlace == 770){
              return project.images[3].sted
            }
            else{
              return project.images[1].sted
            }
          }
          else if(index === 6){
            if(windowsPlace == 770){
              return project.images[3].sted
            }
            else{
              return project.images[3].sted
            }
          }
          else if(index == 7){
            if(windowsPlace == 770){
              return project.images[1].sted
            }
            else{
              return project.images[1].sted
            }
          }
          else if(index === 8){
            if(windowsPlace == 770){
              return project.images[2].sted
            }
            else{
              return project.images[1].sted
            }
          }
          else if(index === 9){
            if(windowsPlace == 770){
              return project.images[1].sted
            }
            else{
              return project.images[1].sted
              
            }
          }
          else if(index === 10){
            if(windowsPlace == 770){
              return project.images[1].sted
            }
            else{
              return project.images[2].sted
            }
          }
          else if(index === 11){
            if(windowsPlace == 770){
              return project.images[3].sted
            }
            else{
              return project.images[1].sted
            }
          }
        }
      },
      projectSizeImagesName(index, project, windowsPlace){ 
        if(windowsPlace == 425){
          return project.images[1].name

        }
        else{
          if(index === 0){
            if(windowsPlace == 770){
              return project.images[1].name
            }
            else{
              return project.images[1].name
            }
          }
          else if(index === 1){
            if(windowsPlace == 770){
              return project.images[1].name
            }
            else{
              return project.images[1].name
            }
          }
          else if(index === 2){
            if(windowsPlace == 770){
              return project.images[2].name
            }
            else{
              return project.images[3].name
            }
          }
          else if(index === 3){
            if(windowsPlace == 770){
              return project.images[3].name
            }
            else{
              return project.images[2].name
            }
          }
          else if(index === 4){
            if(windowsPlace == 770){
              return project.images[1].name
            }
            else{
              return project.images[1].name
              
            }
          }
          else if(index === 5){
            if(windowsPlace == 770){
              return project.images[3].name
            }
            else{
              return project.images[1].name
            }
          }
          else if(index === 6){
            if(windowsPlace == 770){
              return project.images[3].name
            }
            else{
              return project.images[3].name
            }
          }
          else if(index == 7){
            if(windowsPlace == 770){
              return project.images[1].name
            }
            else{
              return project.images[1].name
            }
          }
          else if(index === 8){
            if(windowsPlace == 770){
              return project.images[2].name
            }
            else{
              return project.images[1].name
            }
          }
          else if(index === 9){
            if(windowsPlace == 770){
              return project.images[1].name
            }
            else{
              return project.images[1].name
              
            }
          }
          else if(index === 10){
            if(windowsPlace == 770){
              return project.images[1].name
            }
            else{
              return project.images[2].name
            }
          }
          else if(index === 11){
            if(windowsPlace == 770){
              return project.images[3].name
            }
            else{
              return project.images[1].name
            }
          }
        }
        
      },
      getWindowWidth(event) { // gør at jeg ved hvilken størrelse pc skræmen er og får de for skellige ting lavet om samtidig
        this.windowswidth = window.innerWidth;
        this.imagesShiftSize()
        this.showText()
        this.allProject()
      },
      getClass(index){ // gør at elemtent for den rigtigte class efter hvilken tal den skal have
        if(index === 0){
          return 'boks1-100'
        }
        else if(index === 1){
          return 'boks2-100'
        }
        else if(index === 2){
          return 'boks3-100'
        }
        else if(index === 3){
          return 'boks4-100'
        }
        else if(index === 4){
          return 'boks5-100'
        }
        else if(index === 5){
          return 'boks6-100'
        }
        else if(index === 6){
          return 'boks7-100'
        }
        else if(index == 7){
          return 'boks8-100'
        }
        else if(index === 8){
          return 'boks9-100'
        }
        else if(index === 9){
          return 'boks10-100'
        }
        else if(index === 10){
          return 'boks11-100'
        }
        else if(index === 11){
          return 'boks12-100'
        }
      },
      getTekstClass(index){ // gør at elemtent for den rigtigte class efter hvilken tal den skal have
        if(index === 0){
          return 'tekst1-100'
        }
        else if(index === 1){
          return 'tekst2-100'
        }
        else if(index === 2){
          return 'tekst3-100'
        }
        else if(index === 3){
          return 'tekst4-100'
        }
        else if(index === 4){
          return 'tekst5-100'
        }
        else if(index === 5){
          return 'tekst6-100'
        }
        else if(index === 6){
          return 'tekst7-100'
        }
        else if(index == 7){
          return 'tekst8-100'
        }
        else if(index === 8){
          return 'tekst9-100'
        }
        else if(index === 9){
          return 'tekst10-100'
        }
        else if(index === 10){
          return 'tekst11-100'
        }
        else if(index === 11){
          return 'tekst12-100'
        }
      },
      getTriangleClass(index){ // gør at elemtent for den rigtigte class efter hvilken tal den skal have
        if(index === 0){
          return 'triangle1-100'
        }
        else if(index === 1){
          return 'triangle2-100'
        }
        else if(index === 2){
          return 'triangle3-100'
        }
        else if(index === 3){
          return 'triangle4-100'
        }
        else if(index === 4){
          return 'triangle5-100'
        }
        else if(index === 5){
          return 'triangle6-100'
        }
        else if(index === 6){
          return 'triangle7-100'
        }
        else if(index == 7){
          return 'triangle8-100'
        }
        else if(index === 8){
          return 'triangle9-100'
        }
        else if(index === 9){
          return 'triangle10-100'
        }
        else if(index === 10){
          return 'triangle11-100'
        }
        else if(index === 11){
          return 'triangle12-100'
        }
      },
      getId(index){ // gør at elemtent for den rigtigte id efter hvilken tal den skal have
        if(index === 0){
          return 'boks1'
        }
        else if(index === 1){
          return 'boks2'
        }
        else if(index === 2){
          return 'boks3'
        }
        else if(index === 3){
          return 'boks4'
        }
        else if(index === 4){
          return 'boks5'
        }
        else if(index === 5){
          return 'boks6'
        }
        else if(index === 6){
          return 'boks7'
        }
        else if(index == 7){
          return 'boks8'
        }
        else if(index === 8){
          return 'boks9'
        }
        else if(index === 9){
          return 'boks10'
        }
        else if(index === 10){
          return 'boks11'
        }
        else if(index === 11){
          return 'boks12'
        }
      },
      getTekstId(index){ // gør at elemtent for den rigtigte id efter hvilken tal den skal have
        if(index === 0){
          return 'tekst1'
        }
        else if(index === 1){
          return 'tekst2'
        }
        else if(index === 2){
          return 'tekst3'
        }
        else if(index === 3){
          return 'tekst4'
        }
        else if(index === 4){
          return 'tekst5'
        }
        else if(index === 5){
          return 'tekst6'
        }
        else if(index === 6){
          return 'tekst7'
        }
        else if(index == 7){
          return 'tekst8'
        }
        else if(index === 8){
          return 'tekst9'
        }
        else if(index === 9){
          return 'tekst10'
        }
        else if(index === 10){
          return 'tekst11'
        }
        else if(index === 11){
          return 'tekst12'
        }
      },
      getTriangleId(index){ // gør at elemtent for den rigtigte id efter hvilken tal den skal have
        if(index === 0){
          return 'triangle1'
        }
        else if(index === 1){
          return 'triangle2'
        }
        else if(index === 2){
          return 'triangle3'
        }
        else if(index === 3){
          return 'triangle4'
        }
        else if(index === 4){
          return 'triangle5'
        }
        else if(index === 5){
          return 'triangle6'
        }
        else if(index === 6){
          return 'triangle7'
        }
        else if(index == 7){
          return 'triangle8'
        }
        else if(index === 8){
          return 'triangle9'
        }
        else if(index === 9){
          return 'triangle10'
        }
        else if(index === 10){
          return 'triangle11'
        }
        else if(index === 11){
          return 'triangle12'
        }
      },
      openModal(id){ // åbner modalen der vister info om den enkenlte projekt
        console.log(id)
        this.getOneProjekt(id)
        eventBus.$emit("showModal", true)

        if(this.windowswidth <= 630){
          this.showText()
        }
      },
      showText(){ // til når teksten skal vises i modallen
        console.log(this.windowswidth)

        if(this.windowswidth <= 630){
          console.log("er her desværre")
          this.showTeskt = true
          eventBus.$emit("changeStyling", true, this.windowswidth)
        }
        else{
          console.log("jaaaa.. jeg kom her hen")
          if(this.showTeskt == true){
            this.showTeskt = false;
            eventBus.$emit("changeStyling", false, this.windowswidth)
          } 
          else{
            this.showTeskt = true
            eventBus.$emit("changeStyling", true, this.windowswidth)

          } 
        }    
      },
      changeSlideNext(){ // til når man skrifter til næste billede frem
        let caruselLength = this.caruselShow.length
        let slidetrue = 0

        for (let i = 0; i < caruselLength; i++) {
          if(this.caruselShow[i] == true){
            this.caruselShow[i] = false
            slidetrue = i
          }
        }

        if(slidetrue == (caruselLength - 1)){
          this.$set(this.caruselShow, 0,  true)
        }
        else{
          this.$set(this.caruselShow, slidetrue + 1,  true)
        }
      },
      changeSlideBack(){ // til når man skrifter til næste billede tilbage
        let caruselLength = this.caruselShow.length
        let slidetrue = 0

        for (let i = 0; i < caruselLength; i++) {
          if(this.caruselShow[i] == true){
            this.caruselShow[i] = false
            slidetrue = i
          }
        }

        if(slidetrue == 0){
          this.$set(this.caruselShow, caruselLength - 1, true) // this.$set(data'en navn, stedet, den nye værdi)
        }
        else{
          this.$set(this.caruselShow, slidetrue - 1, true)
        }
      }
    },
    beforeDestroy() {
      window.removeEventListener('resize', this.getWindowWidth);
      window.removeEventListener('scroll', this.stickNavbar)
    }
  }
</script>

<!-- testing CSS-->
<style>
  input[type="checkbox"]{
    width: 16px;
    height: 16px;
  }

  
</style>

<!-- almindelig css -->
<style>
  .show-site-bar{
    display: block;
  }

  .hidde-site-bar{
    display: none;
  }

  .btnIcons{
    background-color: transparent;
    border: none;
  }

  .boks-btn{
    height: 100%;
    width: 100%;
    padding: 0;
    border: none;
  }

  .strickyProjektHeigth{
    padding-top: 4.8em;
  }

  .imagesSize{
    width: 100%;
    height: 100%;
    border: 1px solid #607272;
  }

  .overksriftFlexBoks{
    display: flex;
    flex-flow: row nowrap;
    margin: 0.5em;
  }

  .overskriftSize{
    font-size: 4em;
  }

  /*************************************************/
  /*                   side menu                   */
  /*************************************************/
  .hideAndSeekBoks{
    display: flex;
    flex-flow: column wrap;
    background-color: #CCFFFF;
    width: 100%;
    margin: -0.2em 0 0.1em 0;
  }

  .hideAndSeekButtom{
    border: none;
    background-color: #B8E6E6;
    padding: 0.5em;
    margin: 0.1em 0;
    width: 100%;
    text-align: start;
    font-size: 1.5em;
    outline: none;
  }

  .hideAndSeekAnimation{
    animation: showSiteBar;
    animation-duration: 1s;
    animation-iteration-count: 1;
  }

  @keyframes showSiteBar {
    0%{
      /* width: 0%; */
      background-color: #fff;
      color: #fff;
    }
    100%{
      /* width: 100%; */
      background-color: #B8E6E6;
      color: #607272;
    }
  }

  /*************************************************/
  /*                 Projekterne                   */
  /*************************************************/
  .OuterBoks{
    display: flex;
  }

  /*************************************************/
  /*            billederne og teksten              */
  /*************************************************/
  .boks1-100{
    background: chartreuse;
    width: 22em;
    height: 19em;
    margin: 2em 2em 2em 5em;
  }

  .boks1-50{
    background: chartreuse;
    width: 16.2em;
    height: 13.5em;
    margin: 0.2em 2em 2em 5em;
  }

  .boks2-100{
    background: cyan;
    width: 22em;
    height: 19em;
    margin: 2em 2em 2em 2em; 
  }

  .boks2-50{
    background: cyan;
    width: 16.2em;
    height: 13.5em;
    margin: 0.2em 2em 2em 2em;
  }

  .boks3-100{
    background: darkorange;
    width: 22em;
    height: 42em;
    margin: 2em 5em 2em 2em;
  }

  .boks3-50{
    background: darkorange;
    width: 15.9em;
    height: 31em;
    margin: 0.2em 5em 2em 2em;
  }

  .boks4-100{
    background: deeppink;
    width: 48em;
    height: 19em;
    margin: 25em 3em 2em -79em;
  }

  .boks4-50{
    background: deeppink;
    width: 36.5em;
    height: 13.6em;
    margin: 17.5em 4em 2em -61.4em;
  }

  .boks5-100{
    background-color: crimson;
    width: 22em;
    height: 19em;
    margin: 2em 2.0em 2.0em 5em;
  }

  .boks5-50{
    background-color: crimson;
    width: 16.2em;
    height: 13.5em;
    margin: 2em 2.0em 2.0em 5em;
  }

  .boks6-100{
    background-color: darkblue;
    width: 48em;
    height: 19em;
    margin: 2em 5em 2em 2em;
  }

  .boks6-50{
    background-color: darkblue;
    width: 36.5em;
    height: 13.6em;
    margin: 2em 5em 2em 2em;
  }

  .boks7-100{
    background-color: darkorchid;
    width: 48em;
    height: 19em;
    margin: 2em 2em 2em 5em;
  }

  .boks7-50{
    background-color: darkorchid;
    width: 36.5em;
    height: 13.6em;
    margin: 2em 2em 2em 5em;
  }

  .boks8-100{
    background-color: dodgerblue;
    width: 22em;
    height: 19em;
    margin: 2em 5em 2em 2em;
  }

  .boks8-50{
    background-color: dodgerblue;
    width: 16.2em;
    height: 13.5em;
    margin: 2em 5em 2em 2em;
  }

  .boks9-100{
    background-color: fuchsia;
    width: 22em;
    height: 42em;
    margin: 2em 2em 2em 5em;
  }

  .boks9-50{
    background-color: fuchsia;
    width: 15.9em;
    height: 31em;
    margin: 2em 2em 2em 5em;
  }

  .boks10-100{
    background-color: gold;
    width: 22em;
    height: 19em;
    margin: 2em;
  }

  .boks10-50{
    background-color: gold;
    width: 16.2em;
    height: 13.5em;
    margin: 2em;
  }

  .boks11-100{
    background-color: gray;
    width: 22em;
    height: 19em;
    margin: 2em 5em 2em 2em;
  }

  .boks11-50{
    background-color: gray;
    width: 16.2em;
    height: 13.5em;
    margin: 2em 5em 2em 2em;
  }

  .boks12-100{
    background-color: greenyellow;
    width: 48em;
    height: 19em;
    margin: -21em 2em 2em 31em;
  }

  .boks12-50{
    background-color: greenyellow;
    width: 36.5em;
    height: 13.6em;
    margin: -15.5em 2em 2em 24.9em;
  }

  .OuterBoksFlex{
    display: flex;
    flex-flow: row wrap;
  }

  .tekst1-100, .tekst2-100, .tekst5-100, .tekst8-100, .tekst10-100, .tekst11-100{
    font-size: 1.5em;
    padding: 0.5em;
    position: absolute;
    background: transparent;
    color: transparent;
    width: 17.6em;
    text-align: center;
    margin: 9.5em 0 0 -0.9em;
  }

  .tekst1-50, .tekst2-50, .tekst5-50, .tekst8-50, .tekst10-50, .tekst11-50{
    font-size: 1.0em;
    padding: 0.5em;
    position: absolute;
    background: transparent;
    color: transparent;
    width: 19.5em;
    text-align: center;
    margin: 9.5em 0 0 -0.9em;
  }

  .tekst3-100, .tekst9-100{
    font-size: 1.5em;
    padding: 0.5em;
    position: absolute;
    background: transparent;
    color: transparent;
    width: 17.6em;
    text-align: center;
    margin: 27.9em 0 0 -0.9em;
  }

  .tekst3-50, .tekst9-50{
    font-size: 1em;
    padding: 0.5em;
    position: absolute;
    background: transparent;
    color: transparent;
    width: 19.2em;
    text-align: center;
    margin: 30.4em 0 0 -0.9em;
  }

  .tekst4-100, .tekst6-100, .tekst7-100, .tekst12-100{
    font-size: 1.5em;
    padding: 0.5em;
    position: absolute;
    background: transparent;
    color: transparent;
    width: 38.4em;
    text-align: center;
    margin: 9.5em 0 0 -0.9em;
  }

  .tekst4-50, .tekst6-50, .tekst7-50, .tekst12-50{
    font-size: 1em;
    padding: 0.5em;
    position: absolute;
    background: transparent;
    color: transparent;
    width: 44em;
    text-align: center;
    margin: 9.5em 0 0 -0.9em;
  }

  .triangle1-100, .triangle2-100, .triangle5-100, .triangle8-100, .triangle10-100, .triangle11-100{
    border-top: 13px solid transparent;
    border-left: 17px solid transparent;
    position: absolute;
    margin: 233px 0em 0 -1.3em;
  }

  .triangle1-50, .triangle2-50, .triangle5-50, .triangle8-50, .triangle10-50, .triangle11-50{
    border-top: 9px solid transparent;
    border-left: 13px solid transparent;
    position: absolute;
    margin: 155px 0 0 -13px;
  }

  .triangle3-100, .triangle9-100{
    border-top: 13px solid transparent;
    border-left: 17px solid transparent;
    position: absolute;
    margin: 601px 0em 0 -1.3em;
  }

  .triangle3-50, .triangle9-50{
    border-top: 9px solid transparent;
    border-left: 12px solid transparent;
    position: absolute;
    margin: 434px 0 0 -12px;
  }

  .triangle4-100, .triangle6-100, .triangle7-100, .triangle12-100{
    border-top: 13px solid transparent;
    border-left: 17px solid transparent;
    position: absolute;
    margin: 233px 0em 0 -1.3em;
  }

  .triangle4-50, .triangle6-50, .triangle7-50, .triangle12-50{
    border-top: 9px solid transparent;
    border-left: 12px solid transparent;
    position: absolute;
    position: absolute;
    margin: 155px 0 0 -12px;
  }

  /* hover og animation */
  .boks1-100:hover .tekst1-100, .boks2-100:hover .tekst2-100, .boks5-100:hover .tekst5-100, .boks8-100:hover .tekst8-100, .boks10-100:hover .tekst10-100, .boks11-100:hover .tekst11-100{
    background: #CCFFFF;
    color: #607272;
    animation-name: fromTranparentTooColorWithText;
    animation-duration: 1.5s;
    animation-iteration-count: 1;
  }

  .boks1-50:hover .tekst1-50, .boks2-50:hover .tekst2-50, .boks5-50:hover .tekst5-50, .boks8-50:hover .tekst8-50, .boks10-50:hover .tekst10-50, .boks11-50:hover .tekst11-50{
    background: #CCFFFF;
    color: #607272;
    animation-name: fromTranparentTooColorWithText;
    animation-duration: 1.5s;
    animation-iteration-count: 1;
  }

  .boks3-100:hover .tekst3-100, .boks9-100:hover .tekst9-100{
    background: #CCFFFF;
    color: #607272;
    animation-name: fromTranparentTooColorWithText;
    animation-duration: 1.5s;
    animation-iteration-count: 1;
  }

  .boks3-50:hover .tekst3-50, .boks9-50:hover .tekst9-50{
    background: #CCFFFF;
    color: #607272;
    animation-name: fromTranparentTooColorWithText;
    animation-duration: 1.5s;
    animation-iteration-count: 1;
  }

  .boks4-100:hover .tekst4-100, .boks6-100:hover .tekst6-100, .boks7-100:hover .tekst7-100, .boks12-100:hover .tekst12-100{
    background: #CCFFFF;
    color: #607272;
    animation-name: fromTranparentTooColorWithText;
    animation-duration: 1.5s;
    animation-iteration-count: 1;
  }

  .boks4-50:hover .tekst4-50, .boks6-50:hover .tekst6-50, .boks7-50:hover .tekst7-50, .boks12-50:hover .tekst12-50{
    background: #CCFFFF;
    color: #607272;
    animation-name: fromTranparentTooColorWithText;
    animation-duration: 1.5s;
    animation-iteration-count: 1;
  }

  .boks1-100:hover .triangle1-100, .boks2-100:hover .triangle2-100, .boks5-100:hover .triangle5-100, .boks8-100:hover .triangle8-100, .boks10-100:hover .triangle10-100, .boks11-100:hover .triangle11-100{
    border-top: 13px solid #A3CCCC;
    animation-name: fromTranparentTooColorTriangle;
    animation-duration: 1.5s;
    animation-iteration-count: 1;
  }

  .boks1-50:hover .triangle1-50, .boks2-50:hover .triangle2-50, .boks5-50:hover .triangle5-50, .boks8-50:hover .triangle8-50, .boks10-50:hover .triangle10-50, .boks11-50:hover .triangle11-50{
    border-top: 9px solid #A3CCCC;
    animation-name: fromTranparentTooColorTriangle;
    animation-duration: 1.5s;
    animation-iteration-count: 1;
  }

  .boks3-100:hover .triangle3-100, .boks9-100:hover .triangle9-100{
    border-top: 13px solid #A3CCCC;
    animation-name: fromTranparentTooColorTriangle;
    animation-duration: 1.5s;
    animation-iteration-count: 1;
  }

  .boks3-50:hover .triangle3-50, .boks9-50:hover.triangle9-50{
    border-top: 9px solid #A3CCCC;
    animation-name: fromTranparentTooColorTriangle;
    animation-duration: 1.5s;
    animation-iteration-count: 1;
  }

  .boks4-100:hover .triangle4-100, .boks6-100:hover .triangle6-100, .boks7-100:hover .triangle7-100, .boks12-100:hover .triangle12-100{
    border-top: 13px solid #A3CCCC;
    animation-name: fromTranparentTooColorTriangle;
    animation-duration: 1.5s;
    animation-iteration-count: 1;
  }

  .boks4-50:hover .triangle4-50, .boks6-50:hover .triangle6-50, .boks7-50:hover .triangle7-50, .boks12-50:hover .triangle12-50{
    border-top: 9px solid #A3CCCC;
    animation-name: fromTranparentTooColorTriangle;
    animation-duration: 1.5s;
    animation-iteration-count: 1;
  }

  @keyframes fromTranparentTooColorWithText {
    0%{
      background-color: transparent;
      color: transparent;
    }
    100%{
      background-color: #CCFFFF;
      color: #607272;
    }
  }

  @keyframes fromTranparentTooColorTriangle {
    0%{
    border-top: 13px solid transparent;
      
    }
    100%{
      border-top: 13px solid #A3CCCC;
    }
  }
</style>

<!-- media querys -->
<style>
  @media screen and (max-width: 1366px){
    .boks4-50 {
      margin: 17.5em 4.5em 2em -61.4em;
    }
    .boks4-100{
      margin: 25em 4em 2em -79em;
    }
  }

  @media screen and (max-width: 1360px){
    .boks1-100, .boks7-100, .boks9-100 {
      margin: 2em 2em 2em 4.5em;
    }

    .boks6-100, .boks8-100, .boks11-100 {
      margin: 2em 4.5em 2em 2em;
    }
  }

  @media screen and (max-width: 1352px){
    .boks3-100{
      margin: 2em 4.5em 2em 2em;
    }

    .boks4-100 {
      margin: 25em 4em 2em -78.5em;
    }
  }

  @media screen and (max-width: 1344px){
    .boks1-100, .boks2-100, .boks5-100, .boks8-100, .boks10-100, .boks11-100{
      width: 21em;
      height: 18em;
    }

    .boks3-100, .boks9-100{
      width: 21em;
      height: 40em;
    }

    .boks4-100, .boks6-100, .boks7-100{
      width: 46em;
      height: 18em;
    }

    .boks4-100{
      margin: 24em 7em 2em -75.5em;
    }

    .boks5-100{
      margin: 2em 2em 2em 4.5em;
    }

    .boks12-100{
      width: 46em;
      height: 18em;
      margin: -20em 2em 2em 29.5em;
    }

    .boks1-50 {
      margin: 0.2em 2em 2em 4.5em;
    }

    .boks3-50 {
      margin: 0.2em 4.5em 2em 2em;
    }

    .boks5-50, .boks7-50, .boks9-50 {
      margin: 2em 2.0em 2.0em 4.5em;
    }

    .boks6-50, .boks8-50, .boks11-50  {
      margin: 2em 4.5em 2em 2em;
    }

    .tekst1-100, .tekst2-100, .tekst5-100, .tekst8-100, .tekst10-100, .tekst11-100{
      width: 337px;
      margin: 8.5em 0 0 -0.9em;
    }

    .tekst3-100, .tekst9-100{
      width: 337px;
      margin: 26.2em 0 0 -0.9em;
    }

    .tekst4-100, .tekst6-100, .tekst7-100, .tekst12-100{
      width: 737px;
      margin: 8.5em 0 0 -0.9em;
    }

    .triangle1-100, .triangle2-100, .triangle5-100, .triangle8-100, .triangle10-100, .triangle11-100{
      margin: 213px 0em 0 -1.3em;
    }

    .triangle3-100, .triangle9-100{
      margin: 567px 0em 0 -1.3em;
    }

    .triangle4-100, .triangle6-100, .triangle7-100, .triangle12-100{
      margin: 212px 0em 0 -1.3em;
    }
  }

  @media screen and (max-width: 1325px){
    .boks1-50, .boks2-50, .boks5-50, .boks8-50, .boks10-50, .boks11-50{
      width: 16em;
      height: 13em;
    }

    .boks3-50, .boks9-50{
      width: 16em;
      height: 30em;
    }

    .boks4-50, .boks6-50, .boks7-50{
      width: 36em;
      height: 13.2em;
    }

    .boks4-50{
      margin: 17em 9em 2em -60.5em;
    }

    .boks12-50{
      width: 36em;
      height: 13em;
      margin: -15em 2em 2em 25em;
    }

    .tekst1-50, .tekst2-50, .tekst5-50, .tekst8-50, .tekst10-50, .tekst11-50{
      width: 19.3em;
    }

    .tekst3-50, .tekst9-50 {
      width: 19.3em;
      margin: 29.7em 0 0 -0.9em;
    }

    .tekst4-50, .tekst6-50, .tekst7-50, .tekst12-50{
      width: 43.3em;
    }

    .triangle3-50, .triangle9-50 {
      margin: 425px 0 0 -12px;
    }
  }

  @media screen and (max-width: 1319px){
    .boks1-50, .boks2-50, .boks5-50, .boks8-50, .boks10-50, .boks11-50{
      width: 15.5em;
      height: 12.5em;
    }

    .boks3-50, .boks9-50{
      width: 15.5em;
      height: 29.5em;
    }

    .boks4-50, .boks6-50, .boks7-50{
      width: 35em;
      height: 12.7em;
    }

    .boks4-50{
      margin: 17em 11em 2em -59em;
    }

    .boks12-50{
      width: 35em;
      height: 13em;
      margin: -15em 2em 2em 24em;
    }

    .tekst1-50, .tekst2-50, .tekst5-50, .tekst8-50, .tekst10-50, .tekst11-50{
      width: 250px;
      margin: 9em 0 0 -0.9em;
    }

    .tekst3-50, .tekst9-50{
      width: 250px;
      margin: 29.2em 0 0 -0.9em;
    }

    .tekst4-50, .tekst6-50, .tekst7-50, .tekst12-50{
      width: 562px;
      margin: 9em 0 0 -0.9em;
    }

    .triangle1-50, .triangle2-50, .triangle5-50, .triangle8-50, .triangle10-50, .triangle11-50{
      border-left: 12px solid transparent;
      margin: 148px 0 0 -12px;
    }

    .triangle3-50, .triangle9-50{
      border-left: 12px solid transparent;
     margin: 418px 0 0 -12px;
    }

    .triangle4-50, .triangle6-50, .triangle7-50, .triangle12-50{
      border-left: 12px solid transparent;
      margin: 148px 0 0 -12px;
    }
  }

  @media screen and (max-width: 1296px){
    .boks1-100, .boks2-100, .boks5-100, .boks8-100, .boks10-100, .boks11-100{
      width: 20em;
      height: 17em;
    }

    .boks3-100, .boks9-100{
      width: 20em;
      height: 38em;
    }

    .boks4-100, .boks6-100, .boks7-100{
      width: 44em;
      height: 17em;
    }

    .boks4-100{
      margin: 23em 7em 2em -72.5em;
    }

    .boks12-100{
      width: 44em;
      height: 17em;
      margin: -19em 2em 2em 28.5em;
    }

    .tekst1-100, .tekst2-100, .tekst5-100, .tekst8-100, .tekst10-100, .tekst11-100{
      width: 321px;
      margin: 8em 0 0 -0.9em;
    }

    .tekst3-100, .tekst9-100{
      width: 321px;
      margin: 25em 0 0 -0.9em;
    }

    .tekst4-100, .tekst6-100, .tekst7-100, .tekst12-100{
      width: 705px;
      margin: 8em 0 0 -0.9em;
    }

    .triangle1-100, .triangle2-100, .triangle5-100, .triangle8-100, .triangle10-100, .triangle11-100{
      margin: 202px 0em 0 -1.3em;
    }

    .triangle3-100, .triangle9-100{
      margin: 543px 0em 0 -1.3em;
    }

    .triangle4-100, .triangle6-100, .triangle7-100, .triangle12-100{
      margin: 202px 0em 0 -1.3em;
    }
  }

  @media screen and (max-width: 1289px){
    .boks1-50, .boks2-50, .boks5-50, .boks8-50, .boks10-50, .boks11-50{
      width: 14.5em;
      height: 11.5em;
    }

    .boks3-50, .boks9-50{
      width: 14.5em;
      height: 27.5em;
    }

    .boks4-50, .boks6-50, .boks7-50{
      width: 33em;
      height: 11.7em;
    }

    .boks4-50{
      margin: 16em 11em 2em -56em;
    }

    .boks12-50{
      width: 33em;
      height: 12em;
      margin: -14em 2em 2em 23em;
    }

    .tekst1-50, .tekst2-50, .tekst5-50, .tekst8-50, .tekst10-50, .tekst11-50{
      width: 17.6em;
      margin: 8.5em 0 0 -0.9em;
    }

    .tekst3-50, .tekst9-50{
      width: 17.6em;
      margin: 27.5em 0 0 -0.9em;
    }

    .tekst4-50, .tekst6-50, .tekst7-50, .tekst12-50{
      width: 39.8em;
      margin: 8.5em 0 0 -0.9em;
    }

    .triangle1-50, .triangle2-50, .triangle5-50, .triangle8-50, .triangle10-50, .triangle11-50 {
      margin: 141px 0 0 -12px;
    }

    .triangle3-50, .triangle9-50 {
      margin: 395px 0 0 -12px;
    }

    .triangle4-50, .triangle6-50, .triangle7-50, .triangle12-50{
      margin: 141px 0 0 -12px;
    }
  }

  @media screen and (max-width: 1248px){
    .boks1-100, .boks2-100, .boks5-100, .boks8-100, .boks10-100, .boks11-100{
      width: 19em;
      height: 16em;
    }

    .boks3-100, .boks9-100{
      width: 19em;
      height: 36em;
    }

    .boks4-100, .boks6-100, .boks7-100{
      width: 42em;
      height: 16em;
    }

    .boks4-100{
      margin: 22em 7em 2em -69.5em;
    }

    .boks12-100{
      width: 42em;
      height: 16em;
      margin: -18em 2em 2em 27.5em;
    }

    .tekst1-100, .tekst2-100, .tekst5-100, .tekst8-100, .tekst10-100, .tekst11-100{
      width: 305px;
      margin: 7.5em 0 0 -0.9em;
    }

    .tekst3-100, .tekst9-100{
      width: 305px;
      margin: 23.5em 0 0 -0.9em;
    }

    .tekst4-100, .tekst6-100, .tekst7-100, .tekst12-100{
      width: 671px;
      margin: 7.5em 0 0 -0.9em;
    }

    .triangle1-100, .triangle2-100, .triangle5-100, .triangle8-100, .triangle10-100, .triangle11-100{
      margin: 192px 0em 0 -1.3em;
    }

    .triangle3-100, .triangle9-100{
      margin: 513px 0em 0 -1.3em;
    }

    .triangle4-100, .triangle6-100, .triangle7-100, .triangle12-100{
      margin: 192px 0em 0 -1.3em;
    }
  }

  @media screen and (max-width: 1229px){
    .boks1-50{
      margin: 0.2em 1.5em 1.5em 4.5em;
    }

    .boks2-50{
      margin: 0.2em 1.5em 1.5em 1.5em;
    }

    .boks5-50{
      margin: 1.5em 1.5em 1.5em 4.5em;
    }

    .boks8-50{
      margin: 1.5em 4.5em 1.5em 1.5em;
    }

    .boks10-50{
      margin: 1.5em 1.5em 1.5em 1.5em;
    }
    
    .boks11-50{
      margin: 1.5em 4.5em 1.5em 1.5em;
    }

    .boks9-50{
      height: 26.5em;
      margin: 1.5em 1.5em 1.5em 4.5em;
    }

    .boks3-50{
      height: 26.5em;
      margin: 0.2em 4.5em 1.5em 1.5em;
    }

    .boks4-50{
      width: 32em;
      margin: 15em 11em 2em -54em;
    }

    .boks6-50{
      width: 32em;
      margin: 1.5em 4.5em 1.5em 1.5em;
    }

    .boks7-50{
      width: 32em;
      margin: 1.5em 1.5em 1.5em 4.5em;
    }

    .boks12-50{
      width: 32em;
      height: 12em;
      margin: -13.5em 2em 2em 22em;
    }

    .tekst4-50, .tekst6-50, .tekst7-50, .tekst12-50{
      width: 38.6em;
    }

    .tekst3-50, .tekst9-50 {
      margin: 26.3em 0 0 -0.9em;
    }

    .triangle1-50, .triangle2-50, .triangle5-50, .triangle8-50, .triangle10-50, .triangle11-50 {
      margin: 142px 0 0 -12px;
    }

    .triangle3-50, .triangle9-50{
      margin: 379px 0 0 -12px;
    }

    .triangle4-50, .triangle6-50, .triangle7-50, .triangle12-50 {
        margin: 142px 0 0 -12px;
    }
  }

  @media screen and (max-width: 1200px){
    .boks1-100, .boks2-100, .boks5-100, .boks8-100, .boks10-100, .boks11-100{
      width: 18em;
      height: 15em;
    }

    .boks3-100, .boks9-100{
      width: 18em;
      height: 34em;
    }

    .boks4-100, .boks6-100, .boks7-100{
      width: 40em;
      height: 15em;
    }

    .boks4-100{
      margin: 21em 7em 2em -66.5em;
    }

    .boks12-100{
      width: 40em;
      height: 15em;
      margin: -17em 2em 2em 26.5em;
    }

    .tekst1-100, .tekst2-100, .tekst5-100, .tekst8-100, .tekst10-100, .tekst11-100{
      width: 289px;
      margin: 6.8em 0 0 -0.9em;
    }

    .tekst3-100, .tekst9-100{
      width: 289px;
      margin: 22em 0 0 -0.9em;
    }

    .tekst4-100, .tekst6-100, .tekst7-100, .tekst12-100{
      width: 641px;
      margin: 6.8em 0 0 -0.9em;
    }

    .triangle1-100, .triangle2-100, .triangle5-100, .triangle8-100, .triangle10-100, .triangle11-100{
      margin: 179px 0em 0 -1.3em;
    }

    .triangle3-100, .triangle9-100{
      margin: 483px 0em 0 -1.3em;
    }

    .triangle4-100, .triangle6-100, .triangle7-100, .triangle12-100{
      margin: 179px 0em 0 -1.3em;
    }
  }

  @media screen and (max-width: 1186px){
    .boks1-50 {
      margin: 0.2em 2em 2em 3.5em;
    }

    .boks3-50 {
      margin: 0.2em 3.5em 2em 2em;
    }

    .boks4-50 {
      width: 32.5em;
    }

    .boks5-50, .boks7-50, .boks9-50 {
      margin: 2em 2.0em 2.0em 3.5em;
    }

    .boks6-50, .boks8-50, .boks11-50  {
      margin: 2em 3.5em 2em 2em;
    }

    .boks12-50 {
      width: 32.5em;
      height: 12em;
      margin: -13.5em 2em 2em 21.5em;
    }

    .tekst4-50, .tekst6-50, .tekst7-50, .tekst12-50 {
      width: 39.1em;
    }
  }

  @media screen and (max-width: 1169px){
    .boks1-50, .boks2-50, .boks5-50, .boks8-50, .boks10-50, .boks11-50{
      width: 13.5em;
      height: 11em;
    }

    .boks3-50, .boks9-50{
      width: 13.5em;
      height: 25em;
    }

    .boks4-50, .boks6-50, .boks7-50, .boks12-50{
      width: 30em;
      height: 11em;
    }

    .boks4-50, .boks6-50, .boks7-50, .boks12-50 {
        width: 30.5em;
    }
    .boks4-50{
      margin: 14em 11em 2em -51em;
    }

    .boks12-50{
      margin: -12.5em 2em 2em 21em;
    }

    .tekst1-50, .tekst2-50, .tekst5-50, .tekst8-50, .tekst10-50, .tekst11-50{
      width: 16.4em;
      margin: 7.5em 0 0 -0.9em;
    }

    .tekst3-50, .tekst9-50{
      width: 16.4em;
      margin: 24em 0 0 -0.9em;
    }

    .tekst4-50, .tekst6-50, .tekst7-50, .tekst12-50{
      width: 36.8em;
      margin: 7.5em 0 0 -0.9em;
    }

    .triangle1-50, .triangle2-50, .triangle5-50, .triangle8-50, .triangle10-50, .triangle11-50{
      margin: 128px 0 0 -12px;
    }

    .triangle3-50, .triangle9-50{
      margin: 348px 0 0 -12px;
    }
    
    .triangle4-50, .triangle6-50, .triangle7-50, .triangle12-50{
      margin: 128px 0 0 -12px;
    }
  }

  @media screen and (max-width: 1152px){
    .boks1-100, .boks2-100, .boks5-100, .boks8-100, .boks10-100, .boks11-100{
      width: 17em;
      height: 15em;
    }

    .boks3-100, .boks9-100{
      width: 17em;
      height: 34em;
    }

    .boks4-100, .boks6-100, .boks7-100{
      width: 38em;
      height: 15em;
    }

    .boks4-100{
      margin: 21em 7em 2em -63.5em;
    }

    .boks12-100{
      width: 38em;
      height: 15em;
      margin: -17em 2em 2em 25.5em;
    }

    .tekst1-100, .tekst2-100, .tekst5-100, .tekst8-100, .tekst10-100, .tekst11-100{
      width: 273px;
      margin: 6.8em 0 0 -0.9em;
    }

    .tekst3-100, .tekst9-100{
      width: 273px;
      margin: 22em 0 0 -0.9em;
    }

    .tekst4-100, .tekst6-100, .tekst7-100, .tekst12-100{
      width: 609px;
      margin: 6.8em 0 0 -0.9em;
    }

    .triangle1-100, .triangle2-100, .triangle5-100, .triangle8-100, .triangle10-100, .triangle11-100{
      margin: 179px 0em 0 -1.3em;
    }

    .triangle3-100, .triangle9-100{
      margin: 482px 0em 0 -1.3em;
    }

    .triangle4-100, .triangle6-100, .triangle7-100, .triangle12-100{
      margin: 179px 0em 0 -1.3em;
    }
  }

  @media screen and (max-width: 1110px){
    .boks1-100, .boks2-100, .boks5-100, .boks8-100, .boks10-100, .boks11-100{
      width: 16em;
      height: 14em;
    }

    .boks1-50 {
      margin: 0.2em 1em 1em 4em;
    }

    .boks2-50 {
      margin: 0.2em 1em 1em 1em;
    }

    .boks5-50 {
      margin: 1em 1em 1em 4em;
    }

    .boks8-50 {
      margin: 1em 4em 1em 1em;
    }

    .boks10-50 {
      margin: 2em 1em 1em 1em;
    }

    .boks11-50 {
      margin: 1em 4em 1em 1em;
    }

    .boks3-100, .boks9-100{
      width: 16em;
      height: 32em;
    }

    .boks3-50 {
      margin: 0.2em 4em 1em 1em;
      height: 25em;
    }

    .boks9-50 {
      height: 24em;
      margin: 1em 1em 1em 4em;
    }

    .boks4-100, .boks6-100, .boks7-100, .boks12-100{
      width: 36em;
      height: 14em;
    }

    .boks4-50, .boks6-50, .boks7-50 {
      width: 29em;
    }

    .boks10-50 {
      margin: 1em 1em 1em 1em;
    }

    .boks6-50 {
      margin: 1em 4em 1em 1em;
    }

    .boks7-50 {
      margin: 1em 1em 1em 4em;
    }

    .boks4-100{
      margin: 20em 7em 2em -60.5em;
    }

    .boks4-50 {
      width: 29em;
      margin: 14em 11em 1em -48.5em;
    }

    .boks12-100{
      margin: -16em 2em 2em 24.5em;
    }

    .boks12-50 {
      width: 32.5em;
      height: 11em;
      margin: -12em 2em 2em 19.5em;
    }

    .tekst1-100, .tekst2-100, .tekst5-100, .tekst8-100, .tekst10-100, .tekst11-100{
      width: 257px;
      margin: 6em 0 0 -0.9em;
    }

    .tekst3-100, .tekst9-100{
      width: 257px;
      margin: 20.5em 0 0 -0.9em;
    }

    .tekst3-50, .tekst9-50{
      width: 16.4em;
      margin: 24.1em 0 0 -0.9em;
    }

    .tekst4-100, .tekst6-100, .tekst7-100, .tekst12-100{
      width: 577px;
      margin: 6em 0 0 -0.9em;
    }

    .tekst4-50, .tekst6-50, .tekst7-50, .tekst12-50{
      width: 34.9em;
      margin: 7.5em 0 0 -0.9em;
    }

    .triangle1-100, .triangle2-100, .triangle5-100, .triangle8-100, .triangle10-100, .triangle11-100{
      margin: 163px 0em 0 -1.3em;
    }

    .triangle3-100, .triangle9-100{
      margin: 453px 0em 0 -1.3em;
    }

    .triangle3-50, .triangle9-50{
      margin: 349px 0 0 -12px;
    }

    .triangle4-100, .triangle6-100, .triangle7-100, .triangle12-100{
      margin: 163px 0em 0 -1.3em;
    }
  }

  @media screen and (max-width: 1056px){
    .boks1-100, .boks2-100, .boks5-100, .boks8-100, .boks10-100, .boks11-100{
      width: 15em;
      height: 13em;
    }

    .boks3-100, .boks9-100{
      width: 15em;
      height: 30em;
    }

    .boks4-100, .boks6-100, .boks7-100, .boks12-100{
      width: 34em;
      height: 13em;
    }

    .boks4-100{
      margin: 19em 7em 2em -57.5em;
    }

    .boks12-100{
      margin: -15em 2em 2em 23.5em;
    }

    .tekst1-100, .tekst2-100, .tekst5-100, .tekst8-100, .tekst10-100, .tekst11-100{
      width: 241px;
      margin: 5.5em 0 0 -0.9em;
    }

    .tekst3-100, .tekst9-100{
      width: 241px;
      margin: 19.2em 0 0 -0.9em;
    }

    .tekst4-100, .tekst6-100, .tekst7-100, .tekst12-100{
      width: 545px;
      margin: 5.5em 0 0 -0.9em;
    }

    .triangle1-100, .triangle2-100, .triangle5-100, .triangle8-100, .triangle10-100, .triangle11-100{
      margin: 153px 0em 0 -1.3em;
    }

    .triangle3-100, .triangle9-100{
      margin: 427px 0em 0 -1.3em;
    }

    .triangle4-100, .triangle6-100, .triangle7-100, .triangle12-100{
      margin: 153px 0em 0 -1.3em;
    }
  }

  @media screen and (max-width: 1049px){
    .boks1-50, .boks2-50, .boks5-50, .boks8-50, .boks10-50, .boks11-50{
      width: 12.5em;
      height: 11em;
    }

    .boks3-50, .boks9-50{
      width: 12.5em;
      height: 24em;
    }

    .boks4-50, .boks6-50, .boks7-50, .boks12-50{
      width: 27em;
      height: 11em;
    }

    .boks4-50{
      width: 27em;
      margin: 13em 11em 1em -45.5em;
    }

    .boks12-50{
      width: 28em;
      margin: -12em 2em 2em 18.5em;
    }

    .tekst1-50, .tekst2-50, .tekst5-50, .tekst8-50, .tekst10-50, .tekst11-50{
      width: 202px;
    }

    .tekst3-50, .tekst9-50{
      width: 202px;
      margin: 22.8em 0 0 -0.9em;
    }

    .tekst4-50, .tekst6-50, .tekst7-50, .tekst12-50{
      width: 434px;
    }

    .boks10-50 {
      margin: 1em 1em 1em 1em;
    }
  }

  @media screen and (max-width: 1026px){
    .boks1-50 {
      margin: 0.2em 2em 2em 3em;
    }

    .boks3-50 {
      margin: 0.2em 3em 2em 2em;
    }

    .boks4-50 {
      width: 28em;
      margin: 14em 11em 1em -46.5em;
    }

    .boks3-50, .boks9-50 {
      height: 25em;
    }

    .boks5-50, .boks7-50, .boks9-50 {
      margin: 2em 2.0em 2.0em 3em;
    }

    .boks6-50, .boks8-50, .boks11-50 {
      margin: 2em 3em 2em 2em;
    }

    .boks10-50 {
      margin: 2em 1em 1em 1em;
    }

    .boks12-50 {
      margin: -13em 2em 2em 18.5em;
    }

    .tekst4-50, .tekst6-50, .tekst7-50, .tekst12-50 {
      width: 449px;
    }

    .tekst3-50, .tekst9-50 {
      width: 202px;
      margin: 24.1em 0 0 -0.9em;
    }
  }

  @media screen and (max-width: 1008px){
    .boks1-100, .boks2-100, .boks5-100, .boks8-100, .boks10-100, .boks11-100{
      width: 14em;
      height: 12em;
    }

    .boks3-100, .boks9-100{
      width: 14em;
      height: 28em;
    }

    .boks4-100, .boks6-100, .boks7-100, .boks12-100{
      width: 32em;
      height: 12em;
    }

    .boks4-100{
      margin: 18em 7em 2em -54.5em;
    }

    .boks12-100{
      margin: -14em 2em 2em 22.5em
    }

    .tekst1-100, .tekst2-100, .tekst5-100, .tekst8-100, .tekst10-100, .tekst11-100{
      width: 225px;
      margin: 5em 0 0 -0.9em;
    }

    .tekst3-100, .tekst9-100{
      width: 225px;
      margin: 17.9em 0 0 -0.9em;
    }

    .tekst4-100, .tekst6-100, .tekst7-100, .tekst12-100{
      width: 513px;
      margin: 5em 0 0 -0.9em;
    }

    .triangle1-100, .triangle2-100, .triangle5-100, .triangle8-100, .triangle10-100, .triangle11-100{
      margin: 142px 0em 0 -1.3em;
    }

    .triangle3-100, .triangle9-100{
      margin: 401px 0em 0 -1.3em;
    }

    .triangle4-100, .triangle6-100, .triangle7-100, .triangle12-100{
      margin: 142px 0em 0 -1.3em;
    }
  }

  @media screen and (max-width: 1006px){
    .boks1-50, .boks2-50, .boks5-50, .boks8-50, .boks10-50, .boks11-50{
      width: 12em;
      height: 10em;
    }

    .boks3-50, .boks9-50{
      width: 12em;
      height: 23em;
    }

    .boks4-50, .boks6-50, .boks7-50, .boks12-50{
      width: 26em;
      height: 10em;
    }

    .boks4-50{
      width: 27em;
      margin: 13em 11em 1em -45em;
    }

    .boks12-50{
      width: 27em;
      margin: -12em 2em 2em 18em;
    }

    .tekst1-50, .tekst2-50, .tekst5-50, .tekst8-50, .tekst10-50, .tekst11-50{
      width: 14.5em;
      margin: 7em 0 0 -0.9em;
    }

    .tekst3-50, .tekst9-50{
      width: 14.5em;
      margin: 22.5em 0 0 -0.9em;
    }

    .tekst4-50, .tekst6-50, .tekst7-50, .tekst12-50{
      width: 32.5em;
      margin: 7em 0 0 -0.9em;
    }

    .triangle1-50, .triangle2-50, .triangle5-50, .triangle8-50, .triangle10-50, .triangle11-50{
      margin: 121px 0 0 -12px;
    }

    .triangle3-50, .triangle9-50{
      margin: 329px 0 0 -12px;
    }

    .triangle4-50, .triangle6-50, .triangle7-50, .triangle12-50{
      margin: 121px 0 0 -12px;
    }
  }

  @media screen and (max-width: 976px){
    .boks1-50 {
      margin: 0.2em 1em 1em 3.5em;
    }

    .boks10-50 {
      margin: 1em;
    }

    .boks11-50 {
      margin: 1em 3.5em 1em 1em;
    }

    .boks3-50 {
      margin: 0.2em 3.5em 1em 1em;
    }

    .boks4-50, .boks6-50, .boks7-50, .boks12-50 {
      width: 26em;
      height: 10em;
    }

    .boks3-50, .boks9-50 {
      height: 22em;
    }

    .boks6-50, .boks8-50 {
      margin: 1em 3.5em 1em 1em;
    }

    .boks7-50, .boks9-50, .boks5-50 {
      margin: 1em 1em 1em 3.5em;
    }

    .boks4-50 {
      margin: 12.2em 11em 1em -43.5em;
    }

    .boks12-50 {
      margin: -11em 2em 2em 17.6em;
    }

    .tekst4-50, .tekst6-50, .tekst7-50, .tekst12-50 {
      width: 31.3em;
    }

    .tekst3-50, .tekst9-50 {
      margin: 21.5em 0 0 -0.9em;
    }

    .triangle3-50, .triangle9-50 {
      margin: 314px 0 0 -12px;
    }
  }  

  @media screen and (max-width: 960px){
    .boks1-100, .boks2-100, .boks5-100, .boks8-100, .boks10-100, .boks11-100{
      width: 13em;
      height: 11em;
    }

    .boks3-100, .boks9-100{
      width: 13em;
      height: 25.5em;
    }

    .boks4-100, .boks6-100, .boks7-100, .boks12-100{
      width: 30em;
      height: 11em;
    }

    .boks4-100{
      margin: 16.5em 7em 2em -51.5em;
    }

    .boks12-100{
      margin: -13em 2em 2em 21.5em;
    }

    .tekst1-100, .tekst2-100, .tekst5-100, .tekst8-100, .tekst10-100, .tekst11-100{
      width: 209px;
      margin: 4.3em 0 0 -0.9em;
    }

    .tekst3-100, .tekst9-100{
      width: 209px;
      margin: 16em 0 0 -0.9em;
    }

    .tekst4-100, .tekst6-100, .tekst7-100, .tekst12-100{
      width: 482px;
      margin: 4.3em 0 0 -0.9em;
    }

    .triangle1-100, .triangle2-100, .triangle5-100, .triangle8-100, .triangle10-100, .triangle11-100{
      margin: 129px 0em 0 -1.3em;
    }

    .triangle3-100, .triangle9-100{
      margin: 363px 0em 0 -1.3em;
    }

    .triangle4-100, .triangle6-100, .triangle7-100, .triangle12-100{
      margin: 129px 0em 0 -1.3em;
    }
  }

  @media screen and (max-width: 956px){
    .boks1-50 {
      margin: 0.2em 1em 1em 3em;
    }

    .boks3-50 {
      margin: 0.2em 3em 1em 1em;
    }

    .boks4-50 {
      margin: 12.2em 11em 1em -43em;
    }

    .boks5-50, .boks7-50, .boks9-50 {
      margin: 1em 1em 1em 3em;
    }

    .boks6-50, .boks8-50, .boks11-50 {
      margin: 1em 3em 1em 1em;
    }

    .boks12-50 {
      margin: -11em 2em 2em 17em;
    }

    .boks3-50, .boks9-50 {
      height: 22em;
    }
  }

  @media screen and (max-width: 939px){
    .hideAndSeekButtom {
      font-size: 1.4em;
    }
    
    .boks1-50, .boks2-50, .boks5-50, .boks8-50, .boks10-50, .boks11-50{
      width: 11em;
      height: 9em;
    }

    .boks3-50, .boks9-50{
      width: 11em;
      height: 20em;
    }

    .boks4-50, .boks6-50, .boks7-50, .boks12-50{
      width: 24em;
      height: 9em;
    }

    .boks4-50{
      margin: 11.2em 11em 1em -40em;
    }

    .boks12-50{
      margin: -10em 2em 2em 16em;
    }

    .tekst1-50, .tekst2-50, .tekst5-50, .tekst8-50, .tekst10-50, .tekst11-50{
      width: 13.4em;
      margin: 6em 0 0 -0.9em;
    }

    .tekst3-50, .tekst9-50{
      width: 13.4em;
      margin: 19.2em 0 0 -0.9em;
    }

    .tekst4-50, .tekst6-50, .tekst7-50, .tekst12-50{
      width: 29em;
      margin: 6em 0 0 -0.9em;
    }

    .triangle1-50, .triangle2-50, .triangle5-50, .triangle8-50, .triangle10-50, .triangle11-50{
      margin: 108px 0 0 -12px;
    }

    .triangle3-50, .triangle9-50{
      margin: 284px 0 0 -12px;
    }

    .triangle4-50, .triangle6-50, .triangle7-50, .triangle12-50{
      margin: 108px 0 0 -12px;
    }
  }

  @media screen and (max-width: 912px){
    .boks1-100 {
      margin: 2em 1em 1em 6em;
    }

    .boks2-100 {
      margin: 2em 1em 1em 1em;
    }

    .boks3-100 {
      height: 24em;
      margin: 2em 4em 1em 1em;
    }

    .boks4-100 {
      width: 28em;
      margin: 15em 7em 1em -47em;
    }

    .boks5-100 {
      margin: 1em 1em 1em 6em;
    }

    .boks6-100 {
      width: 28em;
      margin: 1em 4em 1em 1em;
    }

    .boks7-100 {
      width: 28em;
      margin: 1em 1em 1em 6em;
    }

    .boks8-100 {
      margin: 1em 4em 1em 1em;
    }

    .boks9-100 {
      height: 24em;
      margin: 1em 1em 1em 6em;
    }

    .boks10-100{
      margin: 1em;
    }

    .boks11-100 {
      margin: 1em 4em 1em 1em;
    }

    .boks12-100 {
      width: 28em;
      margin: -12em 2em 2em 21em;
    }

    .tekst3-100, .tekst9-100{
      width: 209px;
      margin: 14.7em 0 0 -0.9em;
    }

    .tekst4-100, .tekst6-100, .tekst7-100, .tekst12-100{
      width: 449px;
      margin: 4.3em 0 0 -0.9em;
    }

    .triangle3-100, .triangle9-100 {
      margin: 337px 0em 0 -1.3em;
    }
  }

  @media screen and (max-width: 879px){
    .hideAndSeekButtom {
      font-size: 1.3em;
    }
    
    .boks1-50, .boks2-50, .boks5-50, .boks8-50, .boks10-50, .boks11-50{
      width: 10em;
      height: 8em;
    }

    .boks3-50, .boks9-50{
      width: 10em;
      height: 18em;
    }

    .boks4-50, .boks6-50, .boks7-50, .boks12-50{
      width: 22em;
      height: 8em;
    }

    .boks4-50{
      margin: 10.2em 11em 1em -37em;
    }

    .boks12-50{
      margin: -9em 2em 2em 15em;
    }

    .tekst1-50, .tekst2-50, .tekst5-50, .tekst8-50, .tekst10-50, .tekst11-50{
      width: 12.2em;
      margin: 5em 0 0 -0.9em;
    }

    .tekst3-50, .tekst9-50 {
      width: 12.2em;
      margin: 17em 0 0 -0.9em;
    }

    .tekst4-50, .tekst6-50, .tekst7-50, .tekst12-50{
      width: 26.6em;
      margin: 5em 0 0 -0.9em;
    }

    .triangle1-50, .triangle2-50, .triangle5-50, .triangle8-50, .triangle10-50, .triangle11-50{
      margin: 95px 0 0 -12px;
    }

    .triangle3-50, .triangle9-50{
      margin: 255px 0 0 -12px;
    }

    .triangle4-50, .triangle6-50, .triangle7-50, .triangle12-50{
      margin: 95px 0 0 -12px;
    }
  }

  @media screen and (max-width: 864px){
    .boks3-100 {
      margin: 2em 3.5em 1em 1em;
    }

    .boks6-100, .boks8-100, .boks11-100 {
      margin: 1em 3.5em 1em 1em;
    }

    .boks4-100 {
      margin: 15em 7em 1em -46.6em;
    }
  }

  @media screen and (max-width: 858px){
    .boks1-100 {
      margin: 2em 1em 1em 5em;
    }

    .boks5-100, .boks7-100, .boks9-100 {
      margin: 1em 1em 1em 5em;
    }

    .boks12-100 {
      width: 28em;
      margin: -12em 2em 2em 20em;
    }
  }

  @media screen and (max-width: 847px){
    .boks1-100, .boks2-100, .boks5-100, .boks8-100, .boks10-100, .boks11-100{
      width: 12em;
      height: 10em;
    }

    .boks1-100 {
      margin: 2em 1em 1em 6em;
    }

    .boks3-100, .boks9-100{
      width: 12em;
      height: 22em;
    }

    .boks4-100, .boks6-100, .boks7-100, .boks12-100{
      width: 26em;
      height: 10em;
    }

    .boks4-100{
      margin: 14em 7em 1em -43.5em;
    }

    .boks12-100{
      margin: -11em 2em 2em 20em
    }

    .boks5-100, .boks7-100, .boks9-100 {
      margin: 1em 1em 1em 6em;
    }

    .tekst1-100, .tekst2-100, .tekst5-100, .tekst8-100, .tekst10-100, .tekst11-100{
      width: 193px;
      margin: 3.7em 0 0 -0.9em;
    }

    .tekst3-100, .tekst9-100{
      width: 194px;
      margin: 13.3em 0 0 -0.9em;
    }

    .tekst4-100, .tekst6-100, .tekst7-100, .tekst12-100{
      width: 417px;
      margin: 3.7em 0 0 -0.9em;
    }

    .triangle1-100, .triangle2-100, .triangle5-100, .triangle8-100, .triangle10-100, .triangle11-100{
      margin: 117px 0em 0 -1.3em;
    }

    .triangle3-100, .triangle9-100{
      margin: 309px 0em 0 -1.3em;
    }

    .triangle4-100, .triangle6-100, .triangle7-100, .triangle12-100{
      margin: 117px 0em 0 -1.3em;
    }
  }

  @media screen and (max-width: 819px){
    .boks1-50 {
      margin: 0.2em 1em 1em 2.5em;
    }

    .boks3-50 {
      margin: 0.2em 2.5em 1em 1em;
    }

    .boks4-50 {
      margin: 10.2em 11em 1em -36.5em;
    }

    .boks7-50, .boks9-50, .boks5-50  {
      margin: 1em 1em 1em 2.5em;
    }

    .boks8-50, .boks11-50, .boks6-50 {
      margin: 1em 2.5em 1em 1em;
    }

    .boks12-50 {
      margin: -9em 2em 2em 14.5em;
    }
  }

  @media screen and (max-width: 808px){
    .boks1-100 {
      margin: 2em 1em 1em 5em;
    }

    .boks1-50 {
      margin: 0.2em 1em 1em 2.5em;
    }

    .boks3-50 {
      margin: 0.2em 2.5em 1em 1em;
    }

    .boks4-50 {
      margin: 10.2em 11em 1em -36.5em;
    }

    .boks5-100, .boks7-100, .boks9-100{
      margin: 1em 1em 1em 5em;
    }

    .boks5-50, .boks7-50, .boks9-50 {
      margin: 1em 1em 1em 2.5em;
    }

    .boks6-100 {
      width: 26em;
      margin: 1em 3.5em 1em 1em;
    }

    .boks6-50, .boks8-50, .boks11-50 {
      margin: 1em 2.5em 1em 1em;
    }

    .boks12-100 {
      margin: -11em 2em 2em 19em;
    }

    .boks12-50 {
      margin: -9em 2em 2em 14.5em;
    }
  }

  @media screen and (max-width: 796px){
    .boks1-50 {
      margin: 0.2em 1em 1em 2em;
    }

    .boks3-50 {
      margin: 0.2em 2em 1em 1em;
    }

    .boks4-50 {
      margin: 10.2em 11em 1em -36em;
    }

    .boks7-50, .boks9-50, .boks5-50  {
      margin: 1em 1em 1em 2em;
    }

    .boks8-50, .boks11-50, .boks6-50 {
      margin: 1em 2em 1em 1em;
    }

    .boks12-50 {
      margin: -9em 2em 2em 14em;
    }
  }

  @media screen and (max-width: 792px){
    .boks1-100 {
      margin: 2em 1em 1em 4em;
    }

    .boks5-100, .boks7-100, .boks9-100{
      margin: 1em 1em 1em 4em;
    }

    .boks6-100 {
      width: 26em;
      margin: 1em 3.5em 1em 1em;
    }

    .boks12-100 {
      margin: -11em 2em 2em 18em;
    }
  }

  @media screen and (max-width: 779px){
    .boks1-50 {
      margin: 0.2em 0.5em 0.5em 2em;
    }

    .boks2-50 {
      margin: 0.2em 0.5em 0.5em 0.5em;
    }

    .boks3-50 {
      height: 17em;
      margin: 0.2em 2em 0.5em 0.5em;
    }

    .boks4-50 {
      width: 21em;
      margin: 9.2em 11em 0.5em -34em;
    }

    .boks5-50, .boks7-50, .boks9-50 {
      margin: 0.5em 0.5em 0.5em 2em;
    }

    .boks7-50{
      width: 21em;
    }

    .boks9-50{
      height: 17em;
    }

    .boks6-50{
      width: 21em;
      margin: 0.5em 2em 0.5em 0.5em;
    }

    .boks8-50{
      margin: 0.5em 2em 0.5em 0.5em;
    }

    .boks10-50 {
      margin: 0.5em;
    }

    .boks11-50 {
      margin: 0.5em 2em 0.5em 0.5em;
    }

    .boks12-50 {
      width: 21em;
      margin: -8.5em 2em 2em 13em;
    }

    .tekst1-50, .tekst2-50, .tekst5-50, .tekst8-50, .tekst10-50, .tekst11-50{
      width: 11.7em;
      margin: 5em 0 0 -0.5em;
    }

    .tekst3-50, .tekst9-50{
      width: 11.7em;
      margin: 15.9em 0 0 -0.5em;
    }

    .tekst4-50, .tekst6-50, .tekst7-50, .tekst12-50{
      width: 25em;
      margin: 5em 0 0 -0.5em;
    }

    .triangle1-50, .triangle2-50, .triangle5-50, .triangle8-50, .triangle10-50, .triangle11-50{
      border-top: 5px solid transparent;
      border-left: 7px solid transparent;
      margin: 94px 0 0 -7px;
    }

    .triangle1-50:hover .triangle1-50, .triangle2-50:hover .triangle2-50, .triangle5-50:hover .triangle5-50, .triangle8-50:hover .triangle8-50, .triangle10-50:hover .triangle10-50, .triangle11-50:hover .triangle11-50{
      border-top: 5px solid #A3CCCC;
      border-left: 9px solid transparent;
      animation-name: fromTranparentTooColorTriangle;
      animation-duration: 1.5s;
      animation-iteration-count: 1;
    }

    .triangle3-50, .triangle9-50{
      border-top: 5px solid transparent;
      border-left: 7px solid transparent;
      margin: 240px 0 0 -7px;

    }

    .triangle3-50:hover .triangle3-50, .triangle9-50:hover .triangle9-50{
      border-top: 5px solid #A3CCCC;
      animation-name: fromTranparentTooColorTriangle;
      animation-duration: 1.5s;
      animation-iteration-count: 1;
    }

    .triangle4-50, .triangle6-50, .triangle7-50, .triangle12-50{
      border-top: 5px solid transparent;
      border-left: 7px solid transparent;
      margin: 94px 0 0 -7px;

    }

    .triangle4-50:hover .triangle4-50, .triangle6-50:hover .triangle6-50, .triangle7-50:hover .triangle7-50, .triangle12-50:hover .triangle12-50{
      border-top: 5px solid #A3CCCC;
      border-left: 9px solid transparent;
      animation-name: fromTranparentTooColorTriangle;
      animation-duration: 1.5s;
      animation-iteration-count: 1;
    }
  }

  @media screen and (max-width: 776px){
    .boks3-100 {
      margin: 2em 3em 1em 1em;
    }

    .boks6-100, .boks8-100, .boks11-100 {
      margin: 1em 3em 1em 1em;
    }
  }

  /* tablets */
  @media screen and (max-width: 769px){
    .OuterBoks {
      display: block;
    }

    .boks1-100, .boks2-100, .boks5-100, .boks6-100, .boks8-100, .boks9-100, .boks10-100, .boks12-100{
      width: 15em;
      height: 13em;
    }

    .boks1-100 {
      margin: 2em 2.5em 2.5em 5em;
    }

    .boks2-100{
      margin: 2em 5em 2.5em 2.5em;
    }

    .boks3-100, .boks7-100{
      width: 35em;
      height: 13em;
      margin: 2.5em 5em 2.5em 5em;
    }

    .boks4-100, .boks11-100{
      width: 15em;
      height: 31em;
      
    } 

    .boks4-100, .boks8-100, .boks10-100{
      margin: 2.5em 2.5em 2.5em 5em;
    }

    .boks5-100, .boks9-100, .boks11-100{
      margin: 2.5em 5em 2.5em 2.5em;
    }

    .boks6-100{
      margin: -15.5em 5em 2.5em 25em;
    }

    .boks12-100 {
      margin: -15.5em 2.5em 2.5em 5em;
    }

    .tekst1-100, .tekst2-100, .tekst5-100, .tekst6-100, .tekst8-100, .tekst9-100, .tekst10-100, .tekst12-100{
      width: 241px;
      margin: 5.7em 0 0 -0.9em;
    }

    .tekst4-100, .tekst11-100 {
      width: 241px;
      margin: 20em 0 0 -0.9em;
    }

    .tekst3-100, .tekst7-100{
      width: 559px;
      margin: 5.7em 0 0 -0.9em;
    }

    .triangle1-100, .triangle2-100, .triangle5-100, .triangle6-100, .triangle8-100, .triangle9-100, .triangle10-100, .triangle12-100{
      margin: 157px 0em 0 -1.3em;
    }

    .triangle4-100, .triangle11-100 {
      margin: 443px 0em 0 -1.3em;
    }


    .triangle3-100, .triangle7-100{
      margin: 157px 0em 0 -1.3em;
    }
  }

  @media screen and (max-width: 736px){
    .boks1-100 {
      margin: 2em 2em 2em 5em;
    }

    .boks2-100{
      margin: 2em 4.5em 2em 2em;
    }

    .boks3-100, .boks7-100{
      width: 34em;
      margin: 2em 4.5em 2em 5em;
    }

    .boks4-100, .boks8-100, .boks10-100{
      margin: 2em 2em 2em 5em;
    }

    .boks5-100, .boks9-100, .boks11-100{
      margin: 2em 4.5em 2em 2em;
    }

    .boks6-100{
      margin: -15em 4.5em 2em 24em;
    }

    .boks12-100 {
      margin: -16em 4.5em 2em 5em;
    }
  }

  @media screen and (max-width: 720px){
    .boks1-100, .boks2-100, .boks5-100, .boks6-100, .boks8-100, .boks9-100, .boks10-100, .boks12-100{
      width: 15em;
      height: 13em;
    }

    .boks3-100, .boks7-100{
      width: 34em;
      height: 13em;
    }

    .boks4-100, .boks11-100{
      width: 15em;
      height: 30em;
    } 

    .boks6-100{
      margin: -15em 4.5em 2em 24em;
    }

    .boks12-100 {
      margin: -15em 4.5em 2em 5em;
    }

    .tekst4-100, .tekst11-100 {
      width: 241px;
      margin: 19.3em 0 0 -0.9em;
    }

    .triangle4-100, .triangle11-100 {
      margin: 429px 0em 0 -1.3em;
    }
  }

  @media screen and (max-width: 712px){
    .boks1-100 {
      margin: 2em 2em 2em 4.5em;
    }

    .boks3-100, .boks7-100 {
      margin: 2em 4.5em 2em 4.5em;
    }

    .boks4-100, .boks8-100, .boks10-100 {
      margin: 2em 2em 2em 4.5em;
    }

    .boks6-100 {
      margin: -15em 4.5em 2em 23.5em;
    }

    .boks12-100 {
      margin: -15em 4.5em 2em 4.5em;
    }

    .tekst3-100, .tekst7-100 {
      width: 545px;
    }
  }

  @media screen and (max-width: 704px){
    .boks2-100 {
      margin: 2em 4em 2em 2em;
    }

    .boks5-100, .boks9-100, .boks11-100 {
      margin: 2em 4em 2em 2em;
    }

    .boks3-100, .boks7-100 {
      margin: 2em 4em 2em 4.5em;
    }
  }

  @media screen and (max-width: 696px){
    .boks1-100 {
      margin: 2em 2em 2em 4em;
    }

    .boks3-100, .boks7-100 {
      margin: 2em 4em 2em 4em;
    }

    .boks4-100, .boks8-100, .boks10-100 {
      margin: 2em 2em 2em 4em;
    }

    .boks12-100 {
      margin: -15em 4.5em 2em 4em;
    }
  }

  @media screen and (max-width: 688px){
    .boks1-100 {
      margin: 2em 1.5em 1.5em 4em;
    }

    .boks2-100{
      margin: 2em 4em 1.5em 1.5em;
    }

    .boks3-100, .boks7-100{
      width: 33em;
      margin: 1.5em 4em 1.5em 4em;
    }

    .boks4-100, .boks8-100, .boks10-100{
      margin: 1.5em 1.5em 1.5em 4em;
    }

    .boks4-100, .boks11-100{
      height: 29em;
    }

    .boks5-100, .boks9-100, .boks11-100{
      margin: 1.5em 4em 1.5em 1.5em;
    }

    .boks6-100{
      margin: -14.5em 4em 1.5em 22em;
    }

    .boks12-100 {
      margin: -14.5em 4.5em 1.5em 4em;
    }

    .tekst4-100, .tekst11-100 {
      width: 241px;
      margin: 18.5em 0 0 -0.9em;
    }

    .tekst3-100, .tekst7-100 {
      width: 529px;
      margin: 5.5em 0 0 -0.9em;
    }

    .triangle3-100, .triangle7-100 {
      margin: 152px 0em 0 -1.3em;
    }

    .triangle4-100, .triangle11-100 {
      margin: 413px 0em 0 -1.3em;
    }
  }

  @media screen and (max-width: 672px){
    .boks1-100, .boks2-100, .boks5-100, .boks6-100, .boks8-100, .boks9-100, .boks10-100, .boks12-100{
      width: 14em;
      height: 12em;
    }

    .boks1-100 {
      margin: 2em 1.5em 1.5em 4.5em;
    }

    .boks2-100{
      margin: 2em 5em 1.5em 1.5em;
    }

    .boks3-100, .boks7-100{
      width: 31em;
      height: 12em;
      margin: 1.5em 5em 1.5em 4.5em;
    }

    .boks4-100, .boks11-100{
      width: 14em;
      height: 27em;
    } 

    .boks4-100, .boks8-100, .boks10-100{
      margin: 1.5em 1.5em 1.5em 4.5em;
    }

    .boks5-100, .boks9-100, .boks11-100{
      margin: 1.5em 5em 1.5em 1.5em;
    }

    .boks6-100{
      margin: -13.5em 5em 2em 21.5em;
    }

    .boks12-100 {
      margin: -13.5em 5em 2em 4.5em;
    }

    .tekst1-100, .tekst2-100, .tekst5-100, .tekst6-100, .tekst8-100, .tekst9-100, .tekst10-100, .tekst12-100 {
      width: 225px;
      margin: 5em 0 0 -0.9em;
    }

    .tekst3-100, .tekst7-100 {
      width: 497px;
      margin: 5em 0 0 -0.9em;
    }

    .tekst4-100, .tekst11-100 {
      width: 225px;
      margin: 17em 0 0 -0.9em;
    }

    .triangle1-100, .triangle2-100, .triangle5-100, .triangle6-100, .triangle8-100, .triangle9-100, .triangle10-100, .triangle12-100 {
      margin: 143px 0em 0 -1.3em;
    }

    .triangle3-100, .triangle7-100 {
      margin: 143px 0em 0 -1.3em;
    }

    .triangle4-100, .triangle11-100 {
      margin: 383px 0em 0 -1.3em;
    }
  }

  @media screen and (max-width: 655px){
    .boks1-100 {
      margin: 2em 1.5em 1.5em 4em;
    }

    .boks2-100 {
      margin: 2em 4em 1.5em 1.5em;
    }

    .boks3-100, .boks7-100 {
      margin: 1.5em 4em 1.5em 4em;
    }

    .boks4-100, .boks8-100, .boks10-100 {
      margin: 1.5em 1.5em 1.5em 4em;
    }

    .boks5-100, .boks9-100, .boks11-100 {
      margin: 1.5em 4em 1.5em 1.5em;
    }

    .boks6-100 {
      margin: -13.5em 4.5em 2em 21em;
    }

    .boks12-100 {
      margin: -13.5em 5em 2em 4em;
    }
  }

  @media screen and (max-width: 640px){
    .boks1-100, .boks2-100, .boks5-100, .boks6-100, .boks8-100, .boks9-100, .boks10-100, .boks12-100{
      width: 12.5em;
      height: 11.5em;
    }

    .boks1-100 {
      margin: 2em 1.5em 1.5em 5em;
    }

    .boks2-100{
      margin: 2em 5em 1.5em 1.5em;
    }

    .boks3-100, .boks7-100{
      width: 28em;
      height: 13em;
      margin: 1.5em 5em 1.5em 5em;
    }

    .boks4-100, .boks11-100{
      width: 12.5em;
      height: 26em;
    } 

    .boks4-100, .boks8-100, .boks10-100{
      margin: 1.5em 1.5em 1.5em 5em;
    }

    .boks5-100, .boks9-100, .boks11-100{
      margin: 1.5em 5em 1.5em 1.5em;
    }

    .boks6-100{
      margin: -13em 5.5em 2em 20.5em;
    }

    .boks12-100 {
      margin: -13em 4.5em 2em 5em;
    }

    .tekst1-100, .tekst2-100, .tekst5-100, .tekst6-100, .tekst8-100, .tekst9-100, .tekst10-100, .tekst12-100 {
      width: 201px;
      margin: 4.5em 0 0 -0.9em;
    }

    .tekst3-100, .tekst7-100 {
      width: 449px;
      margin: 5.5em 0 0 -0.9em;
    }

    .tekst4-100, .tekst11-100 {
      width: 201px;
      margin: 16em 0 0 -0.9em;
    }

    .triangle1-100, .triangle2-100, .triangle5-100, .triangle6-100, .triangle8-100, .triangle9-100, .triangle10-100, .triangle12-100 {
      margin: 133px 0em 0 -1.3em;
    }

    .triangle3-100, .triangle7-100 {
      margin: 153px 0em 0 -1.3em;
    }

    .triangle4-100, .triangle11-100 {
      margin: 363px 0em 0 -1.3em;
    }
  }

  @media screen and (max-width: 623px){
    .boks1-100 {
      margin: 2em 1.5em 1.5em 4.5em;
    }

    .boks2-100{
      margin: 2em 4.5em 1.5em 1.5em;
    }

    .boks3-100, .boks7-100{
      margin: 1.5em 4.5em 1.5em 4.5em;
    }

    .boks4-100, .boks8-100, .boks10-100{
      margin: 1.5em 1.5em 1.5em 4.5em;
    }

    .boks5-100, .boks9-100, .boks11-100{
      margin: 1.5em 4.5em 1.5em 1.5em;
    }

    .boks6-100{
      margin: -13em 5em 2em 20em;
    }

    .boks12-100 {
      margin: -13em 5em 2em 4.5em;
    }
  }

  @media screen and (max-width: 608px){
    .boks1-100, .boks2-100, .boks5-100, .boks6-100, .boks8-100, .boks9-100, .boks10-100, .boks12-100{
      width: 12em;
      height: 11em;
    }

    .boks3-100, .boks7-100{
      width: 27em;
      height: 11em;
    }

    .boks4-100, .boks11-100{
      width: 12em;
      height: 25.5em;
    } 

    .boks6-100{
      margin: -12.5em 5em 2em 20em;
    }

    .boks12-100 {
      margin: -13em 4.5em 2em 4.5em;
    }

    .tekst1-100, .tekst2-100, .tekst5-100, .tekst6-100, .tekst8-100, .tekst9-100, .tekst10-100, .tekst12-100 {
      width: 193px;
      margin: 4.2em 0 0 -0.9em;
    }

    .tekst3-100, .tekst7-100 {
      width: 433px;
      margin: 4.2em 0 0 -0.9em;
    }

    .tekst4-100, .tekst11-100 {
      width: 193px;
      margin: 15.8em 0 0 -0.9em;
    }

    .triangle1-100, .triangle2-100, .triangle5-100, .triangle6-100, .triangle8-100, .triangle9-100, .triangle10-100, .triangle12-100 {
      margin: 127px 0em 0 -1.3em;
    }

    .triangle3-100, .triangle7-100 {
      margin: 127px 0em 0 -1.3em;
    }

    .triangle4-100, .triangle11-100 {
      margin: 359px 0em 0 -1.3em;
    }
  }

  @media screen and (max-width: 592px){
    .boks1-100, .boks2-100, .boks5-100, .boks6-100, .boks8-100, .boks9-100, .boks10-100, .boks12-100{
      width: 11.5em;
      height: 10.5em;
    }

    .boks3-100, .boks7-100{
      width: 26em;
      height: 10.5em;
    }

    .boks4-100, .boks11-100{
      width: 11.5em;
      height: 24em;
    } 

    .boks6-100{
      margin: -12em 5em 2em 19.5em;
    }

    .boks12-100 {
      margin: -12em 4.5em 2em 4.5em;
    }

    .tekst1-100, .tekst2-100, .tekst5-100, .tekst6-100, .tekst8-100, .tekst9-100, .tekst10-100, .tekst12-100 {
      width: 185px;
      margin: 4em 0 0 -0.9em;
    }

    .tekst3-100, .tekst7-100 {
      width: 417px;
      margin: 4em 0 0 -0.9em;
    }

    .tekst4-100, .tekst11-100 {
      width: 185px;
      margin: 14.7em 0 0 -0.9em;
    }

    .triangle1-100, .triangle2-100, .triangle5-100, .triangle6-100, .triangle8-100, .triangle9-100, .triangle10-100, .triangle12-100 {
      margin: 123px 0em 0 -1.3em;
    }

    .triangle3-100, .triangle7-100 {
      margin: 123px 0em 0 -1.3em;
    }

    .triangle4-100, .triangle11-100 {
      margin: 337px 0em 0 -1.3em;
    }
  }

  @media screen and (max-width: 577px){
    .boks1-100 {
      margin: 2em 1.5em 1.5em 4em;
    }

    .boks2-100{
      margin: 2em 4em 1.5em 1.5em;
    }

    .boks3-100, .boks7-100{
      margin: 1.5em 4em 1.5em 4em;
    }

    .boks4-100, .boks8-100, .boks10-100{
      margin: 1.5em 1.5em 1.5em 4em;
    }

    .boks5-100, .boks9-100, .boks11-100{
      margin: 1.5em 4em 1.5em 1.5em;
    }

    .boks6-100{
      margin: -12em 5em 2em 18.5em;
    }

    .boks12-100 {
      margin: -12em 5em 2em 4em;
    }
  }

  @media screen and (max-width: 560px){
    .boks1-100 {
      margin: 2em 1.5em 1.5em 3.5em;
    }

    .boks2-100{
      margin: 2em 3.5em 1.5em 1.5em;
    }

    .boks3-100, .boks7-100{
      margin: 1.5em 3.5em 1.5em 3.5em;
    }

    .boks4-100, .boks8-100, .boks10-100{
      margin: 1.5em 1.5em 1.5em 3.5em;
    }

    .boks5-100, .boks9-100, .boks11-100{
      margin: 1.5em 3.5em 1.5em 1.5em;
    }

    .boks6-100{
      margin: -12em 4em 2em 18em;
    }

    .boks12-100 {
      margin: -12em 5em 2em 3.5em;
    }
  }

  @media screen and (max-width: 544px){
    .boks1-100, .boks2-100, .boks5-100, .boks6-100, .boks8-100, .boks9-100, .boks10-100, .boks12-100{
      width: 11em;
      height: 10em;
    }

    .boks3-100, .boks7-100{
      width: 25em;
      height: 10em;
    }

    .boks4-100, .boks11-100{
      width: 11em;
      height: 22.5em;
    } 

    .boks6-100{
      margin: -11.5em 4em 2em 17.5em;
    }

    .boks12-100 {
      margin: -11.5em 5em 2em 3.5em;
    }

    .tekst1-100, .tekst2-100, .tekst5-100, .tekst6-100, .tekst8-100, .tekst9-100, .tekst10-100, .tekst12-100 {
      width: 177px;
      margin: 5em 0 0 -0.9em;
      font-size: 1.2em;
    }

    .tekst3-100, .tekst7-100 {
      width: 402px;
      margin: 5em 0 0 -0.9em;
      font-size: 1.2em;
    }

    .tekst4-100, .tekst11-100 {
      width: 177px;
      margin: 17.5em 0 0 -0.9em;
      font-size: 1.2em;
    }

    .triangle1-100, .triangle2-100, .triangle5-100, .triangle6-100, .triangle8-100, .triangle9-100, .triangle10-100, .triangle12-100 {
      margin: 114px 0em 0 -1.1em;
      border-top: 9px solid transparent;
      border-left: 15px solid transparent;
    }

    .triangle1-100:hover .triangle1-100, .triangle2-100:hover .triangle2-100, .triangle5-100:hover .triangle5-100, .triangle6-100:hover .triangle6-100, .triangle8-100:hover .triangle8-100, .triangle9-100:hover .triangle9-100, .triangle10-100:hover .triangle10-100, .triangle12-100:hover .triangle12-100 {
      border-top: 9px solid #A3CCCC;
      animation-name: fromTranparentTooColorTriangle;
      animation-duration: 1.5s;
      animation-iteration-count: 1;
    }

    .triangle3-100, .triangle7-100 {
      margin: 114px 0em 0 -1.1em;
      border-top: 9px solid transparent;
      border-left: 15px solid transparent;
    }

    .triangle3-100:hover .triangle3-100, .triangle7-100:hover .triangle7-100 {
      border-top: 9px solid #A3CCCC;
      animation-name: fromTranparentTooColorTriangle;
      animation-duration: 1.5s;
      animation-iteration-count: 1;
    }

    .triangle4-100, .triangle11-100 {
      margin: 313px 0em 0 -1.1em;
      border-top: 9px solid transparent;
      border-left: 15px solid transparent;
    }

    .triangle4-100:hover .triangle4-100, .triangle11-100:hover .triangle11-100 {
      border-top: 9px solid #A3CCCC;
      animation-name: fromTranparentTooColorTriangle;
      animation-duration: 1.5s;
      animation-iteration-count: 1;
    }
  }

  @media screen and (max-width: 528px){
    .boks1-100 {
      margin: 2em 1em 1em 3.5em;
    }

    .boks2-100{
      margin: 2em 3.5em 1em 1em;
    }

    .boks3-100, .boks7-100{
      width: 24em;
      margin: 1em 3.5em 1em 3.5em;
    }

    .boks4-100, .boks8-100, .boks10-100{
      margin: 1em 1em 1em 3.5em;
    }

    .boks4-100, .boks11-100{
      height: 22em;
    }

    .boks5-100, .boks9-100, .boks11-100{
      margin: 1em 3.5em 1em 1em;
    }

    .boks6-100{
      margin: -11em 4em 1em 16.5em;
    }

    .boks12-100 {
      margin: -11em 5em 1em 3.5em;
    }

    .tekst3-100, .tekst7-100 {
      width: 383px;
      margin: 5em 0 0 -0.9em;
    }

    .tekst4-100, .tekst11-100 {
      width: 177px;
      margin: 17em 0 0 -0.9em;  
    }

    .triangle4-100, .triangle11-100 {
      margin: 305px 0em 0 -1.1em;
    }
  }

  /* ved ikke om animation og responsiv virker 100% her efter */
  @media screen and (max-width: 512px){
    .boks1-100, .boks2-100, .boks5-100, .boks6-100, .boks8-100, .boks9-100, .boks10-100, .boks12-100{
      width: 10.5em;
      height: 9.5em;
    }

    .boks3-100, .boks7-100{
      width: 23em;
      height: 9.5em;
    }

    .boks4-100, .boks11-100{
      width: 10.5em;
      height: 21em;
    } 

    .boks6-100{
      margin: -10.5em 4em 1em 16em;
    }

    .boks12-100 {
      margin: -10.5em 5em 1em 3.5em;
    }

    .tekst1-100, .tekst2-100, .tekst5-100, .tekst6-100, .tekst8-100, .tekst9-100, .tekst10-100, .tekst12-100 {
      width: 166px;
    }

    .tekst3-100, .tekst7-100 {
      width: 367px;
      margin: 5em 0 0 -0.9em;
    }

    .tekst4-100, .tekst11-100 {
      width: 169px;
      margin: 16.5em 0 0 -0.9em;
    }

    .triangle4-100, .triangle11-100 {
      margin: 298px 0em 0 -1.1em;
    }
  }

  @media screen and (max-width: 495px){
    .boks1-100 {
      margin: 2em 1em 1em 3.5em;
    }

    .boks2-100{
      margin: 2em 3.5em 1em 1em;
    }

    .boks3-100, .boks7-100{
      width: 23em;
      margin: 1em 3.5em 1em 3.5em;
    }

    .boks4-100, .boks8-100, .boks10-100{
      margin: 1em 1em 1em 3.5em;
    }

    .boks4-100, .boks11-100{
      height: 21em;
    }

    .boks5-100, .boks9-100, .boks11-100{
      margin: 1em 3.5em 1em 1em;
    }

    .boks6-100{
      margin: -10.5em 3.5em 1em 16em;
    }

    .boks12-100 {
      margin: -10.5em 5em 1em 3.5em;
    }

    .tekst1-100, .tekst2-100, .tekst5-100, .tekst6-100, .tekst8-100, .tekst9-100, .tekst10-100, .tekst12-100 {
      width: 169px;
    }

    .tekst3-100, .tekst7-100 {
      width: 369px;
    }
  }

  @media screen and (max-width: 479px){
    .boks1-100, .boks2-100, .boks5-100, .boks6-100, .boks8-100, .boks9-100, .boks10-100, .boks12-100{
      width: 10em;
      height: 9em;
    }

    .boks3-100, .boks7-100{
      width: 22em;
      height: 9em;
    }

    .boks4-100, .boks11-100{
      width: 10em;
      height: 20em;
    } 

    .boks6-100{
      margin: -10em 4em 1em 15.5em;
    }

    .boks12-100 {
      margin: -10em 5em 1em 3.5em;
    }

    .tekst1-100, .tekst2-100, .tekst5-100, .tekst6-100, .tekst8-100, .tekst9-100, .tekst10-100, .tekst12-100 {
      width: 161px;
      margin: 4.5em 0 0 -0.9em;
    }

    .tekst3-100, .tekst7-100 {
      width: 354px;
      margin: 4.5em 0 0 -0.9em;
    }

    .tekst4-100, .tekst11-100 {
      width: 161px;
      margin: 15.6em 0 0 -0.9em;
    }

    .triangle1-100, .triangle2-100, .triangle5-100, .triangle6-100, .triangle8-100, .triangle9-100, .triangle10-100, .triangle12-100 {
      margin: 105px 0em 0 -1.1em;
      border-top: 9px solid transparent;
    }

    .triangle1-100:hover .triangle1-100, .triangle2-100:hover .triangle2-100, .triangle5-100:hover .triangle5-100, .triangle6-100:hover .triangle6-100, .triangle8-100:hover .triangle8-100, .triangle9-100:hover .triangle9-100, .triangle10-100:hover .triangle10-100, .triangle12-100:hover .triangle12-100 {
      border-top: 9px solid #A3CCCC;
      animation-name: fromTranparentTooColorTriangle;
      animation-duration: 1.5s;
      animation-iteration-count: 1;
    }

    .triangle3-100, .triangle7-100 {
      margin: 105px 0em 0 -1.1em;
      border-top: 9px solid transparent;
    }

    .triangle3-100:hover .triangle3-100, .triangle7-100:hover .triangle7-100 {
      border-top: 9px solid #A3CCCC;
      animation-name: fromTranparentTooColorTriangle;
      animation-duration: 1.5s;
      animation-iteration-count: 1;
    }

    .triangle4-100, .triangle11-100 {
      margin: 282px 0em 0 -1.1em;
      border-top: 9px solid transparent;
    }

    .triangle4-100:hover .triangle4-100, .triangle11-100:hover .triangle11-100 {
      border-top: 9px solid #A3CCCC;
      animation-name: fromTranparentTooColorTriangle;
      animation-duration: 1.5s;
      animation-iteration-count: 1;
    }
  }

  @media screen and (max-width: 463px){
    .boks1-100 {
      margin: 2em 1em 1em 3em;
    }

    .boks2-100{
      margin: 2em 3em 1em 1em;
    }

    .boks3-100, .boks7-100{
      width: 22em;
      margin: 1em 3em 1em 3em;
    }

    .boks4-100, .boks8-100, .boks10-100{
      margin: 1em 1em 1em 3em;
    }

    .boks4-100, .boks11-100{
      height: 20em;
    }

    .boks5-100, .boks9-100, .boks11-100{
      margin: 1em 3em 1em 1em;
    }

    .boks6-100{
      margin: -10em 3.8em 1em 15.2em;
    }

    .boks12-100 {
      margin: -10em 5em 1em 3em;
    }

     .triangle1-100:hover .triangle1-100, .triangle2-100:hover .triangle2-100, .triangle5-100:hover .triangle5-100, .triangle6-100:hover .triangle6-100, .triangle8-100:hover .triangle8-100, .triangle9-100:hover .triangle9-100, .triangle10-100:hover .triangle10-100, .triangle12-100:hover .triangle12-100 {
      border-top: 9px solid #A3CCCC;
      animation-name: fromTranparentTooColorTriangle;
      animation-duration: 1.5s;
      animation-iteration-count: 1;
    }

    .triangle3-100:hover .triangle3-100, .triangle7-100:hover .triangle7-100 {
      border-top: 9px solid #A3CCCC;
      animation-name: fromTranparentTooColorTriangle;
      animation-duration: 1.5s;
      animation-iteration-count: 1;
    }
  }

  @media screen and (max-width: 448px){
    .boks1-100, .boks2-100, .boks5-100, .boks6-100, .boks8-100, .boks9-100, .boks10-100, .boks12-100{
      width: 9.5em;
      height: 8.5em;
    }

    .boks3-100, .boks7-100{
      width: 21em;
      height: 8.5em;
    }

    .boks4-100, .boks11-100{
      width: 9.5em;
      height: 19em;
    } 

    .boks6-100{
      margin: -9.5em 3.5em 1em 14.5em;
    }

    .boks12-100 {
      margin: -9.5em 5em 1em 3em;
    }

    .tekst1-100, .tekst2-100, .tekst5-100, .tekst6-100, .tekst8-100, .tekst9-100, .tekst10-100, .tekst12-100 {
      width: 153px;
      margin: 4em 0 0 -0.9em;
    }

    .tekst3-100, .tekst7-100 {
      width: 337px;
      margin: 4em 0 0 -0.9em;
    }

    .tekst4-100, .tekst11-100 {
      width: 153px;
      margin: 14.5em 0 0 -0.9em;
    }

    .triangle1-100, .triangle2-100, .triangle5-100, .triangle6-100, .triangle8-100, .triangle9-100, .triangle10-100, .triangle12-100 {
      margin: 97px 0em 0 -1.1em;
    }

    .triangle3-100, .triangle7-100 {
      margin: 97px 0em 0 -1.1em;
    }

    .triangle4-100, .triangle11-100 {
      margin: 265px 0em 0 -1.1em;
    }
  }

  @media screen and (max-width: 431px){
    .boks1-100 {
      margin: 2em 1em 1em 2.5em;
    }

    .boks2-100{
      margin: 2em 2.5em 1em 1em;
    }

    .boks3-100, .boks7-100{
      width: 21em;
      margin: 1em 2.5em 1em 2.5em;
    }

    .boks4-100, .boks8-100, .boks10-100{
      margin: 1em 1em 1em 2.5em;
    }

    .boks4-100, .boks11-100{
      height: 19em;
    }

    .boks5-100, .boks9-100, .boks11-100{
      margin: 1em 2.5em 1em 1em;
    }

    .boks6-100{
      margin: -9.5em 3.5em 1em 14em;
    }

    .boks12-100 {
      margin: -9.5em 5em 1em 2.5em;
    }
  }

  /* mobil */
  @media screen and (max-width: 425px){
    .boks1-100, .boks2-100, .boks3-100, .boks4-100, .boks5-100, .boks6-100, .boks7-100, .boks8-100, .boks9-100, .boks10-100, .boks11-100, .boks12-100{
      height: 8em;
      width: 21em;
      margin: 1em 2.5em 1em 2.5em;
    }

    .tekst1-100, .tekst2-100, .tekst3-100, .tekst4-100, .tekst5-100, .tekst6-100, .tekst7-100, .tekst8-100, .tekst9-100, .tekst10-100, .tekst11-100, .tekst12-100 {
      width: 337px;
      margin: 4.5em 0 0 -0.9em;
    }

    .triangle1-100, .triangle2-100, .triangle3-100, .triangle4-100, .triangle5-100, .triangle6-100, .triangle7-100, .triangle8-100, .triangle9-100, .triangle10-100, .triangle11-100, .triangle12-100 {
      margin: 106px 0em 0 -1.1em; 
    }
  }

  @media screen and (max-width: 415px){
    .tekst1-100, .tekst2-100, .tekst3-100, .tekst4-100, .tekst5-100, .tekst6-100, .tekst7-100, .tekst8-100, .tekst9-100, .tekst10-100, .tekst11-100, .tekst12-100 {
      width: 336px;
      margin: 4.5em 0 0 -0.9em;
    }

    .triangle1-100, .triangle2-100, .triangle3-100, .triangle4-100, .triangle5-100, .triangle6-100, .triangle7-100, .triangle8-100, .triangle9-100, .triangle10-100, .triangle11-100, .triangle12-100 {
      margin: 105px 0em 0 -1.1em; 
    }
  }

  @media screen and (max-width: 412px){
    .tekst1-100, .tekst2-100, .tekst3-100, .tekst4-100, .tekst5-100, .tekst6-100, .tekst7-100, .tekst8-100, .tekst9-100, .tekst10-100, .tekst11-100, .tekst12-100 {
      width: 333px;
    }
  }

  @media screen and (max-width: 410px){
    .tekst1-100, .tekst2-100, .tekst3-100, .tekst4-100, .tekst5-100, .tekst6-100, .tekst7-100, .tekst8-100, .tekst9-100, .tekst10-100, .tekst11-100, .tekst12-100 {
      width: 330px;
    }
  }

  @media screen and (max-width: 406px){
    .tekst1-100, .tekst2-100, .tekst3-100, .tekst4-100, .tekst5-100, .tekst6-100, .tekst7-100, .tekst8-100, .tekst9-100, .tekst10-100, .tekst11-100, .tekst12-100 {
      width: 327px;
    }
  }

  @media screen and (max-width: 403px){
    .tekst1-100, .tekst2-100, .tekst3-100, .tekst4-100, .tekst5-100, .tekst6-100, .tekst7-100, .tekst8-100, .tekst9-100, .tekst10-100, .tekst11-100, .tekst12-100 {
      width: 324px;
    }
  }

  @media screen and (max-width: 400px){
    .tekst1-100, .tekst2-100, .tekst3-100, .tekst4-100, .tekst5-100, .tekst6-100, .tekst7-100, .tekst8-100, .tekst9-100, .tekst10-100, .tekst11-100, .tekst12-100 {
      width: 321px;
    }
  }

  @media screen and (max-width: 397px){
    .tekst1-100, .tekst2-100, .tekst3-100, .tekst4-100, .tekst5-100, .tekst6-100, .tekst7-100, .tekst8-100, .tekst9-100, .tekst10-100, .tekst11-100, .tekst12-100 {
      width: 319px;
    }
  }

  @media screen and (max-width: 394px){
    .tekst1-100, .tekst2-100, .tekst3-100, .tekst4-100, .tekst5-100, .tekst6-100, .tekst7-100, .tekst8-100, .tekst9-100, .tekst10-100, .tekst11-100, .tekst12-100 {
      width: 315px;
    }
  }

  @media screen and (max-width: 391px){
    .tekst1-100, .tekst2-100, .tekst3-100, .tekst4-100, .tekst5-100, .tekst6-100, .tekst7-100, .tekst8-100, .tekst9-100, .tekst10-100, .tekst11-100, .tekst12-100 {
      width: 312px;
    }
  }

  @media screen and (max-width: 388px){
    .tekst1-100, .tekst2-100, .tekst3-100, .tekst4-100, .tekst5-100, .tekst6-100, .tekst7-100, .tekst8-100, .tekst9-100, .tekst10-100, .tekst11-100, .tekst12-100 {
      width: 309px;
    }
  }

  @media screen and (max-width: 384px){
    .tekst1-100, .tekst2-100, .tekst3-100, .tekst4-100, .tekst5-100, .tekst6-100, .tekst7-100, .tekst8-100, .tekst9-100, .tekst10-100, .tekst11-100, .tekst12-100 {
      width: 79.4%;
    }
  }

  @media screen and (max-width: 375px){
    .tekst1-100, .tekst2-100, .tekst3-100, .tekst4-100, .tekst5-100, .tekst6-100, .tekst7-100, .tekst8-100, .tekst9-100, .tekst10-100, .tekst11-100, .tekst12-100 {
      width: 79.2%;
    }
  }

  @media screen and (max-width: 368px){
    .tekst1-100, .tekst2-100, .tekst3-100, .tekst4-100, .tekst5-100, .tekst6-100, .tekst7-100, .tekst8-100, .tekst9-100, .tekst10-100, .tekst11-100, .tekst12-100 {
      width: 79%;
    }
  }

  @media screen and (max-width: 364px){
    .tekst1-100, .tekst2-100, .tekst3-100, .tekst4-100, .tekst5-100, .tekst6-100, .tekst7-100, .tekst8-100, .tekst9-100, .tekst10-100, .tekst11-100, .tekst12-100 {
      width: 285px;
    }
  }

  @media screen and (max-width: 360px){
    .tekst1-100, .tekst2-100, .tekst3-100, .tekst4-100, .tekst5-100, .tekst6-100, .tekst7-100, .tekst8-100, .tekst9-100, .tekst10-100, .tekst11-100, .tekst12-100 {
      width: 281px;
    }
  }

  @media screen and (max-width: 356px){
    .tekst1-100, .tekst2-100, .tekst3-100, .tekst4-100, .tekst5-100, .tekst6-100, .tekst7-100, .tekst8-100, .tekst9-100, .tekst10-100, .tekst11-100, .tekst12-100 {
      width: 277px;
    }
  }

  @media screen and (max-width: 352px){
    .tekst1-100, .tekst2-100, .tekst3-100, .tekst4-100, .tekst5-100, .tekst6-100, .tekst7-100, .tekst8-100, .tekst9-100, .tekst10-100, .tekst11-100, .tekst12-100 {
      width: 272px;
    }
  }

  @media screen and (max-width: 350px){
    .boks1-100, .boks2-100, .boks3-100, .boks4-100, .boks5-100, .boks6-100, .boks7-100, .boks8-100, .boks9-100, .boks10-100, .boks11-100, .boks12-100{
      height: 7em;
      width: 21em;
      margin: 1em 2.5em 1em 2.5em;
    }

    .tekst1-100, .tekst2-100, .tekst3-100, .tekst4-100, .tekst5-100, .tekst6-100, .tekst7-100, .tekst8-100, .tekst9-100, .tekst10-100, .tekst11-100, .tekst12-100 {
      width: 270spx;
      margin: 3.9em 0 0 -0.9em;
    }

    .triangle1-100, .triangle2-100, .triangle3-100, .triangle4-100, .triangle5-100, .triangle6-100, .triangle7-100, .triangle8-100, .triangle9-100, .triangle10-100, .triangle11-100, .triangle12-100 {
      margin: 96px 0em 0 -1.1em; 
    }
  }

  @media screen and (max-width: 346px){
    .tekst1-100, .tekst2-100, .tekst3-100, .tekst4-100, .tekst5-100, .tekst6-100, .tekst7-100, .tekst8-100, .tekst9-100, .tekst10-100, .tekst11-100, .tekst12-100 {
      width: 267px;
      margin: 3.9em 0 0 -0.9em;
    }
  }

  @media screen and (max-width: 342px){
    .tekst1-100, .tekst2-100, .tekst3-100, .tekst4-100, .tekst5-100, .tekst6-100, .tekst7-100, .tekst8-100, .tekst9-100, .tekst10-100, .tekst11-100, .tekst12-100 {
      width: 263px;
      margin: 3.9em 0 0 -0.9em;
    }
  }

  @media screen and (max-width: 338px){
    .tekst1-100, .tekst2-100, .tekst3-100, .tekst4-100, .tekst5-100, .tekst6-100, .tekst7-100, .tekst8-100, .tekst9-100, .tekst10-100, .tekst11-100, .tekst12-100 {
      width: 258px;
      margin: 3.9em 0 0 -0.9em;
    }
  }

  @media screen and (max-width: 335px){
    .tekst1-100, .tekst2-100, .tekst3-100, .tekst4-100, .tekst5-100, .tekst6-100, .tekst7-100, .tekst8-100, .tekst9-100, .tekst10-100, .tekst11-100, .tekst12-100 {
      width: 256px;
      margin: 3.9em 0 0 -0.9em;
    }
  }

  @media screen and (max-width: 331px){
    .tekst1-100, .tekst2-100, .tekst3-100, .tekst4-100, .tekst5-100, .tekst6-100, .tekst7-100, .tekst8-100, .tekst9-100, .tekst10-100, .tekst11-100, .tekst12-100 {
      width: 251px;
      margin: 3.9em 0 0 -0.9em;
    }
  }

  @media screen and (max-width: 327px){
    .tekst1-100, .tekst2-100, .tekst3-100, .tekst4-100, .tekst5-100, .tekst6-100, .tekst7-100, .tekst8-100, .tekst9-100, .tekst10-100, .tekst11-100, .tekst12-100 {
      width: 248px;
      margin: 3.9em 0 0 -0.9em;
    }
  }

  @media screen and (max-width: 323px){
    .tekst1-100, .tekst2-100, .tekst3-100, .tekst4-100, .tekst5-100, .tekst6-100, .tekst7-100, .tekst8-100, .tekst9-100, .tekst10-100, .tekst11-100, .tekst12-100 {
      width: 244px;
      margin: 3.9em 0 0 -0.9em;
    }
  }

  @media screen and (max-width: 320px){
    .tekst1-100, .tekst2-100, .tekst3-100, .tekst4-100, .tekst5-100, .tekst6-100, .tekst7-100, .tekst8-100, .tekst9-100, .tekst10-100, .tekst11-100, .tekst12-100 {
      width: 241px;
      margin: 3.9em 0 0 -0.9em;
    }
  }
</style>