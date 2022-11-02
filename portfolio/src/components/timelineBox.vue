<template>
  <div>
    <!-- <div class="boksAroundTimelineBoks">
      <div class="dot"></div>
        <div class="timelineboks">
          <div class="line1"></div>
          <div class="boks1">
              <p>hej</p>
          </div>
      </div>
    </div>
    <div class="boksAroundTimelineBoks">
      <div class="dot"></div>
        <div class="timelineboks">
          <div class="boks2">
              <p>hej</p>
          </div>
          <div class="line2"></div>
      </div>
    </div>
    <br>  -->
    <div class="boksAroundTimelineBoks">
      <div class="dot"></div>
        <div class="timelineboks">
          <div class="line"></div>
          <div class="boks">
              <p>hej</p>
          </div>
      </div>
    </div>
    <div class="boksAroundTimelineBoks">
      <div class="dot"></div>
        <div class="timelineboks">
          <div class="line"></div>
          <div class="boks">
              <p>hej</p>
          </div>
      </div>
    </div>
      
  </div>
</template>

<script>

  export default {
    name: 'timelineBox',
    data(){
      return{

      }
    },
    created(){

    },
    methob:{
      makeboks(){
        
      }
    }
  }
</script>

<style>
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
    height: 7em;
}

.boks{
    background-color: crimson;
    width: 5em;
    height: 5em;
    margin: 1em 0;
    position: absolute;
}

.boks:nth-child(odd){
right: 43.6em;
}

.boks:nth-child(even){
      left: 43.6em;
}


  .line1{
    background-color: #607272;
    width: 2px;
    height: 7em;
    margin-right: 14px;
    margin-left: 93px;
  } 

  .line2{
    background-color: #607272;
    width: 2px;
    height: 7em;
    margin-right: 95px;
  } 

  .boks1{
    background-color: crimson;
    width: 5em;
    height: 5em;
    margin: 1em 0;
  }

  .boks2{
    background-color: crimson;
    width: 5em;
    height: 5em;
    margin: 1em 0;
    margin-right: 14px;

  }
</style>