<?php
    class educationViewModel{
        /*********************************/
        /*           properties          */
        /*********************************/
        public $educationSted;
        public $educationTittel;
        public $educationStartDate;
        public $educationEndDate;

        /*********************************/
        /*           properties          */
        /*********************************/
        public function __construct($sted, $tittel, $startDate, $endDate)
        {
            $this->educationSted = $sted;
            $this->educationTittel = $tittel;
            $this->educationStartDate = $startDate;
            $this->educationEndDate = $endDate;
        }
    }
?>