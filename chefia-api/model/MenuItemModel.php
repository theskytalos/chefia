<?php
    class MenuItemModel implements JsonSerializable {
        private $menuItemId;
        private $menuItemName;
        private $menuItemDescription;
        private $menuItemPrice;
        private $menuItemStock;
        private $menuItemQuantity; // For requests only
        private $menuCategoryModel;
        private $menuImagesArray;

        function __construct() {
            switch(func_num_args()) {
                case 1:
                    $this->setMenuItemId(func_get_arg(0));
                    break;
            }
        }

        public function getMenuItemId() {
            return $this->menuItemId;
        }

        public function setMenuItemId($menuItemId) {
            $this->menuItemId = $menuItemId;
        }

        public function getMenuItemName() {
            return $this->menuItemName;
        }

        public function setMenuItemName($menuItemName) {
            $this->menuItemName = $menuItemName;
        }

        public function getMenuItemDescription() {
            return $this->menuItemDescription;
        }

        public function setMenuItemDescription($menuItemDescription) {
            $this->menuItemDescription = $menuItemDescription;
        }

        public function getMenuItemPrice() {
            return $this->menuItemPrice;
        }

        public function setMenuItemPrice($menuItemPrice) {
            $this->menuItemPrice = $menuItemPrice;
        }

        public function getMenuItemStock() {
            return $this->menuItemStock;
        }

        public function setMenuItemStock($menuItemStock) {
            $this->menuItemStock = $menuItemStock;
        }

        public function getMenuItemQuantity() {
            return $this->MenuItemQuantity;
        }

        public function setMenuItemQuantity($menuItemQuantity) {
            $this->menuItemQuantity = $menuItemQuantity;
        }

        public function getMenuCategoryModel() {
            return $this->menuCategoryModel;
        }

        public function setMenuCategoryModel($menuCategoryModel) {
            $this->menuCategoryModel = $menuCategoryModel;
        }

        public function getMenuImagesArray() {
            return $this->menuImagesArray;
        }

        public function setMenuImagesArray($menuImagesArray) {
            $this->menuImagesArray = $menuImagesArray;
        }

        public function jsonSerialize() {
            return ["menuItemId" => $this->getMenuItemId(),
                    "menuItemName" => $this->getMenuItemName(),
                    "menuItemDescription" => $this->getMenuItemDescription(),
                    "menuItemPrice" => $this->getMenuItemPrice(),
                    "menuItemStock" => $this->getMenuItemStock(),
                    "menuCategoryModel" => $this-> getMenuCategoryModel()];
        }
    }
?>