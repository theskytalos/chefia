<?php
    require_once dirname(__FILE__) . "/../../Connection.php";
    require_once dirname(__FILE__) . "/../ShopModel.php";
    require_once dirname(__FILE__) . "/../ShopPhoneModel.php";
    
    class ShopDAO {
        public function createShop($shopModel) {
            global $pdo;
        }

        public function editShop($shopModel) {
            global $pdo;
        }

        public function removeShop($shopModel) {
            global $pdo;
        }

        public function getShop($shopModel) {
            global $pdo;
        }

        public function getAllShopsByInteraction($shopModel) {
            global $pdo;

            $shopQuery = $pdo->prepare("SELECT shops_id, shops_name, shops_description, shops_specialty, shops_logo_image, shops_cep, shops_uf, shops_city, shops_neighbourhood, shops_street, shops_number, shops_complement, shops_reference, shops_map_url FROM shops WHERE interactions_id_fk = :id;");
            $shopQuery->bindValue(":id", $shopModel->getInteractionModel()->getInteractionId(), PDO::PARAM_INT);

            $shopsArray = array();

            if ($shopQuery->execute()) {
                if ($shopQuery->rowCount() > 0) {
                    while ($row = $shopQuery->fetch()) {
                        $shopModel = new ShopModel();

                        $shopModel->setId($row["shops_id"]);
                        $shopModel->setName($row["shops_name"]);
                        $shopModel->setDescription($row["shops_description"]);
                        $shopModel->setSpecialty($row["shops_specialty"]);
                        $shopModel->setLogoImage($row["shops_logo_image"]);
                        $shopModel->setCep($row["shops_cep"]);
                        $shopModel->setUf($row["shops_uf"]);
                        $shopModel->setCity($row["shops_city"]);
                        $shopModel->setNeighbourhood($row["shops_neighbourhood"]);
                        $shopModel->setStreet($row["shops_street"]);
                        $shopModel->setNumber($row["shops_number"]);
                        $shopModel->setComplement($row["shops_complement"]);
                        $shopModel->setReference($row["shops_reference"]);
                        $shopModel->setMapUrl($row["shops_map_url"]);

                        $shopPhoneNumbers = array();

                        $phoneQuery = $pdo->prepare("SELECT shops_phones_id, shops_phones_type, shops_phones_number FROM shops_phones WHERE shops_id_fk = :id;");
                        $phoneQuery->bindValue(":id", $shopModel->getId(), PDO::PARAM_INT);

                        if ($phoneQuery->execute()) {
                            if ($phoneQuery->rowCount() > 0) {
                                while ($rowPhone = $phoneQuery->fetch()) {
                                    $shopPhoneModel = new ShopPhoneModel();

                                    $shopPhoneModel->setId($rowPhone["shops_phones_id"]);
                                    $shopPhoneModel->setType($rowPhone["shops_phones_type"]);
                                    $shopPhoneModel->setNumber($rowPhone["shops_phones_number"]);

                                    array_push($shopPhoneNumbers, $shopPhoneModel);
                                }
                            }
                        }

                        $shopModel->setPhoneNumbers($shopPhoneNumbers);

                        array_push($shopsArray, $shopModel);
                    }
                }
            }

            return $shopsArray;
        }

        public function checkExistentShop($shopModel) {
            global $pdo;
        }
    }
?>