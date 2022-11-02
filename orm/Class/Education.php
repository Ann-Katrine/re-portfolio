<?php
    class Educations{
        /*********************************/
        /*           properties          */
        /*********************************/
        private $educationId;
        private $educationSted;
        private $educationTittel;
        private $educationStartDate;
        private $educationEndDate;

        /*********************************/
        /*           Constructer         */
        /*********************************/
        function __construct($id, $sted, $tittel, $startDate, $endDate)
        {
            $this->educationId = $id;
            $this->educationSted = $sted;
            $this->educationTittel = $tittel;
            $this->educationStartDate = $startDate;
            $this->educationEndDate = $endDate;
        }


        /*********************************/
        /*              Getter           */
        /*********************************/
        public function getEducation()
        {
            return
            [
                "id" => $this->educationId,
                "sted" => $this->educationSted,
                "tittel" => $this->educationTittel,
                "startDate" => $this->educationStartDate,
                "endDate" => $this->educationEndDate
            ];
        }

        public function getId()
        {
            return $this->educationId;
        }

        public function getsted()
        {
            return $this->educationSted;
        }

        public function getTittel()
        {
            return $this->educationTittel;
        }

        public function getStartDate()
        {
            return $this->educationStartDate;
        }

        public function getEndDate(){
            return $this->educationEndDate;
        }


        /*********************************/
        /*              Setter           */
        /*********************************/
        public function setEducation($sted, $tittel, $startDate, $endDate)
        {
            $this->educationSted = $sted;
            $this->educationTittel = $tittel;
            $this->educationStartDate = $startDate;
            $this->educationEndDate = $endDate;
        }
    }
?>