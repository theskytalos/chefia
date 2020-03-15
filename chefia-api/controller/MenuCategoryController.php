<?php
    require_once dirname(__FILE__) . "/../model/MenuCategoryModel.php";
    require_once dirname(__FILE__) . "/../model/dao/MenuCategoryDAO.php";

    class MenuCategoryController {
        public function createMenuCategory($menuCategoryModel) {
            if (is_null($menuCategoryModel->getMenuCategoryText()) || empty($menuCategoryModel->getMenuCategoryText()))
                return ["status" => false, "message" => "O campo texto é obrigatório."];

            if (is_numeric($menuCategoryModel->getMenuCategoryText()))
                return ["status" => false, "message" => "O campo texto não pode ser numérico."];

            $menuCategoryDAO = new MenuCategoryDAO();
            if ($menuCategoryDAO->createMenuCategory($menuCategoryModel))
                return ["status" => true, "message" => "Categoria criada com sucesso."];
            else
                return ["status" => false, "message" => "Não foi possível criar a categoria."];
        }

        public function editMenuCategory($menuCategoryModel) {
            if (is_null($menuCategoryModel->getMenuCategoryId()) || empty($menuCategoryModel->getMenuCategoryId())) 
                return ["status" => false, "message" => "O Id da categoria é obrigatório."];

            if (!is_numeric($menuCategoryModel->getMenuCategoryId()))
                return ["status" => false, "message" => "O Id da categoria deve ser numérico."];

            if (is_null($menuCategoryModel->getMenuCategoryText()) || empty($menuCategoryModel->getMenuCategoryText()))
                return ["status" => false, "message" => "O campo texto é obrigatório."];

            if (is_numeric($menuCategoryModel->getMenuCategoryText()))
                return ["status" => false, "message" => "O campo texto não pode ser numérico."];

            $menuCategoryDAO = new MenuCategoryDAO();
            if ($menuCategoryDAO->editMenuCategory($menuCategoryModel))
                return ["status" => true, "message" => "Categoria editada com sucesso"];
            else
                return ["status" => false, "message" => "Não foi possível editar a categoria."];
        }

        public function removeMenuCategory($menuCategoryModel) {
            if (is_null($menuCategoryModel->getMenuCategoryId()) || empty($menuCategoryModel->getMenuCategoryId()))
                return ["status" => false, "message" => "O Id da categoria é obrigatório."];

            if (!is_numeric($menuCategoryModel->getMenuCategoryId())) 
                return ["status" => false, "message" => "O Id da categoria deve ser numérico."];

            $menuCategoryDAO = new MenuCategoryDAO();
            if ($menuCategoryDAO->removeMenuCategory($menuCategoryModel))
                return ["status" => true, "message" => "Categoria removida com sucesso."];
            else
                return ["status" => false, "message" => "Não foi possível remover a categoria."];
        }

        public function getMenuCategory($menuCategoryModel) {
            if (is_null($menuCategoryModel->getMenuCategoryId()) || empty($menuCategoryModel->getMenuCategoryId()))
                return ["status" => false, "message" => "O Id da categoria é obrigatório."];

            if (!is_numeric($menuCategoryModel->getMenuCategoryId())) 
                return ["status" => false, "message" => "O Id da categoria deve ser numérico."];
            
            $menuCategoryDAO = new MenuCategoryDAO();
            if (!is_null($menuCategoryModel = $menuCategoryDAO->getMenuCategory($menuCategoryModel)))
                return ["status" => true, "message" => $menuCategoryModel];
            else
                return ["status" => false, "message" => "Esta categoria não existe."];
        }

        public function getAllMenuCategories() {
            $menuCategoryDAO = new MenuCategoryDAO();
            if (empty($menuCategoriesArray = $menuCategoryDAO->getAllMenuCategories()))
                return ["status" => true, "message" => $menuCategoriesArray];
            else
                return ["status" => false, "message" => "Não há nenhuma categoria."];
        }
    }
?>