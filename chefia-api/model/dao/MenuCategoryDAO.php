<?php
    require_once dirname(__FILE__) . "/../../Connection.php";
    require_once dirname(__FILE__) . "/../MenuCategoryModel.php";

    class MenuCategoryDAO {
        public function createMenuCategory($menuCategoryModel) {
            global $pdo;

            $menuCategoryQuery = $pdo->prepare("INSERT INTO menu_categories (menu_categories_text) VALUES (?);");
            $menuCategoryQuery->bindValue(1, $menuCategoryModel->getMenuCategoryText(), PDO::PARAM_STR);

            return $menuCategoryQuery->execute();
        }

        public function editMenuCategory($menuCategoryModel) {
            global $pdo;

            $menuCategoryQuery = $pdo->prepare("UPDATE menu_categories SET menu_categories_text = ? WHERE menu_categories_id = ?;");
            $menuCategoryQuery->bindValue(1, $menuCategoryModel->getMenuCategoryText(), PDO::PARAM_STR);
            $menuCategoryQuery->bindValue(2, $menuCategoryModel->getMenuCategoryId(), PDO::PARAM_INT);

            return $menuCategoryQuery->execute();
        }

        public function removeMenuCategory($menuCategoryModel) {
            global $pdo;

            $menuCategoryQuery = $pdo->prepare("DELETE FROM menu_categories WHERE menu_categories_id = ?;");
            $menuCategoryQuery->bindValue(1, $menuCategoryModel->getMenuCategoryId(), PDO::PARAM_INT);

            return $menuCategoryQuery->execute();
        }

        public function getMenuCategory($menuCategoryModel) {
            global $pdo;

            $menuCategoryQuery = $pdo->prepare("SELECT menu_categories_text FROM menu_categories WHERE menu_categories_id = ?;");
            $menuCategoryQuery->bindValue(1, $menuCategoryModel->getMenuCategoryId(), PDO::PARAM_INT);

            if ($menuCategoryQuery->execute()) {
                if ($menuCategoryQuery->rowCount() == 1) {
                    $row = $menuCategoryQuery->fetch();

                    $menuCategoryModel->setMenuCategoryText($row["menu_categories_text"]);

                    return $menuCategoryModel;
                }
            }

            return NULL;
        }

        public function getAllMenuCategories() {
            global $pdo;

            $menuCategoryQuery = $pdo->query("SELECT menu_categories_id, menu_categories_text FROM menu_categories;");

            $menuCategoriesArray = array();

            if ($menuCategoryQuery) {
                if ($menuCategoryQuery->rowCount() > 0) {
                    while ($row = $menuCategoryQuery->fetch()) {
                        $menuCategoryModel = new MenuCategoryModel();

                        $menuCategoryModel->setMenuCategoryId($row["menu_categories_id"]);
                        $menuCategoryModel->setMenuCategoryText($row["menu_categories_text"]);

                        array_push($menuCategoriesArray, $menuCategoryModel);
                    }
                }
            }

            return $menuCategoriesArray;
        }

        public function checkExistentMenuCategory($menuCategoryModel) {
            global $pdo;

            $menuCategoryQuery = $pdo->prepare("SELECT menu_categories_id FROM menu_categories WHERE menu_categories_id = ?;");
            $menuCategoryQuery->bindValue(1, $menuCategoryModel->getMenuCategoryId(), PDO::PARAM_INT);

            if ($menuCategoryQuery->execute())
                if ($menuCategoryQuery->rowCount() == 1)
                    return true;

            return false;
        }
    }

?>