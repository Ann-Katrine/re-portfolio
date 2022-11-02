<?php
    class Category{
        /*********************************/
        /*           properties          */
        /*********************************/
        private $id;
        private $name;
        Private $type;

        /*********************************/
        /*           Constructer         */
        /*********************************/
        function __construct($idet, $navn, $typen)
        {
            $this->id = $idet;
            $this->name = $navn;
            $this->type = $typen;
        }    
        
        /*********************************/
        /*              Getter           */
        /*********************************/
        public function getCategoryWithType()
        {
            return
            [
                "id" => $this->id,
                "name" => $this->name,
                "type" => $this->type
            ];
        }

        public function getCategoryWihtoutType()
        {
            return
            [
                "id" => $this->id,
                "name" => $this->name
            ];
        }

        public function getId()
        {
            return $this->id;
        }

        public function getName()
        {
            return $this->name;
        }

        public function getType()
        {
            return $this->type;
        }
        
        /*********************************/
        /*              Setter           */
        /*********************************/
        public function setCategoryWithType($navn, $typen)
        {
            $this->name = $navn;
            $this->type = $typen;
        }

        public function setName($name)
        {
            $this->name = $name;
        }

        public function setType($typen)
        {
            $this->type = $typen;
        }
    }
?>