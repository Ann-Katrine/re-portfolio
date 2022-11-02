<?php
    class AllSoftwareViewModel{
        /*********************************/
        /*           properties          */
        /*********************************/
        public $softwareId;
        public $softwareName;

        /*********************************/
        /*           properties          */
        /*********************************/
        public function __construct($id, $name)
        {
            $this->softwareId = $id;
            $this->softwareName = $name;
        }
    }
?>