<template>
    <div>
        <div>
            <button @click="hideAndSeek()" class="hideAndSeekButtom">sprog</button>
            <div :style="css">
                <ul class="hideAndSeekBoks">
                    <li>
                        <input type="checkbox"><label>C++</label>
                    </li>
                    <li>
                        <input type="checkbox"><label>C#</label>
                    </li>
                    <li>
                        <input type="checkbox"><label>HTML</label>
                    </li>
                    <li>
                        <input type="checkbox"><label>CSS</label>
                    </li>
                    <li>
                        <input type="checkbox"><label>PHP</label>
                    </li>
                </ul>
            </div>
            
        </div>
    </div>
</template>


<script>
export default {
    name: "siteNavbar",
    data(){
        return{
            css: "display: none;"
        }
    },
    created(){

    },
    methods:{
        hideAndSeek(){
            if(this.css == "display: none;"){
                this.css = "display: block;";
            }
            else{
                this.css = "display: none;";
            }
        }
    }
}
</script>

<style>

    .hideAndSeekBoks{
        display: flex;
        flex-flow: column wrap;
        background-color: #EBFFFF;
        margin-right: 67.4em;
    }

    .hideAndSeekButtom{
        border: none;
        background-color: #B8E6E6;
        padding: 0.5em 9em 0.5em 0.5em;
        font-size: 1.5em;
        outline: none;
    }
</style>