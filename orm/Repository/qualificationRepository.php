<?php
    include_once("../orm/Class/db.php");
    include_once("../orm/Class/Qualifications.php");
    include_once("../orm/viewModel/qualification/AllQualifivationsViewModel.php");

    class qualificationRepsoitory{
        /*********************************/
        /*             GET               */     
        /*********************************/
        //custom JSON format
        public function getAllQualification()
        {
            $db = new DB();
            $getQualification = array();
            $finish = array();

            $stmt = $db->conn->prepare("SELECT name FROM qualifications");
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false){
                while ($row = $result->fetch_object()) {
                    $qualificationName[] = new AllQualificationsViewModel($row->name);
                }

                $antalQualification = count($qualificationName);
                for ($i = 0; $i < $antalQualification; $i++) { 
                    $getQualification[] = [
                        "name" => $qualificationName[$i]->QualificationName
                    ];
                }

                array_push($finish, true, $getQualification);

                return $finish;
            }
            else{
                array_push($finish, false);
                return $finish;
            }

            $stmt->close();
            $db->conn->close();
        }

        public function getOneQualification($id)
        {
            $db = new DB();
            $qualification = null;

            $stmt = $db->conn->prepare("SELECT id, name FROM qualifications WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false && $result->num_rows > 0){
                while ($row = $result->fetch_object()) {
                    $qualification = new Qualifications($row->id, $row->name);
                }

                http_response_code(200);
                return $qualification;
            }
            else{
                http_response_code(404);
                return false;
            }

            $stmt->close();
            $db->conn->close();
        }

        /*********************************/
        /*              POST             */
        /*********************************/
        public function postQualification($qualification)
        {
            $db = new DB();

            $stmt = $db->conn->prepare("INSERT INTO qualification (name) VALUES (?)");
            
            $name = $qualification->getName();

            $stmt->bind_param("s", $name);
            $stmt->execute();

            $result = $stmt->affected_rows;

            if($result === 1){
                http_response_code(201);
                $finish = "Skills'en blev oprettet";
                echo $finish;
            }
            else{
                http_response_code(404);
                die("Skills'en blev ikke oprettet");
            }

            $stmt->close();
            $db->conn->close();
        }

        /*********************************/
        /*              PUT              */
        /*********************************/
        public function putQualification($qualification)
        {
            $db = new DB();

            $id = $qualification->getId();

            $stmt = $db->conn->prepare("UPDATE qualification SET name = ? WHERE id =" . $id);

            $name = $qualification->getName();

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
        public function deleteQualification($id)
        {
            $db = new DB();

            $stmt = $db->conn->prepare("DELETE FROM qualification WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->affected_rows;

            if($result === 1){
                http_response_code(200);
                $finish = "Skills'en blev slettet";
                echo $finish;
            }
            else{
                http_response_code(404);
                die("Skills'en blev ikke slettet");
            }

            $stmt->close();
            $db->conn->close();
        }
    }
?>