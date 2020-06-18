<?php
    require_once dirname(__FILE__) . "/../model/ChatModel.php";
    require_once dirname(__FILE__) . "/../model/TransitionModel.php";
    require_once dirname(__FILE__) . "/../model/dao/InteractionDAO.php";

    class ContextController {
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

            $chatModel = new ChatModel();

            try {
                $interaction = $interactionController->getInteraction($interactionId);
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }

            if (is_null($interaction))
                throw new Exception("Interação inexistente.");

            $chatModel->setChatInteraction($interaction);
            $transitionController = new TransitionController();

            try {
                $transitions = $transitionController->getAllTransitionsByOwnerInteraction($interactionId);
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }

            $chatModel->setChatTransitions($transitions);

            return $chatModel;
        }
    }
?>