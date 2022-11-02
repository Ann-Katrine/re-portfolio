<?php
    include_once("../orm/Class/db.php");
    include_once("../orm/Class/Billeder.php");
    include_once("../orm/viewModel/images/imagesWithoutTypeViewModel.php");
    include_once("../orm/viewModel/images/allInformationImagesViewModel.php");
    include_once("../orm/viewModel/category/allIformationOnCategoriesViewModel.php");

    class ImagesRepository{
        /*********************************/
        /*             GET               */     
        /*********************************/
        public function getAllImages() // kommer højst sandsynlig ikke til at bruge
        {
            $db = new DB();
            $images = array();

            $stmt = $db->conn->prepare("SELECT id, name, sted FROM billeder");
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false){
                while ($row = $result->fetch_object()) {
                    $images[] = new Images($row->id, $row->name, $row->sted);
                }

                http_response_code(200);
                return $images;
            }
            else{
                http_response_code(404);
                die("Det blev ikke fundet");
            }

            $stmt->close();
            $db->conn->close();
        }

        // custom JSON format
        public function getAllImagesWithProjectIdAndCategory4($id)
        {
            $db = new DB();
            $images = array();
            $finish = array();

            $stmt = $db->conn->prepare("SELECT billeder.name, billeder.sted
                                        FROM projekt
                                        INNER JOIN billeder_has_projekt ON billeder_has_projekt.projekt_id = projekt.id
                                        INNER JOIN billeder ON billeder.id = billeder_has_projekt.billeder_id
                                        INNER JOIN category ON category.id = billeder_has_projekt.category_id
                                        WHERE projekt.id = ? AND billeder_has_projekt.category_id = 4");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false){
                while($row = $result->fetch_object()){
                    $images[] = new ImagesWithoutTypeViewModel($row->name, $row->sted);
                }

                $antalImages = count($images);
                for ($i = 0; $i < $antalImages; $i++) { 
                    $setImages[] = [
                        "name" => $images[$i]->imagesName,
                        "sted" => $images[$i]->imagesSted
                    ];
                }

                array_push($finish, true, $setImages);
            }
            else{
                array_push($finish, false);
            }
            return $finish;
            $stmt->close();
            $db->conn->close();
        }

        public function getAllImagesWithAllCateogories($id)
        {
            $db = new DB();
            $images = array();
            $finish = array();

            $stmt = $db->conn->prepare("SELECT billeder.id, billeder.name, billeder.sted, category.name AS type, category.id AS typeId
                                        FROM projekt
                                        INNER JOIN billeder_has_projekt ON billeder_has_projekt.projekt_id = projekt.id
                                        INNER JOIN billeder ON billeder.id = billeder_has_projekt.billeder_id
                                        INNER JOIN category ON category.id = billeder_has_projekt.category_id
                                        WHERE projekt.id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false){
                while ($row = $result->fetch_object()) {
                    $category[] = new AllInformationOnCategories($row->typeId, $row->type);
                    $images[] = new AllInformationOnImages($row->id, $row->name, $row->sted, $category);
                }

                $antal = count($images);
                for ($i = 0; $i < $antal; $i++) { 
                    $setImages[] = [
                        "id" => $images[$i]->imagesId,
                        "name" => $images[$i]->imagesName,
                        "sted" => $images[$i]->imagesSted,
                        "type" => array(
                            "id" => $images[$i]->imagesType[$i]->categoryId,
                            "name" => $images[$i]->imagesType[$i]->categoryName
                        )
                    ];
                }
                array_push($finish, true, $setImages);
            }
            else{
                array_push($finish, false);
            }
            return $finish;
            $stmt->close();
            $db->conn->close();
        }

        public function getOneImages($id)
        {
            $db =  new DB();
            $finish = array();
            $images = null;

            $stmt = $db->conn->prepare("SELECT id, name, sted FROM billeder WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false && $result->num_rows > 0){
                while ($row = $result->fetch_object()) {
                    $images = new Images($row->id, $row->name, $row->sted);
                }
                array_push($finish, true, $images);
            }
            else{
                array_push($finish, false);
            }
            return $finish;
            $stmt->close();
            $db->conn->close();
        }

        public function getOneImagesWithName($name)
        {
            $db = new DB();
            $images = null;
            $resultTrue = array();

            $stmt = $db->conn->prepare("SELECT id, name, sted FROM billeder WHERE id = ?");
            $stmt->bind_param("s", $name);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false && $result->num_rows > 0){
                while ($row = $result->fetch_object()) {
                    $images = new Images($row->id, null, null);
                }
                
                array_push($resultTrue, true, $images);
            }
            else{
                array_push($resultTrue, false);
            }
            return $resultTrue;
            $stmt->close();
            $db->conn->close();
        }

        /*********************************/
        /*              POST             */
        /*********************************/
        public function postImages($pictures)
        {
            $db = new DB();
            $finish = array();
            // $images = array();

            $stmt = $db->conn->prepare("INSERT INTO billeder(name, sted) values (?, ?)");
            
            $name = $pictures->getName();
            $sted = $pictures->getbeskrivelse();
            
            $stmt->bind_param("ss", $name, $sted);
            $stmt->execute();

            $result = $stmt->affected_rows;

            if($result === 1){

                $id = $stmt->insert_id;
                array_push($finish, true, $id);
            }
            else{
                array_push($finish, false);
            }
            return $finish;
            $stmt->close();
            $db->conn->close();
        }

        /*********************************/
        /*              PUT              */
        /*********************************/
        public function putImages($pictures)
        {
            $db = new DB();
            
            $id = $pictures->getId();

            $stmt = $db->conn->prepare("UPDATE billeder SET name = ?, sted = ? WHERE id =" . $id);
            
            $name = $pictures->getName();
            $sted = $pictures->getSted();

            $stmt->bind_param("ss", $name, $sted);
            $stmt->execute();

            if($stmt->execute() == true){
                http_response_code(201);
                $finish = "Billedet blev ændret";
            }
            else{
                http_response_code(404);
                die("Billedet blev ikke ændret");
            }

            $stmt->close();
            $db->conn->close();
        }

        /*********************************/
        /*              DELETE           */
        /*********************************/
        public function deleteImages($id)
        {
            $db = new DB();


            $stmt = $db->conn->prepare("DELETE FROM billeder WHERE id = ?");
            $stmt->bind_param("i", $id);
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