<?php
    class WorkExperienceViewModel{
        /*********************************/
        /*           properties          */
        /*********************************/
        public $workExperienceSted;
        public $workExperienceTittel;
        public $workExperienceStartDate;
        public $workExperienceEndDate;

        /*********************************/
        /*           properties          */
        /*********************************/
        public function __construct($sted, $tittel, $startDate, $endDate)
        {
            $this->workExperienceSted = $sted;
            $this->workExperienceTittel = $tittel;
            $this->workExperienceStartDate = $startDate;
            $this->workExperienceEndDate = $endDate;
        }
    }
?>