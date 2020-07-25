<?php
    require_once dirname(__FILE__) . "/../model/ShopModel.php";
    require_once dirname(__FILE__) . "/../model/dao/ShopDAO.php";
    require_once dirname(__FILE__) . "/InteractionController.php";

    class ShopController {
        public function getAllShopsByInteraction($interactionId) {
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

            $shopModel = new ShopModel();
            $shopDAO = new ShopDAO();

            $shopModel->setInteractionModel(new InteractionModel($interactionId));

            return $shopDAO->getAllShopsByInteraction($shopModel);
        }
    }
?>