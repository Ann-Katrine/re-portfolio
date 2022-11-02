<?php
    class AllProjektViewModel{
        /*********************************/
        /*           properties          */
        /*********************************/
        public $allProjectId;
        public $allProjectName;
        public $allProjectImages = array();

        /*********************************/
        /*           properties          */
        /*********************************/
        public function __construct($id, $name, $images)
        {
            $this->allProjectId = $id;
            $this->allProjectName = $name;
            $this->allProjectImages = $images;
        }
    }
?>