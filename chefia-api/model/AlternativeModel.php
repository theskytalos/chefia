<?php
    class AlternativeModel implements JsonSerializable {
        private $alternativeId;
        private $alternativeText;
        private $alternativeNextStateModel;
        private $stateModel;
        private $menuCategoryModel;
        private $menuItemModel;

        public function getAlternativeId() {
            return $this->alternativeId;
        }

        public function setAlternativeId($alternativeId) {
            $this->alternativeId = $alternativeId;
        }

        public function getAlternativeText() {
            return $this->alternativeText;
        }

        public function setAlternativeText($alternativeText) {
            $this->alternativeText = $alternativeText;
        }

        public function getAlternativeNextStateModel() {
            return $this->alternativeNextStateModel;
        }

        public function setAlternativeNextStateModel($alternativeNextStateModel) {
            $this->alternativeNextStateModel = $alternativeNextStateModel;
        }

        public function getStateModel() {
            return $this->stateModel;
        }

        public function setStateModel($stateModel) {
            $this->stateModel = $stateModel;
        }

        public function getMenuCategoryModel() {
            return $this->menuCategoryModel;
        }

        public function setMenuCategoryModel($menuCategoryModel) {
            $this->menuCategoryModel = $menuCategoryModel;
        }

        public function getMenuItemModel() {
            return $this->menuItemModel;
        }

        public function setMenuItemModel($menuItemModel) {
            $this->menuItemModel = $menuItemModel;
        }

        public function jsonSerialize() {
            return ["alternativeId" => $this->getAlternativeId(),
                    "alternativeText" => $this->getAlternativeText(),
                    "alternativeNextStateModel" => $this->getAlternativeNextStateModel(),
                    "stateModel" => $this->getStateModel(),
                    "menuCategoryModel" => $this->getMenuCategoryModel(),
                    "menuItemModel" => $this->getMenuItemModel()];
        }
    }
?>