<?php 
    include_once("../orm/Class/db.php");
    include_once("../orm/Class/Category.php");

    class CategoryRepository{
        /*********************************/
        /*             GET               */     
        /*********************************/
        public function getCateogeriesWithType($type)
        {
            $db = new DB();
            $category = array();

            $stmt = $db->conn->prepare("SELECT id, name, type FROM category WHERE type = ?");
            $stmt->bind_param("i", $type);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false){
                while($row = $result->fetch_object()){
                    $category[] = new Category($row->id, $row->name, $row->type);
                }

                http_response_code(200);
                return $category;
            }
            else{
                http_response_code(404);
                die("Det blev ikke fundet");
            }

            $stmt->close();
            $db->conn->close();
        }

        public function getCategoryWithTypeAsNull()
        {
            $db = new DB();
            $category = array();

            $stmt = $db->conn->prepare("SELECT id, name, type FROM category WHERE type = NULL");
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false){
                while($row = $result->fetch_object()){
                    $category[] = new Category($row->id, $row->name, $row->type);
                }

                http_response_code(200);
                return $category;
            }
            else{
                http_response_code(404);
                die("Det blev ikke fundet");
            }
            
            $stmt->close();
            $db->conn->close();
        }

        public function getCategoryWithId($id)
        {
            $db = new DB();
            $finish = array();

            $stmt = $db->conn->prepare("SELECT id FROM category WHERE type = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false){

                $categoryId = array();
                while ($row = $result->fetch_object()) {
                    $categoryId[] = new Category($row->id, null, null);
                }
                array_push($finish, true, $categoryId);
            }
            else{

                array_push($finish, false);
            }

            return $finish;
            $stmt->close();
            $db->conn->close();
        }

        //ved ikke om skal bruges, hvis ikke skal den bare laves om
        public function getCategoryWithName($name)
        {
            $db = new DB();
            $category = array();

            $stmt = $db->conn->prepare("SELECT id, name, type FROM category WHERE name = ?");
            $stmt->bind_param("s", $name);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false){
                while($row = $result->fetch_object()){
                    $category[] = new Category($row->id, $row->name, $row->type);
                }

                http_response_code(200);
                return $category;
            }
            else{
                http_response_code(404);
                die("Der blev ikke fundet");
            }
            
            $stmt->close();
            $db->conn->close();
        }

        /*********************************/
        /*             POST              */     
        /*********************************/
        public function postOverCategory($category)
        {
            $db = new DB();
            $finish = array();

            $stmt = $db->conn->prepare("INSERT INTO category(name, type) VALUES (?, null)");

            $name = $category->getName();

            $stmt->bind_param("s", $name);
            $stmt->execute();

            $result = $stmt->affected_rows;

            if($result === 1){

                http_response_code(200);
                return true;
            }
            else{

                http_response_code(404);
                return false;
            }

            $stmt->close();
            $db->conn->close();
        }

        public function postUnderCategory($category)
        {
            $db = new DB();

            $stmt = $db->conn->prepare("INSERT INTO category(name, type) VALUES (?, ?)");

            $name = $category->getName();
            $type = $category->getType();

            $stmt->bind_param("si", $name, $type);
            $stmt->execute();

            $result = $stmt->affected_rows;

            if($result === 1){

                http_response_code(200);
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
        /*             PUT               */     
        /*********************************/
        public function putOverCategory($category)
        {
            $db = new DB();

            $id = $category->getId();

            $stmt = $db->conn->prepare("UPDATE category SET name = ?, type = NULL WHERE id =". $id);

            $name = $category->getName();

            $stmt->bind_param("s", $name);
            $stmt->execute();

            if($stmt->execute() == true){
                
                http_response_code(200);
                return true;
            }
            else{

                http_response_code(404);
                return false;
            }

            $stmt->close();
            $db->conn->close();
        }

        public function putUnderCateogry($category)
        {
            $db = new DB();

            $id = $category->getId();

            $stmt = $db->conn->prepare("UPDATE category SET name = ?, type = ? WHERE id =". $id);

            $name = $category->getName();
            $type = $category->getType();

            $stmt->bind_param("si", $name, $type);
            // $stmt->execute();

            if($stmt->execute() == true){

                http_response_code(200);
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
        /*             DELETE            */     
        /*********************************/
        public function delete($id)
        {
            $db = new DB();

            $stmt = $db->conn->prepare("DELETE FROM category WHERE id = ?");
            $stmt->bind_param("i",  $id);
            $stmt->execute();

            $result = $stmt->affected_rows;

            if($result === 1){
                
                http_response_code(200);
                return true;
            }
            else{

                http_response_code(404);
                return false;
            }

            $stmt->close();
            $db->conn->close();
        }
    }
?>