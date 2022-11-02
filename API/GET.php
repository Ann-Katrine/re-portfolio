<?php 
    // gør at man for alle fejl frem 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include_once("./service/searchFunktion.php");
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
    include_once("../orm/Repository/categoryRespository.php");

    class GET{
        private $id = 0;
        private $uriArray = array();
        private $countUri;
        private $arrayVali = array();

        public function findRoute($uri, $headers)
        {
            header("Access-Control-Allow-Methods: *");
            
            if(in_array("application/json", $headers)){
                $this->uriArray = $uri;
                $this->countUri = count($this->uriArray);

                switch ($uri[1]) {
                    case 'diagram':
                        $this->diagramRoute($uri); 
                        break;
                    case 'education':
                        $this->educationRoute($uri); 
                        break;
                    case 'images-type':
                        $this->imagesTypeRoute($uri);
                        break;
                    case 'language':
                        $this->languageRoute($uri); 
                        break;
                    case 'profile':
                        $this->profileroute($uri); 
                        break;
                    case 'projekt':
                        $this->projektRoute($uri); 
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

        /*
        private function imagesRoute($uri)
        {
            $image = new ImagesRepository();
            $vali = new Validering();
            $finish = array();

            if($this->countUri === 2){
                $result = $image->getAllImages();

                $countImages = count($result);
                for($i = 0; $i < $countImages; $i++){
                    $getImages = $result[$i];
                    $finish[] = $getImages->getImages();
                }

                echo json_encode($finish);
            }
            else if($this->countUri > 2){
                array_push($this->arrayVali, $uri[2]);
                $result = $vali->isNumeric($this->arrayVali);
                if($result == true){
                    $this->id = $uri[2];
                    
                    $result = $image->getOneImages($this->id);
                    
                    if($result == false){
                        die("Billeder kunne ikke findes");
                    }
                    else{
                        echo json_encode($result->getImages());
                    }
                }
                else{
                    http_response_code(404);
                    die("404 - Det blev ikke fundet");
                }
            }
            else{
                http_response_code(400);
                die("400 - bad request method!");
            }
        }
        */

        private function diagramRoute($uri)
        {
            $diagram = new diagramRepository();
            $vali = new Validering();
            $finish = array();

            if($this->countUri === 2){
                $result = $diagram->getAllDiagram();

                if($result[0] === true){

                    http_response_code(200);
                    echo json_encode($result[1]);
                }
                else{
                    http_response_code(404);
                    die("et blev ikke fundet");
                }
            }
            else if($this->countUri > 2){

                $this->arrayVali = [];
                array_push($this->arrayVali, $uri[2]);
                $result = $vali->isNumeric($this->arrayVali);
                if($result == true){
                    $this->id = $uri[2];

                    $result = $diagram->getOneDiagram($this->id);
                    
                    if($result != false){
                        echo json_encode($result->getDiagram());
                    }
                    else{
                        die("Diagrammet blev ikke fundet");
                    } 
                }
                else if($result === false){

                    if($uri[2] == "all-diagram-and-project-id"){

                        $this->arrayVali = [];
                        array_push($this->arrayVali, $uri[1]);
                        $result = $vali->isNumeric($this->arrayVali);
                        if($result === true){

                            $result = $diagram->getAllDiagramWithProjectId($uri[1]);
                            return $result;
                        }
                        else{
                            http_response_code(404);
                            die("404 - Det blev ikke fundet");
                        }
                    }
                    else if($uri[2] == "all-diagram-with-id"){

                        $this->arrayVali = [];
                        array_push($this->arrayVali, $uri[1]);
                        $result = $vali->isNumeric($this->arrayVali);
                        if($result === true){

                            $result = $diagram->getAllInformationWithProjectId($uri[1]);
                            return $result;
                        }
                        else{
                            http_response_code(404);
                            die("404 - Det blev ikke fundet");
                        }
                    }
                    else{
                        http_response_code(404);
                        die("404 - Det blev ikke fundet");
                    }
                }
                else{
                    http_response_code(400);
                    die("400 - bad request method!");
                }
            }
            else{
                http_response_code(400);
                die("400 - bad request method!");
            }
        }

        private function educationRoute($uri)
        {
            $education = new educationRepository();
            $vali = new Validering();
            $finish = array();

            if($this->countUri == 2){
                $result = $education->getAllEducation();

                if($result[0] === true){
                    http_response_code(200);    
                    echo json_encode($result[1]);
                }
                else{
                    http_response_code(404);
                    die("Det bliv ikke fundet");
                }
            }
            else if($this->countUri > 2){
                array_push($this->arrayVali, $uri[2]);
                $result = $vali->isNumeric($this->arrayVali);
                if($result == true){
                    $this->id = $uri[2];

                    $result = $education->getOneEducation($this->id);

                    echo json_encode($result->getEducation());
                }
                else{
                    http_response_code(404);
                    die("404 - Det blev ikke fundet");
                }
            }
            else{
                http_response_code(400);
                die("400 - bad request");
            }
        }

        private function imagesRoute($uri)
        {
            $image = new ImagesRepository();
            $vali = new Validering();

            if($uri[0] == "all-images-category"){

                $tal = $uri[1];
                $this->arrayVali = [];
                array_push($this->arrayVali, $tal);
                $result = $vali->isNumeric($this->arrayVali);
                if($result === true){

                    $result = $image->getAllImagesWithAllCateogories($tal);
                    return $result;
                }
                else{
                    http_response_code(400);
                    die("400 - bad request method!");
                }
            }
            else if($uri[0] == "images-category-4-and-project-id"){

                $tal = $uri[1];
                $this->arrayVali = [];
                array_push($this->arrayVali, $tal);
                $result = $vali->isNumeric($this->arrayVali);
                if($result === true){

                    $result = $image->getAllImagesWithProjectIdAndCategory4($tal);
                    return $result;
                }
                else{
                    http_response_code(400);
                    die("400 - bad request method!");
                }
            }
            else{
                http_response_code(400);
                die("400 - bad request method!");
            }
        }

        private function imagesTypeRoute($uri)
        {
            $imagesType = new CategoryRepository();
            $finish = array();

            if($this->countUri == 2){
                $result = $imagesType->getAllCateogeries();

                $countImagesType = count($result);
                for ($i = 0; $i < $countImagesType; $i++) { 
                    $getImagesType = $result[$i];
                    $finish[] = $getImagesType->getCategory();
                }

                echo json_encode($finish);
            }
            else{
                http_response_code(400);
                die("400 - bad request");
            }
        }

        private function languageRoute($uri)
        {
            $language = new LanguageRepository();
            $category = new CategoryRepository();
            $vali = new Validering();
            $finish = array();

            if($this->countUri == 2){
                
                $result = $category->getCategoryWithId(2);
                if($result[0] === true){

                    $getFinish = array();
                    $tempArray = array();
                    $antal = count($result[1]);
                    for ($i=0; $i < $antal; $i++) { 
                        
                        $id = intval($result[1][$i]->getId());
                        // array_push($getFinish, $id);
                        $getLangeuages = $language->getAllLangeuageWithId($id);
                        if($getLangeuages[0] === true){

                            $languageAntal = count($getLangeuages[1]);
                            for ($j = 0; $j < $languageAntal; $j++) { 

                                array_push($getFinish, $getLangeuages[1][$j]->getSprog());
                                // array_push($finish, $getFinish);
                            }
                            array_push($tempArray, $id, $getFinish);
                            array_push($finish, $tempArray); 
                             
                            
                    
                        }
                        $tempArray = [];
                        $getFinish = [];
                    }

                    echo json_encode($finish);
                }
                else{

                    http_response_code(404);
                    die("404 - Der blev ikke fundet nogle kategori'er");                    
                }

                // $result = $language->getAllLanguage();
                
                // if($result[0] === true){
                    
                //     http_response_code(200);
                //     echo json_encode($result[1]);
                // }
                // else{
                //     http_response_code(404);
                //     die("404 - Det blev ikke fundet");
                // }
            }
            else if($this->countUri > 2){

                $this->arrayVali = [];
                array_push($this->arrayVali, $uri[2]);
                $result = $vali->isNumeric($this->arrayVali);
                if($result == true){
                    
                    $this->id = $uri[2];

                    $result = $language->getOneLanguage($this->id);
                    echo json_encode($result->getSprog());
                }
                else if($result == false){

                    if($uri[2] == "all-language-and-project-id"){

                        $this->arrayVali = [];
                        array_push($this->arrayVali, $uri[1]);
                        $result = $vali->isNumeric($this->arrayVali);
                        if($result === true){
                            
                            $result = $language->getAllLanguageWithProjectId($this->id);
                            return $result;
                        }
                        else{
                            http_response_code(404);
                            die("404 - Det blev ikke fundet");
                        }
                    }
                    else if($uri[2] == "all-language-with-project-id"){
                        
                        $this->arrayVali = [];
                        array_push($this->arrayVali, $uri[1]);
                        $result = $vali->isNumeric($this->arrayVali);
                        if($result === true){
                            
                            $result = $language->getAllInformationFromLanguage($this->id);
                            return $result;
                        }
                        else{
                            http_response_code(404);
                            die("404 - Det blev ikke fundet");
                        }
                    }
                    else{
                        http_response_code(404);
                        die("404 - Det blev ikke fundet");
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

        private function profileroute($uri)
        {
            $profile = new profilRepository();
            $vali = new Validering();
            $finish = array();

            if($this->countUri === 2){
                $result = $profile->getAllProfile();

                if($result[0] === true){
                    http_response_code(200);
                    echo json_encode($result[1]);
                }
                else{
                    http_response_code(404);
                    die("Det blev ikke fundet");
                }
                // $countProfile = count($result);
                // for($i = 0; $i < $countProfile; $i++){
                //     $getProfile = $result[$i];
                //     $finish[] = $getProfile->getProfile();
                // }

                // echo json_encode($finish);
            }
            else if($this->countUri > 2){
                array_push($this->arrayVali, $uri[2]);
                $result = $vali->isNumeric($this->arrayVali);
                if($result == true){
                    $this->id = $uri[2];

                    $result = $profile->getOneProfile($this->id);

                    echo json_encode($result->getProfile);
                }
                else{
                    http_response_code(404);
                    die("404 - Det blev ikke fundet");
                }
            }
            else{
                http_response_code(400);
                die("400 - bad request");
            }
        }

        private function projektRoute($uri)
        {
            $projekt = new projectRepository();
            $vali = new Validering();
            $finish = array();

            if($this->countUri == 2){
                $result = $projekt->getAllProjectsId();

                if($result[0] == true){

                    $antal = count($result[1]);
                    for ($i = 0; $i < $antal; $i++) { 
                        $getProjekt = $projekt->getAllProject($result[1][$i]);
                        $finish[] = $getProjekt[1];
                    }

                    echo json_encode($finish);
                }
                else{
                    http_response_code(404);
                    die("Projekterne blev ikke fundet");
                }
            }
            else if($this->countUri > 2){
                array_push($this->arrayVali, $uri[2]);
                $result = $vali->isNumeric($this->arrayVali);
                
                if($result == true){

                    $this->id = $uri[2];
                    $sted = array("images-category-4-and-project-id", $this->id);
                    $getImages = $this->imagesRoute($sted);

                    if($getImages[0] === true){
                        
                        $sted = array("project", $this->id, "all-language-and-project-id");
                        $getLangeuages = $this->languageRoute($sted);
                        if($getLangeuages[0] === true){
                            
                            $sted = array("project", $this->id, "all-diagram-and-project-id");
                            $getDiagram = $this->diagramRoute($sted);
                            if($getDiagram[0] === false){
                                
                                http_response_code(404);
                                die("404 - Det blev ikke fundet");
                            }
                        }
                        else{
                            http_response_code(404);
                            die("404 - Det blev ikke fundet");
                        }
                    }
                    else{
                        http_response_code(404);
                        die("404 - Det blev ikke fundet");
                    }

                    $result = $projekt->getOneProjekt($this->id, $getImages[1], $getLangeuages[1], $getDiagram[1]);

                    if($result[0] === true){
                        http_response_code(200);
                        echo json_encode($result[1]);
                    }
                    else{
                        http_response_code(404);
                        die("404 - Det blev ikke fundet");
                    }
                }
                else if($result == false){

                    // til Search-menuen så man for du forskellige værdier der bliver sendt med
                    $search = explode("?", $uri[2]); // Deler search op efter "?"

                    if($uri[2] == "favorit"){
                        $result = $projekt->getFavoritProjekt();

                        if($result[0] == true){
                            
                            echo json_encode($result[1]);
                        }
                        else{
                            http_response_code(404);
                            die("Projekt blev ikke fundet");
                        }
                    }
                    else if($uri[2] == "newest-3"){

                        $result = $projekt->get3NewestProject();
                        if($result[0] === true){

                            $id = array();
                            $antal = count($result[1]);
                            for ($i = 0; $i < $antal; $i++) { 
                                
                                $getResult = $result[1][$i];
                                $setId = $getResult->getId();
                                $id[] = intval($setId);
                            }

                            for ($i = 0; $i < $antal; $i++) { 
                                
                                $result = $projekt->getinformationToThe3NewestProject($id[$i]);
                                array_push($finish, $result);
                            }

                            http_response_code(200);
                            echo json_encode($finish);
                        }
                        else{

                            http_response_code(404);
                            die("Der bliv ikke fundet nogle projekter!");
                        }
                    }
                    else if($uri[2] == "admin"){

                        $result = count($uri);
                        if($result > 3){

                            $this->arrayVali = [];
                            array_push($this->arrayVali, $uri[3]);
                            $result = $vali->onlyIfThingExist($this->arrayVali);
                            if($result === false){ // Hvis der ikke er noget tal med
                                
                                $result = $vali->isNumeric($this->arrayVali);
                                if($result === true){

                                    $this->id = $uri[3];
                                    $sted = array("all-images-category", $this->id);
                                    $getImages = $this->imagesRoute($sted);
                                    if($getImages[0] === true){

                                        $sted = array("project", $this->id, "all-language-with-project-id");
                                        $getLangeuages = $this->languageRoute($sted);
                                        if($getLangeuages[0] === true){
                                            
                                            $sted = array("project", $this->id, "all-diagram-with-id");
                                            $getDiagram = $this->diagramRoute($sted);
                                            if($getDiagram[0] === false){
                                                
                                                http_response_code(404);
                                                die("404 - Det blev ikke fundet");
                                            }
                                        }
                                        else{
                                            http_response_code(404);
                                            die("404 - Det blev ikke fundet");
                                        }
                                    }
                                    else{
                                        http_response_code(404);
                                        die("404 - Det blev ikke fundet");
                                    }

                                    if($getImages[0] === true && $getLangeuages[0] === true && $getDiagram[0] === true){

                                        $result = $projekt->getOneProjectToAdmin($this->id, $getImages[1], $getLangeuages[1], $getDiagram[1]);
                                        if($result[0] === true){
                                            http_response_code(200);
                                            echo json_encode($result[1]);
                                        }
                                        else{
                                            http_response_code(404);
                                            die("404 - Projektet blev ikke fundet");
                                        }
                                    }
                                    else{
                                        http_response_code(404);
                                        die("404 - Det blev ikke fundet");
                                    }
                                }
                                else{
                                    http_response_code(404);
                                    die("404 - Der skal være et tal til sidst");
                                }
                            }
                            else{
                                http_response_code(404);
                                die("404 - Det blev ikke fundet");
                            }
                        }
                        else{
                            $result = $projekt->getAllProjectsId();
                            if($result[0] === true){

                                $antal = count($result[1]);
                                for ($i = 0; $i < $antal; $i++) { 
                                    $getProject = $projekt->getAllProjectToAdmin($result[1][$i]);
                                    $finish[] = $getProject[1];
                                }
                                echo json_encode($finish);
                            }
                            else{
                                http_response_code(404);
                                die("Projekterne blev ikke fundet");
                            }
                        }
                    }
                    else if($search[0] == "search-menu"){
                        $searchFunktions = new SearchFunktion();
                        $result = $searchFunktions->findRoute($search[1]);

                        if($result[0] === true){

                            $antal = count($result[1]);
                            for ($i = 0; $i < $antal; $i++) { 
                                $getProjekt = $projekt->getAllProject($result[1][$i]);
                                $finish[] = $getProjekt[1];
                            }
                            http_response_code(200);
                            echo json_encode($finish);
                        }
                        else{
                            http_response_code(404);
                            die("Projekterne blev ikke fundet");
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

        private function projektTypeRoute($uri)
        {
            $projektType = new projektTypeRepository();
            $vali = new Validering();
            $finish = array();

            if($this->countUri == 2){

                $result = $projektType->getAllProjectType();
                if($result[0] === true){

                    http_response_code(200);
                    echo json_encode($result[1]);
                }
                else{
                    http_response_code(404);
                    die("404 - Det blev ikke fundet");
                }
            }
            else if($this->countUri > 2){

                array_push($this->arrayVali, $uri[2]);
                $result = $vali->isNumeric($this->arrayVali);
                if($result == true){
                    $this->id = $uri[2];

                    $result = $projektType->getOneProjectType($this->id);
                    echo json_encode($result->getProjektType());
                }
                else{
                    http_response_code(404);
                    die("404 - Det blev ikke fundet");
                }
            }
            else{
                http_response_code(400);
                die("400 - bad request");
            }
        }

        private function qualificationRoute($uri)
        {
            $qualification = new qualificationRepsoitory();
            $vali = new Validering();
            $finish = array();

            if($this->countUri === 2){
                $result = $qualification->getAllQualification();

                if($result[0] === true){
                    http_response_code(200);
                    echo json_encode($result[1]);
                }
                else{
                    http_response_code(404);
                    die("Kvalifikationerne blev ikke fundet");
                }
            }
            else if($this->countUri > 2){
                array_push($this->arrayVali, $uri[2]);
                $result = $vali->isNumeric($this->arrayVali);
                if($result == true){
                    $this->id = $uri[2];

                    $result = $qualification->getOneQualification($this->id);

                    echo json_encode($result->getQualification());
                }
                else{
                    http_response_code(404);
                    die("404- Det blev ikke fundet");
                }
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
            $finish = array();

            if($this->countUri == 2){
                $result = $software->getAllSoftware();

                if($result[0] === true){

                    http_response_code(200);
                    echo json_encode($result[1]);
                }
                else{
                    http_response_code(404);
                    die("404 - Det blev ikke fundet");
                }
            }
            else if($this->countUri > 2){
                array_push($this->arrayVali, $uri[2]);
                $result = $vali->isNumeric($this->arrayVali);
                if($result == true){
                    $this->id = $uri[2];

                    $result = $software->getOneSoftware($this->id);
                    echo json_encode($result->getSoftware());
                }
                else{
                    http_response_code(404);
                    die("404 - Det blev ikke fundet");
                }
            }
            else{
                http_response_code(400);
                die("400 - bad request");
            }
        }

        private function workExperienceRoute($uri)
        {
            $workExperience = new workExperienceRepository();
            $vali = new Validering();
            $finish = array();

            if($this->countUri == 2){
                $result = $workExperience->getAllWorkExperience();

                if($result[0] === true){
                    http_response_code(200);
                    echo json_encode($result[1]);
                }
                else{
                    http_response_code(404);
                    die("Det blev ikke fundet");
                }
            }
            else if($this->countUri > 2){
                array_push($this->arrayVali, $uri[2]);
                $result = $vali->isNumeric($this->arrayVali);
                if($result == true){
                    $this->id = $uri[2];

                    $result = $workExperience->getOneWorkExperience($this->id);
                    echo json_encode($result->getWorkExperience());
                }
                else{
                    http_response_code(404);
                    die("404 -DEt blev ikke fundet");
                }
            }
            else{
                http_response_code(400);
                die("400 - Det blev ikke fundet");
            }
        }

        private function workTypeRoute($uri)
        {
            $workType = new workTypeRepository();
            $vali = new Validering();
            $finish = array();

            if($this->countUri == 2){
                $result = $workType->getAllWorkType();
                if($result[0] === true){

                    http_response_code(200);
                    echo json_encode($result[1]);
                }
                else{
                    http_response_code(404);
                    die("404 - Det blev ikke fundet");
                }
            }
            else if($this->countUri > 2){
                array_push($this->arrayVali, $uri[2]);
                $result = $vali->isNumeric($this->arrayVali);
                if($result == true){
                    $this->id = $uri[2];

                    $result = $workType->getOneWorkType($this->id);
                    echo json_encode($result->getWorkType());
                }
                else{
                    http_response_code(404);
                    die("404 - Det blev ikke fundet");
                }
            }
            else{
                http_response_code(400);
                die("400 - bad request");
            }
        }
    }
?>