<?php
    class Profiles{
        /*********************************/
        /*           properties          */
        /*********************************/
        private $profileId;
        private $profileBriefDescription;


        /*********************************/
        /*           Constructer         */
        /*********************************/
        function __construct($id, $briefDescription)
        {
            $this->profileId = $id;
            $this->profileBriefDescription = $briefDescription;
        }


        /*********************************/
        /*              Getter           */
        /*********************************/
        public function getProfile()
        {
            return
            [
                "id" => $this->profileId,
                "briefDescription" => $this->profileBriefDescription
            ];
        }

        public function getId()
        {
            return $this->profileId;
        }

        public function getBriefDescription()
        {   
            return $this->profileBriefDescription;
        }


        /*********************************/
        /*              Setter           */
        /*********************************/
        public function setProfile($briefDescription)
        {
            $this->profileBriefDescription = $briefDescription;
        }
    }
?>