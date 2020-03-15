<?php
    require_once dirname(__FILE__) . "/../model/MenuItemModel.php";
    require_once dirname(__FILE__) . "/../model/dao/MenuItemDAO.php";

    class MenuItemController {
        public function createMenuItem($menuItemModel) {
            if (is_null($menuItemModel->getMenuItemName()) || empty($menuItemModel->getMenuItemName())) {

            }

            if (is_numeric($menuItemModel->getMenuItemName())) {

            }

            if (is_null($menuItemModel->getMenuItemDescription()) || empty($menuItemModel->getMenuItemDescription())) {

            }

            if (is_numeric($menuItemModel->getMenuItemDescription())) {

            }

            if (is_null($menuItemModel->getMenuItemPrice()) || empty($menuItemModel->getMenuItemPrice())) {

            }

            if (is_null($menuItemModel->getMenuItemStock()) || empty($menuItemModel->getMenuItemStock())) {

            }

            if (!is_numeric($menuItemModel->getMenuItemStock())) {

            }

            if (is_null($menuItemModel->getMenuItemQuantity()) || empty($menuItemModel->getMenuItemQuantity())) {

            }

            if (!is_numeric($menuItemModel->getMenuItemQuantity())) {

            }

            if (is_null($menuItemModel->getMenuCategoryModel()->getMenuCategoryId()) || empty($menuItemModel->getMenuCategoryModel()->menuCategoryId())) {

            }

            if (!is_numeric($menuItemModel->getMenuCategoryModel()->getMenuCategoryId())) {

            }

            $menuCategoryDAO = new MenuCategoryDAO();
            if ($menuCategoryDAO->checkExistentMenuCategory($menuItemModel->getMenuCategoryModel())) {
                // Categoria referenciada não existe
            }

            $menuItemDAO = new MenuItemDAO();
            return $menuItemDAO->createMenuItem($menuItemModel);
        }

        public function editMenuItem($menuItemModel) {
            if (is_null($menuItemModel->getMenuItemId()) || empty($menuItemModel->getMenuItemId())) {

            }

            if (!is_numeric($menuItemModel->getMenuItemId())) {

            }

            if (is_null($menuItemModel->getMenuItemName()) || empty($menuItemModel->getMenuItemName())) {

            }

            if (is_numeric($menuItemModel->getMenuItemName())) {

            }

            if (is_null($menuItemModel->getMenuItemDescription()) || empty($menuItemModel->getMenuItemDescription())) {

            }

            if (is_numeric($menuItemModel->getMenuItemDescription())) {

            }

            if (is_null($menuItemModel->getMenuItemPrice()) || empty($menuItemModel->getMenuItemPrice())) {

            }

            if (is_null($menuItemModel->getMenuItemStock()) || empty($menuItemModel->getMenuItemStock())) {

            }

            if (!is_numeric($menuItemModel->getMenuItemStock())) {

            }

            if (is_null($menuItemModel->getMenuItemQuantity()) || empty($menuItemModel->getMenuItemQuantity())) {

            }

            if (!is_numeric($menuItemModel->getMenuItemQuantity())) {

            }

            if (is_null($menuItemModel->getMenuCategoryModel()->getMenuCategoryId()) || empty($menuItemModel->getMenuCategoryModel()->menuCategoryId())) {

            }

            if (!is_numeric($menuItemModel->getMenuCategoryModel()->getMenuCategoryId())) {

            }

            $menuCategoryDAO = new MenuCategoryDAO();
            if ($menuCategoryDAO->checkExistentMenuCategory($menuItemModel->getMenuCategoryModel())) {
                // Categoria referenciada não existe
            }

            $menuItemDAO = new MenuItemDAO();
            return $menuItemDAO->editMenuItem($menuItemModel);
        }

        public function removeMenuItem($menuItemModel) {
            if (is_null($menuItemModel->getMenuItemId()) || empty($menuItemModel->getMenuItemId())) {

            }

            if (!is_numeric($menuItemModel->getMenuItemId())) {

            }

            // TODO: VERIFICAR DEPENDÊNCIAS

            $menuItemDAO = new MenuItemDAO();
            return $menuItemDAO->removeMenuItem($menuItemModel);
        }

        public function getMenuItemById($menuItemModel) {
            if (is_null($menuItemModel->getMenuItemId()) || empty($menuItemModel->getMenuItemId())) {

            }

            if (!is_numeric($menuItemModel->getMenuItemId())) {

            }

            $menuItemDAO = new MenuItemDAO();
            if (!$menuItemDAO->checkExistentMenuItem($menuItemModel)) {
                // Menu referenciado não existe
            }

            return $menuItemDAO->getMenuItemById($menuItemModel);
        }

        public function getAllMenuItems() {
            $menuItemDAO = new MenuItemDAO();
            return $menuItemDAO->getAllMenuItems();
        }
    }
?>