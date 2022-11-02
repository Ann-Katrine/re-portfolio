<?php
    class AllLanguageViewModel{
        /*********************************/
        /*           properties          */
        /*********************************/
        public $languageId;
        public $languageName;

        /*********************************/
        /*           properties          */
        /*********************************/
        public function __construct($id, $name)
        {
            $this->languageId = $id;
            $this->languageName = $name;
        }
    }
?>