<?php
    class AlternativeModel implements JsonSerializable {
        private $alternativeId;
        private $alternativeText;
        private $alternativeNextStateModel;
        private $stateModel;

        public function getAlternativeId() {
            return $this->alternativeId;
        }

        public function setAlternartiveId($alternativeId) {
            $this->alternativeId = $alternativeId;
        }

        public function getAlternativeText() {
            return $this->alternativeText;
        }

        public function setAlternativeText($alternativeText) {
            $this->alternativeText = $alternativeText;
        }

        public function getAlternativeNextStateModel() {
            return $this->alternativeNextStateModel;
        }

        public function setAlternativeNextStateModel($alternativeNextStateModel) {
            $this->alternativeNextStateModel = $alternativeNextStateModel;
        }

        public function getStateModel() {
            return $this->stateModel;
        }

        public function setStateModel($stateModel) {
            $this->stateModel = $stateModel;
        }

        public function jsonSerialize() {
            return ["alternativeId" => $this->getAlternativeId(),
                    "alternativeText" => $this->getAlternativeText(),
                    "alternativeNextStateModel" => $this->getAlternativeNextStateModel(),
                    "stateModel" => $this->getStateModel()];
        }
    }
?>