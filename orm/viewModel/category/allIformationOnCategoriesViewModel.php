<?php 
    class AllInformationOnCategories{
        /*********************************/
        /*           properties          */
        /*********************************/
        public $categoryId;
        public $categoryName;

        /*********************************/
        /*           Constructer         */
        /*********************************/
        public function __construct($id, $name)
        {
            $this->categoryId = $id;
            $this->categoryName = $name;
        }
    }
?>