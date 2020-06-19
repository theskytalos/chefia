<?php
    require_once dirname(__FILE__) . "/../model/ItemModel.php";
    require_once dirname(__FILE__) . "/../model/InteractionModel.php";
    require_once dirname(__FILE__) . "/../model/dao/ItemDAO.php";

    class ItemController {
        public function createItem() {

        }

        public function editItem() {

        }

        public function removeItem() {

        }

        public function getItem($itemId) {
            
        }

        public function getAllItems() {
            
        }

        public function getAllItemsByInteraction($interactionId) {
            if (is_null($interactionId))
                throw new Exception("O id da interação é obrigatório.");

            if (!is_numeric($interactionId))
                throw new Exception("O id da interação deve ser numérico.");

            if ((int)$interactionId < 0)
                throw new Exception("O id da interação não pode ser negativo.");

            $interactionController = new InteractionController();
            if ((int)$interactionController->countAllInteractions() == 0)
                throw new Exception("Não há nenhuma interação para ser carregada.");

            if (!$interactionController->checkExistentInteraction($interactionId))
                throw new Exception("Interação inexistente.");

            $itemModel = new ItemModel();
            $itemDAO = new ItemDAO();
            $itemModel->setInteractionModel(new InteractionModel($interactionId));

            return $itemDAO->getAllItemsByInteraction($itemModel);
        }
    }
?>