<?php
    include_once("../orm/Class/db.php");
    include_once("../orm/Class/Project.php");
    include_once("../orm/viewModel/project/3NewestProjektViewModel.php");
    include_once("../orm/viewModel/images/imagesWithoutTypeViewModel.php");
    include_once("../orm/viewModel/images/ImagesWithTypeViewModel.php");
    include_once("../orm/viewModel/project/favoriteProjectViewModel.php");
    include_once("../orm/viewModel/project/allProjektViewModel.php");
    include_once("../orm/viewModel/project/oneProjectViewModel.php");
    include_once("../orm/viewModel/language/oneLanguageViewModel.php");
    include_once("../orm/viewModel/diagram/oneDiagramViewModel.php");
    include_once("../orm/viewModel/workType/oneWorkTypeViewModel.php");
    include_once("../orm/viewModel/workType/allWorkTypeViewModel.php");
    include_once("../orm/viewModel/software/oneSoftwareViewModel.php");
    include_once("../orm/viewModel/software/AllSoftwareViewModel.php");
    include_once("../orm/viewModel/projectType/oneProjektTypeViewModel.php");
    include_once("../orm/viewModel/projectType/allProjektTypeViewModel.php");
    include_once("../orm/viewModel/project/allProjektToAdminViewModel.php");
    include_once("../orm/viewModel/project/allInformationProjectViewModel.php");

    class projectRepository{
        /*********************************/
        /*             GET               */     
        /*********************************/
        public function getAllProjectsId()
        {
            $db = new DB();
            $projekt = array();
            $arrayFinish = array();

            $stmt = $db->conn->prepare("SELECT id FROM projekt");
            $stmt->execute();

            $result =  $stmt->get_result();

            if($result != false){
                while ($row = $result->fetch_object()) {
                    $projekt[] = new Projects($row->id, null, null, null, null, null, null, null, null, null, null, null);
                }

                array_push($arrayFinish, true, $projekt);
            }
            else{
                array_push($arrayFinish, false);
            }
            return $arrayFinish;
            $stmt->close();
            $db->conn->close();
        }

        // custom JSON format
        public function getAllProject($projectId)
        {
            $db = new DB();
            $finish = "";
            $arrayFinish = array();
            $images = array();
            $project = null;

            $stmt = $db->conn->prepare("SELECT projekt.id, projekt.name, billeder.name AS imagesName, billeder.sted, category.name AS type
                                        FROM projekt
                                        INNER JOIN billeder_has_projekt ON billeder_has_projekt.projekt_id = projekt.id
                                        INNER JOIN billeder ON billeder.id = billeder_has_projekt.billeder_id
                                        INNER JOIN category ON category.id = billeder_has_projekt.category_id
                                        WHERE projekt.id = ?");
            
            $id = $projectId->getId();

            $stmt->bind_param("i", $id);
            $stmt->execute();
            
            $result = $stmt->get_result();

            if($result != false){
                while ($row = $result->fetch_object()) {
                    $images[] = new ImagesWithTypeViewModel($row->imagesName, $row->sted, $row->type);
                    $project = new AllProjektViewModel($row->id, $row->name, $images);
                }

                $antalImages = count($images);
                
                for ($i=0; $i < $antalImages; $i++) { 
                    $getImages[] = [
                        "name" => $project->allProjectImages[$i]->imagesName,
                        "sted" => $project->allProjectImages[$i]->imagesSted,
                        "type" => $project->allProjectImages[$i]->imagesType
                    ];
                }

                $finish = [
                    "id" => $project->allProjectId,
                    "name" => $project->allProjectName,
                    "images" => $getImages
                ];

                array_push($arrayFinish, true, $finish);
            }
            else{
                array_push($arrayFinish, false);
            }
            return $arrayFinish;
            $stmt->close();
            $db->conn->close();
        }

        // custom JSON format
        public function getAllProjectToAdmin($projectId)
        {
            $db = new DB();
            $finish = "";
            $arrayFinish = array();
            $project = null;

            $stmt = $db->conn->prepare("SELECT id, name, start_date, end_date FROM projekt WHERE id = ?");

            $id = $projectId->getId();

            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false){
                while ($row =  $result->fetch_object()) {
                    $project = new AllProjektToAdminViewModel($row->id, $row->name, $row->start_date, $row->end_date);
                }

                $finish = [
                    "id" => $project->allProjectId,
                    "name" => $project->allProjectName,
                    "startDate" => $project->allProjectStartDate,
                    "endDate" => $project->allProjectEndDate
                ];

                array_push($arrayFinish, true, $finish);
            }
            else{
                array_push($arrayFinish, false);
            }
            return $arrayFinish;
            $stmt->close();
            $db->conn->close();
        }

        // custom JSON format
        public function getOneProjekt($id, $images, $language, $diagram)
        {
            $db = new DB();
            $finish = array();

            $stmt = $db->conn->prepare("SELECT projekt.name, projekt.favorite , projekt.dato, projekt.description, projekt.start_date, projekt.end_date, GROUP_CONCAT(DISTINCT billeder.name) as imagesName, GROUP_CONCAT(DISTINCT billeder.sted) as imagesSted, GROUP_CONCAT(DISTINCT sprog.name) as sprog, GROUP_CONCAT(DISTINCT diagrammer.name) as diagram, GROUP_CONCAT(DISTINCT arbejds_type.name) as arbejdsType, GROUP_CONCAT(DISTINCT software.name) as software, GROUP_CONCAT(DISTINCT projekt_type.name) as projektType FROM projekt 
                                        INNER JOIN billeder_has_projekt ON projekt.id = billeder_has_projekt.projekt_id
                                        INNER JOIN billeder ON billeder.id = billeder_has_projekt.billeder_id
                                        INNER JOIN projekt_has_sprog ON projekt.id = projekt_has_sprog.projekt_id
                                        INNER JOIN sprog ON sprog.id = projekt_has_sprog.sprog_id
                                        INNER JOIN projekt_has_diagrammer ON projekt.id = projekt_has_diagrammer.projekt_id
                                        INNER JOIN diagrammer ON diagrammer.id = projekt_has_diagrammer.diagrammer_id
                                        INNER JOIN arbejds_type ON arbejds_type.id = projekt.arbejds_type_id
                                        INNER JOIN software ON software.id = projekt.software_id
                                        INNER JOIN projekt_type ON projekt_type.id = projekt.projekt_type_id
                                        WHERE projekt.id = ? GROUP BY projekt.id");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false && $result->num_rows > 0){
                while($row = $result->fetch_object()){
                    $workType = new OneWorkTypeViewModel($row->arbejdsType);
                    $softwareValue = new OneSoftwareViewModel($row->software);
                    $projectType = new OneProjectTypeViewModel($row->projektType);
                    $project = new OneprojectViewModel($row->name, $row->favorite, $row->description, $row->start_date, $row->end_date, $softwareValue, $projectType, $workType, $images, $language, $diagram);
                }

                $setProject = [
                    "name" => $project->projectName,
                    "favorite" => $project->projectFavorite,
                    "description" => $project->projectDescription,
                    "startDate" => $project->projectStartDate,
                    "endDate" => $project->projectEndDate,
                    "software" => $project->projectSoftware->softwareName,
                    "projectType" => $project->projectProjectType->projectTypeName,
                    "workType" => $project->projectWorkType->WorkTypeName,
                    "images" => $images,
                    "language" => $language,
                    "diagram" => $diagram
                ];

                array_push($finish, true, $setProject);
            }
            else{
                array_push($finish, false);
            }
            return $finish;
            $stmt->close();
            $db->conn->close();
        }

        // custom JSON format
        public function getOneProjectToAdmin($id, $images, $language, $diagram)
        {
            $db = new DB();
            $finish = array();

            $stmt = $db->conn->prepare("SELECT projekt.id, projekt.name, projekt.favorite, projekt.dato, projekt.description, projekt.start_date, projekt.end_date, arbejds_type.id AS arbejdsId, arbejds_type.name AS arbejdsType, software.id AS softwareId, software.name AS software, projekt_type.id AS projektTypeId, projekt_type.name AS projektType 
                                        FROM projekt 
                                        INNER JOIN arbejds_type ON arbejds_type.id = projekt.arbejds_type_id 
                                        INNER JOIN software ON software.id = projekt.software_id 
                                        INNER JOIN projekt_type ON projekt_type.id = projekt.projekt_type_id 
                                        WHERE projekt.id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false && $result->num_rows > 0){
                while ($row = $result->fetch_object()) {
                    $workType[] = new AllWorkTypeViewModel($row->arbejdsId, $row->arbejdsType);
                    $softwareValue[] = new AllSoftwareViewModel($row->softwareId, $row->software);
                    $projectType[] = new AllProjectTypeViewModel($row->projektTypeId, $row->projektType);
                    $project = new AllInformationOneProject($row->id, $row->name, $row->favorite, $row->dato, $row->description, $row->start_date, $row->end_date, $softwareValue, $projectType, $workType, $language, $diagram, $images);
                }

                $setProject = [
                    "id" => $project->projectId,
                    "name" => $project->projectName,
                    "favorite" => $project->projectFavorite,
                    "date" => $project->projectDate,
                    "description" => $project->projectDescription,
                    "startDate" => $project->projectStartDate,
                    "endDate" => $project->projectEndDate,
                    "software" => array(
                        "id" => $project->projectSoftware[0]->softwareId,
                        "name" => $project->projectSoftware[0]->softwareName
                    ),
                    "projectType" => array(
                        "id" => $project->projectProjectType[0]->projectTypeId,
                        "name" => $project->projectProjectType[0]->projectTypeName
                    ),
                    "workType" => array(
                        "id" => $project->projectWorkType[0]->workTypeId,
                        "name" => $project->projectWorkType[0]->workTypeName
                    ),
                    "language" => $language,
                    "diagram" => $diagram,
                    "images" => $images
                ];
                array_push($finish, true, $setProject);
            }
            else{
                array_push($finish, false);
            }
            return $finish;
            $stmt->close();
            $db->conn->close();
        }

        public function getOneProjektWithId($id)
        {
            $db = new DB();
            $finish = array();

            $stmt = $db->conn->prepare("SELECT id FROM projekt WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false && $result->num_rows > 0){
                return true;
            }
            else{
                return false;
            }
            $stmt->close();
            $db->conn->close();
        }

        public function get3NewestProject() // - bliver brugt
        {
            $db = new DB();
            $project = array();
            $arrayFinish = array();

            $stmt = $db->conn->prepare("SELECT projekt.id FROM projekt ORDER by projekt.dato DESC LIMIT 3");
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false){
                while ($row = $result->fetch_object()){
                    $project[] = new Projects($row->id, null, null, null, null, null, null, null, null, null, null, null);
                }

                array_push($arrayFinish, true, $project);

                http_response_code(200);
                return $arrayFinish;
            }
            else{
                array_push($arrayFinish, false);
                
                http_response_code(404);
                return $arrayFinish;
            }

            $stmt->close();
            $db->conn->close();
        }

        // custom JSON format 
        public function getinformationToThe3NewestProject($id)
        {
            $db = new DB();
            $finish = "";
            $projekt = null;
            $images = array();
            $arrayFinish = array();

            $stmt = $db->conn->prepare("SELECT projekt.id, projekt.name, billeder.name AS image, billeder.sted, category.name AS type
                                        FROM projekt
                                        INNER JOIN billeder_has_projekt ON billeder_has_projekt.projekt_id = projekt.id
                                        INNER JOIN billeder ON billeder.id = billeder_has_projekt.billeder_id
                                        INNER JOIN category ON category.id = billeder_has_projekt.category_id
                                        WHERE projekt.id = ?
                                        GROUP BY projekt.id");
            
            // $id = $projectId->getId();

            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false){
                while ($row = $result->fetch_object()) {
                    $images[] = new ImagesWithTypeViewModel($row->image, $row->sted, $row->type);
                    $projekt = new Newest3ProjectViewModel($row->id, $row->name, $images);
                }

                var_dump($projekt);
                var_dump($id);
                exit();

                $finish = [
                    "id" => $projekt->newest3ProjectId,
                    "name" => $projekt->newest3ProjectName,
                    "images" => array(
                        "name" => $projekt->newest3ProjectImages[0]->imagesName,
                        "sted" => $projekt->newest3ProjectImages[0]->imagesSted,
                        "type" => $projekt->newest3ProjectImages[0]->imagesType
                    )
                ];

                array_push($arrayFinish, true, $finish);
            }
            else{
                array_push($arrayFinish, false);
            }
            return $arrayFinish;
            $stmt->close();
            $db->conn->close();
        }

        //custom JSON format
        public function getFavoritProjekt() // - bliver brugt
        {
            $db = new DB();
            $finish = array();
            $projekt = null;
            $arrayFinish = array();
            $images = array();

            $stmt = $db->conn->prepare("SELECT projekt.name, projekt.favorite, billeder.name as imagesName, billeder.sted 
                                        FROM projekt
                                        INNER JOIN billeder_has_projekt ON billeder_has_projekt.projekt_id = projekt.id
                                        INNER JOIN billeder ON billeder.id = billeder_has_projekt.billeder_id 
                                        INNER JOIN category ON category.id = billeder_has_projekt.category_id
                                        WHERE projekt.favorite = 1 
                                        GROUP BY projekt.id");
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false){
                while ($row = $result->fetch_object()){
                    $images[] = new ImagesWithoutTypeViewModel($row->imagesName, $row->sted);
                    $projekt = new FavoriteProjectViewModel($row->name, $row->favorite, $images);
                }

                $finish = [
                    "name" => $projekt->farvoriteProjektName,
                    "favorite" => $projekt->farvoriteProjektFavorite,
                    "images" => array(
                        "name" => $projekt->favoriteProjektImages[0]->imagesName,
                        "sted" => $projekt->favoriteProjektImages[0]->imagesSted
                    )
                ];

                array_push($arrayFinish, true, $finish);
            }
            else{
                array_push($arrayFinish, false, $db->conn->error);
            }
            return $arrayFinish;
            $stmt->close();
            $db->conn->close();
        }

        public function getOneProjectTocheckWith($id)
        {
            $db = new DB();
            $finish = array();

            $stmt = $db->conn->prepare("SELECT projekt.name, projekt.favorite, projekt.description, projekt.start_date, projekt.end_date, software.id AS softwareId, projekt_type.id AS projectTypeId, arbejds_type.id AS workTypeId
                                        FROM projekt
                                        INNER JOIN software ON software.id = projekt.software_id
                                        INNER JOIN arbejds_type ON arbejds_type.id = projekt.arbejds_type_id
                                        INNER JOIN projekt_type ON projekt_type.id = projekt.projekt_type_id
                                        WHERE projekt.id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false){
                while ($row = $result->fetch_object()) {
                    $project = new Projects(null, $row->name, $row->favorite, null, $row->description, $row->start_date, $row->end_date, $row->softwareId, $row->projectTypeId, $row->workTypeId, null, null);
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

        public function getOneBillederProjekt($id, $whichId)
        {
            $db = new DB();
            $mMtabel = array();
            $billeder = array();

            if($whichId == "projekt"){
                $stmt = $db->conn->prepare("SELECT projekt_id, billeder_id FROM billeder_has_projekt WHERE projekt_id = ?");
            }
            else if($whichId == "billeder"){
                $stmt = $db->conn->prepare("SELECT projekt_id, billeder_id FROM billeder_has_projekt WHERE billeder_id = ?");
            }
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false && $result->num_rows > 0){
                while ($row = $result->fetch_object()) {
                    $billeder[] = new Projects($row->projekt_id, null, null, null, null, null, null, null, null, null, null, null, $row->billeder_id);
                }
                array_push($mMtabel, true, $billeder);
            }
            else{
                array_push($mMtabel, false);
            }
            return $mMtabel;
            $stmt->close();
            $db->conn->close();
        }

        public function getOneDiagramProjekt($id, $whichId)
        {
            $db = new DB();
            $mMtabel = array();

            if($whichId == "projekt"){
                $stmt = $db->conn->prepare("SELECT projekt_id, diagrammer_id FROM projekt_has_diagrammer WHERE projekt_id = ?");
            }
            else if($whichId == "diagram"){
                $stmt = $db->conn->prepare("SELECT projekt_id, diagrammer_id FROM projekt_has_diagrammer WHERE diagrammer_id = ?");
            }
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false && $result->num_rows > 0){
                http_response_code(200);
                return true;
            }
            else{
                http_response_code(404);
                return false;
            }

            $stmt->close();
            $db->conn->close();
        }

        public function getOneSprogProjekt($id, $whichId)
        {
            $db = new DB();
            $mMtabel = array();

            if($whichId == "projekt"){
                $stmt = $db->conn->prepare("SELECT projekt_id, sprog_id FROM projekt_has_sprog WHERE projekt_id = ?");
            }
            else if($whichId == "sprog"){
                $stmt = $db->conn->prepare("SELECT projekt_id, sprog_id FROM projekt_has_sprog WHERE sprog_id = ?");
            }
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result != false && $result->num_rows > 0){
                return true;
            }
            else{
                return false;
            }

            $stmt->close();
            $db->conn->close();
        }

        /*********************************/
        /*             POST              */     
        /*********************************/
        public function postProjekt($projekt)
        {
            $db = new DB(); 

            $stmt = $db->conn->prepare("INSERT INTO projekt (name, favorite, dato, description, start_date, end_date, arbejds_type_id, software_id, projekt_type_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $name = $projekt->getName();
            $favorite = $projekt->getFavorite();
            $date = $projekt->getDate();
            $description = $projekt->getDescription();
            $startDate = $projekt->getStartDate();
            $endDate = $projekt->getEndDate();
            $software = $projekt->getSoftware();
            $proejktType = $projekt->getProjektType();
            $workType  = $projekt->getWorkType();

            $stmt->bind_param('sisssssss', $name, $favorite, $date, $description, $startDate, $endDate, $software, $proejktType, $workType);
            $stmt->execute();

            $result = $stmt->affected_rows;

            if($result === 1){

                $id = $db->conn->insert_id;
                $arrayTrue = array();
                array_push($arrayTrue, true, $id);
                
                http_response_code(201);
                return $arrayTrue;
            }
            else{
                $arrayflase = array();
                array_push($arrayflase, false);
                return $arrayflase;
            }

            $stmt->close();
            $db->conn->close();
        }

        public function postSprogProjekt($projektId, $sprogId)
        {
            $db = new DB();
            
            $stmt = $db->conn->prepare("INSERT INTO projekt_has_sprog (projekt_id, sprog_id) VALUES (?, ?)");

            $language = $sprogId->getId();

            $stmt->bind_param("ii", $projektId, $language);
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

        public function postDiagramProjekt($projektId, $diagramId)
        {

            $db = new DB();
            
            $stmt = $db->conn->prepare("INSERT INTO projekt_has_diagrammer(projekt_id, diagrammer_id) VALUES (?, ?)");

            $diagram = $diagramId->getId();

            $stmt->bind_param("ii", $projektId, $diagram);
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

        /*********************************/
        /*              PUT              */
        /*********************************/
        public function putProjekt($projekt)
        {
            $db = new DB();  
            
            $id = $projekt->getId();

            $stmt = $db->conn->prepare("UPDATE projekt SET name = ?, favorite = ?, dato = ?, description = ?, start_date = ?, end_date = ?, arbejds_type_id = ?, software_id = ?, projekt_type_id = ? WHERE id =" . $id);
                        
            $name = $projekt->getName();
            $favorite = $projekt->getFavorite();
            $date = $projekt->getDate();
            $description = $projekt->getDescription();
            $startDate = $projekt->getStartDate();
            $endDate = $projekt->getEndDate();
            $software = $projekt->getSoftware();
            $proejktType = $projekt->getProjektType();
            $workType  = $projekt->getWorkType();

            $stmt->bind_param("sissssiii", $name, $favorite, $date, $description, $startDate, $endDate, $software, $proejktType, $workType);
            $stmt->execute();

            if($stmt->execute() == true){
                return true;
            }
            else{
                return false;
            }

            $stmt->close();
            $db->conn->close();
        }

        public function putSprogProjekt($sprogId, $projektId)
        {
            $db = new DB();

            $stmt = $db->conn->prepare("UPDATE projekt_has_sprog SET projekt_id = ?, sprog_id = ? WHERE projekt_id =" . $projektId);
            $stmt->bind_param("ii", $sprogId, $projektId);
            $stmt->execute();

            if($stmt->execute() == true){
                http_response_code(201);
                return true;
            }
            else{
                http_response_code(404);
                die("Det blev ikke ændret");
            }

            $stmt->close();
            $db->conn->close();
        }

        public function putDiagramProjekt($diagramId, $projektId)
        {
            $db = new DB();

            $stmt = $db->conn->prepare("UPDATE projekt_has_diagrammer SET projekt_id = ?, diagrammer_id = ? WHERE projekt_id =" . $projektId);
            $stmt->bind_param("ii", $diagramId, $projektId);
            $stmt->execute();

            if($stmt->execute() == true){
                http_response_code(201);
                return true;
            }
            else{
                http_response_code(404);
                die("Det blev ikke ændret");
            }

            $stmt->close();
            $db->conn->close();
        }

        /*********************************/
        /*              DELETE           */
        /*********************************/
        public function deleteProjekt($id)
        {
            $db = new DB();   

            $stmt = $db->conn->prepare("DELETE FROM projekt WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->affected_rows;

            if($result === 1){
                http_response_code(200);
                
                return true;
            }
            else{
                http_response_code(404);
                return false;
            }

            $stmt->close();
            $db->conn->close();
        }

        public function deleteSprogProjekt($id, $whichId)
        {
            $db = new DB();
            $finish = array();

            if($whichId == "projekt"){
                $stmt = $db->conn->prepare("DELETE FROM projekt_has_sprog WHERE projekt_id = ?");
            }
            else if($whichId == "sprog"){
                $stmt = $db->conn->prepare("DELETE FROM projekt_has_sprog WHERE sprog_id = ?");
            }
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->affected_rows;
            if($result >= 1){
                array_push($finish, true);
            }
            else{
                array_push($finish, false, $db->conn->error);
            }
            return $finish;
            $stmt->close();
            $db->conn->close();
        }

        public function deleteDiagramProjekt($id, $whichId)
        {
            $db = new DB();
            $finish = array();

            if($whichId == "projekt"){
                $stmt = $db->conn->prepare("DELETE FROM projekt_has_diagrammer WHERE projekt_id = ?");
            }
            else if($whichId == "diagram"){
                $stmt = $db->conn->prepare("DELETE FROM projekt_has_diagrammer WHERE diagrammer_id = ?");
            }

            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->affected_rows;

            if($result >= 1){
                array_push($finish, true);
            }
            else{
                array_push($finish, false, $db->conn->error);
            }
            return $finish;
            $stmt->close();
            $db->conn->close();
        }
    }
?>