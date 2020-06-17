<?php
    require_once dirname(__FILE__) . "/../model/StateModel.php";
    require_once dirname(__FILE__) . "/../model/dao/StateDAO.php";

    class StateController {
        public function createState($stateModel) {
            if (is_null($stateModel->getStateText()) || empty($stateModel->getStateText()))
            	return ["status" => false, "message" => "O campo Texto do Estado é obrigatório."];

	    if (is_numeric($stateModel->getStateText()))
		return ["status" => false, "message" => "O campo Texto do Estado não pode ser numérico."];    

            $stateDAO = new StateDAO();
            if ($stateDAO->createState($stateModel))
		return ["status" => true, "message" => "Estado criado com sucesso."];
	    else
		return ["status" => false, "message" => "Não foi possível criar o Estado."];
        }

        public function editState($stateModel) {
            if (is_null($stateModel->getStateId()) || empty($stateModel->getStateId()))
		return ["status" => false, "message" => "O Id do Estado é obrigatório."];

            if (!is_numeric($stateModel->getStateId()))
		return ["status" => false, "message" => "O Id do Estado deve ser numérico."];

            if (is_null($stateModel->getStateText()) || empty($stateModel->getStateText()))
          	return ["status" => false, "message" => "O campo Texto do Estado é obrigatório."];

            if (!$stateDAO->checkExistentState($stateModel))
 		return ["status" => false, "message" => "O Estado não existe."];

            $stateDAO = new StateDAO();
            if ($stateDAO->editState($stateModel))
		return ["status" => true, "message" => "Estado editado com sucesso."];
	    else
		return ["status" => false, "message" => "Não foi possível editar o Estado."];
        }

        public function removeState($stateModel) {
            if (is_null($stateModel->getStateId()) || empty($stateModel->getStateId()))
		return ["status" => false, "message" => "O Id do Estado é obrigatório."];

            if (!is_numeric($stateModel->getStateId()))
		return ["status" => false, "message" => "O Id do Estado deve ser numérico."];

            if (!$stateDAO->checkExistentState($stateModel))
 		return ["status" => false, "message" => "O Estado não existe."];

            $stateDAO = new StateDAO();
            if ($stateDAO->removeState($stateModel))
		return ["status" => true, "message" => "Estado removido com sucesso."];
	    else
		return ["status" => false, "message" => "Não foi possível remover o Estado"];
        }

        public function getState($stateModel) {
            if (is_null($stateModel->getStateId()))
                return ["status" => false, "message" => "O Id do Estado é obrigatório."];
                
            if (!is_numeric($stateModel->getStateId()))
                return ["status" => false, "message" => "O Id do Estado deve ser numérico."];

            $stateDAO = new StateDAO();
            if (empty($stateModel->getStateId())) {
                if (!is_null($stateModel = $stateDAO->getFirstState()))
                    return ["status" => true, "message" => $stateModel];
                else
                    return ["status" => false, "message" => "O Estado não existe."];
            } else {
                if (!$stateDAO->checkExistentState($stateModel))
                    return ["status" => false, "message" => "O Estado não existe."];
                     
                if (!is_null($stateModel = $stateDAO->getState($stateModel)))
                    return ["status" => true, "message" => $stateModel];
                else
                    return ["status" => false, "message" => "O Estado não existe."];
            }
        }

        public function getAllStates() {
            $stateDAO = new StateDAO();
            if (!empty($statesArray = $stateDAO->getAllStates()))
                return ["status" => true, "message" => $statesArray];
            else
                return ["status" => false, "message" => "Não há Estados."];	
        }

        public function countAllStates() {
            $stateDAO = new StateDAO();

            return $stateDAO->countAllStates();
        }
    }
?>
