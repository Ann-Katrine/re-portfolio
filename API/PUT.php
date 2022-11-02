<?php 
    // gør at man for alle fejl frem 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

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
    include_once("./DELETE.php");
    include_once("./POST.php");

    class PUT{
        private $id;
        private $arrayVali = array();
        private $uriArray = array();
        private $countUri;

        public function findRoute($uri, $headers)
        {
            
            header("Access-Control-Allow-Methods: *");
            if(in_array("application/json", $headers)){
                
                $vali = new Validering();
                $this->uriArray = $uri;
                $this->countUri = count($this->uriArray);
                if($this->countUri == 3){

                    $this->id = $uri[2];
                    array_push($this->arrayVali, $this->id);
                    $result = $vali->isNumeric($this->arrayVali);

                    if($result === true){
                        
                        switch ($uri[1]) {
                            case 'diagram':
                                $this->diagramRoute($headers); 
                                break;
                            case 'education':
                                $this->educationRoute(); 
                                break;
                            case 'language':
                                $this->languageRoute($headers); 
                                break;
                            case 'profile':
                                $this->profileroute(); 
                                break;
                            case 'projekt':
                                $this->projektRoute($headers); 
                                break;
                            case 'projekt-type':
                                $this->projektTypeRoute(); 
                                break;
                            case 'qualification':
                                $this->qualificationRoute(); 
                                break;
                            case 'software':
                                $this->softwareRoute(); 
                                break;
                            case 'work-experience':
                                $this->workExperienceRoute(); 
                                break;
                            case 'work-type':
                                $this->workTypeRoute(); 
                                break;
                            default:
                                http_response_code(400);
                                die("400 - bad request method!");
                                break;
                        }
                    }
                    else{
                        http_response_code(400);
                        die("400 - bad request");
                    }
                }
                else{
                    http_response_code(400);
                    die("400 - bad request method!");
                }
            }
            else{
                http_response_code(412);
				die('412 - Wrong Accept type. Only JSON supported!');
            }
        }

        private function imagesRoute($sti)
        {
            $images = new ImagesProjectRepository();
            $vali = new Validering();

            $result = count($sti);
            if($result == 2){

                if($sti[0] == "check-images"){

                    $this->arrayVali = [];
                    array_push($this->arrayVali, $sti[1]);
                    $result = $vali->isNumeric($this->arrayVali);
                    if($result == true){

                        $this->id = $sti[1];
                        $result = $images->checkImages($this->id);
                        return $result;
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
                return false;
            }
        }

        private function diagramRoute($sti)
        {
            $diagram = new diagramRepository();
            $vali = new Validering();

            $result = count($sti);
            if($result == 1){

                $data = json_decode(file_get_contents('php://input'),true); // Til raw
                $values = array("name");
                $result = $vali->thingsExist($data, $values);
                if($result === true){

                    $name = $data["name"];

                    array_push($this->arrayVali, $name);
                    $result  =$vali->notEmpty($this->arrayVali);
                    if($result === true){

                        $checkDiagram = $diagram->getOneDiagram($this->id);
                        if($checkDiagram != false){
                            $dataName = $checkDiagram->getName();

                            $this->arrayVali = array();
                            $arrayData = array();
                            array_push($this->arrayVali, $name);
                            array_push($arrayData, $dataName);

                            if($this->arrayVali != $dataName){

                                $length = array(45);
                                $result = $vali->isLenght($this->arrayVali, $length);
                                if($result === true){

                                    $diagrammet = new Diagrams($this->id, $name);
                                    $result = $diagram->putDiagram($diagrammet);
                                    if($result === true){
                                        echo json_encode("Diagrammet blev ændret");
                                    }
                                    else{
                                        echo json_encode("Diagrammet kunne ikke ændres");
                                    }
                                }
                                else{
                                    http_response_code(400);
                                    die("400 - bad request");
                                }
                            }
                            else{
                                http_response_code(200);
                                die("200 - diagrammet kan blev ikke updateret på grund af, der var ikke nogle ændringer.");
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
                else{
                    http_response_code(400);
                    die("400 - bad request");
                }
            }
            else if($result >= 1){

                if($sti[0] == "check-diagram"){

                    $this->arrayVali = [];
                    array_push($this->arrayVali, $sti[1]);
                    $result = $vali->isNumeric($this->arrayVali);
                    if($result == true){

                        $this->id = $sti[1];
                        $result = $diagram->checkDiagram($this->id);
                        return $result;
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
                die("400 - bad request");
            }

            
        }

        private function educationRoute()
        {
            $education = new educationRepository();
            $vali = new Validering();

            $data = json_decode(file_get_contents('php://input'),true); // Til raw
            $values = array("name", "startDate", "endDate");
            $result = $vali->thingsExist($data, $values);

            if($result === true){

                $name = $data["name"];
                $sDate = $data["startDate"];
                $eDate = $data["endDate"];

                array_push($this->arrayVali, $name, $sDate, $eDate);
                $result = $vali->notEmpty($this->arrayVali);
                if($result === true){

                    $chechEduacation = $education->getOneEducation($this->id);
                    if($chechEduacation != false){

                        $dataName = $chechEduacation->getName();
                        $dataStartDate = $chechEduacation->getStartDate();
                        $dataEndDate = $chechEduacation->getEndDate();

                        $this->arrayVali = array();
                        $arrayData = array();
                        array_push($this->arrayVali, $name, $sDate, $eDate);
                        array_push($arrayData, $dataName, $dataStartDate, $dataEndDate);

                        $tal = 0;
                        for ($i = 0; $i < 3; $i++) { 
                            if($this->arrayVali[$i] == $arrayData[$i]){
                                $tal++;
                            }
                        }

                        if($tal == 0){

                            $length = array(100, 10, 10);
                            $result = $vali->isLenght($this->arrayVali, $length);
                            if($result == true){

                                $educations = new Educations($this->id, $name, $sDate, $eDate);
                                $result = $education->putEducation($educations);
                                if($result === true){
                                    echo json_encode("Uddannelsen blev ændret");
                                }
                                else{
                                    echo json_encode("Uddannelsen blev ikke ændret");
                                }
                            }
                            else{
                                http_response_code(400);
                                die("400 - bad request");
                            }
                        }
                        else{
                            http_response_code(200);
                            die("200 - Uddannelse kan blev ikke updateret på grund af, der var ikke nogle ændringer.");
                        }
                    }
                    else{
                        http_response_code(404);
                        die("Det blev ikke fundet");
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

        private function languageRoute($sti)
        {
            $language = new LanguageRepository();
            $vali = new Validering();

            $result = count($sti);
            if($result == 1){

                $data = json_decode(file_get_contents('php://input'),true); // til raw
                $values = array("name");
                $result = $vali->thingsExist($data, $values);
                if($result === true){

                    $name = $data["name"];

                    array_push($this->arrayVali, $name);
                    $result = $vali->notEmpty($this->arrayVali);
                    if($result === true){
                        
                        $checkLanguage = $language->getOneLanguage($this->id);
                        if($checkLanguage[0] == true){

                            $dataName = $checkLanguage[1]->getName();

                            $arrayData = array($dataName);
                            if($this->arrayVali != $arrayData){

                                $length = array(45);
                                $result = $vali->isLenght($this->arrayVali, $length);
                                if($result === true){
                                    $languages = new Language($this->id, $name);
                                    $result = $language->putLanguage($languages);
                                    if($result === true){
                                        echo json_encode("Sproget blev ændret");
                                    }
                                    else{
                                        echo json_encode("Sproget kunne ikke ændres");
                                    }
                                }
                                else{
                                    http_response_code(404);
                                    die("Det blev ikke fundet");
                                }
                            }
                            else{
                                http_response_code(200);
                                die("200 - Sproget kan blev ikke updateret på grund af, der var ikke nogle ændringer.");
                            }
                        }
                        else{
                            http_response_code(404);
                            die("Det blev ikke fundet");
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
            else if($result >= 1){

                if($sti[0] == "check-language"){

                    $this->arrayVali = [];
                    array_push($this->arrayVali, $sti[1]);
                    $result = $vali->isNumeric($this->arrayVali);
                    if($result == true){

                        $this->id = $sti[1];
                        $result = $language->checkLanguage($this->id);
                        return $result;
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
                die("400 - bad request");
            }
        }

        private function profileroute()
        {
            $profile = new profilRepository();
            $vali = new Validering();

            $data = json_decode(file_get_contents('php://input'),true); // Til raw
            $values = array("briefDescription");
            $result = $vali->thingsExist($data, $values);
            if($result === true){

                $brief = $data["briefDescription"];

                array_push($this->arrayVali, $brief);
                $result = $vali->notEmpty($this->arrayVali);
                if($result === true){

                    $checkProfile = $profile->getOneProfile($this->id);
                    if($checkProfile != false){

                        $dataBrief = $checkProfile->getBriefDescription();

                        $arrayData = array();
                        array_push($arrayData, $dataBrief);
                        if($brief != $dataBrief){

                            $profiles = new Profiles($this->id, $brief);
                            $result = $profile->putProfile($profile);
                            if($result === true){
                                echo json_encode("Kort beskrivelse blev ændret");
                            }
                            else{
                                echo json_encode("Kort beskrivelse kunne ikke ændres");
                            }
                        }
                        else{
                            http_response_code(200);
                            die("200 - Kort beskrivelse kan blev ikke updateret på grund af, der var ikke nogle ændringer.");
                        }
                    }
                    else{
                        http_response_code(404);
                        die("Det blev ikke fundet");
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

        private function projektRoute($headers)
        {
            $projekt = new projectRepository();
            $billederRep = new ImagesRepository();
            $diagramRep = new diagramRepository();
            $languageRep = new LanguageRepository();
            $vali = new validering();

            $data = json_decode(file_get_contents('php://input'),true); // til raw
            $values = array("name", "favorite", "date", "description", "startDate", "endDate", "software", "projektType", "workType", "language", "diagram", "images");
            $result = $vali->thingsExist2Values($data, $values);
            if($result === true){ // tjekker om alle tinge der skal sendes med er sendt med

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
                if($result === true){
                    
                    $this->arrayVali = array();
                    array_push($this->arrayVali, $fav);
                    $result = $vali->isNumeric($this->arrayVali);
                    if($result === true){ // tjekker nogle af værdierne igennem for om de er tal
                        
                        $this->arrayVali = array();
                        array_push($this->arrayVali, $images);
                        $result = $vali->isArray($this->arrayVali);                  
                        if($result === true){ // tjekker om $images er et array
                            
                            $fav =  intval($fav);
                            if($fav == 1 || $fav == 2){ // tjekker om favorit er 1 eller 2
                                
                                if($fav == 1){ // tjekker om favorit er 1
                                    $checkFavorite = $projekt->getFavoritProjekt();
                                    if(is_array($checkFavorite) == true){ // tjekker om der allerede findes en favorite
                                        http_response_code(406);
                                        die("Du kan ikke oprette en mere favorite, der findes allerde en i systemmet");
                                    }
                                }

                                $this->arrayVali = array();
                                array_push($this->arrayVali, $name, $fav, $des, $sDate, $eDate);
                                $length = array(45, 1, 500, 10, 10);
                                $result = $vali->isLenght($this->arrayVali, $length);
                                if($result === true){   // For at se om længederne på værdi'erne ikke er for lange

                                    $checkLanguage = array(); 
                                    $checkDiagram = array();
                                    $checkImages = array();
                                    $checkProjekt = $projekt->getOneProjectTocheckWith($this->id); // For at hente de oplysinger der i databasen omkring projeket med id'et "$this->id"
                                    
                                    $tal = 0;
                                    $antal = count($language);
                                    for ($i = 0; $i < $antal; $i++) {  // For at hente de oplysinger der i databasen omkring projeket angående sprog med id'et "$this->id"
                                        
                                        $uriArray = [];
                                        $uriArray = array("check-language", intval($this->id));
                                        $getLanguages = $this->languageRoute($uriArray);
                                        if($getLanguages[0] == true){
                                            array_push($checkLanguage, $getLanguages[1]);
                                            $tal++;
                                        }
                                    }
                                    if($tal == $antal){
                                        $getLanguages = true;
                                    }
                                    else{
                                        $getLanguages = false;
                                    }

                                    $tal = 0;
                                    $antal = count($diagram);
                                    for ($i = 0; $i < $antal; $i++) {  // For at hente de oplysinger der i databasen omkring projeket angående diagram med id'et "$this->id"
                                        
                                        $uriArray = [];
                                        $uriArray = array("check-diagram", intval($this->id));
                                        $getDiagram = $this->diagramRoute($uriArray);
                                        if($getDiagram[0] == true){
                                            array_push($checkDiagram, $getDiagram[1]);
                                            $tal++;
                                        }
                                    }
                                    if($tal == $antal){
                                        $getDiagram = true;
                                    }
                                    else{
                                        $getDiagram = false;
                                    }

                                    $tal = 0;
                                    $antal = count($images);
                                    for ($i=0; $i < $antal; $i++) {  // For at hente de oplysinger der i databasen omkring projeket angående billeder med id'et "$this->id"
                                        
                                        $uriArray = [];
                                        $uriArray = array("check-images", intval($this->id));
                                        $getImages = $this->imagesRoute($uriArray);
                                        if($getImages[0] == true){
                                            array_push($checkImages, $getImages[1]);
                                            $tal++;
                                        }
                                    }
                                    if($tal == $antal){
                                        $getImages = true;
                                    }
                                    else{
                                        $getImages = false;
                                    }

                                    if($checkProjekt[0] === true && $getImages === true && $getLanguages === true && $getDiagram === true){
                                        
                                        $dataName = $checkProjekt[1]->getName();
                                        $dataFav = $checkProjekt[1]->getFavorite();
                                        $dataDes = $checkProjekt[1]->getDescription();
                                        $dataSDate = $checkProjekt[1]->getStartDate();
                                        $dataEDate = $checkProjekt[1]->getEndDate();
                                        $dataSoftware = $checkProjekt[1]->getSoftware();
                                        $dataProjektType = $checkProjekt[1]->getProjektType();
                                        $dataWorkType = $checkProjekt[1]->getWorkType();
                                        $dataLanguage = $checkLanguage[0];
                                        $dataDiagram = $checkDiagram[0];
                                        $dataImages = $checkImages[0];

                                        $tempImages = array();
                                        $antal = count($images);
                                        for ($i = 0; $i < $antal; $i++) { 
                                            array_push($tempImages, $images[$i][2]);
                                        }

                                        $this->arrayVali = array();
                                        $arrayData = array($dataName, $dataFav, $dataDes, $dataSDate, $dataEDate, $dataSoftware, $dataProjektType, $dataWorkType, $dataLanguage, $dataDiagram, $dataImages);
                                        array_push($this->arrayVali, $name, $fav, $des, $sDate, $eDate, $software, $projektType, $workType, $language, $diagram, $tempImages);

                                        $checkArray = array();
                                        $tal = 0;   // Til at se om der er nogle der er ens
                                        $tempTal = 0;   // Til at se om nogle i "mange til mange" tablerne der er ens
                                        for ($i = 0; $i < 11; $i++) { // For at tjekke igennem alle værdierne og se om man faktisk har ændret nogle
                                            
                                            if($i >= 8){ // kun for værdi der er et array

                                                $antal = count($this->arrayVali[$i]);
                                                if($antal >= 2){ // kun hvis array'et består af flere end "1 værdi"

                                                    $antalData = count($arrayData[$i]);
                                                    if($antal == $antalData){ // hvis arrayData og arrayvali har lige mange værdi'er

                                                        $tempTal = 0;
                                                        $antal = count($this->arrayVali[$i]);
                                                        for ($j = 0; $j < $antal; $j++) { // tjekker igennem hver element i array'et
                                                            
                                                            if($this->arrayVali[$i][$j] == $arrayData[$i][$j]){ 
                                                                $tempTal++;
                                                            }
                                                            
                                                        }
                                                        if($tempTal == $antal){
                                                            $tal++;
                                                        }
                                                        else{
                                                            array_push($checkArray, $i);
                                                        }
                                                    }
                                                    else{ // hvis arrayData og arrayvali ikke har lige mange værdi'er
                                                        array_push($checkArray, $i);
                                                    }
                                                }
                                                else{ // hvis array'et består af flere værdi'er

                                                    if($this->arrayVali[$i] == $arrayData[$i]){
                                                        $tal++;
                                                    }
                                                    else{
                                                        array_push($checkArray, $i);
                                                    }
                                                }
                                            }
                                            else{ // til værdierne ikke er et array
                                                if($this->arrayVali[$i] == $arrayData[$i]){
                                                    $tal++;
                                                }
                                                else{
                                                    array_push($checkArray, $i);
                                                }
                                            }
                                        }

                                        if($tal != 11){
                                            
                                            $delete = new DELETE();

                                            $this->uriArray = [];
                                            array_push($this->uriArray, "delete", "projekt", "diagram-project", $this->id);
                                            $result1 = $delete->findRoute($this->uriArray, $headers);

                                            $this->uriArray = [];
                                            array_push($this->uriArray, "delete", "projekt", "language-project", $this->id);
                                            $result2 = $delete->findRoute($this->uriArray, $headers);

                                            $this->uriArray = [];
                                            array_push($this->uriArray, "delete", "projekt", "images-project", $this->id);
                                            $result3 = $delete->findRoute($this->uriArray, $headers);

                                            if($result1 === true && $result2 === true && $result3 === true){
                                                
                                                
                                                $setProject = new Projects($this->id, $name, $fav, $uploadDate, $des, $sDate, $eDate, $software, $projektType, $workType, null, null);
                                                $updateProject = $projekt->putProjekt($setProject);

                                                if($updateProject == true){
                                                    
                                                    $post = new POST();

                                                    $this->uriArray = [];
                                                    array_push($this->uriArray, "api", "projekt", "diagram", $this->id, $diagram);
                                                    $result1 = $post->findRoute($this->uriArray, $headers, "nope");

                                                    $this->uriArray = [];
                                                    array_push($this->uriArray, "api", "projekt", "language", $this->id, $language);
                                                    $result2 = $post->findRoute($this->uriArray, $headers, "nope");

                                                    $this->uriArray = [];
                                                    array_push($this->uriArray, "api", "projekt", "images", $this->id, $images);
                                                    $result3 = $post->findRoute($this->uriArray, $headers, "nope");

                                                    if($result1 === true && $result2 === true && $result3 === true){

                                                        http_response_code(200);
                                                        echo json_encode("Projectet med updateret");
                                                    }
                                                    else{
                                                        http_response_code(404);
                                                        die("404 - der var noget der kig galt under updatringen af projektet");
                                                    }
                                                }
                                                else{
                                                    http_response_code(404);
                                                    die("404 - der kig noget galt under updatringen af projektet");
                                                }
                                            }
                                            else{
                                                http_response_code(404);
                                                die("404 - der kig noget galt under sletningen");
                                            }
                                        }
                                        else{
                                            http_response_code(200);
                                            die("200 - Der var ikke nogle ændringer, så projektet blev ikek updateret.");
                                        }
                                    }
                                    else{

                                        http_response_code(404);
                                        die("404 - Det blev ikke fundet");
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
                            http_response_code(404);
                            die("404 - billedet er ikke et array");
                        }
                    }
                    else{
                        http_response_code(400);
                        die("400 - bad request");
                    }
                }
                else{
                    http_response_code(404);
                    die("400 - bad request");
                }
            }
            else{
                http_response_code(400);
                die("400 - bad request");
            }
        }

        private function projektTypeRoute()
        {
            $projektType = new projektTypeRepository();
            $vali = new Validering();

            $data = json_decode(file_get_contents('php://input'),true); // Til raw
            $values = array("name");
            $result = $vali->thingsExist2Values($data, $values);
            if($result === true){

                $name = $data["name"];

                array_push($this->arrayVali, $name);
                $result = $vali->notEmpty($this->arrayVali);
                if($result === true){

                    $checkProjektType = $projektType->getOneProjectType($this->id);
                    
                    if($checkProjektType[0] == true){

                        $dataName = $checkProjektType[1]->getName();
                        
                        $arrayData = array();
                        array_push($arrayData, $dataName);

                        if($this->arrayVali != $arrayData){

                            $length = array(45);
                            $this->uriArray = [];
                            array_push($this->uriArray, $this->arrayVali[1]);
                            $result = $vali->isLenght($this->uriArray, $length);

                            if($result === true){

                                $projektTypes = new ProjektTypes($this->id, $name);
                                $result = $projektType->putProjectType($projektTypes);
                                if($result === true){
                                    http_response_code(200);
                                    echo json_encode("Projekt typen blev ændret");
                                }
                                else{
                                    http_response_code(404);
                                    die("Projekt typen kunne ikke ændres");
                                }
                            }
                            else{
                                http_response_code(400);
                                die("400 - bad request");
                            }
                        }
                        else{
                            http_response_code(200);
                            die("200 - Projekt Type kan blev ikke updateret på grund af, der var ikke nogle ændringer.");
                        }
                    }
                    else{
                        http_response_code(404);
                        die("Det blev ikke fundet");
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

        private function qualificationRoute()
        {
            $qualification = new qualificationRepsoitory();
            $vali = new Validering();

            $data = json_decode(file_get_contents('php://input'),true); // Til raw
            $values = array("name");
            $result = $vali->thingsExist($data, $values);
            if($result === true){

                $name = $data["name"];

                array_push($this->arrayVali, $name);
                $result = $vali->notEmpty($this->arrayVali);
                if($result === true){

                    $checkQualification = $qualification->getOneQualification($this->id);
                    if($checkQualification != false){

                        $dataName = $checkQualification->getName();
                        
                        $arrayData = array($dataName);
                        if($this->arrayVali != $arrayData){

                            $length = array(60);
                            $result = $vali->isLenght($this->arrayVali, $length);
                            if($result === true){

                                $qualifications = new Qualifications($this->id, $name);
                                $result = $qualification->putQualification($qualifications);
                                if($result === true){
                                    echo json_encode("Kvalification blev ændret");
                                }
                                else{
                                    echo json_encode("Kvalification kunne ikke ændres");
                                }
                            }
                            else{
                                http_response_code(400);
                                die("400 - bad request");
                            }
                        }
                        else{
                            http_response_code(200);
                            die("200 - Kvalifikation kan blev ikke updateret på grund af, der var ikke nogle ændringer.");
                        }
                    }
                    else{
                        http_response_code(404);
                        die("Det blev ikke fundet");
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

        private function softwareRoute()
        {
            $software = new softwareRespository();
            $vali = new Validering();

            $data = json_decode(file_get_contents('php://input'),true); // Til raw
            $values = array("name");
            $result = $vali->thingsExist($data, $values);
            if($result === true){

                $name = $data["name"];
                array_push($this->arrayVali, $name);
                $result = $vali->notEmpty($this->arrayVali);
                if($result === true){

                    $checkSoftware = $software->getOneSoftware($this->id);
                    if($checkSoftware != false){

                        $dataName = $checkSoftware->getName();

                        $arrayData = array($dataName);
                        if($this->arrayVali != $arrayData){

                            $length = array(45);
                            $result = $vali->isLenght($this->arrayVali, $length);
                            if($result === true){
                                $softwaren = new Softwares($this->id, $name);
                                $result = $software->putSoftware($softwaren);
                                if($result === true){
                                    echo json_encode("Softwaren blev ændret");
                                }
                                else{
                                    echo json_encode("Softwaren kunne ikke ændres");
                                }
                            }
                            else{
                                http_response_code(404);
                                die("Det blev ikke fundet");
                            }
                        }
                        else{
                            http_response_code(200);
                            die("200 - Softwaren kan blev ikke updateret på grund af, der var ikke nogle ændringer.");
                        }
                    }
                    else{
                        http_response_code(404);
                        die("Det blev ikke fundet");
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

        private function workExperienceRoute()
        {
            $workExpirence = new workExperienceRepository();
            $vali = new Validering();

            $data = json_decode(file_get_contents('php://input'),true); // Til raw
            $values = array("name", "startDate", "endDate");
            $result = $vali->thingsExist($data, $values);
            if($result === true){
                
                $name = $data["name"];
                $sDate = $data["startDate"];
                $eDate = $data["endDate"];

                array_push($this->arrayVali, $name, $sDate, $eDate);
                $result = $vali->notEmpty($this->arrayVali);
                if($result === true){

                    $checkWorkExperience = $workExpirence->getOneWorkExperience($this->id);
                    if($checkWorkExperience != false){

                        $dataName = $checkWorkExperience->getName();
                        $dataSDate = $checkWorkExperience->getStartDate();
                        $dataEDate = $checkWorkExperience->getEndDate();

                        $arrayData = array($dataName, $dataSDate, $dataEDate);

                        $tal = 0;
                        for ($i = 0; $i < 3; $i++) { 
                            if($this->arrayVali[$i] == $arrayData[$i]){
                                $tal++;
                            }
                        }

                        if($tal == 0){
                            
                            $length = array(100, 10, 10);
                            $result = $vali->isLenght($this->arrayVali, $length);
                            if($result === true){

                                $workExpirences = new WorkExperiences($this->id, $name, $sDate, $eDate);
                                $result = $workExpirence->putWorkExperience($workExpirences);
                                if($result === true){
                                    echo json_encode("Erhvervserfaring blev ændret");
                                }
                                else{
                                    echo json_encode("Erhvervserfaring kunne ikke ændres");
                                }
                            }
                            else{
                                http_response_code(400);
                                die("400 - bad request");
                            }
                        }
                        else{
                            http_response_code(200);
                            die("200 - Erhvervserfaring blev ikke updateret på grund af, der var ikke nogle ændringer.");
                        }
                    }
                    else{
                        http_response_code(404);
                        die("Det blev ikke fundet");
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

        private function workTypeRoute()
        {
            $workType = new workTypeRepository();
            $vali = new Validering();

            $data = json_decode(file_get_contents('php://input'),true); // Til raw
            $values = array("name");
            $result = $vali->thingsExist($data, $values);
            if($result === true){

                $name = $data["name"];

                array_push($this->arrayVali, $name);
                $result = $vali->notEmpty($this->arrayVali);
                if($result === true){

                    $checkWorkType = $workType->getOneWorkType($this->id);
                    if($checkWorkType != false){
                        
                        $dataName = $checkWorkType->getName();

                        $arrayData = array($dataName);
                        if($this->arrayVali != $arrayData){

                            $workTypes = new WorkTypes($this->id, $name);
                            $result = $workType->putWorkType($workTypes);
                            if($result === true){
                                echo json_encode("Arbejdes typen blev ændret");
                            }
                            else{
                                echo json_encode("Arbejdes typen kunne ikke ændres");
                            }
                        }
                        else{
                            http_response_code(200);
                            die("200 - Produktet kan blev ikke updateret på grund af, der var ikke nogle ændringer.");
                        }
                    }
                    else{
                        http_response_code(404);
                        die("Det blev ikke fundet");
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