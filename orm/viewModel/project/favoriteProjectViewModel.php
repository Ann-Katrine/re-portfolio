<?php
    class FavoriteProjectViewModel{
        /*********************************/
        /*           properties          */
        /*********************************/
        public $farvoriteProjektName;
        public $farvoriteProjektFavorite;
        public $favoriteProjektImages = array();

        /*********************************/
        /*           Constructer         */
        /*********************************/
        public function __construct($name, $favorite, $images)
        {
            $this->farvoriteProjektName = $name;
            $this->farvoriteProjektFavorite = $favorite;
            $this->favoriteProjektImages = $images;
        }
    }
?>