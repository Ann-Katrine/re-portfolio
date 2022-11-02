<?php
    class OneprojectViewModel{
        /*********************************/
        /*           properties          */
        /*********************************/
        public $projectName;
        public $projectFavorite;
        public $projectDescription;
        public $projectStartDate;
        public $projectEndDate;

        public $projectSoftware;
        public $projectProjectType;
        public $projectWorkType;
        public $projectImage = array();
        public $projectLanguage = array();
        public $projectDiagram = array();

        /*********************************/
        /*           properties          */
        /*********************************/
        public function __construct($name, $favrite, $description, $startDate, $endDate,  $software, $projectType, $workType, $images, $language, $diagram)
        {
            $this->projectName = $name;
            $this->projectFavorite = $favrite;
            $this->projectDescription = $description;
            $this->projectStartDate = $startDate;
            $this->projectEndDate = $endDate;
            $this->projectSoftware = $software;
            $this->projectProjectType = $projectType;
            $this->projectWorkType = $workType;
            $this->projectImage = $images;
            $this->projectLanguage = $language;
            $this->projectDiagram = $diagram;
        }
    }
?>