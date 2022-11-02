<template>
    <div >
        <div v-show="showModal" class="outer-modal">
            <div id="indreModal" class="indre-modal">
                <div class="btn-rigth">
                    <button @click="closeModal()" class="btnModal">
                        <ion-icon class="close-ikon" name="close-outline" ></ion-icon>
                    </button>
                </div>
                <div class="modal-center">
                    <slot >

                    </slot>
                </div>
            </div>
        </div>
    </div>
    
</template>

<script>
    import eventBus from '../eventBus'

    export default {
        name: "showProjekt",
        data(){
            return{
                showModal: false,
                modalHeigth: 0,
                tekstOpen: false
            }
        },
        created(){
            eventBus.$on("showModal", (status) => {
                this.showModal = status
                console.log("modalen er åben")
            })
            eventBus.$on("changeStyling", (status, screnWidth) =>{
                let modal = document.getElementById("indreModal")

                if(screnWidth <= 630){
                    modal.classList.add("indre-modal")
                    modal.classList.add("addScrollBar")
                    modal.classList.remove("modal-mades-smaller")
                    modal.classList.remove("indre-modal-with-secret-text")
                }
                else{
                    if(status == true){
                        modal.classList.add("indre-modal-with-secret-text")
                        modal.classList.add("addScrollBar")
                        modal.classList.remove("indre-modal")
                        modal.classList.remove("modal-mades-smaller")
                    }
                    else{
                        modal.classList.add("indre-modal")
                        modal.classList.add("modal-mades-smaller")
                        modal.classList.remove("indre-modal-with-secret-text")
                        modal.classList.remove("addScrollBar")
                    }
                }
            })
        },
        methods: {
            closeModal(){
                this.showModal = false
                let modal = document.getElementById("indreModal")

                if(modal.classList != "indre-modal"){
                    modal.classList.add("indre-modal")
                }

                modal.classList.remove("modal-mades-smaller")
                modal.classList.remove("indre-modal-with-secret-text")
                modal.classList.remove("addScrollBar")
            }  
        }
    }
</script>

<style>
    .outer-modal{
        z-index: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        position: fixed;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 50%);
    }

    .indre-modal{
       background-color: #B8E6E6;
       width: 800px;
       max-width: 100%;
       min-height: 430px;
       max-height: 100%;
       border-radius: 25px;
    }

    .indre-modal-with-secret-text{
        background-color: #B8E6E6;
        width: 820px;
        max-width: 100%;
        height: 630px;
        max-height: 100%;
        border-radius: 25px;
        animation-name: modalMadeLarger;
        animation-duration: 1.5s;
        animation-iteration-count: 1;
    }

    .addScrollBar{
        overflow: auto;
    }

    .modal-mades-smaller{
        animation-name: modalMadeSmaller;
        animation-duration: 1.5s;
        animation-iteration-count: 1;
    }

    @keyframes modalMadeLarger {
        0%{
            height: 487px;
        }
        100%{
            height: 630px;
        }
    }
    @keyframes modalMadeSmaller {
        0%{
            height: 630px;
        }
        100%{
            height: 487px;
        }
    }

    /* husk  ::-webkit-scrollbar kan blive ændret med tiden med hvrodan det virker*/
    /* virker ikke på firefox "i nu!!!!"*/
    .indre-modal-with-secret-text::-webkit-scrollbar{
        width: 11px;
    }

    .btn-rigth{
        text-align: right;
        position: sticky;
        top: 1px;
    }

    .modal-center{
        text-align: left;
        padding: 0em 6em;
    }

    .btnModal{
        background-color: transparent;
        border: none;
        padding: 1em 1em 0em 0em;
    }

    .btnModalDown{
        background-color: transparent;
        border: none;
        padding: 1em 1em 0em 0em;
    }

    .btnModal:hover .close-ikon, .btnModalDown:hover .close-ikon{
        color:#000;
    }

    .btnModal:focus .close-ikon, .btnModalDown:focus .close-ikon{
        outline: none;
    }

    .close-ikon{
        color: #607272;
        width: 2em;
        height: 2em;
    }

    .modal-images-fix{
    display: flex;
    flex-flow: row wrap;
    }

    .modal-btn{
        width: 3em;
        height: 250px;
        max-width: 100%;
        max-height: 100%;

        border: none;
        /* background-color: #fff; */
        background-image: url("/backgroundWhite.png");
        background-repeat: no-repeat;
        background-size: cover;
         background-position: right; 
    }

    .btn-next{
        padding: 0 0 0 0;
    }

    .modal-btn:hover .close-ikon{
        color: #000;
    }
    
    .modal-btn:focus {
        outline: none;
    }
    
    .modal-img{
        width: 525px;
        height: 250px;
        max-width: 100%;
        max-height: 100%;
    }

    .modal-overskrift{
        padding:0.3em 0 0.3em 0;
        font-size: 1.8em;
    }

    .modal-date{
        font-size: 0.9em;
        padding: 0 0 0.5em 0
    }

    .modal-kategori-flex{
        display: flex;
        flex-flow: row wrap;
    }

    .modal-kategori{
        display: flex;
        flex-flow: column wrap;
        align-content: center;
        justify-content: center;
        border-radius: 20px;
        min-width: 50px;
        height: 20px;
        text-align: center;
        padding: 0.2em 0.6em;
        margin: 0 0.5em 0.5em 0;
    }

    .modal-kategori-tekst{
        font-size: 1.0em;
        text-transform: uppercase;
    }

    .ekstra-Tekst{
        text-align: center;
    }

    .modal-secret-text-bottom{
        padding-bottom: 2em;
    }

    .modal-circle-box{
        display: flex;
        justify-content: center;
        align-items: center;
        flex-flow: row nowrap;
    }

    .modal-circles{
        margin: 0.1em;
        background-color: #fff;
        width: 10px;
        height: 10px;
        border-radius: 100%;
    }

    .pinkColor{
        background-color: #ff66a3;
    }
    .yellowColor{
        background-color: #ffff4d;
    }
    .greenColor{
        background-color: #8cff66;
    }
    .redColor{
        background-color: #ff6666;
    }
    .blueColor{
        background-color: #809fff;
    }
