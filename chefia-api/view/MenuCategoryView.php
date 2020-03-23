<?php
    require_once dirname(__FILE__) . "/../model/MenuCategoryModel.php";
    require_once dirname(__FILE__) . "/../controller/MenuCategoryController.php";
    require_once dirname(__FILE__) . "/../Rest.php";

    if (isset($requestBody["apiRequest"]) && !empty($requestBody["apiRequest"])) {
        switch($requestBody["apiRequest"]) {
            case "create":
		if (!checkNotNull($requestBody, ["menuCategoryText"]))
		    response(["success" => false, "content" => "URL inválida."]);

		$menuCategoryModel = new MenuCategoryModel();
		$menuCategoryController = new MenuCategoryController();

		$menuCategoryModel->setMenuCategoryText($requestBody["menuCategoryText"]);

		response($menuCategoryController->createMenuCategory($menuCategoryModel));
                break;
            case "edit":
		if (!checkNotNull($requestBody, ["menuCategoryId", "menuCategoryText"]))
		    response(["success" => false, "content" => "URL inválida."]);

		$menuCategoryModel = new MenuCategoryModel();
		$menuCategoryController = new MenuCategoryController();

		$menuCategoryModel->setMenuCategoryId($requestBody["menuCategoryId"]);
		$menuCategoryModel->setMenuCategoryText($requestBody["menuCategoryText"]);

		response($menuCategoryController->createMenuCategory($menuCategoryModel));
                break;
            case "remove":
		if (!checkNotNull($requestBody, ["menuCategoryId"]))
		    response(["success" => false, "content" => "URL inválida."]);

		$menuCategoryModel = new MenuCategoryModel();
		$menuCategoryController = new MenuCategoryController();

		$menuCategoryModel->setMenuCategoryId($requestBody["menuCategoryId"]);

		response($menuCategoryController->createMenuCategory($menuCategoryModel));
                break;
	    case "get":
		if (!checkNotNull($requestBody, ["menuCategoryId"]))
		    response(["success" => false, "content" => "URL inválida."]);

		$menuCategoryModel = new MenuCategoryModel();
		$menuCategoryController = new MenuCategoryController();

		$menuCategoryModel->setMenuCategoryId($requestBody["menuCategoryId"]);

		response($menuCategoryController->getMenuCategory($menuCategoryModel));
                break;
            case "getAll":
		$menuCategoryController = new MenuCategoryController();

		response($menuCategoryController->createMenuCategory());
                break;
            default:
                response(["success" => false, "content" => "Comando de API desconhecido."]);
        }
    } else
        response(["success" => false, "content" => "URL inválida."]); 
?>
