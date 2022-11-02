<?php 
    class OneWorkTypeViewModel{
        /*********************************/
        /*           properties          */
        /*********************************/
        public $WorkTypeName;

        /*********************************/
        /*           properties          */
        /*********************************/
        public function __construct($name)
        {
            $this->WorkTypeName = $name;
        }
    }
?>