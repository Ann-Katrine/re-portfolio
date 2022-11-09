<?php
    class AllLanguageViewModel{
        /*********************************/
        /*           properties          */
        /*********************************/
        public $languageHeadlineId;
        public $languageHeadlineName;
        public $languageId;
        public $languageName;

        /*********************************/
        /*           properties          */
        /*********************************/
        public function __construct($headlineId, $headlineName, $id, $name)
        {
            $this->languageHeadlineId = $headlineId;
            $this->languageHeadlineName = $headlineName;
            $this->languageId = $id;
            $this->languageName = $name;
        }
    }
?>