<?php
    class Qualifications{
        /*********************************/
        /*           properties          */
        /*********************************/
        private $QualificationId;
        private $QualificationName;


        /*********************************/
        /*           Constructer         */
        /*********************************/
        function __construct($id, $name){
            $this->QualificationId = $id;
            $this->QualificationName = $name;
        }


        /*********************************/
        /*              Getter           */
        /*********************************/
        public function getQualification(){
            return
            [
                "id" => $this->QualificationId,
                "name" => $this->QualificationName
            ];
        }

        public function getId(){
            return $this->QualificationId;
        }

        public function getName(){
            return $this->QualificationName;
        }


        /*********************************/
        /*              Setter           */
        /*********************************/
        public function setQualification($name){
            $this->QualificationName = $name;
        }
    }
?>