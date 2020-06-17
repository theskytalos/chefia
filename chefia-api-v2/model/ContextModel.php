<?php
    class ContextModel implements JsonSerializable {
        private $contextId;
        private $contextName;

        function __construct() {
            switch (func_num_args()) {
                case 1:
                    $this->setContextId(func_get_arg(0));
                    break;
            }
        }

        public function getContextId() {
            return $this->contextId;
        }

        public function setContextId($contextId) {
            $this->contextId = $contextId;
        }

        public function getContextName() {
            return $this->contextName;
        }

        public function setContextName($contextName) {
            $this->contextName = $contextName;
        }

        public function jsonSerialize() {
            return ["contextId" => $this->getContextId(),
                    "contextName" => $this->getContextName()];
        }
    }
?>