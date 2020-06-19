<?php
    require_once dirname(__FILE__) . "/../controller/ChatController.php";
    require_once dirname(__FILE__) . "/../Rest.php";

    if (isset($requestBody["apiRequest"]) && !empty($requestBody["apiRequest"])) {
        switch ($requestBody["apiRequest"]) {
            case "get":
                if (!checkNotNull($requestBody, ["interactionId"]))
                    response(["success" => false, "content" => "URL inválida."]);

                $chatController = new ChatController();
                
                try {
                    response(["success" => true, "content" => $chatController->getNextChat($requestBody["interactionId"])]);
                } catch (Exception $e) {
                    response(["success" => false, "content" => $e->getMessage()]);
                } finally {
                    response(["success" => false, "content" => "Um erro inesperado aconteceu."]);
                }

                break;
            default:
                response(["success" => false, "content" => "Comando de API desconhecido."]);
        }
    } else
        response(["success" => false, "content" => "URL inválida."]);

    exit();
?>