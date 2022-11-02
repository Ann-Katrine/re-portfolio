<template>
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
</template>

<style>
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

</style>