<?php
    class AllDiagramViewModel{
        /*********************************/
        /*           properties          */
        /*********************************/
        public $diagramId;
        public $diagramName;

        /*********************************/
        /*           properties          */
        /*********************************/
        public function __construct($id, $name)
        {
            $this->diagramId = $id;
            $this->diagramName = $name;
        }
    }
?>