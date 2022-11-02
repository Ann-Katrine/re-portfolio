<?php 
    include_once("../orm/Class/db.php");
    include_once("../orm/Class/Project.php");

    class SearchRespository{
        /*********************************/
        /*             GET               */     
        /*********************************/
        public function findeRoute($sql, $values)
        {
            $result = $this->searchFunktion($sql, $values);
            return $result;
        }

        private function searchFunktion($sql, $values)
        {
            $db = new DB();
            $finish = array();
            $project = array();

            $stmt = $db->conn->prepare($sql);

            $tegn = "";
            $antal = count($values);
            for ($i = 0; $i < $antal;$i++) { 
                $tegn .= "i";
            }

            $stmt->bind_param($tegn,...$values);

            $stmt->execute();
            $result = $stmt->get_result();


            if($result != false){
                while ($row = $result->fetch_object()) {
                    $project[] = new Projects($row->id, null, null, null, null, null, null, null, null, null, null, null);
                }

                array_push($finish, true, $project);
            }
            else{
                array_push($finish, false);
            }
            return $finish;
            $stmt->close();
            $db->conn->close();
        }
    }
?>