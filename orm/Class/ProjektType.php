<?php
    class ProjektTypes{
        /*********************************/
        /*           properties          */
        /*********************************/
        private $projektTypeId;
        private $projektTypeName;
        private $projektTypeTypen;

        /*********************************/
        /*           Constructer         */
        /*********************************/
        function __construct($id, $name, $type)
        {
            $this->projektTypeId = $id;
            $this->projektTypeName = $name;
            $this->projektTypeTypen = $type;
        }


        /*********************************/
        /*              Getter           */
        /*********************************/
        public function getProjektType()
        {
            return
            [
                "id" => $this->projektTypeId,
                "name" => $this->projektTypeName,
                "type" => $this->projektTypeTypen
            ];
        }

        public function getId()
        {
            return $this->projektTypeId;
        }

        public function getName()
        {
            return $this->projektTypeName;
        }

        public function getType()
        {
            return $this->projektTypeTypen;
        }

        /*********************************/
        /*              Setter           */
        /*********************************/
        public function setProjektType($name, $type)
        {
            $this->projektTypeName = $name;
            $this->projektTypeTypen = $type;
        }

        public function setName($name)
        {
            $this->projektTypeName = $name;
        }

        public function setType($type)
        {
            $this->projektTypeTypen = $type;
        }
    }
?>