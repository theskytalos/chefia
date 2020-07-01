<?php
    class ItemModel implements JsonSerializable {
        private $itemId;
        private $itemName;
        private $itemDescription;
        private $itemPrice;
        private $itemStock;
        private $itemQuantity;
        private $itemNote;
        private $interactionModel;

        function __construct() {
            switch (func_num_args()) {
                case 1:
                    $this->setItemId(func_get_arg(0));
                    break;
            }
        }

        public function getItemId() {
            return $this->itemId;
        }

        public function setItemId($itemId) {
            $this->itemId = $itemId;
        }

        public function getItemName() {
            return $this->itemName;
        }

        public function setItemName($itemName) {
            $this->itemName = $itemName;
        }

        public function getItemDescription() {
            return $this->itemDescription;
        }

        public function setItemDescription($itemDescription) {
            $this->itemDescription = $itemDescription;
        }

        public function getItemPrice() {
            return $this->itemPrice;
        }

        public function setItemPrice($itemPrice) {
            $this->itemPrice = $itemPrice;
        }

        public function getItemStock() {
            return $this->itemStock;
        }

        public function setItemStock($itemStock) {
            $this->itemStock = $itemStock;
        }

        public function getItemQuantity() {
            return $this->itemQuantity;
        }

        public function setItemQuantity($itemQuantity) {
            $this->itemQuantity = $itemQuantity;
        }

        public function getItemNote() {
            return $this->itemNote;
        }

        public function setItemNote($itemNote) {
            $this->itemNote = $itemNote;
        }

        public function getInteractionModel() {
            return $this->interactionModel;
        }

        public function setInteractionModel($interactionModel) {
            $this->interactionModel = $interactionModel;
        }

        public function jsonSerialize() {
            if (!is_null($this->getItemQuantity()) && !is_null($this->getItemNote()))
                return ["itemId" => $this->getItemId(),
                        "itemName" => $this->getItemName(),
                        "itemDescription" => $this->getItemDescription(),
                        "itemPrice" => $this->getItemPrice(),
                        "itemStock" => $this->getItemStock(),
                        "itemQuantity" => $this->getItemQuantity(),
                        "itemNote" => $this->getItemNote(),
                        "interactionModel" => $this->getInteractionModel()];
            else
                return ["itemId" => $this->getItemId(),
                        "itemName" => $this->getItemName(),
                        "itemDescription" => $this->getItemDescription(),
                        "itemPrice" => $this->getItemPrice(),
                        "itemStock" => $this->getItemStock(),
                        "interactionModel" => $this->getInteractionModel()];
        }
    }
?> 