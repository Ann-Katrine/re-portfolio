<?php
    class ImagesWithTypeViewModel{
        /*********************************/
        /*           properties          */
        /*********************************/
        public $imagesName;
        public $imagesSted;
        public $imagesType;

        /*********************************/
        /*           Constructer         */
        /*********************************/
        public function __construct($name, $sted, $type)
        {
            $this->imagesName = $name;
            $this->imagesSted = $sted;
            $this->imagesType = $type;
        }
    }
?>