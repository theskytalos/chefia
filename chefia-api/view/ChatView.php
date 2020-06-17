<?php
    require_once dirname(__FILE__) . "/../model/StateModel.php";
    require_once dirname(__FILE__) . "/../model/ChatModel.php";
    require_once dirname(__FILE__) . "/../controller/ChatController.php";
    require_once dirname(__FILE__) . "/../Rest.php";

    if (isset($requestBody["apiRequest"]) && !empty($requestBody["apiRequest"])) {
        switch($requestBody["apiRequest"]) {
            case "getNextChat":
                if (!checkNotNull($requestBody, ["stateId"]))
                    response(["success" => false, "content" => "URL inválida."]);
                    
                $chatModel = new ChatModel();
                $chatController = new ChatController();
                
                $chatModel->setChatState(new StateModel($requestBody["stateId"]));
                response($chatController->getNextChat($chatModel));   
                break;
            default:
                response(["success" => false, "content" => "Comando de API desconhecido."]);
        }
    } else 
        response(["success" => false, "content" => "URL inválida."]);    
?>