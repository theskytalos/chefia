<?php
    class SugestionModel implements JsonSerializable {
        private $sugestionId;
        private $sugestionDatetime;
        private $sugestionText;

        public function getSugestionId() {
            return $this->sugestionId;
        }

        public function setSugestionId($sugestionId) {
            $this->sugestionId = $sugestionId;
        }

        public function getSugestionDatetime() {
            return $this->sugestionDatetime;
        }

        public function setSugestionDatetime($sugestionDatetime) {
            $this->sugestionDatetime = $sugestionDatetime;
        }

        public function getSugestionText() {
            return $this->sugestionText;
        }

        public function setSugestionText($sugestionText) {
            $this->sugestionText = $sugestionText;
        }

        public function jsonSerialize() {
            return ["sugestionId" => $this->getSugestionId(),
                    "sugestionDatetime" => $this->getSugestionDatetime(),
                    "sugestionText" => $this->getSugestionText()];
        }
    }
?>