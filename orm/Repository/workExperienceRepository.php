<?php
    include_once("../orm/class/db.php");
    include_once("../orm/class/WorkExperience.php");
    include_once("../orm/viewModel/workExperience/workExperienceViewModel.php");

    class workExperienceRepository{
        /*********************************/
        /*             GET               */     
        /*********************************/
        // custom JSON format
        public function getAllWorkExperience()
        {
            $db = new DB();
            $getExperience = "";
            $setExperience = array();
            $finish = array();

            $stmt = $db->conn->prepare("SELECT sted, tittel, start_date, end_date FROM work_experience");
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false){
                while($row = $result->fetch_object()){
                    $getExperience = new WorkExperienceViewModel($row->sted, $row->tittel, $row->start_date, $row->end_date);
                }

                $setExperience[] = [
                    "sted" => $getExperience->workExperienceSted,
                    "tittel" => $getExperience->workExperienceTittel,
                    "startDate" => $getExperience->workExperienceStartDate,
                    "endDate" => $getExperience->workExperienceEndDate
                ];

                array_push($finish, true, $setExperience);
            }
            else{
                array_push($finish, false);
            }
            return $finish;
            $stmt->close();
            $db->conn->close();
        }

        public function getOneWorkExperience($id)
        {
            $db = new DB();
            $experience = null;

            $stmt = $db->conn->prepare("SELECT id, sted, tittel, start_date, end_date FROM work_experience WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false && $result->num_rows >0){
                while($row = $result->fetch_object()){
                    $experience = new WorkExperiences($row->id, $row->sted, $row->titel, $row->start_date, $row->end_date);
                }

                http_response_code(200);
                return $experience;
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
        public function postWorkExperience($experience)
        {
            $db = new DB();

            $stmt = $db->conn->prepare("INSERT INTO work_experience (name, start_date, end_date) VALUES (?, ?, ?)");
            
            $name = $experience->getName();
            $startDate = $experience->getStartDate();
            $endDate = $experience->getEndDate();

            $stmt->bind_param("sss", $name, $startDate, $endDate);
            $stmt->execute();

            $result = $stmt->affected_rows;

            if($result === 1){
                http_response_code(201);
                $finish = "Erhvervserfaringen blev oprettet";
                echo $finish;
            }
            else{
                http_response_code(404);
                die("Erhvervserfaringen blev ikke oprettet");
            }

            $stmt->close();
            $db->conn->close();
        }

        /*********************************/
        /*              PUT              */
        /*********************************/
        public function putWorkExperience($experience)
        {
            $db = new DB();

            $id = $experience->getId();

            $stmt = $db->conn->prepare("UPDATE work_experience SET name = ?, start_date = ?, end_date = ? WHERE id =" . $id);
            
            $name = $experience->getName();
            $startDate = $experience->getStartDate();
            $endDate = $experience->getEndDate();

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
        public function deleteWorkExperience($id)
        {
            $db = new DB();

            $stmt = $db->conn->prepare("DELETE FROM work_experience WHERE id = ?");
            $stmt->bind_param("i", $id);

            $result = $stmt->affected_rows;

            if($result === 1){
                http_response_code(200);
                $finish = "Erhvervserfaringen blev slettet";
                echo $finish;
            }
            else{
                http_response_code(404);
                die("Erhvervserfaringen blev ikke slettet");
            }

            $stmt->close();
            $db->conn->close();
        }
    }
?>