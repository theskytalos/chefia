<?php
    require_once dirname(__FILE__) . "/../model/MenuImageModel.php";
    require_once dirname(__FILE__) . "/../controller/MenuImageController.php";
    require_once dirname(__FILE__) . "/../Rest.php";

    if (isset($requestBody["apiRequest"]) && !empty($requestBody["apiRequest"])) {
        switch($requestBody["apiRequest"]) {
            case "create":
		$menuImageModel = new MenuImageModel();
		$menuImageController = new MenuImageController();

		response($menuImageController->createMenuImage($menuImageModel));
                break;
            case "edit":
		$menuImageModel = new MenuImageModel();
		$menuImageController = new MenuImageController();

		response($menuImageController->editMenuImage($menuImageModel));
                break;
            case "remove":
		$menuImageModel = new MenuImageModel();
		$menuImageController = new MenuImageController();

		response($menuImageController->removeMenuImage($menuImageModel));
                break;
            case "getAllByState":
		$menuImageModel = new MenuImageModel();
		$menuImageController = new MenuImageController();

		response($menuImageController->getAllMenuImagesByState($menuImageModel));
                break;
            default:
                response(["success" => false, "content" => "Comando de API desconhecido."]);
        }
    } else
        response(["success" => false, "content" => "URL inválida."]);    
?>
