<?php
    require_once dirname(__FILE__) . "/../model/AlternativeModel.php";
    require_once dirname(__FILE__) . "/../model/dao/StateDAO.php";
    require_once dirname(__FILE__) . "/../model/dao/AlternativeDAO.php";

    class AlternativeController {
        public function createAlternative($alternativeModel) {
            if (is_null($alternativeModel->getAlternativeText()) || empty($alternativeModel->getAlternativeText()))
                return ["status" => false, "message" => "O campo texto não pode ser nulo."];

            if (is_numeric($alternativeModel->getAlternativeText()))
                return ["status" => false, "message" => "O campo texto não pode ser numérico."];

            if (is_null($alternativeModel->getAlternativeNextStateModel()->getStateId()) || empty($alternativeModel->getAlternativeNextStateModel()->getStateId()))
                return ["status" => false, "message" => "O campo Próximo Estado não pode ser nulo."];

            if (!is_numeric($alternativeModel->getAlternativeNextStateModel()->getStateId()))
                return ["status" => false, "message" => "O campo Próximo Estado deve ser numérico."];

            $stateDAO = new StateDAO();
            if (!$stateDAO->checkExistentState($alternativeModel->getAlternativeNextStateModel()))
                return ["status" => false, "message" => "O campo Próximo Estado está referenciando um estado que não existe."];

                if (is_null($alternativeModel->getStateModel()->getStateId()) || empty($alternativeModel->getStateModel()->getStateId()))
                return ["status" => false, "message" => "O Id do estado referenciado é obrigatório."];

            if (!is_numeric($alternativeModel->getStateModel()->getStateId()))
                return ["status" => false, "message" => "O Id do estado referenciado deve ser numérico."];

            if ((int)$alternativeModel->getStateModel()->getStateId() < 0)
                return ["status" => false, "message" => "O Id do estado referenciado não pode ser negativo."];

            if (!$stateDAO->checkExistentState($alternativeModel->getStateModel())) 
                return ["status" => false, "message" => "O estado referenciado não existe."];

            $alternativeDAO = new AlternativeDAO();

            if ($alternativeDAO->createAlternative($alternativeModel))
                return ["status" => true, "message" => "Alternativa criada com sucesso."];
            else
                return ["status" => false, "message" => "Não foi possível criar a alternativa"];
        }

        public function editAlternative($alternativeModel) {
            if (is_null($alternativeModel->getAlternativeId()) || empty($alternativeModel->getAlternativeId()))
                return ["status" => false, "message" => "O Id da alternativa é obrigatório."];

            if (!is_numeric($alternativeModel->getAlternativeId()))
                return ["status" => false, "message" => "O Id da alternativa deve ser numérico."];

            if ((int) $alternativeModel->getAlternativeId() < 0)
                return ["status" => false, "message" => "O Id da alternativa não pode ser negativo."];

            $alternativeDAO = new AlternativeDAO();
            if (!$alternativeDAO->checkExistentAlternative($alternativeModel))
                return ["status" => false, "message" => "A alternativa a ser editada não existe."];

            if (is_null($alternativeModel->getAlternativeText()) || empty($alternativeModel->getAlternativeText()))
                return ["status" => false, "message" => "O campo texto é obrigatório."];

            if (is_numeric($alternativeModel->getAlternativeText()))
                return ["status" => false, "message" => "O campo texto não pode ser numérico."];

            if (is_null($alternativeModel->getAlternativeNextStateModel()->getStateId()) || empty($alternativeModel->getAlternativeNextStateModel()->getStateId()))
                return ["status" => false, "message" => "O Id do próximo estado é obrigatório."];

            if (!is_numeric($alternativeModel->getAlternativeNextStateModel()->getStateId()))
                return ["status" => false, "message" => "O Id do próximo estado deve ser numérico."];

            $stateDAO = new StateDAO();
            if (!$stateDAO->checkExistentState($alternativeModel->getAlternativeNextStateModel()))
                return ["status" => false, "message" => "O próximo estado referenciado não existe."];

            if (is_null($alternativeModel->getStateModel()->getStateId()) || empty($alternativeModel->getStateModel()->getStateId()))
                return ["status" => false, "message" => "O Id do estado referenciado é obrigatório."] ;

            if (!is_numeric($alternativeModel->getStateModel()->getStateId()))
                return ["status" => false, "message" => "O Id do estado referenciado deve ser numérico."];

            if ((int) $alternativeModel->getStateModel()->getStateId())
                return ["status" => false, "message" => "O Id do estado referenciado não pode ser negativo."];

            if (!$stateDAO->checkExistentState($alternativeModel->getStateModel()))
                return ["status" => false, "message" => "O estado referenciado não existe."];

            if ($alternativeDAO->editAlternative($alternativeModel))
                return ["status" => true, "message" => "Alternativa editada com sucesso."]; 
            else
                return ["status" => false, "message" => "Não foi possível editar a alternativa."];
        }

        public function removeAlternative($alternativeModel) {
            if (is_null($alternativeModel->getAlternativeId()) || empty($alternativeModel->getAlternativeId()))
                return ["status" => false, "message" => "O Id da alternativa é obrigatório."];

            if (!is_numeric($alternativeModel->getAlternativeId()))
                return ["status"=> false, "message" => "O Id da alternativa deve ser numérico."];

            if ((int) $alternativeModel->getAlternativeId() < 0)
                return ["status" => false, "message" => "O Id da alternativa não pode ser negativo."];

            $alternativeDAO = new AlternativeDAO();
            if (!$alternativeDAO->checkExistentAlternative($alternativeModel)) {
                return ["status" => false, "message" => "A alternativa a ser removida não existe."];
            }

            if ($alternativeDAO->removeAlternative($alternativeModel))
                return ["status" => true, "message" => "Alternativa removida com sucesso."];
            else
                return ["status" => false, "message" => "Não foi possível remover a alternativa."];
        }

        public function getAllAlternativesByState($alternativeModel) {
            if (is_null($alternativeModel->getStateModel()->getStateId()) || empty($alternativeModel->getStateModel()->getStateId()))
                return ["status" => false, "message" => "O Id do estado referenciado é obrigatório."];

            if (!is_numeric($alternativeModel->getStateModel()->getStateId()))
                return ["status" => false, "message" => "O Id do estado referenciado deve ser numérico."];

            if ((int)$alternativeModel->getStateModel()->getStateId() < 0)
                return ["status" => false, "message" => "O Id do estado referenciado não pode ser negativo."];

            $stateDAO = new StateDAO();
            if (!$stateDAO->checkExistentState($alternativeModel->getStateModel())) 
                return ["status" => false, "message" => "O estado referenciado não existe."];

            $alternativeDAO = new AlternativeDAO();
            if (!empty($alternativesArray = $alternativeDAO->getAllAlternativesByState($alternativeModel))) 
                return ["status" => true, "message" => $alternativesArray];
            else
                return ["status" => false, "message" => $alternativesArray];
        }
    }
?>