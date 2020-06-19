<?php
    require_once dirname(__FILE__) . "/../model/ChatModel.php";
    require_once dirname(__FILE__) . "/InteractionController.php";
    require_once dirname(__FILE__) . "/TransitionController.php";
    require_once dirname(__FILE__) . "/ItemController.php";

    class ChatController {
        public function getNextChat($interactionId) {
            if (is_null($interactionId))
                throw new Exception("O id da interação é obrigatório.");

            if (!is_numeric($interactionId))
                throw new Exception("O id da interação deve ser numérico.");

            if ((int)$interactionId < 0)
                throw new Exception("O id da interação não pode ser negativo.");

            $interactionController = new InteractionController();
            if ((int)$interactionController->countAllInteractions() == 0)
                throw new Exception("Não há chats para serem carregados.");

            if ((int)$interactionId > 0)
                $interaction = $interactionController->getInteraction($interactionId);
            else {
                $interaction = $interactionController->getFirstInteraction();
                $interactionId = $interaction->getInteractionId();
            }

            $transitionController = new TransitionController();
            $transitions = $transitionController->getAllTransitionsByOwnerInteraction($interactionId);

            $itemController = new ItemController();
            $items = $itemController->getAllItemsByInteraction($interactionId);

            $chatModel = new ChatModel();
            $chatModel->setChatInteraction($interaction);
            $chatModel->setChatTransitions($transitions);
            $chatModel->setChatItems($items);

            return $chatModel;
        }
    }
?>