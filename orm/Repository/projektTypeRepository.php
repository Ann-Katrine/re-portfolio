<?php
    include_once("../orm/class/db.php");
    include_once("../orm/class/ProjektType.php");
    include_once("../orm/viewModel/projectType/oneProjektTypeViewModel.php");
    include_once("../orm/viewModel/projectType/allProjektTypeViewModel.php");

    class projektTypeRepository{
        /*********************************/
        /*             GET               */     
        /*********************************/
        // custom JSON format
        public function getAllProjectType()
        {
            $db = new DB();
            $finish = array();

            $stmt = $db ->conn->prepare("SELECT id, name FROM projekt_type");
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false){
                while ($row = $result->fetch_object()) {
                    $type[] = new AllProjectTypeViewModel($row->id, $row->name);
                }

                $antalType = count($type);
                for ($i = 0; $i < $antalType; $i++) { 
                    $setType[] = [
                        "id" => $type[$i]->projectTypeId,
                        "name" => $type[$i]->projectTypeName
                    ];
                }

                array_push($finish, true, $setType);
            }
            else{
                array_push($finish);
            }
            return $finish;
            $stmt->close();
            $db->conn->close();
        }

        public function getOneProjectType($id)
        {
            $db = new DB();
            $finish = array();
            $type= null;

            $stmt = $db->conn->prepare("SELECT id, name FROM projekt_type WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false && $result->num_rows > 0){
                while ($row = $result->fetch_object()) {
                    $type = new ProjektTypes($row->id, $row->name, null);
                }
                array_push($finish, true, $type);
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
        public function postProjectType($type)
        {
            $db = new DB();

            $stmt = $db->conn->prepare("INSERT INTO projekt_type (name, category_id	) VALUES (?, ?)");
            
            $name = $type->getName();
            $typen = $type->getType();

            $stmt->bind_param("si", $name, $typen);
            $stmt->execute();

            $result = $stmt->affected_rows;

            if($result === 1){
                http_response_code(201);
                $finish = "Projekt Typen blev oprettet";
                echo $finish;
            }
            else{
                http_response_code(404);
                die("Projekt typen blev ikke oprettet");
            }

            $stmt->close();
            $db->conn->close();
        }

        /*********************************/
        /*              PUT              */
        /*********************************/
        public function putProjectType($type)
        {
            $db = new DB();

            $id = $type->getId();

            $stmt = $db->conn->prepare("UPDATE projekt_type SET name = ?, category_id = ? WHERE id = " . $id);

            $name = $type->getName();
            $typen = $type->getType();

            $stmt->bind_param("si", $name, $typen);
            $stmt->execute();

            if($stmt->execute() == true){
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
        public function deleteProejctType($id)
        {
            $db = new DB();

            $stmt = $db->conn->prepare("DELETE FROM projekt_type WHERE id = ?");
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
    }
?>  