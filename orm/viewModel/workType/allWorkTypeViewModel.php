<?php
    class AllWorkTypeViewModel{
        /*********************************/
        /*           properties          */
        /*********************************/
        public $workTypeId;
        public $workTypeName;

        /*********************************/
        /*           properties          */
        /*********************************/
        public function __construct($id, $name)
        {
            $this->workTypeId = $id;
            $this->workTypeName = $name;
        }
    }
?>