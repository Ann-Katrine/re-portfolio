<?php
    class ImagesWithoutTypeViewModel{
        /*********************************/
        /*           properties          */
        /*********************************/
        public $imagesName;
        public $imagesSted;

        /*********************************/
        /*           Constructer         */
        /*********************************/
        public function __construct($name, $sted)
        {
            $this->imagesName = $name;
            $this->imagesSted = $sted;
        }
    }
?>