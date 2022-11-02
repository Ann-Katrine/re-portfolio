<?php
    include_once("../orm/class/db.php");
    include_once("../orm/class/Education.php");
    include_once("../orm/viewModel/education/educationViewModel.php");

    class educationRepository{
        /*********************************/
        /*             GET               */     
        /*********************************/
        //custom JSON format
        public function getAllEducation()
        {
            $db = new DB();
            $getEducation = array();
            $setEducation = array();
            $finish = array();

            $stmt = $db->conn->prepare("SELECT sted, tittel, start_date, end_date FROM education");
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false){
                while ($row = $result->fetch_object()) {
                    $getEducation[] = new educationViewModel($row->sted, $row->tittel, $row->start_date, $row->end_date);
                }

                $antalEducation = count($getEducation);
                for ($i = 0; $i < $antalEducation; $i++) { 
                    $setEducation[] = [
                        "sted" => $getEducation[$i]->educationSted,
                        "tittel" => $getEducation[$i]->educationTittel,
                        "startDate" => $getEducation[$i]->educationStartDate,
                        "endDate" => $getEducation[$i]->educationEndDate
                    ];
                }

                array_push($finish, true, $setEducation);
            }
            else{
                array_push($finish, false);
            }
            return $finish;
            $stmt->close();
            $db->conn->close();
        }

        public function getOneEducation($id)
        {
            $db = new DB();
            $education = null;

            $stmt = $db->conn->prepare("SELECT id, sted, tittel, start_date, end_date FROM education WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false && $result->num_rows > 0){
                while ($row = $result->fetch_object()) {
                    $education = new Educations($row->id, $row->sted, $row->tittel, $row->start_date, $row->end_date);
                }

                http_response_code(200);
                return $education;
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
        public function postEducation($education)
        {
            $db = new DB();

            $stmt = $db->conn->prepare("INSERT INTO education (name, start_date, end_date) VALUES (?, ? ,?)");

            $name = $education->getName();
            $startDate = $education->getStartDate();
            $endDate = $education->getEndDate();

            $stmt->bind_param("sss", $name, $startDate, $endDate);
            $stmt->execute();

            $result = $stmt->affected_rows;

            if($result === 1){
                http_response_code(201);
                $finish = "Uddannelsen blev oprettet";
                echo $finish;
            }
            else{
                http_response_code(404);
                die("Uddannelsen blev ikke oprettet");
            }

            $stmt->close();
            $db->conn->close();
        }

        /*********************************/
        /*              PUT              */
        /*********************************/
        public function putEducation($education)
        {
            $db = new DB();

            $id = $education->getId();

            $stmt = $db->conn->prepare("UPDATE education SET name = ?, start_date = ?, end_date = ? WHERE id =" . $id);

            $name = $education->getName();
            $startDate = $education->getStartDate();
            $endDate = $education->getEndDate();

            $stmt->bind_param("sss", $name, $startDate, $endDate);
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
        public function deleteEduaction($id)
        {
            $db = new DB();

            $stmt = $db->conn->prepare("DELETE FROM education WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->affected_rows;

            if($result === 1){
                http_response_code(200);
                $finish = "Uddannelsen blev slettet";
                echo $finish;
            }
            else{
                http_response_code(404);
                die("Uddannelsen blev ikke slettet");
            }

            $stmt->close();
            $db->conn->close();
        }
    }
?>