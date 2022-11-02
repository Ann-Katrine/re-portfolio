<template>
  <div >
    <nav id="navbar">
      <ul id="ulNavbar" class="menu">
        <li>
          <router-link to="/" class="overskrift">Ann-Katrine Th. Nykjær</router-link>
        </li>
        <li>
          <router-link to="/projekt">Projekter</router-link>
        </li>
      </ul>
      
    </nav>
  </div>
</template>

<script>

export default {
  name: 'menubar',  
}
</script>


<style>
  .testNavbar{
    background-color: #CCFFFF;
    width: 100%;
    height: 3px;
    padding: 0;
    padding-bottom: 5%;
  } 

  .menu{
    width: 100%;
    height: 3px;
    padding: 0;
    padding-bottom: 5%;
    background-image: url("/test.png");
    background-repeat: no-repeat;
    background-size: cover;
    background-position: right;
  }

  ul{ 
    margin: 0;
    padding: 0;
    list-style-type: none; /* så a-tags prikker ikke bliver vist*/
  }

  li{
    display: inline; /* den bruger når man er på IE6-7 for der virker inline-block ikke*/
    position: relative;
  }

  li a{
    display: inline-block; /* går at linkene ikke begynder at sætte sig under hinanden */
    padding: 0.4em;
    text-decoration: none;
    font-size: 1.3em;

  }

  .overskrift{
    font-size: 2.4em;
  }

  .sticky{
    position: fixed;
    top: 0;
    width: 100%;
	  z-index: 1;
  }

  @media screen and (max-width: 1226px){
    .overskrift{
      font-size: 2.1em;
    }
  }

  @media screen and (max-width: 1070px){
    li a {
      padding: 0.3em;
    }
  }

  @media screen and (max-width: 950px){
    .menu, .testNavbar{
      height: 10px;
    }
  }

  @media screen and (max-width: 900px){
    li a {
      font-size: 1.2em;
    }
    .overskrift {
      font-size: 2em;
    }
  }

  @media screen and (max-width: 640px){
    .overskrift {
      font-size: 1.9em;
    }
  }

  @media screen and (max-width: 600px){
    .overskrift {
      font-size: 1.7em;
    }
  }

  @media screen and (max-width: 480px){
    li a {
      padding: 0.4em;
    }
  }  

  @media screen and (max-width: 460px){
    .menu, .testNavbar {
      height: 20px;
    }
  }

  @media screen and (max-width: 430px){
    .overskrift {
      font-size: 1.6em;
    }
  }

  @media screen and (max-width: 430px){
    li a {
      padding: 0.3em;
    }
  }

  @media screen and (max-width: 410px){
    .overskrift {
      font-size: 1.5em;
    }
  }

  @media screen and (max-width: 340px){
    .overskrift {
      font-size: 1.5em;
    }
  }

  @media screen and (max-width: 334px){
    .overskrift {
      font-size: 1.45em;
    }

    li a {
      font-size: 1.1em;
    }
  }
</style>