<?php
    include_once("../orm/class/db.php");
    include_once("../orm/class/Sprog.php");
    include_once("../orm/viewModel/language/oneLanguageViewModel.php");
    include_once("../orm/viewModel/language/allLanguageViewModel.php");

    class LanguageRepository{
        /*********************************/
        /*             GET               */     
        /*********************************/
        // custom JSON format
        public function getAllLanguage()
        {
            $db = new DB();
            $finish = array();

            $stmt = $db->conn->prepare("SELECT id, name FROM sprog");
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false){
                while ($row = $result->fetch_object()) {
                    $getLanguage[] = new AllLanguageViewModel($row->id, $row->name);
                }

                $antalLanguage = count($getLanguage);
                for ($i = 0; $i < $antalLanguage; $i++) { 
                    $setLanguage[] = [
                        "id" => $getLanguage[$i]->languageId,
                        "name" => $getLanguage[$i]->languageName
                    ];
                }

                array_push($finish, true, $setLanguage);
            }
            else{
                array_push($finish, false);
            }
            return $finish;
            $stmt->close();
            $db->conn->close();
        }

        // custom JSON format
        public function getAllLanguageWithProjectId($id)
        {
            $db = new DB();
            $language = array();
            $finish = array();

            $stmt = $db->conn->prepare("SELECT sprog.name FROM projekt
                                        INNER JOIN projekt_has_sprog ON projekt_has_sprog.projekt_id = projekt.id
                                        INNER JOIN sprog ON sprog.id = projekt_has_sprog.sprog_id
                                        WHERE projekt.id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false){
                while ($row = $result->fetch_object()) {
                    $getLanguage[] = new OneLanguageViewModel($row->name);
                }

                $antalLanguage = count($getLanguage);
                for ($i = 0; $i < $antalLanguage; $i++) { 
                    $setLanguage[] = [
                        "name" => $getLanguage[$i]->languageName
                    ];
                }

                array_push($finish, true, $setLanguage);
            }
            else{
                array_push($finish, false);
            }
            return $finish;
            $stmt->close();
            $db->conn->close();
        }

        public function getAllLangeuageWithId($id)
        {
            $db = new DB();
            $finish = array();

            $stmt = $db->conn->prepare("SELECT sprog.id, sprog.name FROM sprog
                                        INNER JOIN category ON category.id = sprog.category_id
                                        WHERE category.id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false){

                $getLanguage = array();
                while ($row = $result->fetch_object()) {
                    $getLanguage[] = new Language($row->id, $row->name, null);
                }

                array_push($finish, true, $getLanguage);
            }
            else{

                array_push($finish, false);
            }

            return $finish;
            $stmt->close();
            $db->conn->close();
        }

        // custom JSON format
        public function getAllInformationFromLanguage($id)
        {
            $db = new DB();
            $getLanguage = array();
            $finish = array();

            $stmt = $db->conn->prepare("SELECT sprog.id, sprog.name FROM projekt
                                        INNER JOIN projekt_has_sprog ON projekt_has_sprog.projekt_id = projekt.id
                                        INNER JOIN sprog ON sprog.id = projekt_has_sprog.sprog_id
                                        WHERE projekt.id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false){
                while ($row = $result->fetch_object()) {
                    $getLanguage[] = new AllLanguageViewModel($row->id, $row->name);
                }

                $antalLanguage = count($getLanguage);
                for ($i = 0; $i < $antalLanguage; $i++) { 
                    $setLanguage[] = [
                        "id" => $getLanguage[$i]->languageId,
                        "name" => $getLanguage[$i]->languageName
                    ];
                }
                array_push($finish, true, $setLanguage);
            }
            else{
                array_push($finish, false);
            }
            return $finish;
            $stmt->close();
            $db->conn->close();
        }

        public function getOneLanguage($id)
        {
            $db = new DB();
            $language = null;
            $returnTrue = array();

            $stmt = $db->conn->prepare("SELECT id, name FROM sprog WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false && $result->num_rows > 0){
                while ($row = $result->fetch_object()) {
                    $language = new Language($row->id, $row->name, null);
                }
                array_push($returnTrue, true, $language);
            }
            else{
                array_push($returnTrue, false);
            }
            return $returnTrue;
            $stmt->close();
            $db->conn->close();
        }

        public function checkLanguage($id)
        {
            $db = new DB();
            $language = array();
            $returnTrue = array();

            $stmt = $db->conn->prepare("SELECT sprog.id FROM sprog
                                        INNER JOIN projekt_has_sprog ON projekt_has_sprog.sprog_id = sprog.id
                                        INNER JOIN projekt ON projekt.id = projekt_has_sprog.projekt_id
                                        WHERE projekt.id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false && $result->num_rows > 0){
                while ($row = $result->fetch_object()) {
                    $language[] = new Language($row->id, null, null);
                }

                $getLanguage = array();
                $antal = count($language);
                for ($i = 0; $i < $antal; $i++) { 
                    array_push($getLanguage, $language[$i]->getId());
                }
                array_push($returnTrue, true, $getLanguage);
            }
            else{
                array_push($returnTrue, false);
            }
            return $returnTrue;
            $stmt->close();
            $db->conn->close();
        }

        /*********************************/
        /*              POST             */
        /*********************************/
        public function postLanguage($language)
        {
            $db = new DB();

            $stmt = $db->conn->prepare("INSERT INTO sprog (name, category_id) VALUES (?, ?)");

            $name = $language->getName();
            $type = $language->getType();

            $stmt->bind_param("si", $name, $type);
            $stmt->execute();

            $result = $stmt->affected_rows;

            if($result === 1){
                http_response_code(201);
                $finish = "Sproget blev oprettet";
                echo $finish;
            }
            else{
                http_response_code(404);
                die("Sproget blev ikke oprettet");
            }

            $stmt->close();
            $db->conn->close();
        }

        /*********************************/
        /*              PUT              */
        /*********************************/
        public function putLanguage($language)
        {
            $db = new DB();

            $id = $language->getId();

            $stmt = $db->conn->prepare("UPDATE sprog SET name = ?, category_id = ? WHERE id =" . $id);
            
            $name = $language->getName();
            $type = $language->getType();
            
            $stmt->bind_param("si", $name, $type);
            $stmt->execute();

            if($stmt->execute() == true){
                http_response_code(201);
                return true;
            }
            else{
                http_response_code(404);
                return false;
            }

            $stmt->close();
            $db->conn->close();
        }

        /*********************************/
        /*              DELETE           */
        /*********************************/
        public function deleteLanguage($id)
        {
            $db = new DB();

            $stmt = $db->conn->prepare("DELETE FROM sprog WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->affected_rows;

            if($result === 1){
                http_response_code(200);
                echo true;
            }
            else{
                http_response_code(404);
                echo false;
            }

            $stmt->close();
            $db->conn->close();
        }
    }
?>