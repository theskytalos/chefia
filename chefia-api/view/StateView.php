<?php
    require_once dirname(__FILE__) . "/../model/StateModel.php";
    require_once dirname(__FILE__) . "/../controller/StateController.php";
    require_once dirname(__FILE__) . "/../Rest.php";

    if (isset($requestBody["apiRequest"]) && !empty($requestBody["apiRequest"])) {
        switch($requestBody["apiRequest"]) {
            case "create":
                $stateModel = new StateModel();
                $stateController = new StateController();

                $stateModel->setStateText($requestBody["text"]);

                if ($stateController->createState($stateModel)) {

                } else {

                }

                break;
            case "edit":
                $stateModel = new StateModel();
                $stateController = new StateController();

                $stateModel->setStateId($requestBody["id"]);
                $stateModel->setStateText($requestBody["text"]);

                if ($stateController->editState($stateModel)) {

                } else {

                }

                break;
            case "remove":
                $stateModel = new StateModel();
                $stateController = new StateController();

                $stateModel->setStateId($requestBody["id"]);

                if ($stateController->removeState($stateModel)) {

                } else {

                }

                break;
            case "get":
                $stateModel = new StateModel();
                $stateController = new StateController();

                $stateModel->setStateId($requestBody["id"]);

                if ($stateController->getState($stateModel)) {
                
                } else {

                }

                break;
            case "getAll":
                if ($stateController->getAllStates()) {

                } else {
                    
                }

                break;
            default:
                response(BAD_REQUEST, ["content" => "URL inválida."])
        }
    } else
        response(BAD_REQUEST, ["content" => "URL inválida."]);

    exit();
?>