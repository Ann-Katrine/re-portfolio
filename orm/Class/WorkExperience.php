<?php
    class WorkExperiences{
        /*********************************/
        /*           properties          */
        /*********************************/
        private $workExperienceId;
        private $workExperienceSted;
        private $workExperienceTittel;
        private $workExperienceStartDate;
        private $workExperienceEndDate;


        /*********************************/
        /*           Constructer         */
        /*********************************/
        function __construct($id, $sted, $tittel, $startDate, $endDate){
            $this->workExperienceId = $id;
            $this->workExperienceSted = $sted;
            $this->workExperienceTittel = $tittel;
            $this->workExperienceStartDate = $startDate;
            $this->workExperienceEndDate = $endDate;
        }


        /*********************************/
        /*              Getter           */
        /*********************************/
        public function getWorkExperience(){
            return
            [
                "id" => $this->workExperienceId,
                "sted" => $this->workExperienceSted,
                "tittel" => $this->workExperienceTittel,
                "startDate" => $this->workExperienceStartDate,
                "endDate" => $this->workExperienceEndDate
            ];
        }

        public function getId()
        {
            return $this->workExperienceId;
        }

        public function getsted(){
            return $this->workExperienceSted;
        }

        public function getTittel()
        {
            return $this->workExperienceTittel;
        }

        public function getStartDate()
        {
            return $this->workExperienceStartDate;
        }

        public function getEndDate()
        {
            return $this->workExperienceEndDate;
        }


        /*********************************/
        /*              Setter           */
        /*********************************/
        public function setWorkExperience($sted, $tittel, $startDate, $endDate){
            $this->workExperienceSted = $sted;
            $this->workExperienceTittel = $tittel;
            $this->workExperienceStartDate = $startDate;
            $this->workExperienceEndDate = $endDate;
        }
    }
?>