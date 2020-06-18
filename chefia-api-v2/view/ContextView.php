<?php
    require_once dirname(__FILE__) . "/../controller/ContextController.php";
    require_once dirname(__FILE__) . "/../Rest.php";

    if (isset($requestBody["apiRequest"]) && !empty($requestBody["apiRequest"])) {
        switch ($requestBody["apiRequest"]) {
            case "create":
                if (!checkNotNull($requestBody, ["contextName"]))
                    response(["success" => false, "content" => "URL inválida."]);

                $contextController = new ContextController();

                response($contextController->createContext($requestBody["contextName"]));
                break;
            case "edit":
                break;
            case "remove":
                break;
            case "get":
                break;
            default:
                response(["success" => false, "content" => "Comando de API desconhecido."]);
        }
    } else
        response(["success" => false, "content" => "URL inválida."]);
?>