<?php
    require_once dirname(__FILE__) . "/../model/ContextModel.php";
    require_once dirname(__FILE__) . "/../model/dao/ContextDAO.php";

    class ContextController {
        public function createContext() {

        }

        public function editContext() {

        }

        public function removeContext() {

        }

        public function getContext($contextId) {
            if (is_null($contextId))
                throw new Exception("O id do contexto não pode ser nulo.");

            if (!is_numeric($contextId))
                throw new Exception("O id do contexto deve ser numérico.");

            if ((int)$contextId < 0)
                throw new Exception("O id do contexto não pode ser negativo.");

            if (!$this->checkExistentContext($contextId))
                throw new Exception("Contexto inexistente.");

            $contextModel = new ContextModel($contextId);
            $contextDAO = new ContextDAO();

            return $contextDAO->getContext($contextModel);
        }

        public function getAllContexts() {
            
        }

        public function checkExistentContext($contextId) {
            if (is_null($contextId))
                throw new Exception("O id do contexto não pode ser nulo.");

            if (!is_numeric($contextId))
                throw new Exception("O id do contexto deve ser numérico.");

            if ((int)$contextId < 0)
                throw new Exception("O id do contexto não pode ser negativo.");

            $contextModel = new ContextModel($contextId);
            $contextDAO = new ContextDAO();

            return $contextDAO->checkExistentContext($contextModel);
        }
    }
?>