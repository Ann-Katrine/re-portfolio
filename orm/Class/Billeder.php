<?php
    class Images{
        /*********************************/
        /*           properties          */
        /*********************************/
        private $imagesId;
        private $imagesName;
        private $imagesBeskrivelse;


        /*********************************/
        /*           Constructer         */
        /*********************************/
        function __construct($id, $name, $description){
            $this->imagesId = $id;
            $this->imagesName = $name;
            $this->imagesBeskrivelse = $description;
        }


        /*********************************/
        /*              Getter           */
        /*********************************/
        public function getImages(){
            return
            [
                "id" => $this->imagesId,
                "name" => $this->imagesName,
                "description" => $this->imagesBeskrivelse
            ];
        }

        public function getId(){
            return $this->imagesId;
        }

        public function getName(){
            return $this->imagesName;
        }

        public function getbeskrivelse(){
            return $this->imagesBeskrivelse;
        }


        /*********************************/
        /*              Setter           */
        /*********************************/
        public function setImages($name, $description)
        {
            $this->imagesName = $name;
            $this->imagesBeskrivelse = $description;
        }
    }
?>