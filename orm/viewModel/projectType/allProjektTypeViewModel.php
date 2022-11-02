<?php
    class AllProjectTypeViewModel{
        /*********************************/
        /*           properties          */
        /*********************************/
        public $projectTypeId;
        public $projectTypeName;

        /*********************************/
        /*           properties          */
        /*********************************/
        public function __construct($id, $name)
        {
            $this->projectTypeId = $id;
            $this->projectTypeName = $name;
        }
    }
?>