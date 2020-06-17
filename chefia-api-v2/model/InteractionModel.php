<?php
    class InteractionModel implements JsonSerializable {
        private $interactionId;
        private $interactionContent;
        private $contextModel;

        function __construct() {
            switch (func_num_args()) {
                case 1:
                    $this->setInteractionId(func_get_arg(0));
                    break;
            }
        }

        public function getInteractionId() {
            return $this->interactionId;
        }

        public function setInteractionId($interactionId) {
            $this->interactionId = $interactionId;
        }

        public function getInteractionContent() {
            return $this->interactionContent;
        }

        public function setInteractionContent($interactionContent) {
            $this->interactionContent = $interactionContent;
        }

        public function getContextModel() {
            return $this->contextModel;
        }

        public function setContextModel($contextModel) {
            $this->contextModel = $contextModel;
        }

        public function jsonSerialize() {
            return ["interactionId" => $this->getInteractionId(),
                    "interactionContent" => $this->getInteractionContent(),
                    "contextModel" => $this->getContextModel()];
        }
    }
?>