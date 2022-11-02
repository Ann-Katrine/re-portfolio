<template>
    <div>
       <h1>{{msg}}</h1>
       <p>windows width: {{ windowswidth }}</p>
       <p>windows height: {{ windowsheight }}</p>

        <button @click="openModal()">åben modal</button>
      

        <!-- {{ nytTal}} -->

       <div v-for="item in items" :key="item.message">
          <div v-if="tal == 1">
            <p class="green"> {{ item.message }} </p>
          </div>
          <div v-else-if=" tal == 2">
            <p class="red"> {{ item.message }} </p>
          </div>
          <div v-else-if="tal == 3">
            <p> {{ item.message }} </p>
          </div>
          <div v-else>
            <p> {{ item.message }} </p>
          </div>
       </div>


      <p v-for="(index, key) in amount" :key="key">
        <span :class="getClass(key % 12)">{{ key % 12 }} - {{ index }}</span>
      </p>

      

      <!-- test til animation -->
      <div class="flexboks mellemrum">
        
        <!-- forsættelse af første forsøg på camping van, med flere detaljer -->
        <div class="campingVanWaitingBox">
          <!-- landskab -->
          <div class="theSky"></div>
          <div class="theSunsCirkel">
            <div class="theSun"></div>
            <div class="theMoon"></div>
          </div>
          <!-- theStars -->
          <div>
            <div class="bigStar"></div>
            <div class="bigStar"></div>
            <div class="bigStar"></div>
            <div class="bigStar"></div>
            <div class="bigStar"></div>
            <div class="bigStar"></div>
            <div class="bigStar"></div>
            <div class="bigStar"></div>
            <div class="bigStar"></div>
            <div class="bigStar"></div>
            <div class="bigStar"></div>
            <div class="bigStar"></div>
            <div class="bigStar"></div>
            <div class="bigStar"></div>
            <div class="bigStar"></div>
            <div class="bigStar"></div>
            <div class="bigStar"></div>
            <div class="bigStar"></div>
            <div class="bigStar"></div>
            <div class="bigStar"></div>
            <div class="bigStar"></div>
            <div class="bigStar"></div>
            <div class="bigStar"></div>
            <div class="bigStar"></div>
          </div>
          <div class="grass"></div>
          <div class="road"></div>
          <div class="stripes"></div>

          <div class="storetBjerg"></div>
          <div class="treeStump"></div>
          <div class="treeTop"></div>
          <div class="treeStump1"></div>
          <div class="treeTop1"></div>
          <div class="treeStump2"></div>
          <div class="treeTop2"></div>
          <div class="lake"></div>
          
          <!-- gemme bokse -->
          <div class="RightBox"></div>
          <div class="leftBox"></div>

          <!-- camping van -->
          <div class="bilKasse"></div>
          <div class="fruntKasseUnder"></div>
          <div class="fruntKasseOver"></div>
          <div class="longWindow"></div>
          <div class="frontWindow"></div>
          <div class="hjul1">
            <img src="../images/hujlKapsel.png" class="huljkapsel">
          </div>
          <div class="hjul2">
            <img src="../images/hujlKapsel.png" class="huljkapsel">
          </div>
          
        </div>
      
        <!-- bevære sig infinite -->
        <div class="mellemrum">
          <p class="tekst">bevære sig infinite</p>
          <div class="langCirkel">
            <div class="lilleCirkel"></div>
          </div>
        </div>
       
       <!-- beværer sig kun med musen over -->
        <div class="mellemrum">
          <p class="tekst">bevæer sig kun med musen over</p>
          <div class="langCirkel">
            <div class="lilleCirkel1"></div>
          </div>
        </div>
        
        <!-- bliver usynlig til slut, når man holder over cirklen -->
        <div class="mellemrum">
          <p class="tekst">bliver usynlig til slut, <br> når man holder over cirklen</p>
          <div class="langCirkel">
            <div class="lilleCirkel2"></div>
          </div>
        </div>

        <!-- bliver usunlig til slut, når du holder over den langecirkel -->
        <div class="mellemrum">
          <p class="tekst">bliver usunlig til slut, <br> når du holder over den langecirkel</p>
          <div class="langCirkel1">
            <div class="lilleCirkel3"></div>
          </div>
        </div>

        <!-- bliver sunlig til slut, når du holder over den langecirkel -->
        <div class="mellemrum">
          <p class="tekst">bliver sunlig til slut, <br> når du holder over den langecirkel</p>
          <div class="langCirkel2">
            <div class="lilleCirkel4"></div>
          </div>
        </div>

        <!-- firkant der snurrer hele vejen rundt -->
        <div class="mellemrum">
          <p class="tekst">firkant der snurrer hele vejen rundt</p>
          <div class="lillefirkant"></div>
        </div>

        <!-- firkant der snurrer rundt til 20g -->
        <div class="mellemrum">
          <p class="tekst">firkant der snurrer rundt til 20g</p>
          <div class="lillefirkant1"></div>
        </div>

        <!-- firkant der snurrer rundt -->
        <div class="mellemrum">
          <p class="tekst">firkant der snurrer rundt</p>
          <div class="lillefirkant2"></div>
        </div>

        <!-- lilla firkant der snurrer rundt med <br> det samme, rød firkant der er 1s delay -->
        <div class="mellemrum">
          <p class="tekst">lilla firkant der snurrer rundt med <br> det samme, rød firkant der er 1s delay</p>
          <div class="storfirkant"></div>
          <div class="lillefirkan3"></div>
        </div>

        <!-- tekst der køre 360deg rundt -->
        <div class="snurrerTop mellemrum">
          <h2 class="tekst">I'm a spinning top!</h2>
        </div>

        <!-- tekst der bliver vist, hvor man kun ser lidt af gang hvor der er skygge i staten og slutning -->
        <div class="mellemrum">
          <h2 class="shineTekse">shine animation text</h2>
        </div>

        <!-- en masse bolde der holder op og ned hele tiden, 6 hopper forskelligt af de ander 6 bolde-->
        <div class="bagground">
          <div class="cirkel4a cirkelTop"></div>
          <div class="cirkel4b cirkelTop"></div>
          <div class="cirkel5a cirkelTop"></div>
          <div class="cirkel5b cirkelTop"></div>
          <div class="cirkel6a cirkelTop"></div>
          <div class="cirkel6b cirkelTop"></div>
          <div class="cirkel7a cirkelTop"></div>
          <div class="cirkel7b cirkelTop"></div>
          <div class="cirkel8a cirkelTop"></div>
          <div class="cirkel8b cirkelTop"></div>
          <div class="cirkel4a cirkelTop"></div>
          <div class="cirkel4b cirkelTop"></div>
           <div class="cirkel5a cirkelTop"></div>
          <div class="cirkel5b cirkelTop"></div>
          <div class="cirkel6a cirkelTop"></div>
          <div class="cirkel6b cirkelTop"></div>
          <div class="cirkel7a cirkelTop"></div>
          <div class="cirkel7b cirkelTop"></div>
          <div class="cirkel8a cirkelTop"></div>
          <div class="cirkel8b cirkelTop"></div>
        </div>

        <!-- neonlight hvor det er shadow der forsvinder og kommer igen -->
        <div class="neonLightBaggound">
          <p class="neonText">n</p>
          <p class="neonText">e</p>
          <p class="neonText">o</p>
          <p class="neonText">n</p>
          <p class="neonText">l</p>
          <p class="neonText">i</p>
          <p class="neonText">g</p>
          <p class="neonText">h</p>
          <p class="neonText">t</p>
        </div>

        <!-- tænder og slukker neonlight teksten -->
        <div class="neonLightBaggound1">
          <p class="neonText1">n</p>
          <p class="neonText1">e</p>
          <p class="neonText1">o</p>
          <p class="neonText1">n</p>
          <p class="neonText1">l</p>
          <p class="neonText1">i</p>
          <p class="neonText1">g</p>
          <p class="neonText1">h</p>
          <p class="neonText1">t</p>
        </div>

        
        <!-- tænder og slukker neonlight teksen meget lidt af tid + det meste er tænd hele tiden, det køre som en slags bølje -->
        <div class="neonLightBaggound2">
          <p class="neonText2">n</p>
          <p class="neonText2">e</p>
          <p class="neonText2">o</p>
          <p class="neonText2">n</p>
          <p class="neonText2">l</p>
          <p class="neonText2">i</p>
          <p class="neonText2">g</p>
          <p class="neonText2">h</p>
          <p class="neonText2">t</p>
        </div>

        <!-- 3 bolde der hopper op og ned efter hinanden -->
        <div class="waitingBox">
          <div class="ball"></div>
          <div class="ball"></div>
          <div class="ball"></div>
        </div>

        <!-- 6 bolde der hopper op og ned efter hinanden -->
        <div class="waitingBox">
          <div class="ball"></div>
          <div class="ball"></div>
          <div class="ball"></div>
          <div class="ball"></div>
          <div class="ball"></div>
          <div class="ball"></div>
        </div>

        <!-- 1 bold der kommer ud af det blå og forsvinder igen -->
        <div class="waitingBox1">
          <div class="ball1"></div>
        </div>

        <!-- 3 blode der kommer ud af det blå og forsvinder en efter en -->
        <div class="waitingBox">
          <div class="ballTicks"></div>
          <div class="ballTicks"></div>
          <div class="ballTicks"></div>
        </div>

        <!-- en cirkel af bolde der køre i en cirkel -->
        <div class="waitingBox">
          <div class="firkantRundt">
            <div class="littleCicle"></div>
            <div class="littleCicle"></div>
            <div class="littleCicle"></div>
            <div class="littleCicle"></div>
            <div class="littleCicle"></div>
            <div class="littleCicle"></div>
            <div class="littleCicle"></div>
            <div class="littleCicle"></div>
            <div class="littleCicle"></div>
          </div>
        </div>

        <!-- loading tekst med en bold der hopper op og ned før teksten -->
        <div class="waitingBox">
          <div class="hoppebold"></div>
          <p class="loadingTekst">loading</p>
        </div>

        <!-- loading teskt der har der hjemmelavet dot efter sig der hopper op og ned på samme tid -->
        <div class="waitingBox">
          <p class="loadingTekst1">loading</p>
          <div class="dot"></div>
          <div class="dot"></div>
          <div class="dot"></div>
        </div>

        <!-- loading teskt der har der hjemmelavet dot efter sig der hopper op og ned efter hinanden -->
        <!-- ved ikke lige hvad der sker med min css men kan ikke lige bruge "nth-child()" lige nu så... 
             lavet en hurtig men irreterne løsning -->
        <div class="waitingBox">
          <p class="loadingTekst1">loading</p>
          <div class="dot1"></div>
          <div class="dot2"></div>
          <div class="dot3"></div>
        </div>
        
        <!-- MEGA smart loading screen -->
        <!-- får loadign tekst frem med et bogstav af gang baglæns og dot prikker frem efter det -->
        <div class="waitingBox">
          <div class="door"></div>
          <p class="bogstavKommerFrem1">L</p>
          <p class="bogstavKommerFrem2">O</p>
          <p class="bogstavKommerFrem3">A</p>
          <p class="bogstavKommerFrem4">D</p>
          <p class="bogstavKommerFrem5">I</p>
          <p class="bogstavKommerFrem6">N</p>
          <p class="bogstavKommerFrem7">G</p>
          <div class="loadingDot1"></div>
          <div class="loadingDot2"></div>
          <div class="loadingDot3"></div>
          <div class="secretDoor"></div>
        </div>

        <!-- MEGA smart loading screen -->
        <!-- får loadign tekst frem med et bogstav af gang fra starten af og dot prikker frem efter det -->
        <div class="waitingBox">
          <div class="doora"></div>
          <p class="bogstavKommerFrem1a">L</p>
          <p class="bogstavKommerFrem2a">O</p>
          <p class="bogstavKommerFrem3a">A</p>
          <p class="bogstavKommerFrem4a">D</p>
          <p class="bogstavKommerFrem5a">I</p>
          <p class="bogstavKommerFrem6a">N</p>
          <p class="bogstavKommerFrem7a">G</p>
          <div class="loadingDot1a"></div>
          <div class="loadingDot2a"></div>
          <div class="loadingDot3a"></div>
          <div class="secretDoor"></div>
        </div>

        <div class="waitingBox">
          <div class="smailyFace">
            <div class="smailyAyaLeft"></div>
            <div class="smailyAyaRight"></div>
            <div class="smailyMouth">
              <div class="Smailytunge"></div>
            </div>
            <div class="smailySecretMouth"></div>
          </div>
        </div>

        <!-- rainBowShow -->
        <div class="waitingRanbow">
          <div class="redCircle"></div>
          <div class="orangeCircle"></div>
          <div class="yellowCircle"></div>
          <div class="greenCircle"></div>
          <div class="blueCircel"></div>
          <div class="violetCircle"></div>
          <div class="skyCircle"></div>
          <div class="secretSkyBoxa"></div>
          <div class="ruterhimlen">
            <div class="secretSkyBoxb"></div>
          </div>
          <div class="cloud1">
            <div class="cirkelCloud"></div>
            <div class="cirkelCloud"></div>
            <div class="cirkelCloud"></div>
            <div class="cirkelCloud"></div>
            <div class="cirkelCloud"></div>
            <div class="cirkelCloud"></div>
            <div class="cirkelCloud"></div>
          </div>
          <div class="cloud2">
            <div class="cirkelCloud"></div>
            <div class="cirkelCloud"></div>
            <div class="cirkelCloud"></div>
            <div class="cirkelCloud"></div>
            <div class="cirkelCloud"></div>
            <div class="cirkelCloud"></div>
            <div class="cirkelCloud"></div>
          </div>
        </div>

        <!-- den første version af camping van køre ud af en vej -->
        <div class="campingVanWaitingBox">
          <!-- landskab -->
          <div class="theSky"></div>
          <div class="theSunsCirkel">
            <div class="theSun"></div>
            <div class="theMoon"></div>
          </div>
          <div class="grass"></div>
          <div class="road"></div>
          <div class="stripes"></div>

          <div class="storetBjerg"></div>
          <div class="treeStump"></div>
          <div class="treeTop"></div>
          <div class="treeStump1"></div>
          <div class="treeTop1"></div>
          <div class="treeStump2"></div>
          <div class="treeTop2"></div>
          
          <div class="RightBox"></div>
          <div class="leftBox"></div>
          <!-- camping van -->
          <div class="bilKasse"></div>
          <div class="fruntKasseUnder"></div>
          <div class="fruntKasseOver"></div>
          <div class="longWindow"></div>
          <div class="frontWindow"></div>
          <div class="hjul1">
            <div class="linje1"></div>
            <div class="linje2"></div>
          </div>
          <div class="hjul2"></div>
          
        </div>
        

        <!-- teskt der køre lige som tekst i starten af star wars film -->
        <div class="STARWARSBox">
          <div class="fade"></div>
          <div class="STARWARStext">
            <div class="crawl">
              <div class="title">
                <p>Episode I</p>
                <h1>The beging</h1>
              </div>
                <p>It is a period of civil war. Rebel spaceships, striking from a hidden base, have won their first victory against the evil Galactic Empire.</p>     
                <p>During the battle, Rebel spies managed to steal secret plans to the Empire’s ultimate weapon, the DEATH STAR, an armored space station with enough power to destroy an entire planet.</p>
                <p>Pursued by the Empire’s sinister agents, Princess Leia races home aboard her starship, custodian of the stolen plans that can save her people and restore freedom to the galaxy…</p>
            </div>
          </div>
        </div>
        
        <!-- nob ikke lige nu -->
        <div class="neonLightBaggound">
          <!-- link til hjælp = https://developer.mozilla.org/en-US/docs/Web/SVG/Attribute/d -->
          <svg viewBox="0 0 200 50" xmlns="http://www.w3.org/2000/svg">
            <path fill="none" stroke="red"
              d="M 10,10 h 20
              t 30,9 0,19 30,9" />
          </svg>
        </div>

      </div>
      

      <!-- snemand -->
      <div class="land">
        <div class="sneGulv"></div>
        <div class="overHat"></div>
        <div class="underHat"></div>
        <div class="oneEye"></div>
        <div class="TwoEye"></div>
        <div class="cirkel"></div>
        <div class="gulerrød"></div>
        <div class="oneHaand"></div>
        <div class="broomstick"></div>
        <div class="broomHeadHair"></div>
        <div class="broomHeadHair1"></div>
        <div class="broomHeadHair2"></div>
        <div class="broomHeadHair3"></div>
        <div class="broomHeadHair4"></div>
        <div class="broomHeadHair5"></div>
        <div class="broomHeadHair6"></div>
        <div class="broomHeadHair7"></div> 
        <div class="broomHeadHair8"></div>        
        <div class="broomHead"></div>
        <div class="scarfOverSize2"></div>
        <div class="scarfOverSize1"></div>
        <div class="scarf"></div>
        <div class="scarfCirkel"></div>
        <div class="cirkel1"></div>
        <div class="cirkel2"></div>
        <div class="testHat"></div>
        <!-- <div class="RabbitBoddy"></div>
        <div class="RabbitHead"></div>
        <div class="RabbitEarhalv"></div>
        <div class="RabbitEarLinear"></div> -->
      </div>
      
       <show-project>
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

          <button class="modal-btn btn-next" @click="changeSlideNext()">
            <ion-icon name="chevron-forward-outline" class="close-ikon"></ion-icon>
          </button>
        </div>
        <div class="modal-circle-box" >
          <div class="modal-circles" v-for="circle in caruselShow" :key="circle.id"></div>
        </div>
        <h2 class="modal-overskrift">Projekt navn meget langt nu!!!?</h2>
        <div class="modal-kategori">
          <p class="modal-kategori-tekst">css</p>
        </div>
        <div class="ekstra-Tekst">
          <button class="btnModalDown" @click="showText()">
            <ion-icon name="chevron-down-outline" class="close-ikon"></ion-icon>
          </button>
        </div>
        <div v-show="showTeskt" class="modal-secret-text-bottom">
          <p>Hey there ~(^.^)~</p>
          <p>Waow all most nothings text on this!</p>
          <p>~(^.^)~ \(O~O) ~(o.o~) ($o$) (o.O)> ~(-.^) (~.~) (ô.O)? (@.@) (x.x) (õ_õ)/ (ò.ó) (-.-) (;o;) (^o^)/ { Hurra) (=.=) (OoO)! (*.*) (^v^) (U.U) <!--(>~<)--> ([].[]) (-@.@-) </p>
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
          <p>Skulle lave en hjemmeside til en Veteranbilklub hvor man kunne se informationer om klub, om medlemmerne og hvad for nogle veteranbiler de har. Man skulle også se hvad for reservadele de hade læggende. Så kan man også lave et login så man bliver medlem.</p>
        </div>
      </show-project>

    </div>    
