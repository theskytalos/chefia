<?php
    class ChatModel implements JsonSerializable {
        private $chatInteraction;
        private $chatTransitions;

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

        public function jsonSerialize() {
            return ["chatInteraction" => $this->getChatInteraction(),
                    "chatTransitions" => $this->getChatTransitions()];
        }
    }
?>