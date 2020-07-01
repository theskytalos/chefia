<?php
    require_once dirname(__FILE__) . "/../../Connection.php";
    require_once dirname(__FILE__) . "/../RequestModel.php";
    require_once dirname(__FILE__) . "/../ItemModel.php";

    class RequestDAO {
        public function createRequest($requestModel) {
            global $pdo;

            $requestQuery = $pdo->prepare("INSERT INTO requests (requests_datetime, requests_total_cost, requests_pay_method, requests_change_for, requests_cep, requests_uf, requests_city, requests_neighbourhood, requests_street, requests_number, requests_complement, requests_reference) VALUES (:requests_datetime, :requests_total_cost, :requests_pay_method, :requests_change_for, :requests_cep, :requests_uf, :requests_city, :requests_neighbourhood, :requests_street, :requests_number, :requests_complement, :requests_reference);");
            $requestQuery->bindValue(":requests_datetime", $requestModel->getRequestDatetime(), PDO::PARAM_STR);
            $requestQuery->bindValue(":requests_total_cost", $requestModel->getRequestTotalCost(), PDO::PARAM_STR);
            $requestQuery->bindValue(":requests_pay_method", $requestModel->getRequestPayMethod(), PDO::PARAM_INT);
            $requestQuery->bindValue(":requests_change_for", $requestModel->getRequestChangeFor(), PDO::PARAM_STR);
            $requestQuery->bindValue(":requests_cep", $requestModel->getRequestCEP(), PDO::PARAM_STR);
            $requestQuery->bindValue(":requests_uf", $requestModel->getRequestUF(), PDO::PARAM_STR);
            $requestQuery->bindValue(":requests_city", $requestModel->getRequestCity(), PDO::PARAM_STR);
            $requestQuery->bindValue(":requests_neighbourhood", $requestModel->getRequestNeighbourhood(), PDO::PARAM_STR);
            $requestQuery->bindValue(":requests_street", $requestModel->getRequestStreet(), PDO::PARAM_STR);
            $requestQuery->bindValue(":requests_number", $requestModel->getRequestNumber(), PDO::PARAM_INT);
            $requestQuery->bindValue(":requests_complement", $requestModel->getRequestComplement(), PDO::PARAM_STR);
            $requestQuery->bindValue(":requests_reference", $requestModel->getRequestReference(), PDO::PARAM_STR);

            $pdo->beginTransaction();

            if ($requestQuery->execute()) {
                $requestId = $pdo->lastInsertId();
                foreach ($requestModel->getRequestItems() as $item) {
                    $requestQuery = $pdo->prepare("INSERT INTO requests_items (requests_id_fk, items_id_fk, items_quantity, items_note) VALUES (:requests_id_fk, :items_id_fk, :items_quantity, :items_note);");
                    $requestQuery->bindValue(":requests_id_fk", $requestId, PDO::PARAM_INT);
                    $requestQuery->bindValue(":items_id_fk", $item->getItemId(), PDO::PARAM_INT);
                    $requestQuery->bindValue(":items_quantity", $item->getItemQuantity(), PDO::PARAM_INT);
                    $requestQuery->bindValue(":items_note", $item->getItemNote(), PDO::PARAM_STR);

                    if (!$requestQuery->execute()) {
                        $pdo->rollBack();
                        return false;
                    }
                }

                $pdo->commit();
                return true;
            }

            return false;
        }

        public function editRequest($requestModel) {
            global $pdo;
        }

        public function removeRequest($requestModel) {
            global $pdo;
        }

        public function getRequest($requestModel) {
            global $pdo;
        }

        public function getTodaysRequests() {
            global $pdo;

            $requestQuery = $pdo->prepare("SELECT requests_id, requests_datetime, requests_total_cost, requests_pay_method, requests_change_for, requests_cep, requests_uf, requests_city, requests_neighbourhood, requests_street, requests_number, requests_complement, requests_reference FROM requests WHERE requests_datetime = :requests_datetime;");
            $requestQuery->bindValue(":requests_datetime", date('Y-m-d'), PDO::PARAM_STR);

            $requestsArray = array();

            if ($requestQuery->execute()) {
                while ($row = $requestQuery->fetch()) {
                    $requestModel = new RequestModel();
                    $requestModel->setRequestId($row["requests_id"]);
                    $requestModel->setRequestDatetime($row["requests_datetime"]);
                    $requestModel->setRequestTotalCost($row["requests_total_cost"]);
                    $requestModel->setRequestPayMethod($row["requests_pay_method"]);
                    $requestModel->setRequestChangeFor($row["requests_change_for"]);
                    $requestModel->setRequestCEP($row["requests_cep"]);
                    $requestModel->setRequestUF($row["requests_uf"]);
                    $requestModel->setRequestCity($row["requests_city"]);
                    $requestModel->setRequestNeighbourhood($row["requests_neighbourhood"]);
                    $requestModel->setRequestStreet($row["requests_street"]);
                    $requestModel->setRequestNumber($row["requests_number"]);
                    $requestModel->setRequestComplement($row["requests_complement"]);
                    $requestModel->setRequestReference($row["requests_reference"]);

                    $requestItemsArray = array();

                    $requestItemsQuery = $pdo->prepare("SELECT items_id_fk, items_quantity, items_note FROM requests_items WHERE requests_id_fk = :requests_id_fk;");
                    $requestItemsQuery->bindValue(":requests_id_fk", $row["requests_id"], PDO::PARAM_INT);

                    if ($requestItemsQuery->execute()) {
                        while ($rowItem = $requestItemsQuery->fetch()) {
                            $itemModel = new ItemModel();

                            $itemModel->setItemId($rowItem["items_id_fk"]);
                            $itemModel->setItemQuantity($rowItem["items_quantity"]);
                            $itemModel->setItemNote($rowItem["items_note"]);

                            array_push($requestItemsArray, $itemModel);
                        }
                    }

                    $requestModel->setRequestItems($requestItemsArray);
                    array_push($requestsArray, $requestModel);
                }
            }

            return $requestsArray;
        }

        public function getAllRequests() {
            global $pdo;
        }
    }
?>