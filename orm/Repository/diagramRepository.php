<?php
    include_once("../orm/class/db.php");
    include_once("../orm/class/Diagram.php");
    include_once("../orm/viewModel/diagram/oneDiagramViewModel.php");
    include_once("../orm/viewModel/diagram/allDiagramViewModel.php");

    class diagramRepository{
        /*********************************/
        /*             GET               */     
        /*********************************/
        // custom JSON format
        public function getAllDiagram()
        {
            $db = new DB();
            $finish = array();

            $stmt = $db->conn->prepare("SELECT id, name FROM diagrammer");
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false){
                while($row = $result->fetch_object()){
                    $getDiagram[] = new AllDiagramViewModel($row->id, $row->name);
                }

                $antalDiagram = count($getDiagram);
                for ($i = 0; $i < $antalDiagram; $i++) { 
                    $setDiagram[] = [
                        "id" => $getDiagram[$i]->diagramId,
                        "name" => $getDiagram[$i]->diagramName
                    ];
                }

                array_push($finish, true, $setDiagram);
            }
            else{
                array_push($finish, false);
            }
            return $finish;
            $stmt->close();
            $db->conn->close();
        }

        // custom JSON format
        public function getAllDiagramWithProjectId($id)
        {
            $db = new DB();
            $diagram = array();
            $finish = array();
            
            $stmt = $db->conn->prepare("SELECT diagrammer.name  FROM projekt
                                        INNER JOIN projekt_has_diagrammer ON projekt_has_diagrammer.projekt_id = projekt.id
                                        INNER JOIN diagrammer ON diagrammer.id = projekt_has_diagrammer.diagrammer_id
                                        WHERE projekt.id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false){
                while($row = $result->fetch_object()){
                    $getDiagram[] = new OneDiagramViewModel($row->name);
                }

                $antalDiagram = count($getDiagram);
                for ($i = 0; $i < $antalDiagram; $i++) { 
                    $setDiagram[] = [
                        "name" => $getDiagram[$i]->diagramName
                    ];
                }

                array_push($finish, true, $setDiagram);
            }
            else{
                array_push($finish, false);
            }
            return $finish;
            $stmt->close();
            $db->conn->close();
        }

        public function getAllInformationWithProjectId($id)
        {
            $db = new DB();
            $finish = array();

            $stmt = $db->conn->prepare("SELECT diagrammer.id, diagrammer.name FROM diagrammer
                                        INNER JOIN projekt_has_diagrammer ON projekt_has_diagrammer.diagrammer_id = diagrammer.id
                                        INNER JOIN projekt ON projekt.id = projekt_has_diagrammer.projekt_id
                                        WHERE projekt.id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false){
                while($row = $result->fetch_object()){
                    $getDiagram[] = new AllDiagramViewModel($row->id, $row->name);
                }

                $antalDiagram = count($getDiagram);
                for ($i = 0; $i < $antalDiagram; $i++) { 
                    $setDiagram[] = [
                        "id" => $getDiagram[$i]->diagramId,
                        "name" => $getDiagram[$i]->diagramName
                    ];
                }

                array_push($finish, true, $setDiagram);
            }
            else{
                array_push($finish, false);
            }
            return $finish;
            $stmt->close();
            $db->conn->close();
        }

        public function getOneDiagram($id)
        {
            $db = new DB();
            $diagram = null;
            $returnTrue = array();

            $stmt = $db->conn->prepare("SELECT id, name FROM diagrammer WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false && $result->num_rows > 0){
                while ($row = $result->fetch_object()) {
                    $diagram = new Diagrams($row->id, $row->name);
                }

                array_push($returnTrue, true, $diagram);
            }
            else{
                array_push($returnTrue, false);
            }
            return $returnTrue;
            $stmt->close();
            $db->conn->close();
        }

        public function checkDiagram($id)
        {
            $db = new DB();
            $diagram = array();
            $returnTrue = array();

            $stmt = $db->conn->prepare("SELECT diagrammer.id FROM diagrammer
                                        INNER JOIN projekt_has_diagrammer ON projekt_has_diagrammer.diagrammer_id = diagrammer.id
                                        INNER JOIN projekt ON projekt.id = projekt_has_diagrammer.projekt_id
                                        WHERE projekt.id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false && $result->num_rows > 0){
                while ($row = $result->fetch_object()) {
                    $diagram[] = new Diagrams($row->id, null);
                }

                $getDiagram = array();
                $antal = count($diagram);
                for ($i = 0; $i < $antal; $i++) { 
                    array_push($getDiagram, $diagram[$i]->getId());
                }
                array_push($returnTrue, true, $getDiagram);
            }
            else{
                array_push($returnTrue, false);
            }
            return $returnTrue;
            $stmt->close();
            $db->conn->close();
        }

        /*********************************/
        /*              POST             */
        /*********************************/
        public function postDiagram($diagram)
        {
            $db = new DB();

            $stmt = $db->conn->prepare("INSERT INTO diagrammer (name) VALUES (?)");

            $name = $diagram->getName();

            $stmt->bind_param("s", $name);
            $stmt->execute();

            $result = $stmt->affected_rows;

            if($result === 1){
                http_response_code(201);
                $finish = "Diagrammet blev oprettet";
                echo $finish;
            }
            else{
                http_response_code(404);
                die("Diagrammet blev ikke oprettet");
            }

            $stmt->close();
            $db->conn->close();
        }

        /*********************************/
        /*              PUT              */
        /*********************************/
        public function putDiagram($diagram)
        {
            $db = new DB();

            $id = $diagram->getId();

            $stmt = $db->conn->prepare("UPDATE diagrammer SET name = ? WHERE id =" . $id);
            
            $name = $diagram->getName();

            $stmt->bind_param("i", $id);
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
        public function deleteDiagram($id)
        {
            $db = new DB();

            $stmt = $db->conn->prepare("DELETE FROM diagrammer WHERE id = ?");
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