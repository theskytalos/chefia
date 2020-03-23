<?php
    require_once dirname(__FILE__) . "/../model/StateModel.php";
    require_once dirname(__FILE__) . "/../model/AlternativeModel.php";
    require_once dirname(__FILE__) . "/../controller/AlternativeController.php";
    require_once dirname(__FILE__) . "/../Rest.php";

    if (isset($requestBody["apiRequest"]) && !empty($requestBody["apiRequest"])) {
        switch($requestBody["apiRequest"]) {
            case "create":
		if (!checkNotNull($requestBody, ["alternativeText", "alternativeNextStateId", "stateId"]))
		    response(["success" => false, "content" => "URL inválida."]);

                $alternativeModel = new AlternativeModel();
                $alternativeController = new AlternativeController();

		$alternativeModel->setAlternativeText($requestBody["alternativeText"]);
		$alternativeModel->setAlternativeNextStateModel(new StateModel($requestBody["alternativeNextStateId"]));
		$alternativeModel->setStateModel(new StateModel($requestBody["stateId"]));

                response($alternativeController->createAlternative($alternativeModel));
                break;
            case "edit":
		if (!checkNotNull($requestBody, ["alternativeId", "alternativeText", "alternativeNextStateId", "stateId"]))
		    response(["success" => false, "content" => "URL inválida."]);

                $alternativeModel = new AlternativeModel();
                $alternativeController = new AlternativeController();

		$alternativeModel->setAlternativeId($requestBody["alternativeId"]);
		$alternativeModel->setAlternativeText($requestBody["alternativeText"]);
		$alternativeModel->setAlternativeNextStateModel(new StateModel($requestBody["alternativeNextStateId"]));
		$alternativeModel->setStateModel(new StateModel($requestBody["stateId"]));

                response($alternativeController->editAlternative($alternativeModel));
                break;
            case "remove":
		if (!checkNotNull($requestBody, ["alternativeId"]))
		    response(["success" => false, "content" => "URL inválida."]);

                $alternativeModel = new AlternativeModel();
                $alternativeController = new AlternativeController();

		$alternativeModel->setAlternativeId($requestBody["alternativeId"]);

                response($alternativeController->removeAlternative($alternativeModel));
                break;
            case "getAllByState":
		if (!checkNotNull($requestBody, ["stateId"]))
		    response(["success" => false, "content" => "URL inválida."]);

                $alternativeModel = new AlternativeModel();
                $alternativeController = new AlternativeController();

		$alternativeModel->setStateModel(new StateModel($requestBody["stateId"]));

                response($alternativeController->createAlternative($alternativeModel));
                break;
            default:
                response(["success" => false, "content" => "Comando de API desconhecido."]);
        }
    } else
        response(["success" => false, "content" => "URL inválida."]);
?>