</template>

<script>
  import showProject from '../components/showProject.vue'
  import eventBus from '../eventBus'

export default {
  components: { 
    showProject 
  },
  data(){
    return{
      showTeskt: false,
      msg: "test world!",
      windowswidth: 0,
      windowsheight: 0,
      items: [
      { message: 'baa' },
      { message: 'feee' },
      { message: 'faaa' }
      ],
      tal: 0,
      amount: [
        'kage',
        'Broccoli',
        'Selleri',
        'Bagels',
        'Kaffe',
        'Te',
        'Kakao',
        'CSS',
        'HTML',
        'PHP',
        'MySQL',
        'Vue',
        'Pizza',
      ],
      caruselShow: [
        true, 
        false, 
        false
      ]
    }
  },
  computed: {
    nytTal: function(){
      console.log("her")
      if(this.tal > 3){
        this.tal = 0
        console.log("reset")
      }
      else{
        console.log("plus")
        this.tal++
      }
      console.log(this.tal)
    }
  },
  created(){
    this.nytTal
  },
  mounted(){
    this.$nextTick(function() {
      window.addEventListener('resize', this.getWindowWidth);
      window.addEventListener('resize', this.getWindowHeight);
      //Init
      this.getWindowWidth()
      this.getWindowHeight()
      this.nytTal
    })

  },
  methods: {
    getWindowWidth(event) {
        // this.windowWidth = document.documentElement.clientWidth;
        this.windowswidth = window.innerWidth;
      },
    getWindowHeight(event) {
      this.windowHeight = document.documentElement.clientHeight;
    },
    getClass(index) {
      if (index === 0) {
        return 'red'
      } else if (index === 1) {
        return 'blue'
      } else if (index === 2) {
        return 'a'
      } else if (index === 3) {
        return 'b'
      } else if (index === 4) {
        return 'c'
      } else if (index === 5) {
        return 'd'
      } else if (index === 6) {
        return 'e'
      } else if (index === 7) {
        return 'f'
      } else if (index === 8) {
        return 'g'
      } else if (index === 9) {
        return 'h'
      } else if (index === 10) {
        return 'i'
      } else if (index === 11) {
        return 'j'
      }
    },
    // til modal
    openModal(){
      console.log("åben")
      eventBus.$emit("showModal", true)
    },
    showText(){
      if(this.showTeskt == true){
        this.showTeskt = false;
        eventBus.$emit("changeStyling", false)
      } 
      else{
        this.showTeskt = true
        eventBus.$emit("changeStyling", true)
      }     

      

    },
    changeSlideNext(){
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
    changeSlideBack(){
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
    window.removeEventListener('resize', this.getWindowHeight);
  }
}
</script>

<!------------------------------->
<!--     animation testing     -->
<!------------------------------->
<style>
/***********************************/
/*            til modal            */
/***********************************/
  

  /* carusel show */
  #slideShow{
    position: relative;
  }



/****************************************/
/*            til animaiton             */
/****************************************/

/***************************SNEMAND**************************/
.land{
  background-color: cyan;
  padding: 10em 0em;
}
.sneGulv{
  background-color: rgb(241, 233, 233);
  height: 5em;
  width: 40em;
  margin: 15em 2em 0 0em;
  position: absolute;
}
.overHat{
  width: 5em;
  height: 3em;
  background-color: #000;
  margin: -3em 4.5em 0em 5em;
  position: absolute;
  animation: flyingOverHat;
  animation-duration: 10s;
  animation-iteration-count: infinite;
}
.underHat{
  width: 6em;
  height: 1em;
  margin: 0em 4.5em -1em 4.5em;
  position: absolute;
  background-color: #000;
  animation: flyingUnderHat;
  animation-duration: 10s;
  animation-iteration-count: infinite;
}
.gulerrød{
 width: 0;
  height: 0;
  border-top: 5px solid transparent;
  border-left: 40px solid orangered;
  border-bottom: 5px solid transparent;
  position: absolute;
  margin: -2.2em 1em 0em 7.3em;
  animation-name: gulerrodryk;
  animation-duration: 5000ms;
  animation-iteration-count: infinite;
  animation-timing-function:linear;
}
.oneEye{
  width: 0.6em;
  height: 0.6em;
  background-color: #000;
  position: absolute;
  border-radius: 100%;
  margin: 1.7em 1em 1em 8em;
}
.TwoEye{
  width: 0.6em;
  height: 0.6em;
  background-color: #000;
  position: absolute;
  border-radius: 100%;
  margin: 1.7em 1em 1em 6.5em;
}
.scarf{
  width: 5em;
  height: 1em;
  background-color: red;
  position: absolute;
  margin: -1em 0 0 5em;
  border-radius: 10px;
}
.scarfCirkel{
  width: 1em;
  height: 1em;
  border-radius: 100%;
  position: absolute;
  background-color: rgb(209, 0, 0);
  margin: -1em 0 0 8em;
}
.scarfOverSize1{
  width: 1em;
  height: 4em;
  position: absolute;
  background-color: red;
  margin: -1em 0 0 8em;
  border-radius: 10px;
  animation-name: scrafFlying1;
  animation-duration: 10s;
  animation-iteration-count: infinite;
}
.scarfOverSize2{
  width: 1em;
  height: 3.8em;
  position: absolute;
  background-color: rgb(209, 0, 0);
  margin: -1em 0 0 7.8em;
  border-radius: 10px;
  transform: rotate(7deg);
  animation-name: scrafFlying2;
  animation-duration: 10s;
  /* animation-delay: 5000ms; */
  animation-iteration-count: infinite;
}
.oneHaand{
  width: 0.3em;
  height: 4em;
  background-color: saddlebrown;
  position: absolute;
  margin: -1.6em 0 0 4.2em;
  border-radius: 10px;
  transform: rotate(-20deg);
}
.broomstick{
  width: 0.5em;
  height: 5em;
  background-color: saddlebrown;
  position: absolute;
  margin: -2.6em 0 0 10.8em;
  border-radius: 10px;
  transform: rotate(30deg);
}
.broomHead{
  width: 3em;
  height: 0.5em;
  background-color: saddlebrown;
  position: absolute;
  margin: -2.4em 0 0 10.8em;
  transform: rotate(30deg);
}
.broomHeadHair{
  width: 3em;
  height: 0.9em;
  position: absolute;
  background-color: rgb(212, 133, 64);
  margin: -3em 0 0 11.1em;
  transform: rotate(30deg);
}
.broomHeadHair1{
  width: 0.1em;
  height: 0.9em;
  position: absolute;
  background-color: rgb(90, 89, 89);
  margin: -3.6em 0 0 11.5em;
  transform: rotate(30deg);
}
.broomHeadHair2{
  width: 0.1em;
  height: 0.9em;
  position: absolute;
  background-color: rgb(90, 89, 89);
  margin: -3.5em 0 0 11.8em;
  transform: rotate(30deg);
}
.broomHeadHair3{
  width: 0.1em;
  height: 0.9em;
  position: absolute;
  background-color: rgb(90, 89, 89);
  margin: -3.3em 0 0 12.1em;
  transform: rotate(30deg);
}
.broomHeadHair4{
  width: 0.1em;
  height: 0.9em;
  position: absolute;
  background-color: rgb(90, 89, 89);
  margin: -3.1em 0 0 12.4em;
  transform: rotate(30deg);
}
.broomHeadHair5{
  width: 0.1em;
  height: 0.9em;
  position: absolute;
  background-color: rgb(90, 89, 89);
  margin: -3em 0 0 12.7em;
  transform: rotate(30deg);
}
.broomHeadHair6{
  width: 0.1em;
  height: 0.9em;
  position: absolute;
  background-color: rgb(90, 89, 89);
  margin: -2.8em 0 0 13em;
  transform: rotate(30deg);
}
.broomHeadHair7{
  width: 0.1em;
  height: 0.9em;
  position: absolute;
  background-color: rgb(90, 89, 89);
  margin: -2.6em 0 0 13.3em;
  transform: rotate(30deg);
}
.broomHeadHair8{
  width: 0.1em;
  height: 0.9em;
  position: absolute;
  background-color: rgb(90, 89, 89);
  margin: -2.4em 0 0 13.6em;
  transform: rotate(30deg);
}
.cirkel{
  width: 5em;
  height: 5em;
  background-color: #fff;
  border-radius: 100%;
  margin: 0em 5em 0em 5em;
}
.cirkel1{
  width: 6em;
  height: 6em;
  background-color: #fff;
  border-radius: 100%;
  margin: -1em 4em 0em 4.5em;
}
.cirkel2{
  width: 7em;
  height: 7em;
  background-color: #fff;
  border-radius: 100%;
  margin: -1em 5em 5em 4em;
  position: absolute;
}
.testHat{
  width: 5em;
  height: 4em;
  background-color: #000;
  position: absolute;
  margin: 1em 0 0em 15.5em;
}
.RabbitBoddy{
  width: 4em;
  height: 4em;
  background-color: #fff;
  border-radius: 100%;
  /* margin: -10em 0 0 15.5em; */
}
.RabbitHead{
  width: 3em;
  height: 3em;
  background-color: #fff;
  border-radius: 100%;
  margin: -5.5em 0 0 2.8em;
}
.RabbitEarLinear{
  width: 0.5em;
  height: 2.6em;
  background-color: #fff;
  border-radius: 10px;
  margin: -2.5em 0 0 4em;
  transform: rotate(10deg);
}
.RabbitEarhalv{
  width: 0.5em;
  height: 2.6em;
  background-color: rgb(226, 226, 226);
  border-radius: 10px;
  margin: -5.4em 0 0 4.3em;
  transform: rotate(10deg);
}


@keyframes flyingUnderHat {
  /* 0% {position: relative;left: 0em; top: 0em;}
  10%{transform: rotate(5deg); position: relative;left: 4em; top: 0.4em;margin: -0.3em 4.5em -1em 4.5em;}
  20%{transform: rotate(20deg); position: relative;left: 4.5em; top: 0.4em;margin: -0.3em 4.5em -1em 4.5em;}
  30%{transform: rotate(40deg); position: relative;left: 5.6em; top: 0.4em;margin: -0.3em 4.5em -1em 4.5em;}
  40%{transform: rotate(90deg); position: relative;left: 7.5em; top: 0.4em;margin: -0.3em 4.5em -1em 4.5em;}
  60%{transform: rotate(120deg); position: relative;left: 9.5em; top: 0.4em;margin: -0.3em 4.5em -1em 4.5em;}
  70%{transform: rotate(140deg); position: relative;left: 10.5em; top: 2.5em;margin: -0.3em 4.5em -1em 4.5em;}
  80%{transform: rotate(160deg); position: relative;left: 10.5em; top: 4em;margin: -0.3em 4.5em -1em 4.5em;}
  90%{transform: rotate(180deg); position: relative;left: 10.5em; top: 6em;margin: -0.3em 4.5em -1em 4.5em;}
  100%{transform: rotate(180deg); position: relative;left: 10.5em; top: 11em;margin: -0.3em 4.5em -1em 4.5em;}  */
  0% {position: relative;left: 0em; top: 0em;}
  2%{transform: rotate(5deg); position: relative;left: 4em; top: 0.4em;margin: -0.3em 4.5em -1em 4.5em;}
  4%{transform: rotate(20deg); position: relative;left: 4.5em; top: 0.4em;margin: -0.3em 4.5em -1em 4.5em;}
  6%{transform: rotate(40deg); position: relative;left: 5.6em; top: 0.4em;margin: -0.3em 4.5em -1em 4.5em;}
  8%{transform: rotate(90deg); position: relative;left: 7.5em; top: 0.4em;margin: -0.3em 4.5em -1em 4.5em;}
  10%{transform: rotate(120deg); position: relative;left: 9.5em; top: 0.4em;margin: -0.3em 4.5em -1em 4.5em;}
  12%{transform: rotate(140deg); position: relative;left: 10.5em; top: 2.5em;margin: -0.3em 4.5em -1em 4.5em;}
  14%{transform: rotate(160deg); position: relative;left: 10.5em; top: 4em;margin: -0.3em 4.5em -1em 4.5em;}
  16%{transform: rotate(180deg); position: relative;left: 10.5em; top: 6em;margin: -0.3em 4.5em -1em 4.5em;}
  18%{transform: rotate(180deg); position: relative;left: 10.5em; top: 11em;margin: -0.3em 4.5em -1em 4.5em;} 
  100%{transform: rotate(180deg); position: relative;left: 10.5em; top: 11em;margin: -0.3em 4.5em -1em 4.5em;} 
}
@keyframes flyingOverHat {
  /* 0% {position: relative;left: 0em; top: 0em;}
  10%{transform: rotate(5deg); position: relative;left: 4.6em; top: 0.4em;margin: -0.3em 4.5em -1em 4.5em;}
  20%{transform: rotate(20deg); position: relative;left: 5.5em; top: 0.4em;margin: -0.3em 4.5em -1em 4.5em;}
  30%{transform: rotate(40deg); position: relative;left: 7.3em; top: 0.4em;margin: -0.3em 4.5em -1em 4.5em;}
  40%{transform: rotate(90deg); position: relative;left: 9.5em; top: 1.4em;margin: -0.3em 4.5em -1em 4.5em;}
  60%{transform: rotate(120deg); position: relative;left: 11.6em; top: 2.4em;margin: -0.3em 4.5em -1em 4.5em;}
  70%{transform: rotate(140deg); position: relative;left: 12em; top: 4.5em;margin: -0.3em 4.5em -1em 4.5em;} 
  80%{transform: rotate(160deg); position: relative;left: 11.7em; top: 6.5em;margin: -0.3em 4.5em -1em 4.5em;}
  90%{transform: rotate(180deg); position: relative;left: 11em; top: 9em;margin: -0.3em 4.5em -1em 4.5em;}
  100%{transform: rotate(180deg); position: relative;left: 11em; top: 14em;margin: -0.3em 4.5em -1em 4.5em;}   */
  0% {position: relative;left: 0em; top: 0em;}
  2%{transform: rotate(5deg); position: relative;left: 4.6em; top: 0.4em;margin: -0.3em 4.5em -1em 4.5em;}
  4%{transform: rotate(20deg); position: relative;left: 5.5em; top: 0.4em;margin: -0.3em 4.5em -1em 4.5em;}
  6%{transform: rotate(40deg); position: relative;left: 7.3em; top: 0.4em;margin: -0.3em 4.5em -1em 4.5em;}
  8%{transform: rotate(90deg); position: relative;left: 9.5em; top: 1.4em;margin: -0.3em 4.5em -1em 4.5em;}
  10%{transform: rotate(120deg); position: relative;left: 11.6em; top: 2.4em;margin: -0.3em 4.5em -1em 4.5em;}
  12%{transform: rotate(140deg); position: relative;left: 12em; top: 4.5em;margin: -0.3em 4.5em -1em 4.5em;} 
  14%{transform: rotate(160deg); position: relative;left: 11.7em; top: 6.5em;margin: -0.3em 4.5em -1em 4.5em;}
  16%{transform: rotate(180deg); position: relative;left: 11em; top: 9em;margin: -0.3em 4.5em -1em 4.5em;}
  18%{transform: rotate(180deg); position: relative;left: 11em; top: 14em;margin: -0.3em 4.5em -1em 4.5em;}  
  100%{transform: rotate(180deg); position: relative;left: 11em; top: 14em;margin: -0.3em 4.5em -1em 4.5em;}  
}
@keyframes gulerrodryk{
  0%{transform: rotate(0deg)}
  25%{transform: rotate(5deg);}
  75%{transform: rotate(-5deg);}
  100%{transform: rotate(0deg);}
}
@keyframes scrafFlying1 {
  0%{transform: rotate(0deg);margin: -1em 0 0 8em;}
  25%{transform: rotate(-60deg);margin: -1.5em 0 0 9.2em;}
  100%{transform: rotate(0deg);margin: -1em 0 0 8em;}
}
@keyframes scrafFlying2 {
  0%{transform: rotate(7deg);margin: -1em 0 0 7.8em;}
  25%{transform: rotate(-45deg);margin: -1.4em 0 0 9em;}
  100%{transform: rotate(7deg);margin: -1em 0 0 7.88em;}
}


.flexboks{
  display: flex;
  flex-flow: row wrap;
}
.mellemrum{
  margin: 5em ;
}
.langCirkel{
  width: 5em;
  height: 10em;
  margin: 1em;
  border: 1px solid blue;
  border-radius: 41px;
}
.lilleCirkel{
  width: 4em;
  height: 4em;
  margin: 0.3em 0em 0em 0.5em; 
  position: relative;
  background-color: blue;
  border-radius: 41px;
  animation: moveing;
  animation-duration: 4s;
  animation-iteration-count: infinite;
}
@keyframes moveing{
  0% {left: 0em; top: 0em;}
  75%{background-color: blueviolet; left: 0em; top: 5.4em;}
  100%{left: 0em; top: 0em;}

}

.lilleCirkel1{
  width: 4em;
  height: 4em;
  margin: 0.3em 0em 0em 0.5em; 
  position: relative;
  background-color: blue;
  border-radius: 41px;
}
.lilleCirkel1:hover{
  width: 4em;
  height: 4em;
  margin: 0.3em 0em 0em 0.5em; 
  position: relative;
  background-color: blue;
  border-radius: 41px;
  animation: moveing;
  animation-duration: 4s;
  animation-iteration-count: infinite;
}

.lilleCirkel2{
  width: 4em;
  height: 4em;
  margin: 0.3em 0em 0em 0.5em; 
  position: relative;
  background-color: blue;
  border-radius: 41px;
}
.lilleCirkel2:hover{
  width: 4em;
  height: 4em;
  margin: 0.3em 0em 0em 0.5em; 
  position: relative;
  background-color: blue;
  border-radius: 41px;
  animation: moveingAndTranparent;
  animation-duration: 4s;
  animation-iteration-count: infinite;
}
@keyframes moveingAndTranparent{
  0% {left: 0em; top: 0em;}
  75%{background-color: transparent; left: 0em; top: 5.4em;}
  100%{left: 0em; top: 0em;}
}

.langCirkel1{
  width: 5em;
  height: 10em;
  margin: 1em;
  border: 1px solid red;
  border-radius: 41px;
}
.lilleCirkel3{
  width: 4em;
  height: 4em;
  margin: 0.3em 0em 0em 0.5em; 
  position: relative;
  background-color: red;
  border-radius: 41px;
}
.langCirkel1:hover .lilleCirkel3{
  width: 4em;
  height: 4em;
  margin: 0.3em 0em 0em 0.5em; 
  position: relative;
  background-color: transparent;
  border-radius: 41px;
  animation: moveingAndTranparentToEnd;
  animation-duration: 4s;
  animation-iteration-count: infinite;
}
@keyframes moveingAndTranparentToEnd{
  0% {background-color: red;left: 0em; top: 0em;}
  75%{left: 0em; top: 5.4em;}
  100%{background-color: transparent;left: 0em; top: 0em;}
}


.langCirkel2{
  width: 5em;
  height: 10em;
  margin: 1em;
  border: 1px solid red;
  border-radius: 41px;
}
.lilleCirkel4{
  width: 4em;
  height: 4em;
  margin: 0.3em 0em 0em 0.5em; 
  position: relative;
  background-color: transparent;
  border-radius: 41px;
}
.langCirkel2:hover .lilleCirkel4{
  width: 4em;
  height: 4em;
  margin: 0.3em 0em 0em 0.5em; 
  position: relative;
  background-color: red;
  border-radius: 41px;
  animation: moveingAndTranparent1;
  animation-duration: 4s;
  animation-iteration-count: 1;
}

@keyframes moveingAndTranparent1{
  0% {background-color: transparent;left: 0em; top: 0em;}
  100%{background-color: red; left: 0em; top: 0em;}
}

.lillefirkant{
  width: 5em;
  height: 5em;
  background-color: violet;
  margin: 2em 2em;
  animation-name: spin;
  animation-duration: 5000ms;
  animation-iteration-count: infinite;
  animation-timing-function: linear;
}
@keyframes spin {
    from {
        transform:rotate(0deg);
    }
    to {
        transform:rotate(360deg);
    }
}

.lillefirkant1{
  width: 5em;
  height: 5em;
  background-color: violet;
  margin: 2em 2em;
  animation-name: spinLittle;
  animation-duration: 5000ms;
  animation-iteration-count: infinite;
  animation-timing-function: linear;
}
@keyframes spinLittle {
    from {
        transform:rotate(0deg);
    }
    to {
        transform:rotate(30deg);
    }
}

.lillefirkant2{
  width: 5em;
  height: 5em;
  background-color: violet;
  margin: 2em 2em;
  animation-name: spinLittletest;
  animation-duration: 5000ms;
  animation-iteration-count: infinite;
  animation-timing-function: ease;
}
@keyframes spinLittletest {
    from {
        transform:rotate(0deg);
    }
    to {
        transform:rotate(30deg);
    }
}


.lillefirkan3{
  width: 5em;
  height: 5em;
  background-color: violet;
  position: absolute;
  margin: -7.5em 2.5em;
  animation-name: spin;
  animation-duration: 2s;

  animation-iteration-count: infinite;
  animation-timing-function: linear;
}
.storfirkant{
  width: 6em;
  height: 6em;
  background-color: red;
  margin: 2em 2em;
  animation-name: spin;
  animation-duration: 3s;
  animation-delay: 1s;
  animation-iteration-count: infinite;
  animation-timing-function: linear;
}


.shineTekse{
  text-transform: uppercase;
  font-size: 2em;
  letter-spacing: 4px;
  overflow: hidden;
  background: linear-gradient(90deg, #fff, #000, #fff);
  background-repeat: no-repeat;
  background-size: 80%;
  animation: animate 3s linear infinite;
  -webkit-background-clip: text;
  -webkit-text-fill-color: rgba(255, 255, 255, 0);
}
@keyframes animate {
  0% {
    background-position: -500%;
  }
  100% {
    background-position: 500%;
  }
}

.snurrerTop{
  text-transform: uppercase;
  animation-name: snurrertoppen;
  animation-duration: 5s;
  animation-iteration-count: infinite;
}
@keyframes snurrertoppen {
  0%{transform: rotate(0deg);}
  100%{transform: rotate(360deg);}
}


.bagground{
  border: 1px solid #000;
  width: 30em;
  height: 20em;
  display: flex;
  flex-flow: row nowrap;
}
.cirkelTop{
  top: 16.9em;
}
.cirkel4a{
  width: 3em;
  height: 3em;
  background-color: palevioletred;
  border-radius: 100%;
  position: relative;
  animation-name: hop;
  animation-duration: 20s;
  animation-iteration-count: infinite;
}
.cirkel4b{
  width: 3em;
  height: 3em;
  background-color: rgb(255, 0, 85);
  border-radius: 100%;
  margin: 0 0 0 -3em;
  position: relative;
  animation-name: hop;
  animation-duration: 20s;
  animation-delay: 1s;
  animation-iteration-count: infinite;
}
.cirkel5a{
  width: 3em;
  height: 3em;
  background-color: lightblue;
  border-radius: 100%;
  position: relative;
  animation-name: hop;
  animation-duration: 20s;
  animation-delay: 2s;
  animation-iteration-count: infinite;
}
.cirkel5b{
  width: 3em;
  height: 3em;
  background-color: rgb(0, 191, 255);
  border-radius: 100%;
  position: relative;
  margin: 0 0 0 -3em;
  animation-name: hop;
  animation-duration: 20s;
  animation-delay: 9s;
  animation-iteration-count: infinite;
}
.cirkel6a{
  width: 3em;
  height: 3em;
  background-color:rgb(172, 115, 224);
  border-radius: 100%;
  position: relative;
  animation-name: hop;
  animation-duration: 20s;
  animation-delay: 3s;
  animation-iteration-count: infinite;
}
.cirkel6b{
  width: 3em;
  height: 3em;
  background-color:rgb(132, 0, 255);
  border-radius: 100%;
  position: relative;
  margin: 0 0 0 -3em;
  animation-name: hop;
  animation-duration: 20s;
  animation-delay: 6s;
  animation-iteration-count: infinite;
}
.cirkel7a{
  width: 3em;
  height: 3em;
  background-color:rgb(6, 184, 6);
  border-radius: 100%;
  position: relative;
  animation-name: hop;
  animation-duration: 20s;
  animation-delay: 2s;
  animation-iteration-count: infinite;
}
.cirkel7b{
  width: 3em;
  height: 3em;
  background-color:rgb(0, 255, 0);
  border-radius: 100%;
  position: relative;
  margin: 0 0 0 -3em;
  animation-name: hop;
  animation-duration: 20s;
  animation-delay: 7s;
  animation-iteration-count: infinite;
}
.cirkel8a{
  width: 3em;
  height: 3em;
  background-color:rgb(229, 248, 53);
  border-radius: 100%;
  position: relative;
  animation-name: hop;
  animation-duration: 20s;
  animation-delay: 5s;
  animation-iteration-count: infinite;
}
.cirkel8b{
  width: 3em;
  height: 3em;
  background-color:rgb(229, 255, 0);
  border-radius: 100%;
  margin: 0 0 0 -3em;
  position: relative;
  animation-name: hop;
  animation-duration: 20s;
  animation-delay: 10s;
  animation-iteration-count: infinite;
}
@keyframes hop{
  0%{top: 16.9em;}
  5%{top: 2em;}
  10%{top: 16.9em;}
  15%{top: 4em;}
  20%{top: 16.9em;}
  25%{top: 6em;}
  30%{top: 16.9em;}
  35%{top: 8em;}
  40%{top: 16.9em;}
  45%{top: 10em;}
  50%{top: 16.9em;}
  55%{top: 12em;}
  60%{top: 16.9em;}
  65%{top: 14em;}
  70%{top: 16.9em;}
  75%{top: 16em;}
  80%{top: 16.9em;}
  100%{top: 16.9em;}
}

.neonLightBaggound{
  width: 35em;
  height: 20em;
  margin: 1em 4em;
  background-color: #000;
  display: flex;
  flex-flow: row nowrap;
  justify-content: center;
  align-items: center;
  text-transform: uppercase;
  letter-spacing: 11px
}
.neonText{
  font: italic small-caps bold 3.5em/2 cursive;
  /* color: rgb(255, 255, 0);
  text-shadow: 0 0 5px yellow; */
  color: rgb(73, 73, 62);
  /* text-shadow: 0 0 5px yellow; */
  animation-name: neonLightText;
  animation-duration:  5s;
  animation-iteration-count: infinite;
}
@keyframes neonLightText {
  0%{color: rgb(73, 73, 62);}
  25%{color: rgb(255, 255, 0); text-shadow: 0 0 5px yellow;}
  50%{color: rgb(255, 255, 0); text-shadow: 0 0 15px yellow;}
  75%{color: rgb(255, 255, 0); text-shadow: 0 0 5px yellow;}
  100%{color: rgb(73, 73, 62);}
}

.neonLightBaggound1{
  width: 35em;
  height: 20em;
  margin: 2em 0em;
  background-color: #000;
  display: flex;
  flex-flow: row nowrap;
  justify-content: center;
  align-items: center;
  text-transform: uppercase;
  letter-spacing: 11px;
  animation-name: dayToNight;
  animation-duration:  20s;
  animation-iteration-count: infinite;
}
.neonText1{
  font: italic small-caps bold 3.5em/2 cursive;
  color: rgb(73, 73, 62);
}
.neonText1:nth-child(odd){
  color: rgb(0, 255, 255);
  text-shadow: 0 0 5px rgb(0, 255, 255);
  animation-name: neonDayToNightBlue;
  animation-duration:  20s;
  animation-iteration-count: infinite;
}
.neonText1:nth-child(even){
  color: rgb(204, 0, 255);
  text-shadow: 0 0 5px rgb(204, 0, 255);
  animation-name: neonDayToNightViolat;
  animation-duration:  20s;
  animation-iteration-count: infinite;
}
@keyframes neonDayToNightBlue {
  0%{color: rgb(73, 73, 62); text-shadow: 0 0 5px #fff;}
  50%{color: rgb(0, 255, 255); text-shadow: 0 0 5px rgb(0, 255, 255);}
  60%{color: rgb(73, 73, 62); text-shadow: 0 0 5px #fff;}
  100%{color: rgb(73, 73, 62); text-shadow: 0 0 5px #fff;}
}
@keyframes neonDayToNightViolat {
  0%{color: rgb(73, 73, 62); text-shadow: 0 0 5px #fff;}
  50%{color: rgb(204, 0, 255); text-shadow: 0 0 5px rgb(204, 0, 255);}
  75%{color: rgb(73, 73, 62); text-shadow: 0 0 5px #fff;}
  100%{color: rgb(73, 73, 62); text-shadow: 0 0 5px #fff;}
}
@keyframes dayToNight {
  0%{background-color: #fff;}
  50%{background-color: #000;}
  100%{background-color: #fff;}
}

.neonLightBaggound2{
  width: 35em;
  height: 20em;
  margin: 2em 2em;
  background-color: #000;
  display: flex;
  flex-flow: row nowrap;
  justify-content: center;
  align-items: center;
  text-transform: uppercase;
  letter-spacing: 11px
}
.neonText2{
  font: italic small-caps bold 3.5em/2 cursive;
  color: rgb(73, 73, 62);
  animation-name: color;
  animation-duration:  6s;
  animation-iteration-count: infinite;
}
.neonText2:nth-child(2){
animation-delay: 1s;
}
.neonText2:nth-child(3){
animation-delay: 2s;
}
.neonText2:nth-child(4){
animation-delay: 3s;
}
.neonText2:nth-child(5){
animation-delay: 4s;
}
.neonText2:nth-child(6){
animation-delay: 5s;
}
.neonText2:nth-child(7){
animation-delay: 6s;
}
.neonText2:nth-child(8){
animation-delay: 7s;
}
.neonText2:nth-child(9){
animation-delay: 8s;
}
@keyframes color {
  0%{color: rgb(99, 99, 99);text-shadow: 0 0 5px #000;}
  25%{color: rgb(0, 255, 242); text-shadow: 0 0 5px rgb(0, 255, 242);}
  50%{color: rgb(0, 255, 242); text-shadow: 0 0 10px rgb(0, 255, 242);}
  75%{color: rgb(0, 255, 242); text-shadow: 0 0 5px rgb(0, 255, 242);}
  100%{color:rgb(99, 99, 99);text-shadow: 0 0 5px #000;}
}


.waitingBox{
  width: 30em;
  height: 20em;
  border: 1px solid #000;
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 0 1em;
}
.ball{
  height: 2.5em;
  width: 2.5em;
  margin: 0 0.5em;
  position: relative;
  animation-name: waitingHop;
  animation-duration: 6s;
  animation-iteration-count: infinite;
}
.ball:nth-child(1){
  background-color: skyblue;
  border-radius: 100%;
}
.ball:nth-child(2){
  background-color: skyblue;
  border-radius: 100%;
  animation-delay: 1s;

}
.ball:nth-child(3){
  background-color: skyblue;
  border-radius: 100%;
  animation-delay: 2s;

}
.ball:nth-child(4){
  background-color: skyblue;
  border-radius: 100%;
  animation-delay: 3s;
}
.ball:nth-child(5){
  background-color: skyblue;
  border-radius: 100%;
  animation-delay: 4s;

}
.ball:nth-child(6){
  background-color: skyblue;
  border-radius: 100%;
  animation-delay: 5s;

}
@keyframes waitingHop {
  0%{top: 0;}
  10%{top: 2em;}
  20%{top: 0;}
  30%{top: 2em;}
  40%{top: 0;}
  50%{top: 2em;}
  60%{top: 0;}
  70%{top: 2em;}
  80%{top: 0;}
  90%{top: 2em;}
  100%{top: 0;}
}




.waitingBox1{
  width: 30em;
  height: 20em;
  border: 1px solid #000;
  display: flex;
  justify-content: flex-start;
  align-items: center;
  margin: 0 1em;
}
.ball1{
  height: 2.5em;
  width: 2.5em;
  position: relative;
  animation-name: toLeftAndPuff;
  animation-duration: 6s;
  animation-iteration-count: infinite;
}
.ball1:nth-child(1){
  border-radius: 100%;
  margin: 0 0 0 7em;

}
@keyframes toLeftAndPuff {
  0%{top: 0; left: 0; background-color: transparent; height: 2.5em;
  width: 2.5em;}
  80%{top: 0; left: 9em; background-color: skyblue; height: 2.5em;
  width: 2.5em;}
  100%{top: 0; left: 10em; background-color: #fff; height: 0em;
  width: 0em;}
}


.firkantRundt{
  /* background-color: thistle; */
  width: 10em;
  height: 10em;
  position: absolute;
  animation-name: roundInACirkel;
  animation-duration: 5s;
  animation-iteration-count: infinite;
  border-radius: 100%;
}
.littleCicle{
  width: 2em;
  height: 2em;
  border-radius: 100%;
  background-color: yellow;
}
.littleCicle:nth-child(2){
  margin: 1em 0 0 -1.5em;
}
.littleCicle:nth-child(3){
  margin: 1.5em 0 0 -1em;
}
.littleCicle:nth-child(4){
  margin: 0.5em 0 0 1.5em;
}
.littleCicle:nth-child(5){
  margin: -1.7em 0 0 5.5em;
}
.littleCicle:nth-child(6){
  margin: -4.3em 0 0 8.7em;
}
.littleCicle:nth-child(7){
  margin: -5.8em 0 0 9.5em;
}
.littleCicle:nth-child(8){
  margin: -5.5em 0 0 7.5em;
}
.littleCicle:nth-child(9){
  margin: -3.3em 0 0 3.5em;
}
@keyframes roundInACirkel {
  0%{transform: rotateZ(0deg);}
  100%{transform: rotateZ(360deg);}

}

.hoppebold{
  width: 1em;
  height: 1em;
  background-color: aqua;
  border-radius: 100%;
  margin: 0 0.5em -1em 0;
  animation-name: hoppe;
  animation-duration: 6s;
  animation-iteration-count: infinite;
  position: relative;
}
.loadingTekst{
  font-size: 3em;
  color: #000;
}
@keyframes hoppe {
  0%{bottom: 0;}
  10%{bottom: 1em;}
  20%{bottom: 0;}
  30%{bottom: 1em;}
  40%{bottom: 0;}
  50%{bottom: 1em;}
  60%{bottom: 0;}
  70%{bottom: 1em;}
  80%{bottom: 0;}
  90%{bottom: 1em;}
  100%{bottom: 0;}
}


.loadingTekst1{
  font-size: 4em;
  color: #000;
  /* position: relative; */
}
.dot{
  width: 0.8em;
  height: 0.8em;
  background-color: #000;
  border-radius: 100%;
  margin: 2.3em 0.1em 0em 0.1em;
  animation-name: hoppe;
  animation-duration: 6s;
  animation-iteration-count: infinite;
  background-color: hotpink;
  position: relative;
}

.dot1{
  width: 0.8em;
  height: 0.8em;
  background-color: #000;
  border-radius: 100%;
  margin: 2.5em 0.1em 0em 0.1em;
  animation-name: hoppe;
  animation-duration: 6s;
  animation-iteration-count: infinite;
  background-color: hotpink;
  position: relative;
}
.dot2{
  width: 0.8em;
  height: 0.8em;
  background-color: #000;
  border-radius: 100%;
  margin: 2.5em 0.1em 0em 0.1em;
  animation-name: hoppe;
  animation-duration: 6s;
  animation-iteration-count: infinite;
  background-color: hotpink;
  animation-delay: 1s;
  position: relative;
}
.dot3{
  width: 0.8em;
  height: 0.8em;
  background-color: #000;
  border-radius: 100%;
  margin: 2.5em 0.1em 0em 0.1em;
  animation-name: hoppe;
  animation-duration: 6s;
  animation-iteration-count: infinite;
  background-color: hotpink;
  animation-delay: 2s;
  position: relative;
}


.door{
  width: 0.5em;
  height: 2.5em;
  background-color: #fff;
  position: absolute;
  margin: 0 0 0 -15em;
  animation-name: loadringFirkant;
  animation-duration: 40s;
  animation-iteration-count: 1;
}
.secretDoor{
  width: 6em;
  height: 3em;
  background-color: #fff;
  position: absolute;
  margin: 0 0 0 -21.5em;
}
.bogstavKommerFrem1{
  color: skyblue;
  font-size: 2em;
  animation-name: bogstav7;
  animation-duration: 30s;
  animation-iteration-count: 1;
  position: relative;
}
.bogstavKommerFrem2{
  color: violet;
  font-size: 2em;
  animation-name: bogstav6;
  animation-duration: 25s;
  animation-iteration-count: 1;
  position: relative;
}
.bogstavKommerFrem3{
  color: hotpink;
  font-size: 2em;
  animation-name: bogstav5;
  animation-duration: 23s;
  animation-iteration-count: 1;
  position: relative;
}
.bogstavKommerFrem4{
  color: limegreen;
  font-size: 2em;
  animation-name: bogstav4;
  animation-duration: 19s;
  animation-iteration-count: 1;
  position: relative;
}
.bogstavKommerFrem5{
  color:orange;
  font-size: 2em;
  animation-name: bogstav3;
  animation-duration: 15s;
  animation-iteration-count: 1;
  position: relative;
}
.bogstavKommerFrem6{
  color:yellow;
  font-size: 2em;
  animation-name: bogstav2;
  animation-duration: 10s;
  animation-iteration-count: 1;
  position: relative;
}
.bogstavKommerFrem7{
  color: red;
  font-size: 2em;
  animation-name: bogstav1;
  animation-duration: 5s;
  animation-iteration-count: 1;
  position: relative;
}
/* :nth-child() ville ikke virke lige nu */
.loadingDot1{
 width: 0.5em;
 height: 0.5em;
 margin: 1.1em 0.1em 0em 0.1em;
 border-radius: 100%;
 animation-name: dotLoadingIn, hoppeDotBot, RainBowDot;
 animation-duration: 40s, 6s, 6s;
 animation-iteration-count: 1, infinite, infinite;
 position: relative;
}
.loadingDot2{
 width: 0.5em;
 height: 0.5em;
 margin: 1.1em 0.1em 0em 0.1em;
 border-radius: 100%;
 animation-name: dotLoadingIn, hoppeDotBot, RainBowDot;
 animation-duration: 40s, 6s, 6s;
 animation-delay:0s , 1s, 0s;
 animation-iteration-count: 1, infinite, infinite;
 position: relative;
}
.loadingDot3{
 width: 0.5em;
 height: 0.5em;
 margin: 1.1em 0.1em 0em 0.1em;
 border-radius: 100%;
 animation-name: dotLoadingIn, hoppeDotBot,RainBowDot;
 animation-duration: 40s, 6s, 6s;
 animation-delay:0s , 2s, 0s;
 animation-iteration-count: 1, infinite, infinite;
 position: relative;
}
@keyframes loadringFirkant {
  0%{background-color: red;}
  10%{background-color: yellow;}
  20%{background-color: orange;}
  30%{background-color: limegreen;}
  40%{background-color: hotpink;}
  50%{background-color: violet;}
  55%{background-color: skyblue;}
  70%{background-color: #fff;}
  100%{background-color: #fff;}
}
@keyframes dotLoadingIn {
  0%{width: 0; height: 0; background-color: #000;}
  70%{width: 0; height: 0; background-color: #000;}
  100%{width: 0.5; height: 0.5em; background-color: #000;}
}
@keyframes hoppeDotBot {
  0%{bottom: 0; background-color: #000;}
  10%{bottom: 0.5em; background-color: #000;}
  20%{bottom: 0; background-color: #000;}
  30%{bottom: 0.5em; background-color: #000;}
  40%{bottom: 0; background-color: #000;}
  50%{bottom: 0.5em; background-color: #000;}
  60%{bottom: 0; background-color: #000;}
  70%{bottom: 0.5em; background-color: #000;}
  80%{bottom: 0; background-color: #000;}
  90%{bottom: 0.5em; background-color: #000;}
  100%{bottom: 0; background-color: #000;}
}
@keyframes RainBowDot {
  0%{background-color: red;}
  15%{background-color: yellow;}
  30%{background-color: orange;}
  45%{background-color: limegreen;}
  60%{background-color: hotpink;}
  75%{background-color: violet;}
  100%{background-color: skyblue;}
}
@keyframes bogstav1 {
  0%{transform: rotate(0deg); right: 6.5em;}
  100%{transform: rotate(360deg);right: 0;}
}
@keyframes bogstav2 {
  0%{transform: rotate(0deg);right: 5.5em;}
  30%{transform: rotate(0deg);right: 5.5em;}
  100%{transform: rotate(360deg);right: 0;}
}
@keyframes bogstav3 {
  0%{transform: rotate(0deg); right: 5.5em;}
  40%{transform: rotate(0deg); right: 5.5em;}
  100%{transform: rotate(360deg);right: 0;}
}
@keyframes bogstav4 {
  0%{transform: rotate(0deg); right: 5em;}
  50%{transform: rotate(0deg); right: 5.5em;}
  100%{transform: rotate(360deg);right: 0;}
}
@keyframes bogstav5 {
  0%{transform: rotate(0deg); right: 4.5em;}
  60%{transform: rotate(0deg); right: 4.5em;}
  100%{transform: rotate(360deg);right: 0;}
}
@keyframes bogstav6 {
  0%{transform: rotate(0deg); right: 3.5em;}
  70%{transform: rotate(0deg); right: 3.5em;}
  100%{transform: rotate(360deg);right: 0;}
}
@keyframes bogstav7 {
  0%{transform: rotate(0deg); right: 3.5em;}
  60%{transform: rotate(0deg); right: 3.5em;}
  100%{transform: rotate(360deg);right: 0;}
}

.doora{
  width: 0.5em;
  height: 2.5em;
  background-color: #fff;
  position: absolute;
  margin: 0 0 0 -15em;
  animation-name: loadringFirkanta;
  animation-duration: 40s;
  animation-iteration-count: 1;
}
.bogstavKommerFrem1a{
  font-size: 2em;
  animation-name: bogstav1a;
  animation-duration: 5s;
  animation-iteration-count: 1;
  position: relative;
  color: skyblue;
}
.bogstavKommerFrem2a{
  font-size: 2em;
  animation-name: bogstav2a;
  animation-duration: 10s;
  animation-iteration-count: 1;
  position: relative;
  color: violet;
}
.bogstavKommerFrem3a{
  font-size: 2em;
  animation-name: bogstav3a;
  animation-duration: 15s;
  animation-iteration-count: 1;
  position: relative;
  color: hotpink;
}
.bogstavKommerFrem4a{
  color: limegreen;
  font-size: 2em;
  animation-name: bogstav4a;
  animation-duration: 21s;
  animation-iteration-count: 1;
  position: relative;
  
}
.bogstavKommerFrem5a{
  color:orange;
  font-size: 2em;
  animation-name: bogstav5a;
  animation-duration: 27s;
  animation-iteration-count: 1;
  position: relative;
}
.bogstavKommerFrem6a{
  color:yellow;
  font-size: 2em;
  animation-name: bogstav6a;
  animation-duration: 33s;
  animation-iteration-count: 1;
  position: relative;
}
.bogstavKommerFrem7a{
  color: red;
  font-size: 2em;
  animation-name: bogstav7a;
  animation-duration: 36s;
  animation-iteration-count: 1;
  position: relative;
}
.loadingDot1a{
 width: 0.5em;
 height: 0.5em;
 margin: 1.1em 0.1em 0em 0.1em;
 border-radius: 100%;
 animation-name: dotLoadingIna, hoppeDotBot, RainBowDot;
 animation-duration: 43s, 6s, 6s;
 animation-iteration-count: 1, infinite, infinite;
 position: relative;
}
.loadingDot2a{
 width: 0.5em;
 height: 0.5em;
 margin: 1.1em 0.1em 0em 0.1em;
 border-radius: 100%;
 animation-name: dotLoadingIna, hoppeDotBot, RainBowDot;
 animation-duration: 43s, 6s, 6s;
 animation-delay:0s , 1s, 0s;
 animation-iteration-count: 1, infinite, infinite;
 position: relative;
}
.loadingDot3a{
 width: 0.5em;
 height: 0.5em;
 margin: 1.1em 0.1em 0em 0.1em;
 border-radius: 100%;
 animation-name: dotLoadingIna, hoppeDotBot,RainBowDot;
 animation-duration: 43s, 6s, 6s;
 animation-delay:0s , 2s, 0s;
 animation-iteration-count: 1, infinite, infinite;
 position: relative;
}
@keyframes loadringFirkanta {
  0%{background-color: skyblue;}
  5%{background-color: skyblue;}
  15%{background-color: violet;}
  25%{background-color: hotpink;}
  35%{background-color: limegreen;}
  48%{background-color: orange;}
  68%{background-color: yellow;}
  76%{background-color: red;}
  90%{background-color: #fff;}
  100%{background-color: #fff;}
}
@keyframes dotLoadingIna {
  0%{width: 0; height: 0; background-color: #000;}
  80%{width: 0; height: 0; background-color: #000;}
  100%{width: 0.5; height: 0.5em; background-color: #000;}
}
@keyframes bogstav1a {
  0%{transform: rotate(0deg); right: 3.5em;}
  100%{transform: rotate(360deg);right: 0;}
}
@keyframes bogstav2a {
  0%{transform: rotate(0deg);right: 3.5em;}
  25%{transform: rotate(0deg);right: 3.5em;}
  100%{transform: rotate(360deg);right: 0;}
}
@keyframes bogstav3a {
  0%{transform: rotate(0deg); right: 4.5em;}
  45%{transform: rotate(0deg); right: 4.5em;}
  100%{transform: rotate(360deg);right: 0;}
}
@keyframes bogstav4a {
  0%{transform: rotate(0deg); right: 5em;}
  55%{transform: rotate(0deg); right: 5.5em;}
  100%{transform: rotate(360deg);right: 0;}
}
@keyframes bogstav5a {
  0%{transform: rotate(0deg); right: 5.5em;}
  65%{transform: rotate(0deg); right: 5.5em;}
  100%{transform: rotate(360deg);right: 0;}
}
@keyframes bogstav6a {
  0%{transform: rotate(0deg); right: 5.5em;}
  75%{transform: rotate(0deg); right: 5.5em;}
  100%{transform: rotate(360deg);right: 0;}
}
@keyframes bogstav7a {
  0%{transform: rotate(0deg); right: 6.5em;}
  85%{transform: rotate(0deg); right: 6.5em;}
  100%{transform: rotate(360deg);right: 0;}
}


.campingVanWaitingBox{
  width: 50em;
  height: 40em;
  border: 1px solid #000;
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 0 1em;
}
/* campingvan */
.bilKasse{
  width: 8em;
  height: 3.9em;
  background-color: tomato;
  position: absolute;
  border-radius: 10px;
  margin: 2em 0 0 0;
}
.hjul1{
  /* width: 1.2em;
  height: 1.2em; */
  width: 20px;
  height: 20px;
  background-color: #000;
  position: absolute;
  margin: 6em 4em 0 0em;
  border-radius: 100%;
  animation-name: ruterHujl;
  animation-duration: 15s;
  animation-iteration-count: infinite;
  animation-timing-function: ease-in-out;
}
.hjul2{
  width: 20px;
  height: 20px;
  background-color: #000;
  position: absolute;
  margin: 6em 0 0 8em;
  border-radius: 100%;
  animation-name: ruterHujl;
  animation-duration: 15s;
  animation-iteration-count: infinite;
  animation-timing-function: ease-in-out;
}
.huljkapsel{
  width: 0.9em;
  height: 0.9em;
  margin: 3px 0em 0 3px;
}
.fruntKasseUnder{
  width: 4em;
  height: 2em;
  background-color:tomato;
  position: absolute;
  margin: 3.9em 0 0 8em;
  border-radius: 10px;
}
.fruntKasseOver{
  width: 0;
  height: 0;
  border-bottom: 33px solid tomato;
  border-right: 35px solid transparent;
  position: absolute;
  margin: 0.3em 0 0 9.4em;
}
.longWindow{
  width: 4em;
  height: 1.5em;
  background: grey;
  position: absolute;
  margin: 0.7em 2.5em 0em 0;
  border-radius: 3px;
}
.frontWindow{
  width: 0;
  height: 0;
  border-bottom: 25px solid gray;
  border-right: 25px solid transparent;
  position: absolute;
  margin: 0.7em 0 0 8.5em;
}
/* landskab */
.theSky{
  width: 25em;
  height: 15em;
  background-color: skyblue;
  position: absolute;
  animation-name: DayAndNightTheSky;
  animation-duration: 15s;
  animation-iteration-count: infinite;
}
.theSunsCirkel{
  width: 11em;
  height: 11em;
  /* background-color: slateblue; */
  position: absolute;
  animation-name: ruterTheSun;
  animation-duration: 15s;
  animation-iteration-count: infinite;
}
.theSun{
  width: 2em;
  height: 2em;
  background-color: yellow;
  box-shadow: 0 0 10px yellow;
  border-radius: 100%;
  position: absolute;
}
.theMoon{
  width: 2em;
  height: 2em;
  background-color: #fff;
  position: absolute;
  border-radius: 100%;
  margin:  9em 0em 0em 9em;
  animation-name: theMoonsShadow;
  animation-duration: 15s;
  animation-iteration-count: infinite;
}
.bigStar{
  width: 0.2em;
  height: 0.2em;
  position: absolute;
  animation-name: theStarsShowing;
  animation-duration: 30s;
  animation-iteration-count: infinite;
}
.grass{
  width: 25em;
  height: 7em;
  background-color: green;
  position: absolute;
  margin: 8em 0 0 0;
  animation-name: DayAndNightGrass;
  animation-duration: 15s;
  animation-iteration-count: infinite;
}
.road{
  width: 25em;
  height: 2.5em;
  background-color: grey;
  position: absolute;
  margin: 6em 0 0 0;
}
.stripes{
  width: 25em;
  /* height: 0.3em; */
  /* background-color: #fff; */
  position: absolute; 
  margin: 6em 0 0 0;
  /* border-style: dashed; */
  border: 2px dashed #fff;
}
.treeStump{
  height: 3em;
  width: 1em;
  background-color: sienna;
  margin: 0 1.7em 0em 0em; 
  animation-name: movingBjerg;
  animation-duration: 6s;
  animation-iteration-count: infinite;
  position: absolute;
}
.treeTop{
height: 4.5em;
width: 4.5em;
border-radius: 100%;
position: relative;
background-color: rgb(32, 173, 32);
margin: 0 0 7em 0em;
animation-name: movingBjerg;
animation-duration: 6s;
animation-iteration-count: infinite;
position: absolute;
}
.treeStump1{
  height: 3em;
  width: 1em;
  background-color: rgb(148, 73, 38);
  margin: 0 0.3em 0em 0em; 
  animation-name: movingBjerg1;
  animation-duration: 8s;
  animation-iteration-count: infinite;
  position: absolute;
}
.treeTop1{
height: 4.5em;
width: 4.5em;
border-radius: 100%;
position: relative;
background-color: rgb(26, 141, 26);
margin: 0 -1.4em 7em 0em;
animation-name: movingBjerg1;
animation-duration: 8s;
animation-iteration-count: infinite;
position: absolute;
}
.treeStump2{
  height: 3em;
  width: 1em;
  background-color: sienna;
  margin: 0 1.9em 0em 0em; 
  animation-name: movingBjerg1;
  animation-duration: 8s;
  animation-iteration-count: infinite;
  position: absolute;
}
.treeTop2{
height: 4.5em;
width: 4.5em;
border-radius: 100%;
position: relative;
background-color: rgb(32, 173, 32);
margin: 0 0 7em 0em;
animation-name: movingBjerg1;
animation-duration: 8s;
animation-iteration-count: infinite;
position: absolute;
}
.storetBjerg{
  width: 0;
  height: 0;
  border-left: 50px solid transparent;
  border-right: 50px solid transparent;
  border-bottom: 100px solid grey;
  position: absolute;
  margin: 0 0 5.2em 35em;
  animation-name: movingBjerg;
  animation-duration: 13s;
  animation-iteration-count: infinite;
}
.lake{
  width: 8em;
  height: 2em;
  background-color: rgb(0, 0, 179);
  position: absolute;
  margin:  11.5em 0 0 0;
  border-radius: 100%;
  animation-name: moveingLake;
  animation-duration: 16s;
  animation-iteration-count: infinite;
}
/* hide things */
.RightBox{
  width: 10em;
  height: 15em;
  position: absolute;
  background-color: rgb(199, 199, 199);
  /* background-color: transparent; */
  margin: 0 0 0 35em;
}
.leftBox{
  width: 10em;
  height: 15em;
  position: absolute;
  background-color: rgb(199, 199, 199);
  margin: 0 35em 0 0;
  /* background-color: transparent; */
}
.bigStar:nth-child(1){
  margin: -4em 0 0 -6em;
}
.bigStar:nth-child(2){
  margin: -3em 0 0 3em;
}
.bigStar:nth-child(3){
  margin: -2.9em 0em 0 -2em;
}
.bigStar:nth-child(4){
  margin: -6em 0 0 -4em;
}
.bigStar:nth-child(5){
  margin: -2em 0 0 -10em;
}
.bigStar:nth-child(6){
  margin: -2.5em 0 0 10em;
}
.bigStar:nth-child(7){
  margin: -5em 0 0 -11em;
}
.bigStar:nth-child(8){
  margin: -6em 0 0 0em;
}
.bigStar:nth-child(9){
  margin: -5em 0 0 8em;
}
.bigStar:nth-child(10){
  margin: -7em 0 0 5em;
}
.bigStar:nth-child(11){
  margin: -1em 0 0 -7em;
}
.bigStar:nth-child(12){
  margin: -1em 0 0 7em;
}
.bigStar:nth-child(13){
  margin: -3em 0 0 7.5em;
  width: 0.1em;
  height: 0.1em;
}
.bigStar:nth-child(14){
  margin: -2em 0 0 -4em;
  width: 0.1em;
  height: 0.1em;
}
.bigStar:nth-child(15){
  margin: -3em 0 0 -8em;
  width: 0.1em;
  height: 0.1em;
}
.bigStar:nth-child(16){
  margin: -6em 0 0 10em;
  width: 0.1em;
  height: 0.1em;
}
.bigStar:nth-child(17){
  margin: -0.5em 0 0 -11em;
  width: 0.1em;
  height: 0.1em;
}
.bigStar:nth-child(18){
  margin: -4em 0 0 0em;
  width: 0.1em;
  height: 0.1em;
}
.bigStar:nth-child(19){
  margin: -5em 0 0 5.5em;
  width: 0.1em;
  height: 0.1em;
}
.bigStar:nth-child(20){
  margin: -2em 0 0 1.5em;
  width: 0.1em;
  height: 0.1em;
}
.bigStar:nth-child(21){
  margin: -6.5em 0 0 -8.5em;
  width: 0.1em;
  height: 0.1em;
}
.bigStar:nth-child(22){
  margin: -5.5em 0 0 3em;
  width: 0.1em;
  height: 0.1em;
}
@keyframes moveingTree {
  0%{right: 0;}
  100%{right: 35em;}
}
@keyframes movingBjerg {
  0%{right: 35em;}
  100%{right: 68em;}
}
@keyframes movingBjerg1 {
  0%{right: 35em;}
  25%{right: 35em;}
  100%{right: 68em;}
}
@keyframes ruterTheSun {
  0%{transform: rotate(0deg);}
  100%{transform: rotate(360deg);}
}
@keyframes ruterHujl{
  0%{transform: rotate(0deg);}
  100%{transform: rotate(3600deg);}
}
@keyframes DayAndNightTheSky {
  0% {background-color: skyblue;}
  20%{background-color: skyblue;}
  45%{background-color: #000;}
  80%{background-color: skyblue;}
  100% {background-color: skyblue;}
}
@keyframes DayAndNightGrass {
  0% {background-color: green;}
  20%{background-color: green;}
  45%{background-color: rgb(0, 70, 0);}
  80%{background-color: green;}
  100% {background-color: green;}
}
@keyframes theMoonsShadow {
  0%{box-shadow: 0 0 10px #fff;}
  70%{box-shadow: 0 0 10px #fff;}
  80%{box-shadow: 0 0 0px #fff;}
  100%{box-shadow: 0 0 0px #fff;}
}
@keyframes theStarsShowing {
  0%{background-color: transparent;}
  60%{background-color: transparent;}
  70%{background-color: #fff;}
  76%{background-color: #fff;}
  80%{background-color: transparent;}
  100%{background-color: transparent;}
}
@keyframes moveingLake {
  0%{right: 32em;}
  50%{right: 32em;}
  100%{right: 67em;}
}

/* STAR WARS linge tekst */
/* link = https://css-tricks.com/snippets/css/star-wars-crawl-text/ */
.STARWARSBox{
  /* gør at den fylder hele frikanten */
  width: 800px;
  height: 400px;
  /* gemmer alt det er sværver uden for viewable space */
  overflow: hidden;
  /* sætter bagegrunden */
  background-color: #000;
  margin: 2em 0;
}
.STARWARStext{
  display: flex;
  justify-content: center;
  height: 400px; /* magic nummer af hvor meget tekst der er */
  perspective: 400px; /* This sets allows us to transform the text on a 3D plane, and is somewhat a magic number */
  color: #fff;
  font-family: 'Pathway Gothic One', sans-serif;
  font-size: 500%;
  font-weight: 600;
  letter-spacing: 6px;
  line-height: 150%;
  text-align: justify;
}
.crawl{
  position: relative;
  top: -100px;
  transform-origin: 50% 100%;
  animation: crawl 60s linear infinite;
}
.fade{
  position: relative;
  width: 100%;
  min-height: 60vh;
  top: -25px;
  background-image: linear-gradient(0deg, transparent, black 75%);
  z-index: 1;
}
@keyframes crawl {
  0%{
    top: 0;
    transform: rotateX(20deg) translateZ(0);
  }
  100%{
    top: -6000px;
    transform: rotateX(25deg) translateZ(-2500px);
  }
}

.isKulge1{
  width: 3em;
  height: 3em;
  position: absolute;
  /* border-radius: 100%; */
  border: 0.3em solid yellow;
  margin: 0 18em 6em 0;
}


.ballTicks{
  width: 3em;
  height: 3em;
  position: absolute;
  border-radius: 100%;
}
.ballTicks:nth-child(1){
  margin: 0 15em 0 0;
  animation-name: moveToRigth, fromLittleToBig, colorPink;
  animation-duration: 9s;
  animation-iteration-count: infinite;
}
.ballTicks:nth-child(2){
  margin: 0 15em 0 0;
  animation-name: moveToRigth, fromLittleToBig, colorBlue;
  animation-duration: 9s;
  animation-iteration-count: infinite;
  animation-delay: 3s;
}
.ballTicks:nth-child(3){
  animation-name: moveToRigth, fromLittleToBig, colorViolet;
  animation-duration: 9s;
  animation-iteration-count: infinite;
  animation-delay: 6s;
}
@keyframes moveToRigth {
  0%{margin: 0 15em 0 0;}
  100%{margin: 0 0em 0 15em;}
}
@keyframes fromLittleToBig {
  0%{width: 3em; height: 3em;}
  70%{width: 3em; height: 3em;}
  90%{width: 0em; height: 0em;}
  100%{width: 0em; height: 0em;}
}
@keyframes colorBlue {
  0%{background-color: transparent;}
  100%{background-color: skyblue;}
}
@keyframes colorViolet {
  0%{background-color: transparent;}
  100%{background-color: slateblue;}
}
@keyframes colorPink {
  0%{background-color: transparent;}
  100%{background-color: hotpink;}
}

.waitingRanbow{
  width: 40em;
  height: 30em;
  background-color: skyblue;
  border: 1px solid skyblue;
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 0 1em;
}
.redCircle{
  width: 18em;
  height: 18em;
  background-color: red;
  position: absolute;
  border-radius: 100%;
}
.orangeCircle{
  width: 16em;
  height: 16em;
  background-color: orange;
  position: absolute;
  border-radius: 100%;
}
.yellowCircle{
  width: 14em;
  height: 14em;
  background-color: yellow;
  position: absolute;
  border-radius: 100%;
}
.greenCircle{
  width: 12em;
  height: 12em;
  background-color: green;
  position: absolute;
  border-radius: 100%;
}
.blueCircel{
  width: 10em;
  height: 10em;
  background-color:blue;
  position: absolute;
  border-radius: 100%;
}
.violetCircle{
  width: 8em;
  height: 8em;
  background-color: rgb(231, 34, 231);
  position: absolute;
  border-radius: 100%;
}
.skyCircle{
  width: 6em;
  height: 6em;
  background-color: skyblue;
  position: absolute;
  border-radius: 100%;
}
.secretSkyBoxa{
  width: 20em;
  height: 9em;
  position: absolute;
  background-color: skyblue;
  margin: 9em 0 0 0;
}
.secretSkyBoxb{
  width: 20.4em;
  height: 9.2em;
  position: absolute;
  background-color: skyblue;
  box-shadow: -10px 10px 10px skyblue;
  margin: -0.2em 0 0em -1em;
}
.ruterhimlen{
  width: 18em;
  height: 18em;
  background-color: transparent;
  position: absolute;
  /* border-radius: 100%; */
  animation-name: moveingRainbow;
  animation-duration: 10s;
  animation-iteration-count: infinite;
}
.cloud1{
  width: 14em;
  height: 10em;
  position: absolute;
  margin: 5em 0 0 14em;
}
.cloud2{
  width: 14em;
  height: 10em;
  position: absolute;
  margin: 4.9em 0 0 -10em;
}
.cirkelCloud{
  width: 4em;
  height: 4em;
  background-color: #fff;
  border-radius: 100%;
  position: absolute;
}
.cirkelCloud:nth-child(1){
  margin: 5em 0 0 3em;
}
.cirkelCloud:nth-child(2){
  margin: 3em 0 0 1em;
}
.cirkelCloud:nth-child(3){
  margin: 4em 0 0 6em;
}
.cirkelCloud:nth-child(4){
  margin: 1em 0 0 2em;
}
.cirkelCloud:nth-child(5){
  margin: 1em 0 0 5em;
}
.cirkelCloud:nth-child(6){
  margin: 2em 0 0 7em;
}
.cirkelCloud:nth-child(7){
  margin: 2em 0 0 3em;
}
@keyframes moveingRainbow {
  0%{transform: rotate(0deg);}
  100%{transform: rotate(180deg);}
}

.smailyFace{
  width: 15em;
  height: 15em;
  background-color: yellow;
  position: absolute;
  border-radius: 100%;
  border: 1px solid #000;
  animation-name: ruterFace;
  animation-duration: 15s;
  animation-iteration-count: infinite;
}
.smailyAyaRight{
  width: 1em;
  height: 2em;
  background-color: #000;
  position: absolute;
  border-radius: 100%;
  margin: 4.8em 0 0 4em;
}
.smailyAyaLeft{
  width: 1em;
  height: 2em;
  background-color: #000;
  position: absolute;
  border-radius: 100%;
  /* margin: 4.8em 0 0 9.5em; */
  animation-name: blikBlik;
  animation-duration: 15s;
  animation-iteration-count: infinite;
}
.smailyMouth{
 width: 7em;
 height: 7em;
 background-color: #000;
 position: absolute;
 border-radius: 100%;
 margin: 6.5em 0 0 4em; 
 overflow: hidden;
}
.smailySecretMouth{
  width: 13.5em;
  height: 3em;
  background-color: yellow;
  position: absolute;
  margin: 6.5em 0 0 1em;
}
.Smailytunge{
  width: 2.5em;
  height: 8em;
  position: absolute;
  background-color: red;
  margin: -1em 0 0 2em;
  border-radius: 100%;
  animation-name: tungeKommer;
  animation-duration: 15s;
  animation-iteration-count: infinite;
}
@keyframes tungeKommer {
  0%{margin: -5em 0 0 2em;}
  50%{margin: -5em 0 0 2em;}
  75%{margin: -2em 0 0 2em;}
  100%{margin: -5em 0 0 2em;}
}
@keyframes blikBlik {
  0%{width: 1em; height: 2em; margin: 4.8em 0 0 10em;}
  60%{width: 1em; height: 2em; margin: 4.8em 0 0 10em;}
  64%{width: 3em; height: 0.5em; margin: 5.8em 0 0 9em;}
  69%{width: 1em; height: 2em; margin: 4.8em 0 0 10em;}
  100%{width: 1em; height: 2em; margin: 4.8em 0 0 10em;}
}
@keyframes ruterFace {
  0%{transform: rotate(0deg);}
  70%{transform: rotate(0deg);}
  80%{transform: rotate(10deg);}
  90%{transform: rotate(0deg);}
  100%{transform: rotate(0deg);}
}
</style>


<style>
.green{
  color: blue;
}

.red{
  color: blueviolet;
}

.red {
  background-color: red;
}

.blue {
  background-color: blue;
}

.a {
  background-color: #cecece;
}

.b {
  background-color: #5e5e5e;
}

.c {
  background-color: cyan;
}

.d {
  background-color: darkgoldenrod;
}

.e {
  background-color: ghostwhite;
}

.f {
  background-color: firebrick;
}

.g {
  background-color: green;
}

.h {
  background-color: hotpink;
}

.i {
  background-color: indigo;
}

.j {
  background-color: navajowhite;
}
</style>

