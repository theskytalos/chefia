<?php
    class TransitionTypeModel implements JsonSerializable {
        private $transitionTypeId;
        private $transitionTypeName;

        function __construct() {
            switch (func_num_args()) {
                case 1:
                    $this->setTransitionTypeId(func_get_arg(0));
                    break;
            }
        }

        public function getTransitionTypeId() {
            return $this->transitionTypeId;
        }

        public function setTransitionTypeId($transitionTypeId) {
            $this->transitionTypeId = $transitionTypeId;
        }

        public function getTransitionTypeName() {
            return $this->transitionTypeName;
        }

        public function setTransitionTypeName($transitionTypeName) {
            $this->transitionTypeName = $transitionTypeName;
        }

        public function jsonSerialize() {
            return ["transitionTypeId" => $this->getTransitionTypeId(),
                    "transitionTypeName" => $this->getTransitionTypeName()];
        }
    }
?>