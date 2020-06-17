<?php
    require_once dirname(__FILE__) . "/../model/MenuItemModel.php";
    require_once dirname(__FILE__) . "/../model/dao/MenuCategoryDAO.php";
    require_once dirname(__FILE__) . "/../model/dao/MenuItemDAO.php";

    class MenuItemController {
        public function createMenuItem($menuItemModel) {
            if (is_null($menuItemModel->getMenuItemName()) || empty($menuItemModel->getMenuItemName()))
		      return ["status" => false, "message" => "O campo Nome do Item é obrigatório."];

            if (is_numeric($menuItemModel->getMenuItemName()))
		      return ["status" => false, "message" => "O campo Nome do Item não pode ser numérico."];

            if (is_null($menuItemModel->getMenuItemDescription()) /*|| empty($menuItemModel->getMenuItemDescription())*/)
		      return ["status" => false, "message" => "O campo Descrição do Item é obrigatório."];

            if (is_numeric($menuItemModel->getMenuItemDescription()))
		      return ["status" => false, "message" => "O campo Descrição do Item não pode ser numérico."];

            if (is_null($menuItemModel->getMenuItemPrice()) || empty($menuItemModel->getMenuItemPrice()))
		      return ["status" => false, "message" => "O campo Preço do Item é obrigatório"];

            if (is_null($menuItemModel->getMenuItemStock()) || empty($menuItemModel->getMenuItemStock()))
		      return ["status" => false, "message" => "O campo Estoque do Item é obrigatório"];

            if (!is_numeric($menuItemModel->getMenuItemStock()))
		      return ["status" => false, "message" => "O campo Estoque do Item deve ser numérico."];
	
	      if ((int) $menuItemModel->getMenuItemStock() < 0)
		      return ["status" => false, "message" => "O campo Estoque do Item não pode ser negativo."];

            /*if (is_null($menuItemModel->getMenuItemQuantity()) || empty($menuItemModel->getMenuItemQuantity()))
		return ["status" => false, "message" => ""];

            if (!is_numeric($menuItemModel->getMenuItemQuantity()))
		return ["status" => false, "message" => ""];*/

            if (is_null($menuItemModel->getMenuCategoryModel()->getMenuCategoryId()) || empty($menuItemModel->getMenuCategoryModel()->getMenuCategoryId()))
		      return ["status" => false, "message" => "O Id da categoria referenciada é obrigatório."];

            if (!is_numeric($menuItemModel->getMenuCategoryModel()->getMenuCategoryId()))
		      return ["status" => false, "message" => "O Id da categoria referenciada deve ser numérico."];

            $menuCategoryDAO = new MenuCategoryDAO();
            if (!$menuCategoryDAO->checkExistentMenuCategory($menuItemModel->getMenuCategoryModel()))
               	return ["status" => false, "message" => "A categoria referenciada não existe."];

            $menuItemDAO = new MenuItemDAO();
	      if ($menuItemDAO->createMenuItem($menuItemModel))
	 	      return ["status" => true, "message" => "Item de Menu criado com sucesso."];
	      else
		      return ["status" => false, "message" => "Não foi possível criar o Item de Menu."]; 
        }

        public function editMenuItem($menuItemModel) {
            if (is_null($menuItemModel->getMenuItemId()) || empty($menuItemModel->getMenuItemId()))
		return ["status" => false, "message" => "O Id do item é obrigatório."];

            if (!is_numeric($menuItemModel->getMenuItemId()))
		return ["status" => false, "message" => "O Id do item deve ser numérico."];

            if (is_null($menuItemModel->getMenuItemName()) || empty($menuItemModel->getMenuItemName()))
		return ["status" => false, "message" => "O campo Nome do item é obrigatório."];

            if (is_numeric($menuItemModel->getMenuItemName()))
		return ["status" => false, "message" => "O campo Nome do item não pode ser numérico."];

            if (is_null($menuItemModel->getMenuItemDescription()) || empty($menuItemModel->getMenuItemDescription()))
		return ["status" => false, "message" => "O campo Descrição do item é obrigatório."];

            if (is_numeric($menuItemModel->getMenuItemDescription()))
		return ["status" => false, "message" => "O campo Descrição do item não pode ser numérico."];

            if (is_null($menuItemModel->getMenuItemPrice()) || empty($menuItemModel->getMenuItemPrice()))
		return ["status" => false, "message" => "O campo Preço do item é obrigatório."];

            if (is_null($menuItemModel->getMenuItemStock()) || empty($menuItemModel->getMenuItemStock()))
		return ["status" => false, "message" => "O campo Estoque do item é obrigatório."];

            if (!is_numeric($menuItemModel->getMenuItemStock()))
		return ["status" => false, "message" => "O campo Estoque do item deve ser numérico."];

	    if ((int) $menuItemModel->getMenuItemStock() < 0)
		return ["status" => false, "message" => "O campo Estoque não pode ser negativo"];

	    /*if (is_null($menuItemModel->getMenuItemQuantity()) || empty($menuItemModel->getMenuItemQuantity())) 
		return ["status" => false, "message" => ""];

            if (!is_numeric($menuItemModel->getMenuItemQuantity())) {
		return ["status" => false, "message" => ""];
	    }*/

            if (is_null($menuItemModel->getMenuCategoryModel()->getMenuCategoryId()) || empty($menuItemModel->getMenuCategoryModel()->menuCategoryId()))
		return ["status" => false, "message" => "O Id da categoria referenciada é obrigatório."];

            if (!is_numeric($menuItemModel->getMenuCategoryModel()->getMenuCategoryId()))
		return ["status" => false, "message" => "O Id da categoria referenciada deve ser numérica."];

            $menuCategoryDAO = new MenuCategoryDAO();
            if ($menuCategoryDAO->checkExistentMenuCategory($menuItemModel->getMenuCategoryModel()))
		return ["status" => false, "message" => "A categoria referenciada não existe."];

            $menuItemDAO = new MenuItemDAO();
	    if ($menuItemDAO->editMenuItem($menuItemModel))
		return ["status" => true, "message" => "Item de Menu editado com sucesso."];
	    else
		return ["status" => false, "message" => "Não foi possívele ditar o Item de Menu."];

        }

        public function removeMenuItem($menuItemModel) {
            if (is_null($menuItemModel->getMenuItemId()) || empty($menuItemModel->getMenuItemId()))
		return ["status" => false, "message" => "O Id do item é obrigatório."];

            if (!is_numeric($menuItemModel->getMenuItemId()))
		return ["status" => false, "message" => "O Id do item deve ser numérico."];

            // TODO: VERIFICAR DEPENDÊNCIAS

            $menuItemDAO = new MenuItemDAO();
            if ($menuItemDAO->removeMenuItem($menuItemModel))
		return ["status" => true, "message" => "Item removido com sucesso."];
	    else
		return ["status" => false, "message" => "Não foi possível remover o item."];
        }

        public function getMenuItemById($menuItemModel) {
            if (is_null($menuItemModel->getMenuItemId()) || empty($menuItemModel->getMenuItemId()))
		      return ["status" => false, "message" => "O Id do item é obrigatório."];

            if (!is_numeric($menuItemModel->getMenuItemId()))
		      return ["status" => false, "message" => "O Id do item deve ser numérico."];

            $menuItemDAO = new MenuItemDAO();
            if (!$menuItemDAO->checkExistentMenuItem($menuItemModel))
 		      return ["status" => false, "message" => "O Item não existe."];

            if (!is_null($menuItemDAO = $menuItemDAO->getMenuItemById($menuItemModel)))
		      return ["status" => true, "message" => $menuItemModel];
	      else
		      return ["status" => false, "message" => "O Item não existe."];
        }

        public function getAllMenuItems() {
            $menuItemDAO = new MenuItemDAO();
            if (!empty($menuItemsArray = $menuItemDAO->getAllMenuItems()))
		      return ["status" => true, "message" => $menuItemsArray];		
	      else
   		      return ["status" => false, "message" => "Não há itens."];
        }

        public function getAllMenuItemsByCategory($menuItemModel) {
            if (is_null($menuItemModel->getMenuCategoryModel()->getMenuCategoryId()) || empty($menuItemModel->getMenuCategoryModel()->getMenuCategoryId()))
                  return ["status" => false, "message" => "O Id da categoria é obrigatório."];

            if (!is_numeric($menuItemModel->getMenuCategoryModel()->getMenuCategoryId()))
                  return ["status" => false, "message" => "O Id da categoria deve ser numérico."];

            $menuItemDAO = new MenuItemDAO();
            if (!empty($menuItemsArray = $menuItemDAO->getAllMenuItemsByCategory($menuItemModel)))
                  return ["status" => true, "message" => $menuItemsArray];
            else
                  return ["status" => false, "message" => "Não há itens para esta categoria."];
        }
    }
?>
