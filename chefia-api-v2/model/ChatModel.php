<?php
    class ChatModel implements JsonSerializable {
        private $chatInteraction;
        private $chatTransitions;
        private $chatItems;
        private $chatShops;

        public function getChatInteraction() {
            return $this->chatInteraction;
        }

        public function setChatInteraction($chatInteraction) {
            $this->chatInteraction = $chatInteraction;
        }

        public function getChatTransitions() {
            return $this->chatTransitions;
        }

        public function setChatTransitions($chatTransitions) {
            $this->chatTransitions = $chatTransitions;
        }

        public function getChatItems() {
            return $this->chatItems;
        }

        public function setChatItems($chatItems) {
            $this->chatItems = $chatItems;
        }

        public function getChatShops() {
            return $this->chatShops;
        }

        public function setChatShops($chatShops) {
            $this->chatShops = $chatShops;
        }

        public function jsonSerialize() {
            return ["chatInteraction" => $this->getChatInteraction(),
                    "chatTransitions" => $this->getChatTransitions(),
                    "chatItems" => $this->getChatItems(),
                    "chatShops" => $this->getChatShops()];
        }
    }
?>