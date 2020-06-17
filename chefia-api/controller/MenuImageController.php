<?php
    require_once dirname(__FILE__) . "/../model/MenuImageModel.php";
    require_once dirname(__FILE__) . "/../model/dao/MenuImageDAO.php";
    require_once dirname(__FILE__) . "/../model/dao/MenuItemDAO.php";

    class MenuImageController {
        public function createMenuImage($menuImageModel) {
            if (is_null($menuImageModel->getMenuImagePath()) || empty($menuImageModel->getMenuImagePath()))
                return ["status" => false, "message" => "O diretório da imagem é obrigatório."];

            if (is_numeric($menuImageModel->getMenuImagePath()))
                return ["status" => false, "message" => "O diretório da imagem não pode ser numérico."];

            if (is_null($menuImageModel->getMenuItemModel()->getMenuItemId()) || empty($menuImageModel->getMenuItemModel()->getMenuItemId()))
                return ["status" => false, "message" => "O Id do item referenciado é obrigatório."];

            if (!is_numeric($menuImageModel->getMenuItemModel()->getMenuItemId()))
                return ["status" => false, "message" => "O Id do item referenciado deve ser numérico."];

            $menuItemDAO = new MenuItemDAO();
            if (!$menuItemDAO->checkExistentMenuItem($menuImageModel->getMenuItemModel()))
                return ["status" => false, "message" => "O item referenciado não existe."];

            $menuImageDAO = new MenuImageDAO();
            if ($menuImageDAO->createMenuImage($menuImageModel))
                return ["status" => true, "message" => "Imagem de item criada com sucesso."];
            else
                return ["status" => false, "message" => "Não foi possível criar a imagem de item."];
        }

        public function removeMenuImage($menuImageModel) {
            if (is_null($menuImageModel->getMenuImageId()) || empty($menuImageModel->getMenuImageId()))
                return ["status" => false, "message" => "O Id da imagem é obrigatório."];

            if (!is_numeric($menuImageModel->getMenuImagePath()))
                return ["status" => false, "message" => "O Id da imagem deve ser numérico."];

            $menuImageDAO = new MenuImageDAO();
            if ($menuImageDAO->removeMenuImage($menuImageModel))
                return ["status" => true, "message" => "Imagem de item editada com sucesso."];
            else
                return ["status" => false, "message" => "Não foi possível editar a imagem de item."];
        }

        public function getMenuImage($menuImageModel) {
            if (is_null($menuImageModel->getMenuImageId()) || empty($menuImageModel->getMenuImageId()))
                return ["status" => false, "message" => "O Id da imagem é obrigatório."];

            if (!is_numeric($menuImageModel->getMenuImagePath()))
                return ["status" => false, "message" => "O Id da imagem deve ser numérico."];

            $menuImageDAO = new MenuImageDAO();
            if (!is_null($menuImageModel = $menuImageDAO->getMenuImage($menuImageModel)))
                return ["status" => true, "message" => $menuImageModel];
            else
                return ["status" => false, "message" => "Esta imagem de item não existe."];
        }

        public function getAllMenuImagesByMenuItem($menuImageModel) {
            if (is_null($menuImageModel->getMenuItemModel()->getMenuItemId()) || empty($menuImageModel->getMenuItemModel()->getMenuItemId()))
                return ["status" => false, "message" => "O Id da imagem é obrigatório."];

            if (!is_numeric($menuImageModel->getMenuItemModel()->getMenuItemId()))
                return ["status" => false, "message" => "O Id da imagem deve ser numérico."];

            $menuImageDAO = new MenuImageDAO();
            if (!empty($menuImagesArray = $menuImageDAO->getAllMenuImagesByMenuItem($menuImageModel)))
                return ["status" => true, "message" => $menuImagesArray];
            else
                return ["status" => false, "message" => "Não há imagens deste item."];
        }
    }
?>