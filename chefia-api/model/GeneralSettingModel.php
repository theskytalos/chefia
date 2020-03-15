<?php
    class GeneralSettingModel implements JsonSerializable {
        private $generalSettingKey;
        private $generalSettingValue;

        public function getGeneralSettingKey() {
            return $this->generalSettingKey;
        }

        public function setGeneralSettingKey($generalSettingKey) {
            $this->generalSettingKey = $generalSettingKey;
        }

        public function getGeneralSettingValue() {
            return $this->generalSettingValue;
        }

        public function setGeneralSettingValue($generalSettingValue) {
            $this->generalSettingValue = $generalSettingValue;
        }

        public function jsonSerialize() {
            return ["generalSettingKey" => $this->getGeneralSettingKey(),
                    "generalSettingValue" => $this->getGeneralSettingValue()];
        }
    }
?>