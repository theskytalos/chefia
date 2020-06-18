<?php
    require_once dirname(__FILE__) . "/../controller/ContextController.php";
    require_once dirname(__FILE__) . "/../Rest.php";

    if (isset($requestBody["apiRequest"]) && !empty($requestBody["apiRequest"])) {
        switch ($requestBody["apiRequest"]) {
            case "get":
                if (!checkNotNull($requestBody, ["interactionId"]))
                    response(["success" => false, "content" => "URL inválida."]);

                $chatController = new ChatController();
                
                response($chatController->getNextChat($requestBody["interactionId"]));

                break;
            default:
                response(["success" => false, "content" => "Comando de API desconhecido."]);
        }
    } else
        response(["success" => false, "content" => "URL inválida."]);
?>