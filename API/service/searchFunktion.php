<?php 
    // gør at man for alle fejl frem 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include_once("./validering.php");
    include_once("../orm/Repository/service/searchRespository.php");

    class SearchFunktion{
        private $arrayVali = array();   // Til validering
        private $tabel = array();       // Til alle tabelnavne
        private $id = array();          // Til alle værdi'erne der skal sende med til sql'en
        
        // Alt til SQL'en
        private $select = "SELECT projekt.id FROM projekt ";
        private $innerJoin = "";
        private $where = "WHERE";
        private $groupBy = " GROUP BY projekt.id HAVING ";
        private $thingsAfterGroupBy = "";

        public function findRoute($value)
        {
            $vali = new Validering();

            array_push($this->arrayVali, $value);
            $result = $vali->notEmpty($this->arrayVali);
            if($result === true){

                $result = $vali->isString($value);
                if($result === true){
                    $result = $this->searchFunk($value);
                    return $result;
                }
                else{
                    http_response_code(400);
                    die("400 - bad request");
                }
            }
            else{
                http_response_code(400);
                die("400 - bad request");
            }
        }

        private function searchFunk($value)
        {
            $searchRepository = new SearchRespository();
            $search = explode("=", $value); // Deler search op efter "="
            $search = $search[1];

            $search = explode(",", $search); // Deler search op efter være "," så vi får de forskellige værdier i være for sig

            $countDiagram = 0; 
            $countLanguage = 0;
            $tempId = array();
            $tempDiagramId = "";
            $tempLanguageId = "";

            $countSearch = count($search); 
            for ($i = 0; $i < $countSearch; $i++) { // Deler tabelNavn og id op efter "-"
               
                $tempSearch = explode("-", $search[$i]); 

                // Til at finde tabel navne
                if(count($this->tabel) != 0){ // For hvis der er flere der har det samme tabel navn

                    $count = count($this->tabel);
                    $tempTal = 0;
                    for ($j = 0; $j < $count; $j++) {  // Kigger $this->tabel igennem for at se om der alledere står det tabel navn man har i array'et
                        if($tempSearch[0] == $this->tabel[$j]){
                            $tempTal++;
                        }
                    }
                    if($tempTal === 0){
                        array_push($this->tabel, $tempSearch[0]);
                    }
                }
                else{ // For hvis der kun er et af det samme tabel navn
                    array_push($this->tabel, $tempSearch[0]);
                }

                // For at finde ud af diagrammer og sprogs id'et
                if($tempSearch[0] == "diagrammer" || $tempSearch[0] == "sprog"){

                    if($tempSearch[0] == "diagrammer"){

                        if($tempDiagramId === ""){

                            $tempDiagramId = $tempSearch[1];
                            array_push($tempId, $tempSearch[1]);
                        }
                        else{
                            $tempDiagramId .= "," . $tempSearch[1];
                        }
                        $countDiagram++;
                    }
                    else if($tempSearch[0] == "sprog"){

                        if($tempLanguageId === ""){

                            $tempLanguageId = $tempSearch[1];
                            array_push($tempId, $tempSearch[1]);
                        }
                        else{
                            $tempLanguageId .= "," . $tempSearch[1];
                        }
                        $countLanguage++;
                    }
                }
                // array_push($this->id, $tempSearch[1]);
                array_push($this->id, intval($tempSearch[1]));
            }


            // For at finde ud af hvilke sætninger der skal bruges
            $countTabel = count($this->tabel);
            for ($i = 0; $i < $countTabel; $i++) { 
                switch ($this->tabel[$i]) {
                    case 'projekt_type':
                        if($this->where === "WHERE"){
                            $this->where .= " projekt.projekt_type_id = ?";
                        }
                        else{
                            $this->where .= " AND projekt.projekt_type_id = ?";
                        }
                        break;
                    case 'arbejds_type':
                        if($this->where === "WHERE"){
                            $this->where .= " projekt.arbejds_type_id = ?";
                        }
                        else{
                            $this->where .= " AND projekt.arbejds_type_id = ?";
                        }
                        break;
                    case 'software':
                        if($this->where === "WHERE"){
                            $this->where .= " projekt.software_id = ?";
                        }
                        else{
                            $this->where .= " AND projekt.software_id = ?";
                        }
                        break;
                    case 'diagrammer':
                        if($this->innerJoin === ""){
                            $this->innerJoin .= "INNER JOIN projekt_has_diagrammer ON projekt_has_diagrammer.projekt_id = projekt.id INNER JOIN diagrammer ON diagrammer.id = projekt_has_diagrammer.diagrammer_id";
                        }
                        else{
                            $this->innerJoin .= " INNER JOIN projekt_has_diagrammer ON projekt_has_diagrammer.projekt_id = projekt.id INNER JOIN diagrammer ON diagrammer.id = projekt_has_diagrammer.diagrammer_id";
                        }

                        if($this->where === "WHERE"){

                            $addQuestenmark = "";
                            for ($j = 0; $j < $countDiagram; $j++) { 

                                if($addQuestenmark === ""){
                                    $addQuestenmark = "?";
                                }
                                else{
                                    $addQuestenmark .= ",?";
                                }
                            }
                            $this->where .= " diagrammer.id IN(" . $addQuestenmark . ")";
                        }
                        else{
                            $addQuestenmark = "";
                            for ($j = 0; $j < $countDiagram; $j++) { 

                                if($addQuestenmark === ""){
                                    $addQuestenmark = "?";
                                }
                                else{
                                    $addQuestenmark .= ",?";
                                }
                            }
                            $this->where .= " AND diagrammer.id IN(" . $addQuestenmark . ")";
                        }

                        if($this->thingsAfterGroupBy === ""){
                            $this->thingsAfterGroupBy .= "COUNT(DISTINCT diagrammer.id) = ?";
                        }
                        else{
                            $this->thingsAfterGroupBy .= " AND COUNT(DISTINCT diagrammer.id) = ?";
                        }
                        break;
                    case 'sprog':
                        if($this->innerJoin === ""){
                            $this->innerJoin .= "INNER JOIN projekt_has_sprog ON projekt_has_sprog.projekt_id = projekt.id INNER JOIN sprog ON sprog.id = projekt_has_sprog.sprog_id";
                        }
                        else{
                            $this->innerJoin .= " INNER JOIN projekt_has_sprog ON projekt_has_sprog.projekt_id = projekt.id INNER JOIN sprog ON sprog.id = projekt_has_sprog.sprog_id";
                        }
                        if($this->where === "WHERE"){

                            $addQuestenmark = "";
                            for ($j = 0; $j < $countLanguage; $j++) { 

                                if($addQuestenmark === ""){
                                    $addQuestenmark = "?";
                                }
                                else{
                                    $addQuestenmark .= ",?";
                                }
                            }
                            $this->where .= " sprog.id IN(" . $addQuestenmark . ")";
                        }
                        else{
                            $addQuestenmark = "";
                            for ($j = 0; $j < $countLanguage; $j++) { 

                                if($addQuestenmark === ""){
                                    $addQuestenmark = "?";
                                }
                                else{
                                    $addQuestenmark .= ",?";
                                }
                            }
                            $this->where .= " AND sprog.id IN(" . $addQuestenmark . ")";
                        }

                        if($this->thingsAfterGroupBy === ""){
                            $this->thingsAfterGroupBy .= "COUNT(DISTINCT sprog.id) = ?";
                        }
                        else{
                            $this->thingsAfterGroupBy .= " AND COUNT(DISTINCT sprog.id) = ?";
                        }
                        break;
                }
            }

            // Hvis diagrammer eller sprog er med i sætningen
            if($this->thingsAfterGroupBy != ""){

                for ($i = 0; $i < $countTabel; $i++) {

                    if($this->tabel[$i] === "diagrammer"){
                        array_push($this->id, $countDiagram);
                    }
                    else if($this->tabel[$i] === "sprog"){
                        array_push($this->id, $countLanguage);
                    }
                }
            }

            // Laver selve SQL sætningen
            $eneligSQL = $this->select;
            if($this->innerJoin != ""){
                $eneligSQL .= $this->innerJoin . " ";
            }
            $eneligSQL .= $this->where;
            if($this->thingsAfterGroupBy != ""){
                $eneligSQL .= $this->groupBy . $this->thingsAfterGroupBy;
            }

            $result = $searchRepository->findeRoute($eneligSQL, $this->id);
            return $result;
        }
    }
?>