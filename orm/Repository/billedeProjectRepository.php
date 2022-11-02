<?php 
    include_once("../orm/Class/db.php");
    include_once("../orm/Class/BillederProjekt.php");

    class ImagesProjectRepository{
        /*********************************/
        /*             GET               */     
        /*********************************/
        public function getAllImagesProjectWithbilledeId($id)
        {
            $db = new DB();
            $finish = array();
            $imagesProject = [];

            $stmt = $db->conn->prepare("SELECT id FROM billeder_has_projekt WHERE projekt_id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false && $result->num_rows > 0){
                while ($row = $result->fetch_object()) {
                    $imagesProject[] = new ImagesProject($row->id, null, null, null);
                }

                array_push($finish, true, $imagesProject);
            }
            else{
                array_push($finish, false);
            }
            return $finish;
            $stmt->close();
            $db->conn->close();
        }

        public function getAllImagesProjectWithProjectId($id)
        {
            $db = new DB();
            $images = array();
            $finish = array();

            $stmt = $db->conn->prepare("SELECT billeder_id FROM billeder_has_projekt WHERE projekt_id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false && $result->num_rows > 0){
                while ($row = $result->fetch_object()) {
                    $images[] = new Images($row->billeder_id, null, null);
                }

                $getImages = array();
                $antal = count($images);
                if($antal >= 2){
                    for ($i = 0; $i < $antal; $i++) { 
                        array_push($getImages, $images[$i]->getId());
                    }
                }
                else{
                    array_push($getImages, $images[0]->getId());
                }
                array_push($finish, true, $getImages);
            }
            else{
                array_push($finish, false);
            }
            return $finish;
            $stmt->close();
            $db->conn->close();
        }

        // ikke brugt
        public function getAllImagesProjektFromType4($id)
        {
            $db = new DB();
            $imagesProject = array();

            $stmt = $db->conn->prepare("SELECT id, billeder_has_projekt.billeder_id, billeder_has_projekt.projekt_id, category.name 
                                        FROM billeder_has_projekt 
                                        INNER JOIN projekt ON projekt.id = billeder_has_projekt.projekt_id 
                                        INNER JOIN category ON category.id = billeder_has_projekt.category_id 
                                        WHERE category.id = 4 && projekt.id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false && $result->num_rows > 1){
                while ($row = $result->fetch_object()) {
                    $imagesProject[] = new ImagesProject($row->id, $row->billeder_id, $row->projekt_id, $row->name);
                }

                http_response_code(200);
                return $imagesProject;
            }
            else{
                http_response_code(404);
                return false;
            }

            $stmt->close();
            $db->conn->close();
        }

        public function checkImages($id)
        {
            $db =  new DB();
            $finish = array();

            $stmt = $db->conn->prepare("SELECT billeder.id FROM billeder
                                        INNER JOIN billeder_has_projekt ON billeder_has_projekt.billeder_id = billeder.id
                                        INNER JOIN projekt ON projekt.id = billeder_has_projekt.projekt_id
                                        WHERE projekt.id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false && $result->num_rows > 0){
                while ($row = $result->fetch_object()) {
                    $images[] = new Images($row->id, null, null);
                }

                $getImages = array();
                $antal = count($images);
                for ($i = 0; $i < $antal; $i++) { 
                    array_push($getImages, $images[$i]->getId());

                }
                array_push($finish, true, $getImages);
            }
            else{
                array_push($finish, false);
            }
            return $finish;
            $stmt->close();
            $db->conn->close();
        }

        /*********************************/
        /*              POST             */
        /*********************************/
        public function postImagesProject($imagesProject, $projekt, $type)
        {
            $db = new DB();

            $stmt = $db->conn->prepare("INSERT INTO billeder_has_projekt(billeder_id, projekt_id, category_id) VALUES (?,?,?)");
            
            $stmt->bind_param("iii", $imagesProject, $projekt, $type);
            $stmt->execute();

            $result = $stmt->affected_rows;

            if($result === 1){
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
        /*              PUT              */
        /*********************************/
        public function putImagesProject($id)
        {
            $db = new DB();

            $stmt = $db->conn->prepare("UPDATE billeder_has_projekt SET billeder_id = ?,projekt_id = ?,category_id = ? WHERE projekt_id =" . $id);

            $stmt->bind_param("i", $id);


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
        public function deleteImagesProejct($imageProjekt)
        {
            $db = new DB();

            $stmt = $db->conn->prepare("DELETE FROM billeder_has_projekt WHERE id = ?");

            $id = $imageProjekt->getId();

            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->affected_rows;

            if($result === 1){
                return true;
            }
            else{
                return false;
            }
            $stmt->close();
            $db->conn->close();
        }

        public function deleteImagesProjectWithProject($id)
        {
            $db = new DB();
            
            $stmt = $db->conn->prepare("DELETE FROM billeder_has_projekt WHERE projekt_id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            
            $result = $stmt->affected_rows;

            if($result >= 1){
                return true;
            }
            else{
                return false;
            }
            $stmt->close();
            $db->conn->close();
        }
    }
?>