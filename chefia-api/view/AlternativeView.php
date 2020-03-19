<?php
    require_once dirname(__FILE__) . "/../model/AlternativeModel.php";
    require_once dirname(__FILE__) . "/../controller/AlternativeController.php";
    require_once dirname(__FILE__) . "/../Rest.php";

    if (isset($requestBody["apiRequest"]) && !empty($requestBody["apiRequest"])) {
        switch($requestBody["apiRequest"]) {
            case "create":
                $alternativeModel = new AlternativeModel();
                $alternativeController = new AlternativeController();

                response($alternativeController->createAlternative($alternativeModel));
                break;
            case "edit":
                $alternativeModel = new AlternativeModel();
                $alternativeController = new AlternativeController();

                response($alternativeController->editAlternative($alternativeModel));
                break;
            case "remove":
                $alternativeModel = new AlternativeModel();
                $alternativeController = new AlternativeController();

                response($alternativeController->removeAlternative($alternativeModel));
                break;
            case "getAllByState":
                response($alternativeController->createAlternative($alternativeModel));
                break;
            default:
                response(["success" => false, "content" => "Comando de API desconhecido."]);
        }
    } else
        response(["success" => false, "content" => "URL inválida."]);
?>
