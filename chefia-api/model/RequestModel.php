<?php
    class RequestModel implements JsonSerializable {
        private $requestId;
        private $requestDateTime;
        private $requestTotalCost;
        private $requestPayMethod;
        private $requestItemsArray;

        function __construct() {
            $this->setRequestItemsArray(array());
        }

        public function getRequestId() {
            return $this->requestId;
        }

        public function setRequestId($requestId) {
            $this->requestId = $requestId;
        }

        public function getRequestDateTime() {
            return $this->requestDateTime;
        }

        public function setRequestDateTime($requestDateTime) {
            $this->requestDateTime = $requestDateTime;
        }

        public function getRequestTotalCost() {
            return $this->requestTotalCost;
        }

        public function setRequestTotalCost($requestTotalCost) {
            $this->requestTotalCost = $requestTotalCost;
        }

        public function getRequestPayMethod() {
            return $this->getRequestPayMethod;
        }

        public function setRequestPayMethod($requestPayMethod) {
            $this->requestPayMethod = $requestPayMethod;
        }

        public function getRequestItemsArray() {
            return $this->requestItemsArray;
        }

        public function setRequestItemsArray($requestItemsArray) {
            $this->requestItemsArray = $requestItemsArray;
        }

        public function jsonSerialize() {
            return ["requestId" => $this->getRequestId(),
                    "requestDateTime" => $this->getRequestDateTime(),
                    "requestTotalCost" => $this->getRequestTotalCost(),
                    "requestPayMethod" => $this->getRequestPayMethod(),
                    "requestItemsArray" => $this->getRequestItemsArray()];
        }
    }
?>