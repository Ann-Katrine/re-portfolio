<?php
    class Projects{
        /*********************************/
        /*           properties          */
        /*********************************/
        private $projektId;
        private $projektName;
        private $projektFavorite;
        private $projektDate;
        private $projektDescripstion;
        private $projektStartDate;
        private $projektEndDate;
        private $projektSoftware;
        private $projektProjektType;
        private $projektWorkType;

        private $projektLanguage = array();
        private $projektDiagram = array();
        // private $projektImages = array();

        /*********************************/
        /*           Constructer         */
        /*********************************/
        function __construct($id, $name, $favorite, $date, $description, $startDate, $endDate, $software, $projectType, $workType, $language, $diagram/*, $images*/)
        {
            $this->projektId = $id;
            $this->projektName = $name;
            $this->projektFavorite = $favorite;
            $this->projektDate = $date;
            $this->projektDescripstion = $description;
            $this->projektStartDate = $startDate;
            $this->projektEndDate = $endDate;
            $this->projektSoftware = $software;
            $this->projektProjektType = $projectType;
            $this->projektWorkType = $workType;
            $this->projektLanguage = $language;
            $this->projektDiagram = $diagram;
            // $this->projektImages = $images;
        }


        /*********************************/
        /*              Getter           */
        /*********************************/
        public function getProjekt()
        {
            return
            [
                "id" => $this->projektId,
                "name" => $this->projektName,
                "favorite" => $this->projektFavorite,
                "date" => $this->projektDate,
                "description" => $this->projektDescripstion,
                "startDate" => $this->projektStartDate,
                "endDate" => $this->projektEndDate,
                "software" => $this->projektSoftware,
                "projektType" => $this->projektProjektType,
                "workType" => $this->projektWorkType,
                "language" => $this->projektLanguage,
                "diagram" => $this->projektDiagram
                // "images" => $this->projektImages
            ];
        }

        public function getId()
        {
            return $this->projektId;
        }

        public function getName()
        {
            return $this->projektName;
        }

        public function getFavorite()
        {
            return $this->projektFavorite;
        }

        public function getDate()
        {
            return $this->projektDate;
        }

        public function getDescription()
        {
            return $this->projektDescripstion;
        }

        public function getStartDate()
        {
            return  $this->projektStartDate;
        }

        public function getEndDate()
        {
            return $this->projektEndDate;
        }

        public function getSoftware()
        {
            return $this->projektSoftware;
        }

        public function getProjektType()
        {
            return $this->projektProjektType;
        }

        public function getWorkType()
        {
            return $this->projektWorkType;
        }

        public function getLanguage()
        {
            return $this->projektLanguage;
        }

        public function getDiagram()
        {
            return $this->projektDiagram;
        }

        // public function getImages()
        // {
        //     return $this->projektImages;
        // }


        /*********************************/
        /*              Setter           */
        /*********************************/
        public function setProjekt($name, $favorite, $date, $description, $startDate, $endDate, $software, $projectType, $workType, $language, $diagram/*, $images*/)
        {
            $this->projektName = $name;
            $this->projektFavorite = $favorite;
            $this->projektDate = $date;
            $this->projektDescripstion = $description;
            $this->projektStartDate = $startDate;
            $this->projektEndDate = $endDate;
            $this->projektSoftware = $software;
            $this->projektProjektType = $projectType;
            $this->projektWorkType = $workType;
            $this->projektLanguage = $language;
            $this->projektDiagram = $diagram;
            // $this->projektImages = $images;
        }
    }
?>