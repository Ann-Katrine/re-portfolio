<?php 
    // gør at man for alle fejl frem 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include_once("./DELETE.php"); // midlertidig til jeg har en fejl Class
    include_once("./validering.php");
    include_once("../orm/Repository/billedeRepository.php");
    include_once("../orm/Repository/diagramRepository.php");
    include_once("../orm/Repository/educationRepository.php");
    include_once("../orm/Repository/profileRepository.php");
    include_once("../orm/Repository/projectRepository.php");
    include_once("../orm/Repository/projektTypeRepository.php");
    include_once("../orm/Repository/qualificationRepository.php");
    include_once("../orm/Repository/softwareRepsoitory.php");
    include_once("../orm/Repository/sprogRepository.php");
    include_once("../orm/Repository/workExperienceRepository.php");
    include_once("../orm/Repository/workTypeRepository.php");
    include_once("../orm/Repository/billedeProjectRepository.php");

    class POST{
        private $arrayVali = array();
        private $countUri = 0;
        private $header;

        public function findRoute($uri, $headers, $contentType)
        {
            if(in_array("application/json", $headers)){
                $this->header = $headers;

                switch ($uri[1]) {
                    case 'diagram':
                        $this->diagramRoute($uri); 
                        break;
                    case 'education':
                        $this->educationRoute($uri); 
                        break;
                    case 'projekt':
                        $result = $this->projektRoute($uri, $contentType); 
                        return $result;
                        break;
                    case 'projekt-type':
                        $this->projektTypeRoute($uri); 
                        break;
                    case 'qualification':
                        $this->qualificationRoute($uri); 
                        break;
                    case 'software':
                        $this->softwareRoute($uri); 
                        break;
                    case 'language':
                        $this->languageRoute($uri); 
                        break;
                    case 'work-experience':
                        $this->workExperienceRoute($uri); 
                        break;
                    case 'work-type':
                        $this->workTypeRoute($uri); 
                        break;
                    default:
                        http_response_code(400);
                        die("400 - bad request method!");
                        break;
                }
            }
            else{
                http_response_code(412);
				die('412 - Wrong Accept type. Only JSON supported!');
            }
        }

        private function imagesRoute($data) // skal muligvis laves noget om
        {
            $images = new ImagesRepository();
            $vali = new Validering();
            
            $name = $data[0];
            $des = $data[1];

            array_push($this->arrayVali, $name, $des);
            $result = $vali->notEmpty($this->arrayVali);

            if($result == true){
                
                $this->arrayVali = array();
                array_push($this->arrayVali, $name, $des);
                $length = array(45, 500);
                $result = $vali->isLenght($this->arrayVali, $length);
                if($result == true){
                    
                    $image = new Images(0, $name, $des);
                    $picture = $images->postImages($image);
                    
                    return $picture;
                }
                else{
                    http_response_code(400);
                    return false;
                }
            }
            else{
                http_response_code(404);
                return false;
            }
        }

        private function diagramRoute($uri)
        {
            $data = json_decode(file_get_contents('php://input'), true); // til raw
            
            $diagram = new diagramRepository();
            $vali = new Validering();

            $values = array("name");
            $result = $vali->thingsExist2Values($data, $values);

            if($result == true){
                $name = $data["name"];

                array_push($this->arrayVali, $name);
                $result = $vali->notEmpty($this->arrayVali);
                if($result == true){
                    
                    $this->arrayVali = array();
                    array_push($this->arrayVali, $name);
                    $length = array(45);
                    $result = $vali->isLenght($this->arrayVali, $length);
                    if($result == true){
                        $diagrammer = new Diagrams(0, $name);
                        $diagram->postDiagram($diagrammer);
                        echo json_encode("Diagammet blev oprettet");
                    }
                    else{
                        http_response_code(400);
                        die("400 - En af længderne er forkerte");
                    }
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

        private function educationRoute($uri)
        {
            $data = json_decode(file_get_contents('php://input'), true); // til raw

            $education = new educationRepository();
            $vali = new Validering();
            
            $values = array("name", "startDate", "endDate");
            $result = $vali->thingsExist2Values($data, $values);

            if($result == true){
                
                $name = $data["name"];
                $startDate = $data["startDate"];
                $endDate = $data["endDate"];

                array_push($this->arrayVali, $name, $startDate, $endDate);
                $result = $vali->notEmpty($this->arrayVali);
                if($result === true){
                    
                    $this->arrayVali = array();
                    array_push($this->arrayVali, $name, $startDate, $endDate);
                    $length = array(100, 10, 10);
                    $result = $vali->isLenght($this->arrayVali, $length);
                    if($result === true){

                        $educations = new Educations(0, $name, $startDate, $endDate);
                        $education->postEducation($educations);
                        echo json_encode("Uddannelsen blev tilføjet");
                    }
                    else{
                        http_response_code(400);
                        die("400 - En af længderne er forkerte");
                    }
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

        private function projektRoute($uri, $contentType)
        {
            $data = json_decode(file_get_contents('php://input'), true); // til raw
            $projekt = new projectRepository();
            $billedeProject = new ImagesProjectRepository();
            $billederRep = new ImagesRepository();
            $diagramRep = new diagramRepository();
            $languageRep = new LanguageRepository();
            $delete = new DELETE();

            $vali = new Validering();

            $this->countUri = count($uri);
        
            /* 
            {
                "name": "test",
                "favorite": 2,
                "date": "2021-08-02",
                "description": "test 1 2 3 4",
                "startDate": "2021-08-02",
                "endDate": "2021-08-03",
                "software": 1,
                "projektType": 1,
                "workType": 1,
                "language": 1,
                "diagram": 1,
                "images": {
                    hej,
                    hejsa,
                    heii
                }
            }
            */
            if($this->countUri == 3){
                if(in_array("application/json", $contentType)){ // application/json er raw body type
                    
                    $values = array("name", "favorite", "date", "description", "startDate", "endDate", "software", "projektType", "workType", "language", "diagram", "images");
                    $result = $vali ->thingsExist2Values($data, $values);

                    if($result === true){ // tjekker om alle tingene der skal sendes med er sendt med

                        $name = $data["name"];
                        $fav = $data["favorite"]; 
                        $uploadDate = $data["date"];
                        $des = $data["description"];
                        $sDate = $data["startDate"];
                        $eDate = $data["endDate"];
                        $software = $data["software"];
                        $projektType = $data["projektType"];
                        $workType = $data["workType"];
                        $language = $data["language"];
                        $diagram = $data["diagram"];
                        $images = $data["images"];
                        
                        array_push($this->arrayVali, $name, $fav, $uploadDate, $des, $sDate, $eDate, $software, $projektType, $workType, $language, $diagram, $images);
                        $result = $vali->notEmpty($this->arrayVali);
                        if($result === true){ // tjekker om alle værdierne ikke er tomme 
                            
                            $date1 = strtotime($eDate) - strtotime($sDate);
                            if($date1 >= 0){

                                $this->arrayVali = array();
                                array_push($this->arrayVali, $fav);
                                $result = $vali->isNumeric($this->arrayVali);
                                if($result === true){ // tjekker nogle af værdierne igennem for om de er tal

                                    $this->arrayVali = array();
                                    array_push($this->arrayVali, $images);
                                    $result = $vali->isArray($this->arrayVali);     
                                    
                                    if($result === true){ // tjekker om $images er et array
                                        
                                        $imagesSti = array();
                                        $imagesName = array();
                                        $imagesCategory = array();
                                        
                                        $antal = count($images);
                                        for ($i = 0; $i < $antal; $i++) { 
                                            array_push($imagesSti, $images[$i][0]);
                                            array_push($imagesName, $images[$i][1]);
                                            array_push($imagesCategory, $images[$i][2]);
                                        }

                                        $ImagesTal = array(1, 2, 3, 4);
                                        $result = $vali->inArray($imagesCategory, $ImagesTal);

                                        if($result === true){ // tjekker om $images indholder 1,2,3,4
                                            
                                            $tal = 0;
                                            $findDuplivate = array_count_values(array_column($images, 2));
                                            for ($i=1; $i < 4; $i++) { 
                                                if($findDuplivate[$i] > 1){
                                                    $tal++;
                                                }
                                            }

                                            if($tal == 0){ // tjekker om det kun er 4 der er flere af

                                                $antalImages = count($images);
                                                $tal = 0;
                                                $imagesId = array();

                                                for ($i = 0; $i < $antalImages; $i++) { 
                                                    $postImages = $this->imagesRoute($images[$i]);

                                                    if($postImages[0] === true){ // tjekker om billedet blev oprettet
                                                        $tal++;
                                                        array_push($imagesId, $postImages[1]);
                                                    }
                                                }

                                                if($tal == $antalImages){ // tjekker om alle billeder blev oprettet

                                                    $fav = intval($fav);
                                                    if($fav == 1 || $fav == 2){ // tjekker om favorit er 1 eller 2

                                                        if($fav == 1){ // tjekker om favorit er 1
                                                            $checkFavorite = $projekt->getFavoritProjekt();
                                                            if(is_array($checkFavorite) == true){ // tjekker om der allerede findes en favorite                                                                ekker om jeg får en fejl tilbage
                                                                http_response_code(406);
                                                                die("Du kan ikke oprette en mere favorite, der findes allerde en i systemmet");
                                                            }
                                                        }

                                                        $this->arrayVali = array();
                                                        array_push($this->arrayVali, $name, $fav, $uploadDate, $des, $sDate, $eDate);
                                                        
                                                        $length = array(45, 1, 10, 500, 10, 10);
                                                        $result = $vali->isLenght($this->arrayVali, $length);
                                                        
                                                        if($result === true){ // tjekker nogle af væridernes længder

                                                            $software = intval($software);
                                                            $projektType = intval($projektType);
                                                            $workType = intval($workType);

                                                            $projects = new Projects(0, $name, $fav, $uploadDate, $des, $sDate, $eDate, $software, $projektType, $workType, null, null, null);
                                                            $postProjekt = $projekt->postProjekt($projects);
                                                            
                                                            if($postProjekt[0] === true){ // tjekker om projekt blev oprettet

                                                                $this->arrayVali = array();
                                                                array_push($this->arrayVali, $images, $language, $diagram);
                                                                $manyToManyLength = count($this->arrayVali) + 1;
                                                                $errorMessages = "";

                                                                for ($i = 1; $i < $manyToManyLength; $i++) { 

                                                                    switch ($i) {
                                                                        case $i == 1: // billeder
                                                                            $tal = 0;

                                                                            for ($j = 0; $j < $antalImages; $j++) { 

                                                                                $getBilleder = $billederRep->getOneImagesWithName($imagesId[$j]);
                                                                                if($getBilleder[0] == true){
                                                                                    $tal++;
                                                                                    $postImages = $billedeProject->postImagesProject($imagesId[$j], $postProjekt[1], $images[$j][2]);
                                                                                }
                                                                            }
                                                                            
                                                                            if($tal != $antalImages){

                                                                                http_response_code(404);
                                                                                $errorMessages .= "Der var en eller flere af billederne der ikke kunne findes.";
                                                                            }
                                                                            break;
                                                                        case $i == 2: // sprog
                                                                            $tal = 0;

                                                                            $this->arrayVali = array();
                                                                            array_push($this->arrayVali, $language);
                                                        
                                                                            $result = $vali->isArray($this->arrayVali);
                                                                            if($result == false){

                                                                                $getLangeuages = $languageRep->getOneLanguage(intval($language));
                                                                                
                                                                                
                                                                                if($getLangeuages[0] != false){
                                                                                    $tal++;
                                                                                    $postLanguage = $projekt->postSprogProjekt($postProjekt[1], $getLangeuages[1]);
                                                                                    
                                                                                }
                                                                                else{
                                                                                    $errorMessages .= "Sproget blev ikke fundet.";
                                                                                }
                                                                            }
                                                                            else{
                                                                                
                                                                                $antalLanguage = count($language);
                                                                                for ($j = 0; $j < $antalLanguage; $j++) { 

                                                                                    $getLangeuages = $languageRep->getOneLanguage($language[$j]);
                                                                                    if($getLangeuages[0] === true){

                                                                                        $tal++;
                                                                                        $postLanguage = $projekt->postSprogProjekt($postProjekt[1], $getLangeuages[1]);
                                                                                    }
                                                                                }

                                                                                if($tal != $antalLanguage){
                                                                                    $errorMessages .= "Der var en eller flere af Sprogerne blev ikke fundet.";
                                                                                }
                                                                            }
                                                                            break;
                                                                        case $i == 3: // diagram
                                                                            $tal = 0;
                                                                            
                                                                            $this->arrayVali = array();
                                                                            array_push($this->arrayVali, $diagram);
                                                        
                                                                            $result = $vali->isArray($this->arrayVali);
                                                                            
                                                                            if($diagram == false){
                                                                                $getDiagram = $diagramRep->getOneDiagram($diagram);
                                                                                
                                                                                if($getDiagram != false){
                                                                                    $tal++;
                                                                                    $postdiagram = $projekt->postDiagramProjekt($postProjekt[1], intval($diagram));
                                                                                }
                                                                                else{
                                                                                    $errorMessages .= "Diagrammet blev ikke fundet.";
                                                                                }
                                                                            }
                                                                            else{
                                                                                $antaldiagram = count($diagram);
                                                                                for ($j = 0; $j < $antaldiagram; $j++) { 
                                                                                    $getDiagram = $diagramRep->getOneDiagram(intval($diagram[$j]));
                                                                                    
                    
                                                                                    if($getDiagram[0] == true){
                                                                                        $tal++;
                                                                                        $postdiagram = $projekt->postDiagramProjekt($postProjekt[1], $getDiagram[1]);
                                                                                    }
                                                                                }
                    
                                                                                if($tal != $antaldiagram){
                                                                                    $errorMessages .= "Der  en eller flere af diagrammerne blev ikke fundet.";
                                                                                }
                                                                            }
                                                                    }
                                                                }
                                                                if($errorMessages == ""){

                                                                    http_response_code(201);
                                                                    echo json_encode("Projekt blev succesful oprettet");
                                                                }
                                                                else{
                                                                    // $tal = 0;

                                                                    // $antalImages = count($imagesId);
                                                                    // for ($i = 0; $i < $antalImages; $i++) { 
                                                                        
                                                                    //     $fejlArray1 = [];
                                                                    //     $fejlArray1 = array("fejl", "images-project", $imagesId[$i]);
                                                                    //     $result = $delete->findRoute($fejlArray1, $this->header);

                                                                    //     if($result === true){
                                                                            
                                                                    //         $fejlArray = [];
                                                                    //         $fejlArray = array("fejl", "images", $imagesId[$i]);
                                                                    //         $result = $delete->findRoute($fejlArray, $this->header);
                                                                    //         if($result === true){
                                                                    //             $tal++;
                                                                    //         }
                                                                    //     }

                                                                    // }

                                                                    // if($tal === $antalImages){
                                                                    //     var_dump("jep fik alle billeder");
                                                                    // }
                                                                
                                                                    // $fejlArray = [];
                                                                    // $fejlArray = array("fejl", "projekt", "language-project", $postProjekt[1]);
                                                                    // $result = $delete->findRoute($fejlArray, $this->header);

                                                                    // if($result === true){
                                                                    //     var_dump("jep fik alle sprog");
                                                                    // }

                                                                    // $fejlArray = [];
                                                                    // $fejlArray = array("fejl", "projekt", "diagram-project", $postProjekt[1]);
                                                                    // $result = $delete->findRoute($fejlArray, $this->header);

                                                                    // if($result === true){
                                                                    //     var_dump("jep fil alle diagrammer");
                                                                    // }

                                                                    $fejlArray = [];
                                                                    $fejlArray = array("fejl", "projekt", $postProjekt[1]);
                                                                    $result = $delete->findRoute($fejlArray, $this->header);

                                                                    if($result === true){
                                                                        var_dump("det hele blev slettet");
                                                                    }

                                                                    http_response_code(404);
                                                                    die("404 - Kunne ikke oprettet projekt");
                                                                }
                                                            }
                                                            else{
                                                                $tal = 0;
                                                                $antal = count($imagesId);
                                                                for ($i=0; $i < $antal; $i++) { 

                                                                    $fejlArray = array("fejl", "images", $imagesId[$i]);
                                                                    $result = $delete->findRoute($fejlArray, $this->header);
                                                                    if($result === true){
                                                                        $tal++;
                                                                    }
                                                                }
                                                                if($tal == $antal){
                                                                    http_response_code(404);
                                                                    die("404 - Kunne ikke oprettet projekt");
                                                                }
                                                                else{
                                                                    http_response_code(404);
                                                                    die("404 - Kunne ikke oprettet projekt. billederne bliv ikke slettet");
                                                                }
                                                            }
                                                        }
                                                        else{
                                                            http_response_code(400);
                                                            die("400 - En af længderne er forkerte");
                                                        }
                                                    }
                                                    else{
                                                        http_response_code(404);
                                                        die("404 - Favorite har den forkert værdi. må kun være 1 eller 2");
                                                    }
                                                }
                                                else{
                                                    if($tal > 0){
                                                        $fejlArray = array("fejl", "images", $images);
                                                        $finish = $delete->findRoute($fejlArray ,$this->header);
                                                    }
                                                    http_response_code(404);
                                                    die("404 - nogle af billeder kunne ikke oprettets");
                                                }
                                            }
                                            else{
                                                http_response_code(404);
                                                die("404 - Der må kun være flere af typen information");
                                            }
                                        }
                                        else{
                                            http_response_code(404);
                                            die("404 - Du har ikke sendt en af være billede type med.");
                                        }
                                    }
                                    else{
                                        http_response_code(404);
                                        die("404 - billede er ikke et array");
                                    }
                                }
                                else{
                                    http_response_code(400);
                                    die("400 - bad request (-.-)");
                                }
                            }
                            else{
                                http_response_code(404);
                                die("404 - start dato'en skal være før eller samtidig med slut dato'en");
                            }
                        }
                        else{
                            http_response_code(400);
                            die("400 - bad request (o.o)");
                        }
                    }
                    else{
                        http_response_code(400);
                        die("400 - bad request \(.-.)/");
                    }
                }
                else{
                    http_response_code(400);
                    die("400 - bad header type");
                }

            }
            else if($this->countUri >= 4){

                $this->arrayVali = [];
                array_push($this->arrayVali, $uri[3]);
                $result = $vali->isNumeric($this->arrayVali);
                if($result === true){ // for at tjekke om $uri[3] er et tal

                    $id = $uri[3];
                    $this->arrayVali = [];
                    array_push($this->arrayVali, $uri[4]);
                    $result = $vali->isArray($this->arrayVali);
                    if($result === true){  // for at tjekke om de værdier der er blev sendt med er i et array

                        $result = $projekt->getOneProjektWithId($id); // for at tjekke om projektet findes
                        if($result === true){

                            if($uri[2] == "images"){

                                $antal = count($uri[4]);
                                if($antal >= 2){

                                    $tal = 0;
                                    for ($i = 0; $i < $antal; $i++) { 
                                        
                                        $getImages = $this->imagesRoute($uri[4][$i]);
                                        if($getImages[0] === true){
                                            
                                            $postImagesProject = $billedeProject->postImagesProject($getImages[1], $id, $uri[4][$i][3]);
                                            if($postImagesProject === true){
                                                $tal++;
                                            }
                                        }
                                    }
                                    if($tal == $antal){
                                        return true;
                                    }
                                    else{
                                        return false;
                                    }
                                }
                                else{
                                    return false;
                                }
                            }
                            else if($uri[2] == "language"){
                                $antal = count($uri[4]); // for at finde ud af om der er flere værdier sendt med
                                if($antal >= 2){ 
                                    
                                    $tal = 0;
                                    for ($i = 0; $i < $antal; $i++) { 

                                        $setLanguage = new Language($uri[4][$i], null);
                                        $result = $projekt->postSprogProjekt($id, $setLanguage);
                                        if($result === true){
                                            $tal++;
                                        }
                                    }
                                    if($tal == $antal){
                                        return true;
                                    }
                                    else{
                                        return false;
                                    }
                                }
                                else{
    
                                    $setLanguage = new Language($uri[4], null);
                                    $result = $projekt->postSprogProjekt($id, $setLanguage);
                                    return $result;
                                }
                            }
                            else if($uri[2] == "diagram"){
                                
                                $antal = count($uri[4]); // for at finde ud af om der er flere værdier sendt med
                                if($antal >= 2){ 
                                    
                                    $tal = 0;
                                    for ($i = 0; $i < $antal; $i++) { 

                                        $setDiagram = new Diagrams($uri[4][$i], null);
                                        $result = $projekt->postDiagramProjekt($id, $setDiagram);
                                        if($result === true){
                                            $tal++;
                                        }
                                    }
                                    if($tal == $antal){
                                        return true;
                                    }
                                    else{
                                        return false;
                                    }
                                }
                                else{
    
                                    $setDiagram = new Diagrams($uri[4], null);
                                    $result = $projekt->postDiagramProjekt($id, $setDiagram);
                                    return $result;
                                }
                            }
                            else{
                                return false;
                            }
                        }
                    }
                    else{
                        return false;
                    }
                }
                else{
                    return false;
                }
            }
            else{
                http_response_code(400);
                die("400 - bad request ~(=.=)~");
            }
        }

        private function projektTypeRoute($uri)
        {
            $data = json_decode(file_get_contents('php://input'), true); // til raw

            $projektType = new projektTypeRepository();
            $vali = new Validering();

            $values = array("name");
            $result = $vali->thingsExist2Values($data, $values);

            if($result === true){
                
                $name = $data["name"];

                array_push($this->arrayVali, $name);
                $result = $vali->notEmpty($this->arrayVali);
                if($result === true){

                    $this->arrayVali = array();
                    array_push($this->arrayVali, $name);
                    $length = array(45);
                    $result = $vali->isLenght($this->arrayVali, $length);
                    if($result === true){

                        $projektTypes = new ProjektTypes(0, $name);
                        $projektType->postProjectType($projektTypes);
                        echo json_encode("Det blev oprettet");
                    }
                    else{
                        http_response_code(400);
                        die("400 - En af længderne er forkerte");
                    }
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

        private function qualificationRoute($uri)
        {
            $data = json_decode(file_get_contents('php://input'), true); // til raw

            $qualification = new qualificationRepsoitory();
            $vali = new Validering();

            $values = array("name");
            $result = $vali->thingsExist2Values($data, $values);
            if($result === true){

                $name = $data["name"];
                
                array_push($this->arrayVali, $name);
                $result = $vali->notEmpty($this->arrayVali);
                if($result === true){

                    $length = array(60);
                    $result = $vali->isLenght($this->arrayVali, $length);
                    if($result === true){

                        $qualifications = new Qualifications(0, $name);
                        $qualification->postQualification($qualifications);
                        echo json_encode("Det blev oprettet");
                    }
                    else{
                        http_response_code(400);
                        die("400 - En af længderne er forkerte");
                    }
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

        private function softwareRoute($uri)
        {
            $data = json_decode(file_get_contents('php://input'), true); // til raw
            
            $software = new softwareRespository();
            $vali = new Validering();

            $values = array("name");
            $result = $vali->thingsExist2Values($data, $values);
            if($result === true){

                $name = $data["name"];
                array_push($this->arrayVali, $name);
                $result = $vali->notEmpty($this->arrayVali);
                if($result === true){

                    $length = array(45);
                    $result = $vali->isLenght($this->arrayVali, $length);
                    if($result === true){

                        $softwares = new Softwares(0, $name);
                        $software->postSoftware($softwares);
                        echo json_encode("Det blev oprettet");
                    }
                    else{
                        http_response_code(400);
                        die("400 - En af længderne er forkerte");
                    }
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

        private function languageRoute($uri)
        {
            $data = json_decode(file_get_contents('php://input'), true); // til raw

            $language = new LanguageRepository();
            $vali = new Validering();

            $values = array("name");
            $result = $vali->thingsExist2Values($data, $values);
            if($result === true){
                
                $name = $data["name"];

                $this->arrayVali = array();
                array_push($this->arrayVali, $name);
                $result = $vali->notEmpty($this->arrayVali);
                if($result === true){
                    
                    $length = array(45);
                    $result = $vali->isLenght($this->arrayVali, $length);
                    if($result === true){

                        $languages = new Language(0, $name);
                        $language->postLanguage($languages);
                        echo json_encode("Det blev oprettet");
                    }
                    else{
                        http_response_code(400);
                        die("400 - En af længderne er forkerte");
                    }
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

        private function workExperienceRoute($uri)
        {
            $data = json_decode(file_get_contents('php://input'), true); // til raw

            $workExperience = new workExperienceRepository();
            $vali = new Validering();

            $values = array("name", "startDate", "endDate");
            $result = $vali->thingsExist2Values($data, $values);
            if($result === true){

                $name = $data["name"];
                $startDate = $data["startDate"];
                $endDate = $data["endDate"];

                array_push($this->arrayVali, $name, $startDate, $endDate);
                $result = $vali->notEmpty($this->arrayVali);
                if($result === true){
                    
                    $length = array(100, 10, 10);
                    $result = $vali->isLenght($this->arrayVali, $length);
                    if($result === true){

                        $workExperiences = new WorkExperiences(0, $name, $startDate, $endDate);
                        $workExperience->postWorkExperience($workExperiences);
                    }
                    else{
                        http_response_code(400);
                        die("400 - En af længderne er forkerte");
                    }
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

        private function workTypeRoute($uri)
        {
            $data = json_decode(file_get_contents('php://input'), true); // til raw
            
            $workType = new workTypeRepository();
            $vali = new Validering();

            $values = array("name");
            $result = $vali->thingsExist2Values($data, $values);
            if($result === true){

                $name = $data["name"];

                array_push($this->arrayVali, $name);
                $result = $vali->notEmpty($this->arrayVali);
                if($result === true){

                    $length = array(45);
                    $result = $vali->isLenght($this->arrayVali, $length);
                    if($result === true){

                        $workTypes = new WorkTypes(0, $name);
                        $workType->postWorkType($workTypes);
                        echo json_encode("Det blev oprettet");
                    }
                    else{
                        http_response_code(400);
                        die("400 - En af længderne er forkerte");
                    }
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
    }
?>