<?php 
    class OneProjectTypeViewModel{
        /*********************************/
        /*           properties          */
        /*********************************/
        public $projectTypeName;

        /*********************************/
        /*           properties          */
        /*********************************/
        public function __construct($name)
        {
            $this->projectTypeName = $name;
        }
    }
?>