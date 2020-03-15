<?php
    require_once dirname(__FILE__) . "/../../Connection.php";
    require_once dirname(__FILE__) . "/../MenuImageModel.php";

    class MenuImageDAO {
        public function createMenuImage($menuImageModel) {
            global $pdo;

            $menuImageQuery = $pdo->prepare("INSERT INTO menu_images (menu_images_path, menu_items_id_fk) VALUES (?, ?);");
            $menuImageQuery->bindValue(1, $menuImageModel->getMenuImagePath(), PDO::PARAM_STR);
            $menuImageQuery->bindValue(2, $menuImageModel->getMenuItemModel()->getMenuItemId(), PDO::PARAM_INT);

            return $menuImageQuery->execute();
        }

        public function removeMenuImage($menuImageModel) {
            global $pdo;

            $menuImageQuery = $pdo->prepare("DELETE FROM menu_images WHERE menu_images_id = ?;");
            $menuImageQuery->bindValue(1, $menuImageModel->getMenuImageId(), PDO::PARAM_INT);

            return $menuImageQuery->execute();
        }

        public function getMenuImage($menuImageModel) {
            global $pdo;

            $menuImageQuery = $pdo->prepare("SELECT menu_images_path, menu_items_id_fk FROM menu_images WHERE menu_images_id = ?;");
            $menuImageQuery->bindValue(1, $menuImageModel->getMenuImageId(), PDO::PARAM_INT);

            if ($menuImageQuery->execute()) {
                if ($menuImageQuery->rowCount() == 1) {
                    $row = $menuImageQuery->fetch();

                    $menuImageModel->setMenuImagePath($row["menu_images_path"]);
                    $menuImageModel->setMenuItemModel(new MenuItemModel($row["menu_items_id_fk"]));

                    return $menuImageModel;
                }
            }

            return NULL;
        }

        public function getAllMenuImagesByMenuItem($menuImageModel) {
            global $pdo;

            $menuImageQuery = $pdo->prepare("SELECT menu_images_id, menu_images_path FROM menu_images WHERE menu_items_id_fk = ?;");
            $menuImageQuery->bindValue(1, $menuImageModel->getMenuItemModel()->getMenuItemId(), PDO::PARAM_INT);

            $menuImagesArray = array();

            if ($menuImageQuery->execute()) {
                if ($menuImageQuery->rowCount() > 0) {
                    while ($row = $menuImageQuery->fetch()) {
                        $menuImageModel->setMenuImageId($row["menu_images_id"]);
                        $menuImageModel->setMenuImagePath($row["menu_images_path"]);

                        array_push($menuImagesArray, $menuImageModel);
                    }
                }
            }

            return $menuImagesArray;
        }
    }
?>