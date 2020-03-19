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

		response($stateController->createState($stateModel));
                break;
            case "edit":
                $stateModel = new StateModel();
                $stateController = new StateController();

                $stateModel->setStateId($requestBody["id"]);
                $stateModel->setStateText($requestBody["text"]);

		response($stateController->editState($stateModel));
                break;
            case "remove":
                $stateModel = new StateModel();
                $stateController = new StateController();

                $stateModel->setStateId($requestBody["id"]);

               	response($stateController->removeState($stateModel));
                break;
            case "get":
                $stateModel = new StateModel();
                $stateController = new StateController();

                $stateModel->setStateId($requestBody["id"]);

                response($stateController->getState($stateModel));
                break;
            case "getAll":
                response($stateController->getAllStates());
                break;
            default:
                response(["success" => false, "content" => "Comando de API desconhecido."]);
        }
    } else
        response(["success" => false, "content" => "URL inválida."]);

    exit();
?>
