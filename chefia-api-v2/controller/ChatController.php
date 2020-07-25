<?php
    require_once dirname(__FILE__) . "/../model/ChatModel.php";
    require_once dirname(__FILE__) . "/InteractionController.php";
    require_once dirname(__FILE__) . "/TransitionController.php";
    require_once dirname(__FILE__) . "/ItemController.php";
    require_once dirname(__FILE__) . "/ShopController.php";

    class ChatController {
        public function getNextChat($interactionId, $itemAddedToCart) {
            if (is_null($interactionId))
                throw new Exception("O id da interação é obrigatório.");

            if (!is_numeric($interactionId))
                throw new Exception("O id da interação deve ser numérico.");

            if ((int)$interactionId < 0)
                throw new Exception("O id da interação não pode ser negativo.");

            $interactionController = new InteractionController();
            if ((int)$interactionController->countAllInteractions() == 0)
                throw new Exception("Não há chats para serem carregados.");

            if ((int)$interactionId > 0)
                $interaction = $interactionController->getInteraction($interactionId);
            else {
                $interaction = $interactionController->getFirstInteraction();
                $interactionId = $interaction->getInteractionId();
            }

            $transitionController = new TransitionController();
            $transitions = $transitionController->getAllTransitionsByOwnerInteraction($interactionId);

            $itemController = new ItemController();
            $items = $itemController->getAllItemsByInteraction($interactionId);

            $shopController = new ShopController();
            $shops = $shopController->getAllShopsByInteraction($interactionId);

            // Check if there is a item to substitute in the message
            if (!empty($itemAddedToCart) && is_numeric($itemAddedToCart)) {
                $item = $itemController->getItem($itemAddedToCart);
                if (!is_null($item))
                    $interaction->setInteractionContent(str_replace("__ITEM__", $item->getItemName(), $interaction->getInteractionContent()));
            }

            $chatModel = new ChatModel();
            $chatModel->setChatInteraction($interaction);
            $chatModel->setChatTransitions($transitions);
            $chatModel->setChatItems($items);
            $chatModel->setChatShops($shops);

            return $chatModel;
        }
    }
?>