<?php
    require_once dirname(__FILE__) . "/../../Connection.php";
    require_once dirname(__FILE__) . "/../MenuItemModel.php";
    require_once dirname(__FILE__) . "/MenuImageDAO.php";
    require_once dirname(__FILE__) . "/../../controller/MenuImageController.php";

    class MenuItemDAO {
        public function createMenuItem($menuItemModel) {
            global $pdo;

            $menuItemQuery = $pdo->prepare("INSERT INTO menu_items (menu_items_name, menu_items_description, menu_items_price, menu_items_stock, menu_categories_id_fk) VALUES (?, ?, ?, ?, ?);");
            $menuItemQuery->bindValue(1, $menuItemModel->getMenuItemName(), PDO::PARAM_STR);
            $menuItemQuery->bindValue(2, $menuItemModel->getMenuItemDescription(), PDO::PARAM_STR);
            $menuItemQuery->bindValue(3, $menuItemModel->getMenuItemPrice(), PDO::PARAM_STR);
            $menuItemQuery->bindValue(4, $menuItemModel->getMenuItemStock(), PDO::PARAM_INT);
            $menuItemQuery->bindValue(5, $menuItemModel->getMenuCategoryModel()->getMenuCategoryId(), PDO::PARAM_INT);

            return $menuItemQuery->execute();
        }

        public function editMenuItem($menuItemModel) {
            global $pdo;

            $menuItemQuery = $pdo->prepare("UPDATE menu_items SET menu_items_name = ?, menu_items_description = ?, menu_items_price = ?, menu_items_stock = ?, menu_categories_id_fk = ?;");
            $menuItemQuery->bindValue(1, $menuItemModel->getMenuItemName(), PDO::PARAM_STR);
            $menuItemQuery->bindValue(2, $menuItemModel->getMenuItemDescription(), PDO::PARAM_STR);
            $menuItemQuery->bindValue(3, $menuItemModel->getMenuItemPrice(), PDO::PARAM_STR);
            $menuItemQuery->bindValue(4, $menuItemModel->getMenuItemStock(), PDO::PARAM_INT);
            $menuItemQuery->bindValue(5, $menuItemModel->getMenuCategoryModel()->getMenuCategoryId(), PDO::PARAM_INT);

            return $menuItemQuery->execute();
        }

        public function removeMenuItem($menuItemModel) {
            global $pdo;

            $menuItemQuery = $pdo->prepare("DELETE FROM menu_items WHERE menu_items_id = ?;");
            $menuItemQuery->bindValue(1, $menuItemModel->getMenuItemId(), PDO::PARAM_INT);

            return $menuItemQuery->execute();
        }

        public function getMenuItemById($menuItemModel) {
            global $pdo;

            $menuItemQuery = $pdo->prepare("SELECT menu_items_name, menu_items_description, menu_items_price, menu_items_stock, menu_categories_id_fk FROM menu_items WHERE menu_items_id = ?;");
            $menuItemQuery->bindValue(1, $menuItemModel->getMenuItemId(), PDO::PARAM_INT);

            if ($menuItemQuery->execute()) {
                if ($menuItemQuery->rowCount() == 1) {
                    $row = $menuItemQuery->fetch();

                    $menuItemModel->setMenuItemName($row["menu_items_name"]);
                    $menuItemModel->setMenuItemDescription($row["menu_items_description"]);
                    $menuItemModel->setMenuItemPrice($row["menu_items_price"]);
                    $menuItemModel->setMenuItemStock($row["menu_items_stock"]);
                    $menuItemModel->setMenuCategoryModel(new MenuCategoryModel($row["menu_categories_id_fk"]));

                    $menuImageModel = new MenuImageModel();
                    $menuImageController = new MenuImageController();

                    $menuImageModel->setMenuItemModel($menuItemModel);
                    $menuItemModel->setMenuImagesArray($menuImageController->getAllMenuImagesByMenuItem($menuImageModel));

                    return $menuItemModel;
                }
            }

            return NULL;
        }

        public function getAllMenuItems() {
            global $pdo;

            $menuItemQuery = $pdo->query("SELECT menu_items_id, menu_items_name, menu_items_description, menu_items_price, menu_items_stock, menu_categories_id_fk FROM menu_items;");

            $menuItemsArray = array();

            if ($menuItemQuery) {
                if ($menuItemQuery->rowCount() > 0) {
                    while ($row = $menuItemQuery->fetch()) {
                        $menuItemModel = new MenuItemModel();

                        $menuItemModel->setMenuItemId($row["menu_items_id"]);
                        $menuItemModel->setMenuItemName($row["menu_items_name"]);
                        $menuItemModel->setMenuItemDescription($row["menu_items_description"]);
                        $menuItemModel->setMenuItemPrice($row["menu_items_price"]);
                        $menuItemModel->setMenuItemStock($row["menu_items_stock"]);
                        $menuItemModel->setMenuCategoryModel(new MenuCategoryModel($row["menu_categories_id_fk"]));

                        $menuImageModel = new MenuImageModel();
                        $menuImageController = new MenuImageController();
    
                        $menuImageModel->setMenuItemModel($menuItemModel);
                        $menuItemModel->setMenuImagesArray($menuImageController->getAllMenuImagesByMenuItem($menuImageModel));

                        array_push($menuItemsArray, $menuItemModel);
                    } 
                }
            }

            return $menuItemsArray;
        }

        public function getAllMenuItemsByCategory($menuItemModel) {
            global $pdo;

            $menuItemQuery = $pdo->prepare("SELECT menu_items_id, menu_items_name, menu_items_description, menu_items_price, menu_items_stock, menu_categories_id_fk FROM menu_items WHERE menu_categories_id_fk = ?;");
            $menuItemQuery->bindValue(1, $menuItemModel->getMenuCategoryModel()->getMenuCategoryId(), PDO::PARAM_INT);

            $menuItemsArray = array();

            if ($menuItemQuery->execute()) {
                if ($menuItemQuery->rowCount() > 0) {
                    while ($row = $menuItemQuery->fetch()) {
                        $menuItemModel = new MenuItemModel();

                        $menuItemModel->setMenuItemId($row["menu_items_id"]);
                        $menuItemModel->setMenuItemName($row["menu_items_name"]);
                        $menuItemModel->setMenuItemDescription($row["menu_items_description"]);
                        $menuItemModel->setMenuItemPrice($row["menu_items_price"]);
                        $menuItemModel->setMenuItemStock($row["menu_items_stock"]);
                        $menuItemModel->setMenuCategoryModel(new MenuCategoryModel($row["menu_categories_id_fk"]));

                        $menuImageModel = new MenuImageModel();
                        $menuImageController = new MenuImageController();
    
                        $menuImageModel->setMenuItemModel($menuItemModel);
                        $menuItemModel->setMenuImagesArray($menuImageController->getAllMenuImagesByMenuItem($menuImageModel));

                        array_push($menuItemsArray, $menuItemModel);
                    } 
                }
            }

            return $menuItemsArray;
        }

        public function checkExistentMenuItem($menuItemModel) {
            global $pdo;

            $menuItemQuery = $pdo->prepare("SELECT menu_items_id FROM menu_items WHERE menu_items_id = ?;");
            $menuItemQuery->bindValue(1, $menuItemModel->getMenuItemId(), PDO::PARAM_INT);

            if ($menuItemQuery->execute())
                if ($menuItemQuery->rowCount() == 1)
                    return true;

            return false;
        }
    }
?>