<?php
    include_once("../orm/class/db.php");
    include_once("../orm/class/Software.php");
    include_once("../orm/viewModel/software/oneSoftwareViewModel.php");
    include_once("../orm/viewModel/software/AllSoftwareViewModel.php");

    class softwareRespository{
        /*********************************/
        /*             GET               */     
        /*********************************/
        // custom JSON format
        public function getAllSoftware()
        {
            $db = new DB();
            $finish = array();

            $stmt = $db->conn->prepare("SELECT id, name FROM software");
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false){
                while ($row = $result->fetch_object()) {
                    $software[] = new AllSoftwareViewModel($row->id, $row->name);
                }

                $antalSoftware = count($software);
                for ($i = 0; $i < $antalSoftware; $i++) { 
                    $setSoftware[] = [
                        "id" => $software[$i]->softwareId,
                        "name" => $software[$i]->softwareName
                    ];
                }

                array_push($finish, true, $setSoftware);
            }
            else{
                array_push($finish, false);
            }
            return $finish;
            $stmt->close();
            $db->conn->close();
        }

        public function getOneSoftware($id)
        {
            $db = new DB();
            $software = null;

            $stmt = $db->conn->prepare("SELECT id, name FROM software WHERE id = ?");
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
        public function postSoftware($software)
        {
            $db = new DB();

            $stmt = $db->conn->prepare("INSERT INTO software (name) VALUES (?)");
            
            $name = $software->getName();

            $stmt->bind_param("s", $name);
            $stmt->execute();

            $result = $stmt->affected_rows;

            if($result === 1){
                http_response_code(201);
                $finish = "Software'en blec oprettet";
                echo $finish;
            }
            else{
                http_response_code(404);
                die("Software'en blev ikke oprettet");
            }

            $stmt->close();
            $db->conn->close();
        }


        /*********************************/
        /*              PUT              */
        /*********************************/
        public function putSoftware($software)
        {
            $db = new DB();

            $id = $software->getId();

            $stmt = $db->conn->prepare("UPDATE software SET name  = ? WHERE id =" . $id);

            $name = $software->getName();

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
        public function deleteSoftware($id)
        {
            $db = new DB();

            $stmt = $db->conn->prepare("DELETE FROM software WHERE id = ?");
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