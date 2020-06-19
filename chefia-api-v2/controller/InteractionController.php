<?php
    require_once dirname(__FILE__) . "/../model/InteractionModel.php";
    require_once dirname(__FILE__) . "/../model/dao/InteractionDAO.php";
    require_once dirname(__FILE__) . "/ContextController.php";

    class InteractionController {
        public function createInteraction() {

        }

        public function editInteraction() {

        }

        public function removeInteraction() {

        }

        public function getInteraction($interactionId) {
            if (is_null($interactionId))
                throw new Exception("O id da interação é obrigatório.");
            
            if (!is_numeric($interactionId))
                throw new Exception("O id da interação deve ser numérico.");

            if ((int)$interactionId < 0)
                throw new Exception("O id da interação não pode ser negativo.");

            if ((int)$this->countAllInteractions() == 0)
                throw new Exception("Não há nenhuma interação para ser carregada.");

            if(!$this->checkExistentInteraction($interactionId))
                throw new Exception("Interação inexistente.");

            $interactionModel = new InteractionModel($interactionId);
            $interactionDAO = new InteractionDAO();
    
            $interaction = $interactionDAO->getInteraction($interactionModel);

            $contextController = new ContextController();
            $context = $contextController->getContext($interaction->getContextModel()->getContextId());

            if (!is_null($context))
                $interaction->setContextModel($context);

            return $interaction;
        }

        public function getFirstInteraction() {
            $interactionDAO = new InteractionDAO();

            $interaction = $interactionDAO->getFirstInteraction();

            $contextController = new ContextController();
            $context = $contextController->getContext($interaction->getContextModel()->getContextId());

            if (!is_null($context))
                $interaction->setContextModel($context);

            return $interaction;
        }

        public function getAllInteractions() {
            
        }

        public function checkExistentInteraction($interactionId) {
            if (is_null($interactionId))
                throw new Exception("O id da interação é obrigatório.");
            
            if (!is_numeric($interactionId))
                throw new Exception("O id da interação deve ser numérico.");

            if ((int)$interactionId < 0)
                throw new Exception("O id da interação não pode ser negativo.");

            $interactionModel = new InteractionModel($interactionId);
            $interactionDAO = new InteractionDAO();

            return $interactionDAO->checkExistentInteraction($interactionModel);
        }

        public function countAllInteractions() {
            $interactionDAO = new InteractionDAO();

            return $interactionDAO->countAllInteractions();
        }
    }
?>