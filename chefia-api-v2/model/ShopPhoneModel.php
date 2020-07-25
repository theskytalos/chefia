<?php
    class ShopPhoneModel implements JsonSerializable {
        private $id;
        private $type; // 1 - Telefone, 2 - Celular
        private $number;

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getType() {
            return $this->type;
        }

        public function setType($type) {
            $this->type = $type;
        }

        public function getNumber() {
            return $this->number;
        }

        public function setNumber($number) {
            $this->number = $number;
        }

        public function jsonSerialize() {
            return ["shopPhoneId" => $this->getId(),
                    "shopPhoneType" => $this->getType(),
                    "shopPhoneNumber" => $this->getNumber()];
        }
    }
?>