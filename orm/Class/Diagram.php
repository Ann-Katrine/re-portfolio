<?php
    class Diagrams{
        /*********************************/
        /*           properties          */
        /*********************************/
        private $diagramId;
        private $diagramName;


        /*********************************/
        /*           Constructer         */
        /*********************************/
        function __construct($id, $name)
        {
            $this->diagramId = $id;
            $this->diagramName = $name;
        }


        /*********************************/
        /*              Getter           */
        /*********************************/
        public function getDiagram()
        {
            return
            [
                "id" => $this->diagramId,
                "name" => $this->diagramName
            ];
        }

        public function getId()
        {
            return $this->diagramId;
        }

        public function getName()
        {
            return $this->diagramName;      
        }

        /*********************************/
        /*              Setter           */
        /*********************************/
        public function setDiagram($name)
        {
            $this->diagramName = $name;
        }
    }
?>