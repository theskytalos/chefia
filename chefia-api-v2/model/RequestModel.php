<?php
    class RequestModel implements JsonSerializable {
        private $requestId;
        private $requestDatetime;
        private $requestTotalCost;
        private $requestPayMethod;
        private $requestChangeFor;
        private $requestCEP;
        private $requestUF;
        private $requestCity;
        private $requestNeighbourhood;
        private $requestStreet;
        private $requestNumber;
        private $requestComplement;
        private $requestReference;
        private $requestItems;

        public function getRequestId() {
            return $this->requestId;
        }

        public function setRequestId($requestId) {
            $this->requestId = $requestId;
        }

        public function getRequestDatetime() {
            return $this->requestDatetime;
        }

        public function setRequestDatetime($requestDatetime) {
            $this->requestDatetime = $requestDatetime;
        }

        public function getRequestTotalCost() {
            return $this->requestTotalCost;
        }

        public function setRequestTotalCost($requestTotalCost) {
            $this->requestTotalCost = $requestTotalCost;
        }

        public function getRequestPayMethod() {
            return $this->requestPayMethod;
        }

        public function setRequestPayMethod($requestPayMethod) {
            $this->requestPayMethod = $requestPayMethod;
        }

        public function getRequestChangeFor() {
            return $this->requestChangeFor;
        }

        public function setRequestChangeFor($requestChangeFor) {
            $this->requestChangeFor = $requestChangeFor;
        }

        public function getRequestCEP() {
            return $this->requestCEP;
        }

        public function setRequestCEP($requestCEP) {
            $this->requestCEP = $requestCEP;
        }

        public function getRequestUF() {
            return $this->requestUF;
        }

        public function setRequestUF($requestUF) {
            $this->requestUF = $requestUF;
        }

        public function getRequestCity() {
            return $this->requestCity;
        }

        public function setRequestCity($requestCity) {
            $this->requestCity = $requestCity;
        }

        public function getRequestNeighbourhood() {
            return $this->requestNeighbourhood;
        }

        public function setRequestNeighbourhood($requestNeighbourhood) {
            $this->requestNeighbourhood = $requestNeighbourhood;
        }

        public function getRequestStreet() {
            return $this->requestStreet;
        }

        public function setRequestStreet($requestStreet) {
            $this->requestStreet = $requestStreet;
        }

        public function getRequestNumber() {
            return $this->requestNumber;
        }

        public function setRequestNumber($requestNumber) {
            $this->requestNumber = $requestNumber;
        }

        public function getRequestComplement() {
            return $this->requestComplement;
        }

        public function setRequestComplement($requestComplement) {
            $this->requestComplement = $requestComplement;
        }

        public function getRequestReference() {
            return $this->requestReference;
        }

        public function setRequestReference($requestReference) {
            $this->requestReference = $requestReference;
        }

        public function getRequestItems() {
            return $this->requestItems;
        }

        public function setRequestItems($requestItems) {
            $this->requestItems = $requestItems;
        }

        public function jsonSerialize() {
            return ["requestId" => $this->getRequestId(),
                    "requestDatetime" => $this->getRequestDateTime(),
                    "requestTotalCost" => $this->getRequestTotalCost(),
                    "requestPayMethod" => $this->getRequestPayMethod(),
                    "requestChangeFor" => $this->getRequestChangeFor(),
                    "requestCEP" => $this->getRequestCEP(),
                    "requestUF" => $this->getRequestUF(),
                    "requestCity" => $this->getRequestCity(),
                    "requestNeighbourhood" => $this->getRequestNeighbourhood(),
                    "requestStreet" => $this->getRequestStreet(),
                    "requestNumber" => $this->getRequestNumber(),
                    "requestComplement" => $this->getRequestComplement(),
                    "requestReference" => $this->getRequestReference(),
                    "requestItems" => $this->getRequestItems()];
        }
    }
?>