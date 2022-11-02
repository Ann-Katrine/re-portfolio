<?php
    include_once("../orm/class/db.php");
    include_once("../orm/class/WorkType.php");
    include_once("../orm/viewModel/workType/oneWorkTypeViewModel.php");
    include_once("../orm/viewModel/workType/allWorkTypeViewModel.php");

    class workTypeRepository{
        /*********************************/
        /*             GET               */     
        /*********************************/
        // custom JSON format
        public function getAllWorkType()
        {
            $db = new DB();
            $finish = array();

            $stmt = $db->conn->prepare("SELECT id, name FROM arbejds_type");
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false){
                while ($row = $result->fetch_object()) {
                    $type[] = new AllWorkTypeViewModel($row->id, $row->name);
                }

                $antalType = count($type);
                for ($i = 0; $i < $antalType; $i++) { 
                    $setType[] = [
                        "id" => $type[$i]->workTypeId,
                        "name" => $type[$i]->workTypeName
                    ];
                }

                array_push($finish, true, $setType);
            }
            else{
                array_push($finish, false);
            }
            return $finish;
            $stmt->close();
            $db->conn->close();
        }

        public function getOneWorkType($id)
        {
            $db = new DB();
            $type = null;

            $stmt = $db->conn->prepare("SELECT id, name FROM arbejds_type WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false && $result->num_rows > 0){
                return true;
            }
            else{
                return false;
            }
            $stmt->close();
            $db->conn->close();
        }

        /*********************************/
        /*              POST             */
        /*********************************/
        public function postWorkType($workType)
        {
            $db = new DB();

            $stmt = $db->conn->prepare("INSERT INTO arbejds_type (name) VALUES (?)");

            $name = $workType->getName();

            $stmt->bind_param("s", $name);
            $stmt->execute();

            $result = $stmt->affected_rows;

            if($result === 1){
                http_response_code(201);
                $finish = "Arbejdets typen blev oprettet";
                echo $finish;
            }
            else{
                http_response_code(404);
                die("Arbejdets typen blic ikke oprettet");
            }
            $stmt->close();
            $db->conn->close();
        }

        /*********************************/
        /*              PUT              */
        /*********************************/
        public function putWorkType($type)
        {
            $db = new DB();

            $id = $type->getId();

            $stmt = $db->conn->prepare("UPDATE arbejds_type SET name = ? WHERE id =". $id);
            
            $name = $type->getName();

            $stmt->bind_param("s", $name);
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
        public function deleteWorkType($id)
        {
            $db = new DB();

            $stmt = $db->conn->prepare("DELETE FROM arbejds_type WHERE id = ?");
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