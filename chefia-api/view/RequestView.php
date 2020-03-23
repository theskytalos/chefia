<?php
    require_once dirname(__FILE__) . "/../model/RequestModel.php";
    require_once dirname(__FILE__) . "/../controller/RequestController.php";
    require_once dirname(__FILE__) . "/../Rest.php";

    if (isset($requestBody["apiRequest"]) && !empty($requestBody["apiRequest"])) {
        switch($requestBody["apiRequest"]) {
            case "create":
		if (!checkNotNull($requestBody, ["requestDateTime", "requestTotalCost", "requestPayMethod", "requestItems"]))
		    response(["success" => false, "content" => "URL inválida."]);

		$requestModel = new RequestModel();
		$requestController = new RequestController();

		$requestModel->setRequestDateTime($requestBody["requestDateTime"]);
		$requestModel->setRequestTotalCost($requestBody["requestTotalCost"]);
		$requestModel->setRequestPayMethod($requestBody["requestPayMethod"]);

		$requestItemsArray = array();
		if (is_array($requestItems))
		    foreach ($requestBody["requestItems"] as $requestItem)
		    	array_push($requestItemsArray, new MenuItemModel($requestItem));
		else
		    response(["success" => false, "content" => "Itens inválidos."]);

		$requestModel->setRequestItemsArray($requestItemsArray);

		response($requestController->createRequest($requestModel));
                break;
            case "edit":
		if (!checkNotNull($requestBody, ["requestId", "requestDateTime", "requestTotalCost", "requestPayMethod", "requestItems"]))
		    response(["success" => false, "content" => "URL inválida."]);

		$requestModel = new RequestModel();
		$requestController = new RequestController();

		$requestModel->setRequestId($requestBody["requestId"]);
		$requestModel->setRequestDateTime($requestBody["requestDateTime"]);
		$requestModel->setRequestTotalCost($requestBody["requestTotalCost"]);
		$requestModel->setRequestPayMethod($requestBody["requestPayMethod"]);

		$requestItemsArray = array();
		if (is_array($requestItems))
		    foreach ($requestBody["requestItems"] as $requestItem)
		    	array_push($requestItemsArray, new MenuItemModel($requestItem));
		else
		    response(["success" => false, "content" => "Itens inválidos."]);

		$requestModel->setRequestItemsArray($requestItemsArray);

		response($requestController->editRequest($requestModel));
                break;
            case "remove":
		if (!checkNotNull($requestBody, ["requestId"]))
		    response(["success" => false, "content" => "URL inválida."]);

		$requestModel = new RequestModel();
		$requestController = new RequestController();

		$requestModel->setRequestId($requestBody["requestId"]);

		response($requestController->removeRequest($requestModel));
                break;
            case "get":
		if (!checkNotNull($requestBody, ["requestId"]))
		    response(["success" => false, "content" => "URL inválida."]);

		$requestModel = new RequestModel();
		$requestController = new RequestController();

		$requestModel->setRequestId($requestBody["requestId"]);

		response($requestController->getRequestById($requestModel));
                break;
	    case "getByDate":
		if (!checkNotNull($requestBody, ["requestDateTime"]))
		    response(["success" => false, "content" => "URL inválida."]);

		$requestModel = new RequestModel();
		$requestController = new RequestController();

		$requestModel->setRequestDateTime($requestBody["requestDateTime"]);

		response($requestController->getRequestsByDate($requestModel));
		break;
	    case "getAll":
		$requestController = new RequestController();

		response($requestController->getRequestsByDate());
            default:
                response(["success" => false, "content" => "Comando de API desconhecido."]);
        }
    } else
        response(["success" => false, "content" => "URL inválida."]);
?>
