<?php
    require_once dirname(__FILE__) . "/../model/SugestionModel.php";
    require_once dirname(__FILE__) . "/../model/dao/SugestionDAO.php";

    class SugestionController {
        public function createSugestion($sugestionText) {
            if (is_null($sugestionText) || empty($sugestionText))
                throw new Exception("A sugestão é obrigatória.");

            $sugestionModel = new SugestionModel();
            $sugestionModel->setSugestionDatetime(date("Y-m-d H:i:s"));
            $sugestionModel->setSugestionText(strip_tags($sugestionText));

            $sugestionDAO = new SugestionDAO();
            if ($sugestionDAO->createSugestion($sugestionModel))
                return "Sugestão feita com sucesso!";
            else
                throw new Exception("Não foi possível fazer a sugestão.");
        }

        public function removeSugestion($sugestionId) {
            if (is_null($sugestionId) || empty($sugestionId))
                throw new Exception("Id da sugestão inválido.");

            if (!is_numeric($sugestionId))
                throw new Exception("O id da sugestão deve ser numérico.");

            $sugestionModel = new SugestionModel();
            $sugestionModel->setSugestionId($sugestionId);

            $sugestionDAO = new SugestionDAO();
            if ($sugestionDAO->removeSugestion($sugestionModel))
                return "Sugestão apagada com sucesso.";
            else
                throw new Exception("Não foi possível apagar a sugestão.");
        }

        public function getAllSugestions() {
            $sugestionDAO = new SugestionDAO();
            return $sugestionDAO->getAllSugestions();
        }
    }
?>