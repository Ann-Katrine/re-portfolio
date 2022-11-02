<?php
    class AllProjektToAdminViewModel{
        /*********************************/
        /*           properties          */
        /*********************************/
        public $allProjectId;
        public $allProjectName;
        public $allProjectStartDate;
        public $allProjectEndDate;

        /*********************************/
        /*           properties          */
        /*********************************/
        public function __construct($id, $name, $startDate, $endDate)
        {
            $this->allProjectId = $id;
            $this->allProjectName = $name;
            $this->allProjectStartDate = $startDate;
            $this->allProjectEndDate = $endDate;
        }
    }
?>