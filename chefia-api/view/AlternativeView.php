<?php
    require_once dirname(__FILE__) . "/../model/AlternativeModel.php";
    require_once dirname(__FILE__) . "/../controller/AlternativeController.php";
    require_once dirname(__FILE__) . "/../Rest.php";

    if (isset($requestBody["apiRequest"]) && !empty($requestBody["apiRequest"])) {
        switch($requestBody["apiRequest"]) {
            case "create":
                $alternativeModel = new AlternativeModel();
                $alternativeController = new AlternativeController();

                if ($alternativeController->createAlternative($alternativeModel)) {

                } else {

                }

                break;
            case "edit":
                $alternativeModel = new AlternativeModel();
                $alternativeController = new AlternativeController();

                if ($alternativeController->editAlternative($alternativeModel)) {

                } else {

                }
                break;
            case "remove":
                $alternativeModel = new AlternativeModel();
                $alternativeController = new AlternativeController();

                if ($alternativeController->removeAlternative($alternativeModel)) {

                } else {

                }
                break;
            case "getAllByState":
                if ($alternativeController->createAlternative($alternativeModel)) {

                } else {

                }
                break;
            default:
                response(BAD_REQUEST, ["content" => "URL inválida"]);
        }
    } else
        response(BAD_REQUEST, ["content" => "URL inválida"]);
?>