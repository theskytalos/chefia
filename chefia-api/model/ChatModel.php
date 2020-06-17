<?php
    class ChatModel implements JsonSerializable {
        private $chatState;
        private $chatAlternatives;

        public function getChatState() {
            return $this->chatState;
        }

        public function setChatState($chatState) {
            $this->chatState = $chatState;
        }

        public function getChatAlternatives() {
            return $this->chatAlternatives;
        }

        public function setChatAlternatives($chatAlternatives) {
            $this->chatAlternatives = $chatAlternatives;
        }

        public function jsonSerialize() {
            return ["chatState" => $this->getChatState(),
                    "chatAlternatives" => $this->getChatAlternatives()];
        }
    }
?>