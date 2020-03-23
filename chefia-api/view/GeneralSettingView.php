<?php
    require_once dirname(__FILE__) . "/../model/GeneralSettingModel.php";
    require_once dirname(__FILE__) . "/../controller/GeneralSettingController.php";
    require_once dirname(__FILE__) . "/../Rest.php";

    if (isset($requestBody["apiRequest"]) && !empty($requestBody["apiRequest"])) {
        switch($requestBody["apiRequest"]) {
            case "create":
		if (!checkNotNull($requestBody, ["generalSettingKey", "generalSettingValue"]))
		    response(["success" => false, "content" => "URL inválida."]);

		$generalSettingModel = new GeneralSettingModel();
		$generalSettingController = new GeneralSettingController();

		$generalSettingModel->setGeneralSettingKey($requestBody["generalSettingKey"]);
		$generalSettingModel->setGeneralSettingValue($requestBody["generalSettingValue"]);

		response($generalSettingController->createGeneralSetting($generalSettingModel));		
                break;
            case "edit":
		if (!checkNotNull($requestBody, ["generalSettingKey", "generalSettingValue"]))
		    response(["success" => false, "content" => "URL inválida."]);

		$generalSettingModel = new GeneralSettingModel();
		$generalSettingController = new GeneralSettingController();

		$generalSettingModel->setGeneralSettingKey($requestBody["generalSettingKey"]);
		$generalSettingModel->setGeneralSettingValue($requestBody["generalSettingValue"]);

		response($generalSettingController->editGeneralSetting($generalSettingModel));
                break;
            case "remove":
		if (!checkNotNull($requestBody, ["generalSettingKey"]))
		    response(["success" => false, "content" => "URL inválida."]);

		$generalSettingModel = new GeneralSettingModel();
		$generalSettingController = new GeneralSettingController();

		$generalSettingModel->setGeneralSettingKey($requestBody["generalSettingKey"]);

		response($generalSettingController->removeGeneralSetting($generalSettingModel));
                break;
	    case "getByKey":
		if (!checkNotNull($requestBody, ["generalSettingKey"]))
		    response(["success" => false, "content" => "URL inválida."]);

		$generalSettingModel = new GeneralSettingModel();
		$generalSettingController = new GeneralSettingController();

		$generalSettingModel->setGeneralSettingKey($requestBody["generalSettingKey"]);

		response($generalSettingController->getGeneralSettingByKey($generalSettingModel));
		break;
            case "getAll":
		$generalSettingController = new GeneralSettingController();
		response($generalSettingController->getAllGeneralSettings());

                break;
            default:
                response(["success" => false, "content" => "Comando de API desconhecido."]);
        }
    } else
        response(["success" => false, "content" => "URL inválida."]);
?>
