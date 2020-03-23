<?php
    require_once dirname(__FILE__) . "/../model/StateModel.php";
    require_once dirname(__FILE__) . "/../controller/StateController.php";
    require_once dirname(__FILE__) . "/../Rest.php";

    if (isset($requestBody["apiRequest"]) && !empty($requestBody["apiRequest"])) {
        switch($requestBody["apiRequest"]) {
            case "create":
		if (!checkNotNull($requestBody, ["stateText"]))
		    response(["success" => false, "content" => "URL inválida."]);

                $stateModel = new StateModel();
                $stateController = new StateController();

                $stateModel->setStateText($requestBody["stateText"]);

		response($stateController->createState($stateModel));
                break;
            case "edit":
		if (!checkNotNull($requestBody, ["stateId", "stateText"]))
		    response(["success" => false, "content" => "URL inválida."]);

                $stateModel = new StateModel();
                $stateController = new StateController();

                $stateModel->setStateId($requestBody["stateId"]);
                $stateModel->setStateText($requestBody["stateText"]);

		response($stateController->editState($stateModel));
                break;
            case "remove":
		if (!checkNotNull($requestBody, ["stateId"]))
		    response(["success" => false, "content" => "URL inválida."]);

                $stateModel = new StateModel();
                $stateController = new StateController();

                $stateModel->setStateId($requestBody["stateId"]);

               	response($stateController->removeState($stateModel));
                break;
            case "get":
		if (!checkNotNull($requestBody, ["stateId"]))
		    response(["success" => false, "content" => "URL inválida."]);

                $stateModel = new StateModel();
                $stateController = new StateController();

                $stateModel->setStateId($requestBody["stateId"]);

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
