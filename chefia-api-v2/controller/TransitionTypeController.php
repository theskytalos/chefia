<?php
    require_once dirname(__FILE__) . "/../model/TransitionTypeModel.php";
    require_once dirname(__FILE__) . "/../model/dao/TransitionTypeDAO.php";

    class TransitionTypeController {
        public function createTransitionType() {

        }

        public function editTransitionType() {

        }

        public function removeTransitionType() {

        }

        public function getTransitionType($transitionTypeId) {
            if (is_null($transitionTypeId))
                throw new Exception("O id do tipo de transição não pode ser nulo.");

            if (!is_numeric($transitionTypeId))
                throw new Exception("O id do tipo de transição deve ser numérico.");

            if ((int)$transitionTypeId < 0)
                throw new Exception("O id do tipo de transição não pode ser negativo.");

            if (!$this->checkExistentTransitionType($transitionTypeId))
                throw new Exception("Tipo de transição inexistente.");

            $transitionModel = new TransitionTypeModel($transitionTypeId);
            $transitionDAO = new TransitionTypeDAO();

            return $transitionDAO->getTransitionType($transitionModel);
        }

        public function getAllTransitionTypes() {
            
        }

        public function checkExistentTransitionType($transitionTypeId) {
            if (is_null($transitionTypeId))
                throw new Exception("O id do tipo de transição não pode ser nulo.");

            if (!is_numeric($transitionTypeId))
                throw new Exception("O id do tipo de transição deve ser numérico.");

            if ((int)$transitionTypeId < 0)
                throw new Exception("O id do tipo de transição não pode ser negativo.");

            $transitionModel = new TransitionTypeModel($transitionTypeId);
            $transitionDAO = new TransitionTypeDAO();

            return $transitionDAO->checkExistentTransitionType($transitionModel);
        }
    }
?>