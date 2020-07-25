<?php
    require_once dirname(__FILE__) . "/../controller/ShopController.php";
    require_once dirname(__FILE__) . "/../Rest.php";

    if (isset($requestBody["apiRequest"]) && !empty($requestBody["apiRequest"])) {
        switch ($requestBody["apiRequest"]) {
            case "create":
                break;
            case "edit":
                break;
            case "remove":
                break;
            case "getAll":
                break;
            default:
                response(["success" => false, "content" => "Comando de API desconhecido."]);
        }
    } else
        response(["success" => false, "content" => "URL inválida."]);
?>