</style>

<style>
    @media screen and (max-width: 970px) {
        .indre-modal, .indre-modal-with-secret-text{
            width: 780px;
        }

        .modal-img{
            width: 497px;
        }
    }

    @media screen and (max-width: 930px) {
        .indre-modal, .indre-modal-with-secret-text{
            width: 760px;
        }

        .modal-img{
            width: 477px;
        }
    }

    @media screen and (max-width: 910px) {
        .indre-modal{
            width: 760px;
        }

        .modal-img{
            width: 509px;
        }

        .modal-center{
            padding: 0em 5em;
        }
    }

    @media screen and (max-width: 890px) {
        .indre-modal, .indre-modal-with-secret-text{
            width: 740px;
        }

        .modal-img{
            width: 489px;
        }
    }

    @media screen and (max-width: 850px) {
        .indre-modal, .indre-modal-with-secret-text{
            width: 720px;
        }

        .modal-img{
            width: 469px;
        }
    }

    @media screen and (max-width: 830px) {
        .indre-modal, .indre-modal-with-secret-text{
            width: 700px;
        }

        .modal-img{
            width: 449px;
        }
    }

    @media screen and (max-width: 810px) {
        .indre-modal, .indre-modal-with-secret-text{
            width: 690px;
        }

        .modal-img{
            width: 439px;
        }
    }

    @media screen and (max-width: 790px) {
        .indre-modal, .indre-modal-with-secret-text{
            width: 680px;
        }

        .modal-img{
            width: 429px;
        }
    }

    @media screen and (max-width: 770px) {
        .indre-modal, .indre-modal-with-secret-text{
            width: 660px;
        }

        .modal-img{
            width: 409px;
        }
    }

    /* tabel størrelse  */
    @media screen and (max-width: 750px) {
        .indre-modal, .indre-modal-with-secret-text{
            width: 630px;
        }

        .modal-img{
            width: 379px;
        }
    }

    @media screen and (max-width: 730px) {
        .indre-modal, .indre-modal-with-secret-text{
            width: 620px;
        }

        .modal-img{
            width: 369px;
        }

        .modal-btn, .modal-img{
        height: 234px;
        }
    }

    @media screen and (max-width: 710px) {
        .indre-modal, .indre-modal-with-secret-text{
            width: 600px;
        }

        .modal-img{
            width: 381px;
        }

        .modal-center{
            padding: 0em 4em;
        }
    }

    @media screen and (max-width: 690px) {
        .indre-modal{
            width: 590px;
        }

        .modal-img{
            width: 381px;
        }
    }

    @media screen and (max-width: 670px) {
        .indre-modal, .indre-modal-with-secret-text{
            width: 580px;
        }

        .modal-img{
            width: 361px;
        }
    }

    @media screen and (max-width: 650px) {
        .indre-modal, .indre-modal-with-secret-text{
            width: 560px;
        }

        .modal-img{
            width: 341px;
        }
    }

    /* ændres her i styling */
    @media screen and (max-width: 630px) {
        .indre-modal{
            width: 100%;
            height: 100%;
            border-radius: 0;
        }

        .modal-img{
            width: 380px;
        }

        .ekstra-Tekst{
            display: none;
        }
    }

    @media screen and (max-width: 621px) {
        .indre-modal{
            width: 100%;
            height: 100%;
            border-radius: 0;
        }

        .modal-img{
            width: 370px;
        }

        .ekstra-Tekst{
            display: none;
        }
    }

    @media screen and (max-width: 615px) {
        .modal-img{
            width: 360px;
        }
    }    

    @media screen and (max-width: 605px) {
        .modal-img{
            width: 350px;
        }
    } 

    @media screen and (max-width: 595px) {
        .modal-img{
            width: 340px;
            height: 240px;
        }

        .modal-btn{
            height: 240px;
        }
    } 

    @media screen and (max-width: 585px) {
        .modal-img{
            width: 340px;
        }

        .modal-btn, .modal-img{
            height: 240px;
        }

        .modal-center {
            padding: 0em 3.5em;
        }
    } 

    @media screen and (max-width: 570px) {
        .modal-img{
            width: 335px;
        }

        .modal-btn, .modal-img{
            height: 230px;
        }
    }  

    @media screen and (max-width: 560px) {
        .modal-img{
            width: 330px;
        }

        .modal-btn, .modal-img{
            height: 220px;
        }
    }

    @media screen and (max-width: 560px) {
        .modal-img{
            width: 325px;
        }
    }

    @media screen and (max-width: 550px) {
        .modal-img{
            width: 450px;
            height: 230px;
            margin: 0 0 0 -40px;
        }

        .modal-btn{
            height: 230px;
            background-color: inherit;
            padding-top: 235px;
        }

        .modal-center {
            padding: 0em 3em;
        }

        .modal-circle-box{
            padding-top: 4px;
        }

        .btn-next{
            padding: 235px 0 0 0;
            margin: 0 0 0 -81px;
        }
    } 

    @media screen and (max-width: 545px) {
         .modal-img{
            width: 440px;
        }
    }

    @media screen and (max-width: 535px) {
         .modal-img{
            width: 430px;
        }
    }

    @media screen and (max-width: 525px) {
         .modal-img{
            width: 420px;
        }
    }

    @media screen and (max-width: 515px) {
         .modal-img{
            width: 410px;
        }
    }

    @media screen and (max-width: 505px) {
         .modal-img{
            width: 400px;
        }
    }

    @media screen and (max-width: 495px) {
         .modal-img{
            width: 390px;
        }
    }

    @media screen and (max-width: 485px) {
         .modal-img{
            width: 380px;
        }
    }

    @media screen and (max-width: 475px) {
        .modal-img{
            width: 370px;
        }
    }

    @media screen and (max-width: 470px) {
        .modal-center {
            padding: 0em 2em;
        }

        .modal-img{
            width: 400px;
        }
    } 

    @media screen and (max-width: 463px) {
         .modal-img{
            width: 390px;
        }
    }

    @media screen and (max-width: 453px) {
         .modal-img{
            width: 380px;
        }
    }

    @media screen and (max-width: 443px) {
         .modal-img{
            width: 370px;
        }
    }

    @media screen and (max-width: 433px) {
         .modal-img{
            width: 360px;
        }
    }

    @media screen and (max-width: 423px) {
         .modal-img{
            width: 350px;
        }
    }

    @media screen and (max-width: 413px) {
         .modal-img{
            width: 340px;
        }
    }

    @media screen and (max-width: 403px) {
         .modal-img{
            width: 330px;
        }
    }

    @media screen and (max-width: 393px) {
         .modal-img{
            width: 320px;
        }
    }

    @media screen and (max-width: 383px) {
         .modal-img{
            width: 310px;
        }
    }

    @media screen and (max-width: 375px) {
        .modal-img{
            width: 320px;
            height: 230px;
            margin: 0 0 0 -40px;
        }
        
        .modal-center {
            padding: 0em 1.5em;
        }
    }

    @media screen and (max-width: 367px){
        .modal-img{
            width: 310px;
        }
    } 

    @media screen and (max-width: 357px){
        .modal-img{
            width: 300px;
        }
    } 

    @media screen and (max-width: 347px){
        .modal-img{
            width: 290px;
        }
    } 

    @media screen and (max-width: 337px){
        .modal-img{
            width: 280px;
        }
    } 

    @media screen and (max-width: 327px){
        .modal-img{
            width: 270px;
        }
    }  
</style>