<?php
    class Newest3ProjectViewModel{
        /*********************************/
        /*           properties          */
        /*********************************/
        public $newest3ProjectId;
        public $newest3ProjectName;
        public $newest3ProjectImages = array();

        /*********************************/
        /*           Constructer         */
        /*********************************/
        public function __construct($id, $name, $images)
        {
            $this->newest3ProjectId = $id;
            $this->newest3ProjectName = $name;
            $this->newest3ProjectImages = $images;
        }
    }
?>