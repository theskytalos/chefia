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
            if (is_null($itemId))
                throw new Exception("O id do item é obrigatório.");

            if (!is_numeric($itemId))
                throw new Exception("O id do item deve ser numérico.");

            if ((int)$itemId < 0)
                throw new Exception("O id da item não pode ser negativo.");

            if (!$this->checkExistentItem($itemId))
                throw new Exception("Item inexistente.");

            $itemModel = new ItemModel($itemId);
            $itemDAO = new ItemDAO();

            return $itemDAO->getItem($itemModel);
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

        public function checkExistentItem($itemId) {
            if (is_null($itemId))
                throw new Exception("O id da interação é obrigatório.");

            if (!is_numeric($itemId))
                throw new Exception("O id da interação deve ser numérico.");

            if ((int)$itemId < 0)
                throw new Exception("O id da interação não pode ser negativo.");

            $itemModel = new ItemModel($itemId);
            $itemDAO = new ItemDAO();

            return $itemDAO->checkExistentItem($itemModel);
        }
    }
?>