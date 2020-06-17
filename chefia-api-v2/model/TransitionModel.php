<?php
    class TransitionModel implements JsonSerializable {
        private $transitionId;
        private $transitionFromModel; // InteractionModel
        private $transitionToModel; // InteractionModel
        private $transitionTypeModel;
        private $transitionValue;

        function __construct() {
            switch (func_num_args()) {
                case 1:
                    $this->setTransitionId(func_get_arg(0));
                    break;
            }
        }

        public function getTransitionId() {
            return $this->transitionId;
        }

        public function setTransitionId($transitionId) {
            $this->transitionId = $transitionId;
        }

        public function getTransitionFromModel() {
            return $this->transitionFromModel;
        }

        public function setTransitionFromModel($transitionFromModel) {
            $this->transitionFromModel = $transitionFromModel;
        }

        public function getTransitionToModel() {
            return $this->transitionToModel;
        }

        public function setTransitionToModel($transitionToModel) {
            $this->transitionToModel = $transitionToModel;
        }

        public function getTransitionTypeModel() {
            return $this->transitionTypeModel;
        }

        public function setTransitionTypeModel($transitionTypeModel) {
            $this->transitionTypeModel = $transitionTypeModel;
        }

        public function getTransitionValue() {
            return $this->transitionValue;
        } 

        public function setTransitionValue($transitionValue) {
            $this->transitionValue = $transitionValue;
        }

        public function jsonSerialize() {
            return ["transitionId" => $this->getTransitionId(),
                    "transitionFromModel" => $this->getTransitionFromModel(),
                    "transitionToModel" => $this->getTransitionToModel(),
                    "transitionTypeModel" => $this->getTransitionTypeModel(),
                    "transitionValue" => $this->getTransitionValue()];
        }
    }
?>