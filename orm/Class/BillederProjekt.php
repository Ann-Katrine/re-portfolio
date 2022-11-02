<?php
    class ImagesProject{
        /*********************************/
        /*           properties          */
        /*********************************/
        private $id;
        private $imagesId;
        private $projectId;
        private $typeId;

        /*********************************/
        /*           Constructer         */
        /*********************************/
        function __construct($idet, $billedeId, $projektId, $type)
        {
            $this->id = $idet;
            $this->imagesId = $billedeId;
            $this->projectId = $projektId;
            $this->typeId = $type;
        }

        /*********************************/
        /*              Getter           */
        /*********************************/
        public function getImagesProject()
        {
            return
            [
                "id" => $this->id,
                "billedeId" => $this->imagesId,
                "projektId" => $this->projectId,
                "type" => $this->typeId
            ];
        }

        public function getId()
        {
            return $this->id;
        }

        public function getImageId()
        {
            return $this->imagesId;
        }

        public function getProjectId()
        {
            return $this->projectId;
        }

        public function getTypeId()
        {
            return $this->typeId;
        }

        /*********************************/
        /*              Setter           */
        /*********************************/
        public function setImagesProject($billederId, $projektId, $type)
        {
            $this->imagesId = $billederId;
            $this->projectId = $projektId;
            $this->typeId = $type;
        }

        public function setImages($billedeId)
        {
            $this->imagesId = $billedeId;
        }

        public function setPRoejct($projektId)
        {
            $this->projectId = $projektId;
        }

        public function setType($type)
        {
            $this->typeId = $type;
        }
    }
?>