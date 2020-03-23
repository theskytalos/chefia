<?php
    require_once dirname(__FILE__) . "/../model/MenuItemModel.php";
    require_once dirname(__FILE__) . "/../model/MenuImageModel.php";
    require_once dirname(__FILE__) . "/../controller/MenuImageController.php";
    require_once dirname(__FILE__) . "/../Rest.php";

    if (isset($requestBody["apiRequest"]) && !empty($requestBody["apiRequest"])) {
        switch($requestBody["apiRequest"]) {
            case "create":
		if (!checkNotNull($requestBody, ["menuImagePath", "menuItemId"]))
		    response(["success" => false, "content" => "URL inválida."]);

		$menuImageModel = new MenuImageModel();
		$menuImageController = new MenuImageController();

		$menuImageModel->setMenuImagePath($requestBody["menuImagePath"]);
		$menuImageModel->setMenuItemModel(new MenuItemModel($requestBody["menuItemId"]));

		response($menuImageController->createMenuImage($menuImageModel));
                break;
            case "remove":
		if (!checkNotNull($requestBody, ["menuImageId"]))
		    response(["success" => false, "content" => "URL inválida."]);

		$menuImageModel = new MenuImageModel();
		$menuImageController = new MenuImageController();

		$menuImageModel->setMenuImageId($requestBody["menuImageId"]);

		response($menuImageController->removeMenuImage($menuImageModel));
                break;
	    case "get":
		if (!checkNotNull($requestBody, ["menuImageId"]))
		    response(["success" => false, "content" => "URL inválida."]);

		$menuImageModel = new MenuImageModel();
		$menuImageController = new MenuImageController();

		$menuImageModel->setMenuImageId($requestBody["menuImageId"]);

		response($menuImageController->getMenuImage($menuImageModel));
		break;
            case "getAllByMenuItem":
		if (!checkNotNull($requestBody, ["menuItemId"]))
		    response(["success" => false, "content" => "URL inválida."]);

		$menuImageModel = new MenuImageModel();
		$menuImageController = new MenuImageController();

		$menuImageModel->setMenuItemModel(new MenuItemModel($requestBody["menuItemId"]));

		response($menuImageController->getAllMenuImagesByMenuItem($menuImageModel));
                break;
            default:
                response(["success" => false, "content" => "Comando de API desconhecido."]);
        }
    } else
        response(["success" => false, "content" => "URL inválida."]);    
?>
