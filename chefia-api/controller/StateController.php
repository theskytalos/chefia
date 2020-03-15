<?php
    require_once dirname(__FILE__) . "/../model/StateModel.php";
    require_once dirname(__FILE__) . "/../model/dao/StateDAO.php";

    class StateController {
        public function createState($stateModel) {
            if (is_null($stateModel->getStateText()) || is_empty($stateModel->getStateText())) {
                
            }

            $stateDAO = new StateDAO();
            return $stateDAO->createState($stateModel);
        }

        public function editState($stateModel) {
            if (is_null($stateModel->getStateId()) || is_empty($stateModel->getStateId())) {

            }

            if (!is_numeric($stateModel->getStateId())) {

            }

            if (is_null($stateModel->getStateText()) || is_empty($stateModel->getStateText())) {
                
            }

            if (!$stateDAO->checkExistentState($stateModel)) {
                // Estado referenciado não existe
            }

            $stateDAO = new StateDAO();
            return $stateDAO->editState($stateModel);
        }

        public function removeState($stateModel) {
            if (is_null($stateModel->getStateId()) || is_empty($stateModel->getStateId())) {

            }

            if (!is_numeric($stateModel->getStateId())) {

            }

            if (!$stateDAO->checkExistentState($stateModel)) {
                // Estado referenciado não existe
            }

            $stateDAO = new StateDAO();
            return $stateDAO->removeState($stateModel);
        }

        public function getState($stateModel) {
            if (is_null($stateModel->getStateId()) || is_empty($stateModel->getStateId())) {

            }

            if (!is_numeric($stateModel->getStateId())) {

            }

            if (!$stateDAO->checkExistentState($stateModel)) {
                // Estado referenciado não existe
            }
            
            $stateDAO = new StateDAO();
            return $stateDAO->getState($stateModel);
        }

        public function getAllStates() {
            $stateDAO = new StateDAO();
            return $stateDAO->getAllStates();
        }
    }
?>