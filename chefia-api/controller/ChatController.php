<?php
    require_once dirname(__FILE__) . "/../model/ChatModel.php";
    require_once dirname(__FILE__) . "/../controller/StateController.php";
    require_once dirname(__FILE__) . "/../controller/AlternativeController.php";

    class ChatController {
        function getNextChat($chatModel) {
            if (is_null($chatModel->getChatState()->getStateId()))
                return ["status" => false, "message" => "O Id do estado é obrigatório."];

            if (!is_numeric($chatModel->getChatState()->getStateId()))
                return ["status" => false, "message" => "O Id do estado deve ser numérico."];

            $stateController = new StateController();

            if (empty((int)$stateController->countAllStates()))
                return ["status" => false, "message" => "Não há Chats para serem carregados."];

            $stateResponse = $stateController->getState($chatModel->getChatState());

            if ($stateResponse["status"]) {
                $chatModel->setChatState($stateResponse["message"]);

                $alternativeModel = new AlternativeModel();
                $alternativeModel->setStateModel($stateResponse["message"]);

                $alternativeController = new AlternativeController();
                $alternativeResponse = $alternativeController->getAllAlternativesByState($alternativeModel);

                if (is_array($alternativeResponse["message"]))
                    $chatModel->setChatAlternatives($alternativeResponse["message"]);    

                return ["status" => true, "message" => $chatModel];
            } else
                return ["status" => false, "message" => "O Estado não existe."];
        }
    }
?>