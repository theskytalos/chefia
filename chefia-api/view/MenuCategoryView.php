<?php
    require_once dirname(__FILE__) . "/../model/MenuCategoryModel.php";
    require_once dirname(__FILE__) . "/../controller/MenuCategoryController.php";
    require_once dirname(__FILE__) . "/../Rest.php";

    if (isset($requestBody["apiRequest"]) && !empty($requestBody["apiRequest"])) {
        switch($requestBody["apiRequest"]) {
            case "create":
		$menuCategoryModel = new MenuCategoryModel();
		$menuCategoryController = new MenuCategoryController();

		response($menuCategoryController->createMenuCategory($menuCategoryModel));
                break;
            case "edit":
		$menuCategoryModel = new MenuCategoryModel();
		$menuCategoryController = new MenuCategoryController();

		response($menuCategoryController->createMenuCategory($menuCategoryModel));
                break;
            case "remove":
		$menuCategoryModel = new MenuCategoryModel();
		$menuCategoryController = new MenuCategoryController();

		response($menuCategoryController->createMenuCategory($menuCategoryModel));
                break;
            case "getAllByState":
		$menuCategoryModel = new MenuCategoryModel();
		$menuCategoryController = new MenuCategoryController();

		response($menuCategoryController->createMenuCategory($menuCategoryModel));
                break;
            default:
                response(["success" => false, "content" => "Comando de API desconhecido."]);
        }
    } else
        response(["success" => false, "content" => "URL inválida."]); 
?>
