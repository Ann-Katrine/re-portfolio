<?php 
    // gør at man for alle fejl frem 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include_once("./validering.php");
    include_once("../orm/Repository/billedeRepository.php");
    include_once("../orm/Repository/billedeProjectRepository.php");
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

    class DELETE{
        private $id;
        private $uriArray = array();
        private $countUri;
        private $arrayVali = array();

        public function findRoute($uri, $headers)
        {
            if(in_array("application/json", $headers)){
                $vali = new Validering();
                switch ($uri[1]) {
                    case 'images':
                        $this->id = $uri[2];
                        array_push($this->arrayVali, $this->id);
                        $result = $vali->isNumeric($this->arrayVali);
                        if($result === true){

                            $this->id = intval($this->id);
                            $result = $this->imagesRoute($this->id); //
                            return $result;
                        }
                        else{
                            http_response_code(400); 
                            die("400 - bad request");
                        }
                        break;

                    case 'images-project':
                        $this->id = $uri[2];
                        array_push($this->arrayVali, $this->id);
                        $result = $vali->isNumeric($this->arrayVali);
                        if($result === true){
                            $result = $this->imagesProject($this->id);
                            return $result;
                        }
                        else{
                            http_response_code(400); 
                            die("400 - bad request");
                        }
                        break;
                        
                    case 'diagram':
                        $this->id = $uri[2];
                        array_push($this->arrayVali, $this->id);
                        $result = $vali->isNumeric($this->arrayVali);
                        if($result === true){

                            $this->id = intval($this->id);
                            $this->diagramRoute(); //
                        }
                        else{
                            http_response_code(400); 
                            die("400 - bad request");
                        }
                        break;

                    case 'education':
                        $this->educationRoute(); //
                        break;

                    case 'projekt':
                        $result = $this->projektRoute($uri);
                        return $result;
                        break;

                    case 'projekt-type':
                        $this->projektTypeRoute($uri);//
                        break;

                    case 'qualification':
                        $this->qualificationRoute(); //
                        break;

                    case 'software':
                        $this->softwareRoute($uri); //
                        break;

                    case 'language':
                        $result = $this->languageRoute($uri); //
                        return $result;
                        break;

                    case 'work-experience':
                        $this->workExperienceRoute(); //
                        break;

                    case 'work-type':
                        $this->workTypeRoute($uri); //
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

        private function imagesRoute($Imagesid)
        {
            $images = new ImagesRepository();
            
            $getImages = $images->getOneImages($Imagesid);
            if($getImages[0] == true){
                
                $result = $images->deleteImages($Imagesid);
                return $result;
            }
            else{
                http_response_code(400);
                die("400 - bad request");
            }
        }

        private function imagesProject($id)
        {
            $imagesProject = new ImagesProjectRepository();

            $getImagesProjekt = $imagesProject->getAllImagesProjectWithbilledeId($id);

            if($getImagesProjekt[0] === true){

                $result = $imagesProject->deleteImagesProejct($getImagesProjekt[1][0]);
                return $result;
            }
            else{
                http_response_code(400);
                die("400 - bad request");
            }
        }

        private function diagramRoute()
        {
            $diagram = new diagramRepository();

            $getDiagram = $diagram->getOneDiagram($this->id);
            if($getDiagram[0] === true){
                
                $result = $diagram->deleteDiagram($this->id);
                if($result === true){
                    http_response_code(200);
                    echo json_encode("Diagram blev slettet");
                }
                else{
                    http_response_code(404);
                    echo json_encode("Diagram blev ikke slettet");
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

            $getEducation = $education->getOneEducation($this->id);
            if($getEducation != null){
                $result = $education->deleteEduaction($this->id);
                echo json_encode($result);
            }
            else{
                http_response_code(400);
                die("400 - bad request");
            }
        }

        private function languageRoute($uri)
        {
            $language = new LanguageRepository();
            $vali = new Validering();

            $this->id = $uri[2];
            array_push($this->arrayVali, $this->id);
            $result = $vali->isNumeric($this->arrayVali);
            if($result === true){
                
                $getLanguage = $language->getOneLanguage($this->id);
                if($getLanguage != null){
                    
                    $result = $language->deleteLanguage($this->id);
                    if($result == true){
                        http_response_code(200);
                        echo json_encode("Sprog blev slettet");
                    }
                    else{
                        http_response_code(404);
                        echo json_encode("Sprog blev ikke slettet");
                    }
                } 
                else{
                    http_response_code(400);
                    die("400 - bad request");
                }
            }
            else{

            }
            
        }

        private function projektRoute($uri)
        {
            $projekt = new projectRepository();
            $billedeProjekt = new ImagesProjectRepository();
            $vali = new Validering();

            $this->uriArray = $uri;
            $this->countUri = count($this->uriArray);
            
            if($this->countUri === 3){ // slette hele projektet

                array_push($this->arrayVali, $uri[2]);
                $result = $vali->isNumeric($this->arrayVali);
                if($result === true){

                    $this->id = $uri[2];
                    $getprojekt = $projekt->getOneProjektWithId($this->id); // tjekker om projektet findes
                
                    if($getprojekt === true){
                        $mImages = $projekt->getOneBillederProjekt($this->id, "projekt");
                        $mDiagram = $projekt->getOneDiagramProjekt($this->id, "projekt");
                        $mSprog = $projekt->getOneSprogProjekt($this->id, "projekt");

                        $antalTrue = 0;
                        $manyToMany = array();
                        $ifExist = array();
                        array_push($manyToMany, $mImages[0], $mSprog, $mDiagram);
                        for ($i = 0; $i < 3; $i++) {  // Tjekker igennem om der er nogle billder, diagrammer eller sprog tilknøttet til projektet

                            if($manyToMany[$i] == true){ // Tilføjer kun hvis har givet true tilbage som svar
                                $antalTrue++;
                                array_push($ifExist, $i);
                            }
                            
                        }

                        if($antalTrue === 0){

                            $result =  $projekt->deleteProjekt($this->id);
                            return $result;
                        }
                        else{
                            $howManyExitst = count($ifExist);
                            for ($i = 0; $i < $howManyExitst; $i++) { // Kigger igennem dem der var true og sletter dem

                                if($ifExist[$i] == 0){  // billeder
                                    $imagesId = array();
                                    array_push($imagesId, $mImages);
                                    $mImages = $billedeProjekt->deleteImagesProjectWithProject($this->id, "projekt");
                                
                                    if($mImages == true){
                                        $countId = count($imagesId);
                                        for ($j = 1; $j < $countId-1; $j++) { 
                                            $this->imagesRoute($imagesId[$j]);
                                        }
                                    }
                                }
                                else if($ifExist[$i] == 1){ // sprog
                                    $mSprog = $projekt->deleteSprogProjekt($this->id, "projekt");
                                }
                                else{   // diagram
                                    $mDiagram = $projekt->deleteDiagramProjekt($this->id, "projekt");
                                }
                            }


                            $manyToMany = array();
                            $ifExist = array();
                            $tabels = array();
                            array_push($manyToMany, $mImages, $mSprog, $mDiagram);

                            $antalTrue = 0;
                            for ($i = 0; $i < 3; $i++) { // tjekker igennem med hvor mange der er blevet slette

                                if($manyToMany[$i] == true){
                                    $antalTrue++;
                                    array_push($ifExist, $i);
                                }
                                else{
                                    switch ($manyToMany) {
                                        case 0:
                                            array_push($tabels, "billeder");
                                            break;
                                        case 1:
                                            array_push($tabels, "sprog");
                                            break;
                                        case 2:
                                            array_push($tabels, "diagram");
                                            break;
                                    }
                                }
                            }        

                            if($antalTrue == 3){

                                $result =  $projekt->deleteProjekt($this->id);
                                if($result == true){
                                    echo json_encode("Projekt blev slettet");
                                }
                                else{
                                    echo json_encode("Projekt kunne ikke slettes");
                                }
                            }
                            else{
                                // skal have lavet en anden måde til at finde ud af hvilken der ikke blev slettet.
                                $howManyExitst = count($ifExist);
                                $getErrors = array();
                                $errorMessages = "";
                                for ($i = 0; $i < $howManyExitst; $i++) { 
                                    array_push($getErrors, $manyToMany);
                                    $tempManyToMany =  $manyToMany[$i];
                                    $errorMessages .= "" . $tempManyToMany . " og ";
                                }
                                $errorMessages = rtrim($errorMessages, "og ");
                                $errorMessages = $errorMessages + " blev ikke slettet"; 
                                array_push($getErrors, $errorMessages);

                                http_response_code(404);
                                echo json_encode($getErrors);
                            }
                        }
                    }
                    else{
                        http_response_code(400);
                        die("400 - bad request (~o~)");
                    }
                }
                else{
                    http_response_code(400);
                    die("400 - bad request nope");
                }
            }
            else if($this->countUri > 2){

                $result = $vali->isNumeric($uri[3]);
                if($result === true){
                    $this->id = $uri[3];

                    if($uri[2] == "images-project"){

                        $getImages = $billedeProjekt->getAllImagesProjectWithProjectId($this->id);
                        if($getImages[0] == true){
                            
                            $mImages = $billedeProjekt->deleteImagesProjectWithProject($this->id);
                            if($mImages == true){
                                
                                $tal = 0;
                                $antal = count($getImages[1]);
                                for ($i = 0; $i < $antal; $i++) { 
                                    $result = $this->imagesRoute($getImages[1][$i]);
                                    $tal++;
                                }
                                if($antal == $tal){
                                    return true;
                                }
                                else{
                                    return false;
                                }
                            }
                            else{
                                echo json_encode($mImages);
                            }
                        }
                        else{
                            http_response_code(404);
                            die("Det blev ikke fundet");
                        }
                    }
                    else if($uri[2] == "diagram-project"){
                        $mDiagram = $projekt->getOneDiagramProjekt($this->id, "projekt");
                        
                        if($mDiagram == true){
                            $mDiagram = $projekt->deleteDiagramProjekt($this->id, "projekt");

                            if($mDiagram[0] == true){
                                return true;
                            }
                            else{
                                return false;
                            }
                        }
                        else{
                            http_response_code(404);
                            die("Det blev ikke fundet");
                        }
                    }
                    else if($uri[2] == "language-project"){

                        $mSprog = $projekt->getOneSprogProjekt($this->id, "projekt");

                        if($mSprog === true){
                            $mSprog = $projekt->deleteSprogProjekt($this->id, "projekt");

                            if($mSprog[0] === true){
                                return true;
                            }
                            else{
                                return false;
                            }
                        }
                        else{
                            http_response_code(404);
                            die("Det blev ikke fundet1");
                        }
                    }
                    else{
                        http_response_code(400);
                        die("400 - bad request nope");
                    }
                }
                else{
                    http_response_code(400);
                    die("400 - bad request her");
                }
            }
            else{
                http_response_code(400);
                die("400 - bad request ~(.¨.)~");
            }
            
        }

        private function projektTypeRoute($uri)
        {
            $projektType = new projektTypeRepository();
            $vali = new Validering();

            array_push($this->arrayVali, $uri[2]);
            $result = $vali->isNumeric($this->arrayVali);
            if($result === true){

                $this->id = $uri[2];
                $getProjektType = $projektType->getOneProjectType($this->id);
                if($getProjektType[0] === true){
                    
                    $result = $projektType->deleteProejctType($this->id);
                    if($result === true){

                        http_response_code(200);
                        echo json_encode("Det blev slettet");
                    }
                    else{
                        http_response_code(404);
                        die("404 - det blev ikke slettet");
                    }
                }
                else{
                    http_response_code(400);
                    die("400 - bad request");
                }
            }
            else{
                http_response_code(404);
                die("404 - det blev ikke fundet");
            }
        }

        private function qualificationRoute()
        {
            $qualification = new qualificationRepsoitory();

            $getQualification = $qualification->getOneQualification($this->id);
            if($getQualification != null){
                $result = $qualification->deleteQualification($this->id);
                echo json_encode($result);
            }
            else{
                http_response_code(400);
                die("400 - bad request");
            }
        }

        private function softwareRoute($uri)
        {
            $software = new softwareRespository();
            $vali = new Validering();

            array_push($this->arrayVali, $uri[2]);
            $result = $vali->isNumeric($this->arrayVali);
            if($result === true){

                $this->id = $uri[2];
                $getSoftware = $software->getOneSoftware($this->id);
                if($getSoftware === true){

                    $result = $software->deleteSoftware($this->id);
                    if($result === true){
                        http_response_code(200);
                        echo json_encode("Det blev slettet");
                    }
                    else{
                        http_response_code(404);
                        die("404 - det blev ikke slettet");
                    }
                }
                else{
                    http_response_code(400);
                    die("400 - bad request");
                }
            }
            else{
                http_response_code(404);
                die("404 - det blev ikke fundet");
            }
            
            
        }

        private function workExperienceRoute()
        {
            $workExperience = new workExperienceRepository();

            $getWorkExperience = $workExperience->getOneWorkExperience($this->id);
            if($getWorkExperience != null){
                $result = $workExperience->deleteWorkExperience($this->id);
                echo json_encode($result);
            }
            else{
                http_response_code(400);
                die("400 - bad request");
            }
        }

        private function workTypeRoute($uri)
        {
            $workType = new workTypeRepository();
            $vali = new Validering();

            array_push($this->arrayVali, $uri[2]);
            $result = $vali->isNumeric($this->arrayVali);
            if($result === true){

                $this->id = $uri[2];
                $getWorkType = $workType->getOneWorkType($this->id);
                if($getWorkType === true){
                    
                    $result = $workType->deleteWorkType($this->id);
                    if($result === true){

                        http_response_code(200);
                        echo json_encode("Det blev slettet");
                    }
                    else{
                        http_response_code(404);
                        die("404 - det blev ikke slettet");
                    }
                }
                else{
                    http_response_code(400);
                    die("400 - bad request");
                }
            }
            else{
                http_response_code(404);
                die("404 - det blev ikke fundet");
            }
        }
    }
?>