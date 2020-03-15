<?php
    class StateModel implements JsonSerializable {
        private $stateId;
        private $stateText;

        function __construct() {
            switch(func_num_args()) {
                case 1:
                    $this->setStateId(func_get_arg(0));
                    break;
            }
        }

        public function getStateId() {
            return $this->stateId;
        }

        public function setStateId($stateId) {
            $this->stateId = $stateId;
        }

        public function getStateText() {
            return $this->stateText;
        }

        public function setStateText($stateText) {
            $this->stateText = $stateText;
        }

        public function jsonSerialize() {
            return ["stateId" => $this->getStateId(),
                    "stateText" => $this->getStateText()];
        }
    }
?>