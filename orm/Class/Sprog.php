<?php
    class Language{
        /*********************************/
        /*           properties          */
        /*********************************/
        private $sprogId;
        private $sprogName;
        private $sprogType;

        /*********************************/
        /*           Constructer         */
        /*********************************/
        function __construct($id, $name, $type)
        {
            $this->sprogId = $id;
            $this->sprogName = $name;
            $this->sprogType = $type;
        }


        /*********************************/
        /*              Getter           */
        /*********************************/
        public function getSprog()
        {
            return
            [
                "id" => $this->sprogId,
                "name" => $this->sprogName,
                "type" => $this->sprogType
            ];
        }

        public function getId(){
            return $this->sprogId;
        }

        public function getName()
        {
            return $this->sprogName;
        }

        public function getType()
        {
            return $this->sprogType;
        }

        /*********************************/
        /*              Setter           */
        /*********************************/
        public function setSprog($name, $type)
        {
            $this->sprogName = $name;
            $this->sprogType = $type;
        }

        public function setName($name)
        {
            $this->sprogName = $name;
        }

        public function setType($type)
        {
            $this->sprogType = $type;
        }
    }
?>