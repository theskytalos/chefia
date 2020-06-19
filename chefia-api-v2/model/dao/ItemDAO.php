<?php
    require_once dirname(__FILE__) . "/../../Connection.php";
    require_once dirname(__FILE__) . "/../ItemModel.php";
    require_once dirname(__FILE__) . "/../InteractionModel.php";

    class ItemDAO {
        public function createItem($itemModel) {
            global $pdo;
        }

        public function editItem($itemModel) {
            global $pdo;
        }

        public function removeItem($itemModel) {
            global $pdo;
        }

        public function getItem($itemModel) {
            global $pdo;

            $itemQuery = $pdo->prepare("SELECT items_name, items_description, items_price, items_stock, interactions_id_fk FROM items WHERE items_id = :items_id;");
            $itemQuery->bindValue(":items_id", $itemModel->getItemId(), PDO::PARAM_INT);

            if ($itemQuery->execute()) {
                if ($itemQuery->rowCount() == 1) {
                    $row = $itemQuery->fetch();

                    $itemModel->setItemName($row["items_name"]);
                    $itemModel->setItemDescription($row["items_description"]);
                    $itemModel->setItemPrice($row["items_price"]);
                    $itemModel->setItemStock($row["item_stock"]);
                    $itemModel->setInteractionModel(new InteractionModel($row["interactions_id_fk"]));

                    return $itemModel;
                }
            }

            return NULL;
        }

        public function getAllItemsByInteraction($itemModel) {
            global $pdo;

            $itemQuery = $pdo->prepare("SELECT items_id, items_name, items_description, items_price, items_stock, interactions_id_fk FROM items WHERE interactions_id_fk = :interactions_id_fk;");
            $itemQuery->bindValue(":interactions_id_fk", $itemModel->getInteractionModel()->getInteractionId(), PDO::PARAM_INT);

            $itemsArray = array();

            if ($itemQuery->execute()) {
                if ($itemQuery->rowCount() > 0) {
                    while ($row = $itemQuery->fetch()) {
                        $itemModel = new ItemModel();

                        $itemModel->setItemId($row["items_id"]);
                        $itemModel->setItemName($row["items_name"]);
                        $itemModel->setItemDescription($row["items_description"]);
                        $itemModel->setItemPrice($row["items_price"]);
                        $itemModel->setItemStock($row["item_stock"]);
                        $itemModel->setInteractionModel(new InteractionModel($row["interactions_id_fk"]));

                        array_push($itemsArray, $itemModel);
                    }
                }
            }

            return $itemsArray;
        }

        public function getAllItems() {
            global $pdo;
        }

    }
?>