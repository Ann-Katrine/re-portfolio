<?php
    class WorkTypes{
        /*********************************/
        /*           properties          */
        /*********************************/
        private $workTypeId;
        private $worktypeName;


        /*********************************/
        /*           Constructer         */
        /*********************************/
        function __construct($id, $name)
        {
            $this->workTypeId = $id;
            $this->worktypeName = $name;
        }


        /*********************************/
        /*              Getter           */
        /*********************************/
        public function getWorkType()
        {
            return
            [
                "id" => $this->workTypeId,
                "name" => $this->worktypeName
            ];
        }
        
        public function getId()
        {
            return $this->workTypeId;
        }

        public function getName()
        {
            return $this->worktypeName;
        }

        /*********************************/
        /*              Setter           */
        /*********************************/
        public function setWorkType($name)
        {
            $this->worktypeName = $name;
        }
    }
?>