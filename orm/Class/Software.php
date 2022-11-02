<?php
    class Softwares{
        /*********************************/
        /*           properties          */
        /*********************************/
        private $softwareId;
        private $softwareName;


        /*********************************/
        /*           Constructer         */
        /*********************************/
        function __construct($id, $name)
        {
            $this->softwareId = $id;
            $this->softwareName = $name;
        }


        /*********************************/
        /*              Getter           */
        /*********************************/
        public function getSoftware()
        {
            return
            [
                "id" => $this->softwareId,
                "name" => $this->softwareName
            ];
        }

        public function getId()
        {
            return $this->softwareId;
        }
        
        public function getName()
        {
            return $this->softwareName;
        }


        /*********************************/
        /*              Setter           */
        /*********************************/
        public function setSoftware($name)
        {
            $this->softwareName = $name;
        }
        
    }
?>