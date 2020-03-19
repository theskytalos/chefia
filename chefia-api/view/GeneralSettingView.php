<?php
    require_once dirname(__FILE__) . "/../model/GeneralSettingModel.php";
    require_once dirname(__FILE__) . "/../controller/GeneralSettingController.php";
    require_once dirname(__FILE__) . "/../Rest.php";

    if (isset($requestBody["apiRequest"]) && !empty($requestBody["apiRequest"])) {
        switch($requestBody["apiRequest"]) {
            case "create":

                break;
            case "edit":

                break;
            case "remove":

                break;
            case "getAllByState":

                break;
            default:
                response(["success" => false, "content" => "Comando de API desconhecido."]);
        }
    } else
        response(["success" => false, "content" => "URL inválida."]);
?>
