<?php
    class MenuCategoryModel implements JsonSerializable {
        private $menuCategoryId;
        private $menuCategoryText;

        function __construct() {
            switch(func_num_args()) {
                case 1:
                    $this->setMenuCategoryId(func_get_arg(0));
                    break;
            }
        } 

        public function getMenuCategoryId() {
            return $this->menuCategoryId;
        }

        public function setMenuCategoryId($menuCategoryId) {
            $this->menuCategoryId = $menuCategoryId;
        }

        public function getMenuCategoryText() {
            return $this->menuCategoryText;
        }

        public function setMenuCategoryText($menuCategoryText) {
            $this->menuCategoryText = $menuCategoryText;
        }

        public function jsonSerialize() {
            return ["menuCategoryId" => $this->getMenuCategoryId(),
                    "menuCategoryText" => $this->getMenuCategoryText()];
        }
    }
?>