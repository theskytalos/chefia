<?php
    class ShopModel implements JsonSerializable {
        private $id;
        private $name;
        private $description;
        private $specialty;
        private $logoImage;
        private $cep;
        private $uf;
        private $city;
        private $neighbourhood;
        private $street;
        private $number;
        private $complement;
        private $reference;
        private $mapUrl;
        private $phoneNumbers;
        private $interactionModel;

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getName() {
            return $this->name;
        }

        public function setName($name) {
            $this->name = $name;
        }

        public function getDescription() {
            return $this->description;
        }

        public function setDescription($description) {
            $this->description = $description;
        }

        public function getSpecialty() {
            return $this->specialty;
        }

        public function setSpecialty($specialty) {
            $this->specialty = $specialty;
        }

        public function getLogoImage() {
            return $this->logoImage;
        }

        public function setLogoImage($logoImage) {
            $this->logoImage = $logoImage;
        }

        public function getCep() {
            return $this->cep;
        }

        public function setCep($cep) {
            $this->cep = $cep;
        }

        public function getUf() {
            return $this->uf;
        }

        public function setUf($uf) {
            $this->uf = $uf;
        }

        public function getCity() {
            return $this->city;
        }

        public function setCity($city) {
            $this->city = $city;
        }

        public function getNeighbourhood() {
            return $this->neighbourhood;
        }

        public function setNeighbourhood($neighbourhood) {
            $this->neighbourhood = $neighbourhood;
        }

        public function getStreet() {
            return $this->street;
        }

        public function setStreet($street) {
            $this->street = $street;
        }

        public function getNumber() {
            return $this->number;
        }

        public function setNumber($number) {
            $this->number = $number;
        }

        public function getComplement() {
            return $this->complement;
        }

        public function setComplement($complement) {
            $this->complement = $complement;
        }

        public function getReference() {
            return $this->reference;
        }

        public function setReference($reference) {
            $this->reference = $reference;
        }

        public function getMapUrl() {
            return $this->mapUrl;
        }

        public function setMapUrl($mapUrl) {
            $this->mapUrl = $mapUrl;
        }

        public function getPhoneNumbers() {
            return $this->phoneNumbers;
        }

        public function setPhoneNumbers($phoneNumbers) {
            $this->phoneNumbers = $phoneNumbers;
        }

        public function getInteractionModel() {
            return $this->interactionModel;
        }

        public function setInteractionModel($interactionModel) {
            $this->interactionModel = $interactionModel;
        }

        public function jsonSerialize() {
            return ["shopId" => $this->getId(),
                    "shopName" => $this->getName(),
                    "shopDescription" => $this->getDescription(),
                    "shopSpecialty" => $this->getSpecialty(),
                    "shopLogoImage" => $this->getLogoImage(),
                    "shopCEP" => $this->getCep(),
                    "shopUF" => $this->getUf(),
                    "shopCity" => $this->getCity(),
                    "shopNeighbourhood" => $this->getNeighbourhood(),
                    "shopStreet" => $this->getStreet(),
                    "shopNumber" => $this->getNumber(),
                    "shopComplement" => $this->getComplement(),
                    "shopReference" => $this->getReference(),
                    "shopMapUrl" => $this->getMapUrl(),
                    "shopPhoneNumbers" => $this->getPhoneNumbers(),
                    "interactionModel" => $this->getInteractionModel()];
        }
    }
?>