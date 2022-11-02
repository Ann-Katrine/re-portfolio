<?php 
    class AllInformationOnImages{
        /*********************************/
        /*           properties          */
        /*********************************/
        public $imagesId;
        public $imagesName;
        public $imagesSted;
        
        public $imagesType = array();

        /*********************************/
        /*           Constructer         */
        /*********************************/
        public function __construct($id, $name, $sted, $type)
        {
            $this->imagesId = $id;
            $this->imagesName = $name;
            $this->imagesSted = $sted;
            $this->imagesType = $type;
        }
    }
?>