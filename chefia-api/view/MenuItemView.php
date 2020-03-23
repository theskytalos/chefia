<?php
    require_once dirname(__FILE__) . "/../model/MenuCategoryModel.php";
    require_once dirname(__FILE__) . "/../model/MenuItemModel.php";
    require_once dirname(__FILE__) . "/../controller/MenuItemController.php";
    require_once dirname(__FILE__) . "/../Rest.php";

    if (isset($requestBody["apiRequest"]) && !empty($requestBody["apiRequest"])) {
        switch($requestBody["apiRequest"]) {
            case "create":
		if (!checkNotNull($requestBody, ["menuItemName", "menuItemDescription", "menuItemPrice", "menuItemStock", "menuCategoryId"]))
		    response(["success" => false, "content" => "URL inválida."]);

		$menuItemModel = new MenuItemModel();
		$menuItemController = new MenuItemController();

		$menuItemModel->setMenuItemName($requestBody["menuItemName"]);
		$menuItemModel->setMenuItemDescription($requestBody["menuItemDescription"]);
		$menuItemModel->setMenuItemPrice($requestBody["menuItemPrice"]);
		$menuItemModel->setMenuItemStock($requestBody["menuItemStock"]);
		$menuItemModel->setMenuCategoryModel(new MenuCategoryModel($requestBody["menuCategoryId"]));

		response($menuItemController->createMenuItem($menuItemModel));
                break;
            case "edit":
		if (!checkNotNull($requestBody, ["menuItemId", "menuItemName", "menuItemDescription", "menuItemPrice", "menuItemStock", "menuCategoryId"]))
		    response(["success" => false, "content" => "URL inválida."]);

		$menuItemModel = new MenuItemModel();
		$menuItemController = new MenuItemController();

		$menuItemModel->setMenuItemId($requestBody["menuItemId"]);
		$menuItemModel->setMenuItemName($requestBody["menuItemName"]);
		$menuItemModel->setMenuItemDescription($requestBody["menuItemDescription"]);
		$menuItemModel->setMenuItemPrice($requestBody["menuItemPrice"]);
		$menuItemModel->setMenuItemStock($requestBody["menuItemStock"]);
		$menuItemModel->setMenuCategoryModel(new MenuCategoryModel($requestBody["menuCategoryId"]));

		response($menuItemController->editMenuItem($menuItemModel));
                break;
            case "remove":
		if (!checkNotNull($requestBody, ["menuItemId"]))
		    response(["success" => false, "content" => "URL inválida."]);

		$menuItemModel = new MenuItemModel();
		$menuItemController = new MenuItemController();

		$menuItemModel->setMenuItemId($requestBody["menuItemId"]);

		response($menuItemController->removeMenuItem($menuItemModel));
                break;
	    case "get":
		if (!checkNotNull($requestBody, ["menuItemId"]))
		    response(["success" => false, "content" => "URL inválida."]);

		$menuItemModel = new MenuItemModel();
		$menuItemController = new MenuItemController();

		$menuItemModel->setMenuItemId($requestBody["menuItemId"]);

		response($menuItemController->getMenuItemById($menuItemModel));
                break;
	    case "getAll":
		$menuItemController = new MenuItemController();

		response($menuItemController->getAllMenuItems());
                break;
            default:
                response(["success" => false, "content" => "Comando de API desconhecido."]);
        }
    } else
        response(["success" => false, "content" => "URL inválida."]);    
?>
