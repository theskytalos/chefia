<?php
    require_once dirname(__FILE__) . "/../model/TransitionModel.php";
    require_once dirname(__FILE__) . "/../model/InteractionModel.php";
    require_once dirname(__FILE__) . "/../model/dao/TransitionDAO.php";
    require_once dirname(__FILE__) . "/../controller/TransitionTypeController.php";

    class TransitionController {
        public function createTransition() {

        }

        public function editTransition() {

        }

        public function removeTransition() {

        }

        public function getTransition($transitionId) {

        }

        public function getAllTransitions() {
            
        }

        public function getAllTransitionsByOwnerInteraction($interactionOwnerId) {
            if (is_null($interactionOwnerId))
                throw new Exception("O id da interação é obrigatório.");

            if (!is_numeric($interactionOwnerId))
                throw new Exception("O id da interação deve ser numérico.");

            if ((int)$interactionOwnerId < 0)
                throw new Exception("O id da interação não pode ser negativo.");

            $interactionController = new InteractionController();
            if ((int)$interactionController->countAllInteractions() == 0)
                throw new Exception("Não há nenhuma interação para ser carregada.");

            if (!$interactionController->checkExistentInteraction($interactionOwnerId))
                throw new Exception("Interação inexistente.");

            $transitionModel = new TransitionModel();
            $transitionDAO = new TransitionDAO();

            $transitionModel->setTransitionFromModel(new InteractionModel($interactionOwnerId));
            $transitions = $transitionDAO->getAllTransitionsByOwnerInteraction($transitionModel);

            if (count($transitions) > 0) {
                foreach($transitions as &$transition) {
                    $transitionTypeController = new TransitionTypeController();
                    $transition->setTransitionTypeModel($transitionTypeController->getTransitionType($transition->getTransitionTypeModel()->getTransitionTypeId()));
                }
            }

            return $transitions;
        }
    }
?>