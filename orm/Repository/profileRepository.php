<?php
    include_once("../orm/class/db.php");
    include_once("../orm/class/Profile.php");
    include_once("../orm/viewModel/profile/ProfileViewModel.php");

    class profilRepository{
        /*********************************/
        /*             GET               */     
        /*********************************/
        //custom JSON format
        public function getAllProfile()
        {
            $db = new DB();
            $getProfile =  array();
            $setProfile = array();
            $finish = array();

            $stmt = $db->conn->prepare("SELECT teskt FROM about_me");
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false){
                while ($row = $result->fetch_object()) {
                    // $profile[] = new Profiles($row->id, $row->teskt);
                    $getProfile[] = new ProfileViewModel($row->teskt);
                }

                $antalProfiles = count($getProfile);
                for ($i = 0; $i < $antalProfiles; $i++) { 
                    $setProfile[] = [
                        "tekst" => $getProfile[$i]->profileTekst
                    ];
                }

                array_push($finish, true, $setProfile);
            
                return $finish;
            }
            else{
                array_push($finish, false);
                return $finish;
            }

            $stmt->close();
            $db->conn->close();
        }

        public function getOneProfile($id)
        {
            $db = new DB();

            $stmt = $db->conn->prepare("SELECT id, teskt FROM about_me WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false && $result->num_rows > 0){
                while ($row = $result->fetch_object()) {
                    $profile = new Profiles($row->id, $row->name);
                }
            
                http_response_code(200);
                return $profile;
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
        public function postProfile($profile)
        {
            $db = new DB();

            $stmt = $db->conn->prepare("INSERT INTO about_me (name) VALUES (?)");
            
            $name = $profile->getName();

            $stmt->bind_param("s", $name);
            $stmt->execute();

            $result = $stmt->affected_rows;

            if($result === 1){
                http_response_code(201);
                $finish = "Kort tekst blev oprettet";
                echo $finish;
            }
            else{
                http_response_code(404);
                $finish = "Kort tekst blev ikke oprettet";
            }

            $stmt->close();
            $db->conn->close();
        }

        /*********************************/
        /*              PUT              */
        /*********************************/
        public function putProfile($profile)
        {
            $db = new DB();

            $id = $profile->getId();

            $stmt = $db->conn->prepare("UPDATE about_me SET name = ? WHERE id =" . $id);
            
            $name = $profile->getName();

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
        public function deleteProfile($id)
        {
            $db = new DB();

            $stmt = $db->conn->prepare("DELETE FROM about_me WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->affected_rows;

            if($result === 1){
                http_response_code(200);
                $finish = "Kort tekst blev slettet";
                echo $finish;
            }
            else{
                http_response_code(404);
                die("Kort tekst blev ikek slettet");
            }

            $stmt->close();
            $db->conn->close();
        }
    }
?>