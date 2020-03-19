<?php
    require_once dirname(__FILE__) . "/../model/MenuItemModel.php";
    require_once dirname(__FILE__) . "/../controller/MenuItemController.php";
    require_once dirname(__FILE__) . "/../Rest.php";

    if (isset($requestBody["apiRequest"]) && !empty($requestBody["apiRequest"])) {
        switch($requestBody["apiRequest"]) {
            case "create":
		$menuItemModel = new MenuItemModel();
		$menuItemController = new MenuItemController();

		response($menuItemController->createMenuItem($menuItemModel));
                break;
            case "edit":
		$menuItemModel = new MenuItemModel();
		$menuItemController = new MenuItemController();

		response($menuItemController->editMenuItem($menuItemModel));
                break;
            case "remove":
		$menuItemModel = new MenuItemModel();
		$menuItemController = new MenuItemController();

		response($menuItemController->removeMenuItem($menuItemModel));
                break;
            default:
                response(["success" => false, "content" => "Comando de API desconhecido."]);
        }
    } else
        response(["success" => false, "content" => "URL inválida."]);    
?>
