<?php
    class MenuImageModel implements JsonSerializable {
        private $menuImageId;
        private $menuImagePath;
        private $menuItemModel;

        public function getMenuImageId() {
            return $this->menuImageId;
        }

        public function setMenuImageId($menuImageId) {
            $this->menuImageId = $menuImageId;
        }

        public function getMenuImagePath() {
            return $this->menuImagePath;
        }

        public function setMenuImagePath($menuImagePath) {
            $this->menuImagePath = $menuImagePath;
        }

        public function getMenuItemModel() {
            return $this->menuItemModel;
        }

        public function setMenuItemModel($menuItemModel) {
            $this->menuItemModel = $menuItemModel;
        }

        public function jsonSerialize() {
            return ["menuImageId" => $this->getMenuImageId(),
                    "menuImagePath" => $this->getMenuImagePath(),
                    "menuItemModel" => $this->getMenuItemModel()];
        }
    }
?>