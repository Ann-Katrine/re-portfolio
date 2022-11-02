<?php
    class AllInformationOneProject{
        /*********************************/
        /*           properties          */
        /*********************************/
        public $projectId;
        public $projectName;
        public $projectFavorite;
        public $projectDate;
        public $projectDescription;
        public $projectStartDate;
        public $projectEndDate;

        public $projectSoftware = array();
        public $projectProjectType = array();
        public $projectWorkType = array();
        public $projectLanguage = array();
        public $projectDiagram = array();
        public $projectImage = array();

        /*********************************/
        /*           properties          */
        /*********************************/
        public function __construct($id, $name, $favrite, $date, $description, $startDate, $endDate,  $software, $projectType, $workType, $language, $diagram, $images)
        {
            $this->projectId = $id;
            $this->projectName = $name;
            $this->projectFavorite = $favrite;
            $this->projectDate = $date;
            $this->projectDescription = $description;
            $this->projectStartDate = $startDate;
            $this->projectEndDate = $endDate;
            $this->projectSoftware = $software;
            $this->projectProjectType = $projectType;
            $this->projectWorkType = $workType;
            $this->projectLanguage = $language;
            $this->projectDiagram = $diagram;
            $this->projectImage = $images;
        }
    }
?>