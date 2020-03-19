<?php
    require_once dirname(__FILE__) . "/../model/RequestModel.php";
    require_once dirname(__FILE__) . "/../controller/RequestController.php";
    require_once dirname(__FILE__) . "/../Rest.php";

    if (isset($requestBody["apiRequest"]) && !empty($requestBody["apiRequest"])) {
        switch($requestBody["apiRequest"]) {
            case "create":
		$requestModel = new RequestModel();
		$requestController = new RequestController();

		response($requestController->createRequest($requestModel));
                break;
            case "edit":
		$requestModel = new RequestModel();
		$requestController = new RequestController();

		response($requestController->editRequest($requestModel));
                break;
            case "remove":
		$requestModel = new RequestModel();
		$requestController = new RequestController();

		response($requestController->removeRequest($requestModel));
                break;
            default:
                response(["success" => false, "content" => "Comando de API desconhecido."]);
        }
    } else
        response(["success" => false, "content" => "URL inválida."]);
?>
