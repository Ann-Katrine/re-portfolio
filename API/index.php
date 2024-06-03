<?php 
    // gør at man for alle fejl frem 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include_once("./GET.php");
    include_once("./POST.php");
    include_once("./PUT.php");
    include_once("./DELETE.php");

    // for at finde ud af hvilken medtode man bruge for at sende request'et, som det var get,post,put,delete, mm.
    $httpMethod = $_SERVER['REQUEST_METHOD'];

    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: *");
    header("Access-Control-Allow-Headers: *");
    if($httpMethod == "OPTIONS"){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: *");
        header("Access-Control-Allow-Headers: *");
        header("HTTP/1.1 200 OK");
        die();
    }

    // REQUEST_URI, kommer med alt der er i uri'en. Altså den kommer med alt der er i "QUERY_STRING" plus det, der er inden.
    $uri = $_SERVER['REQUEST_URI'];

    $tempUri = explode("/", $uri);  // deler "$uri" op efter være "/", så det bliver til et array 

    $antalUri = count($tempUri);
    //går at man går igennem alle index'ene i array'et og gør dem unset(sletter) i array'et, endtil man når til "api" så stopper den ved at bruge break
    for($i = 0; $i < $antalUri; $i++){
        if($tempUri[$i] == "api"){
            break;
        }
        unset($tempUri[$i]);
    }

    // gemmer de nye værdier, der ikke er blevet sat til unset
    $uri = array_values($tempUri);

    $headers = apache_request_headers();
    $accept = str_replace(' ', '',$headers['Accept']); // den fjener mellemrum
    $accept = explode(',', $accept); // deler den op efter "," og deler dem op i et array
    
    if($httpMethod === "POST"){
        $contentType = str_replace(' ', '',$headers['Content-Type']); 
        $contentType = explode(',', $contentType);
    }

    /*************************************************/
    /*                       stien                   */
    /*************************************************/
    //finder ud af hvilken HTTP requsts man bruger
    switch($httpMethod){
        case 'GET':
            $GET = new GET();
            $GET->findRoute($uri, $accept);
            break;
        case 'POST':
            $POST = new POST();
            $POST->findRoute($uri, $accept);
            break;
        case 'PUT':
            $PUT = new PUT();
            $PUT->findRoute($uri, $accept);
            break;
        case 'DELETE':
            $DELETE = new DELETE();
            $DELETE->findRoute($uri, $accept);
            break;
        default:
            http_response_code(400);
            die("400 - bad request method!");
            break;
    }
?>