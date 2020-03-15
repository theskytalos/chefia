<?php
    define("OK", 200);
    define("BAD_REQUEST", 400);
    define("UNAUTHORIZED", 401);
    define("INTERNAL_SERVER_ERROR", 500);
    define("NOT_IMPLEMENTED", 501);

    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }

    header("Content-Type:application/json");

    switch ($_SERVER["REQUEST_METHOD"]) {
        case "POST":
            $requestBody = (array) json_decode(file_get_contents("php://input"));
        break;
    }

    function response($responseCode, $responseData) {
        if (is_numeric($responseCode) && is_array($responseData)) {
            http_response_code($responseCode);
            echo json_encode(array("content" => "URL Inválida."));
        }
        exit();
    }
?>