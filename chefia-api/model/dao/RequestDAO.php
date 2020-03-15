<?php
    require_once dirname(__FILE__) . "/../../Connection.php";
    require_once dirname(__FILE__) . "/../RequestModel.php";
    require_once dirname(__FILE__) . "/MenuItemDAO.php";

    class RequestDAO {
        public function createRequest($requestModel) {
            global $pdo;

            $requestQuery = $pdo->prepare("INSERT INTO requests (requests_datetime, requests_total_cost, requests_pay_method) VALUES (?, ?, ?);");
            $requestQuery->bindValue(1, $requestModel->getRequestDateTime(), PDO::PARAM_STR);
            $requestQuery->bindValue(2, $requestModel->getRequestTotalCost(), PDO::PARAM_STR);
            $requestQuery->bindValue(3, $requestModel->getRequestPayMethods(), PDO::PARAM_STR);

            if ($requestQuery->execute()) {
                foreach ($requestModel->getResquestItemsArray() as $menuItem) {
                    $requestQuery = $pdo->prepare("INSERT INTO requests_items (requests_id_fk, menu_items_id_fk, menu_items_quantity) VALUES (?, ?, ?);");
                    $requestQuery->bindValue(1, $requestModel->getRequestId(), PDO::PARAM_INT);
                    $requestQuery->bindValue(2, $menuItem->getMenuItemId(), PDO::PARAM_INT);
                    $requestQuery->bindValue(3, $menuItem->getMenuItemQuantity(), PDO::PARAM_INT);

                    if (!$requestQuery->execute())
                        return false;
                }

                return true;
            }

            return false;
        }

        public function editRequest($requestModel) {
            global $pdo;

            $requestQuery = $pdo->prepare("UPDATE requests SET requests_datetime = ?, requests_total_cost = ?, requests_pay_method = ? WHERE requests_id = ?;");
            $requestQuery->bindValue(1, $requestModel->getRequestDateTime(), PDO::PARAM_STR);
            $requestQuery->bindValue(2, $requestModel->getRequestTotalCost(), PDO::PARAM_STR);
            $requestQuery->bindValue(3, $requestModel->getRequestPayMethod(), PDO::PARAM_INT);
            $requestQuery->bindValue(4, $requestModel->getRequestId(), PDO::PARAM_INT);

            return $requestQuery->execute();
        }

        public function removeRequest($requestModel) {
            global $pdo;

            $requestQuery = $pdo->prepare("DELETE FROM requests_items WHERE requests_id_fk = ?;");
            $requestQuery->bindValue(1, $requestModel->getRequestId(), PDO::PARAM_INT);

            if ($requestQuery->execute()) {
                $requestQuery = $pdo->prepare("DELETE FROM requests WHERE requests_id = ?;");
                $requestQuery->bindValue(1, $requestModel->getRequestId(), PDO::PARAM_INT);

                return $requestQuery->execute();
            }

            return false;
        }

        public function getRequestById($requestModel) {
            global $pdo;

            $requestQuery = $pdo->prepare("SELECT requests_datetime, requests_total_cost, requests_pay_method, requests_table FROM requests WHERE requests_id = ?;");
            $requestQuery->bindValue(1, $requestModel->getRequestId(), PDO::PARAM_INT);
            
            if ($requestQuery->execute()) {
                if ($requestQuery->rowCount() == 1) {
                    $row = $requestQuery->fetch();

                    $requestModel->setRequestDateTime($row["requests_datetime"]);
                    $requestModel->setRequestTotalCost($row["requests_total_cost"]);
                    $requestModel->setRequestPayMethod($row["requests_pay_method"]);
                    $requestModel->setRequestTable($row["requests_table"]);

                    $requestQuery = $pdo->prepare("SELECT menu_items_id_fk, menu_items_quantity FROM requests_items WHERE requests_id_fk = ?;");
                    $requestQuery->bindValue(1, $requestModel->getRequestId(), PDO::PARAM_INT);

                    if ($requestQuery->execute()) {
                        if ($requestQuery->rowCount() > 0) {
                            $menuItemController = new MenuItemController();
                            $requestItemsArray = $requestModel->getRequestItemsArray();

                            while ($row = $requestQuery->fetch()) {
                                $menuItemModel = new MenuItemModel();
                                $menuItemModel->setMenuItemId($row["menu_items_id_fk"]);

                                if (($menuItem = $menuItemController->getMenuItemById($menuItemModel)) != NULL)
                                    array_push($requestItemsArray, $menuItemModel);
                            }

                            $requestModel->setRequestItemArray($requestItemsArray);
                            return $requestModel;
                        }
                    }
                }
            }

            return NULL;
        }

        public function getRequestsByDate($requestModel) {
            global $pdo;

            $requestQuery = $pdo->prepare("SELECT requests_id, requests_total_cost, requests_pay_method, requests_table FROM requests WHERE requests_datetime = ?;");
            $requestQuery->bindValue(1, $requestModel->getRequestDateTime(), PDO::PARAM_INT);
            
            $requestsArray = array();

            if ($requestQuery->execute()) {
                if ($requestQuery->rowCount() > 0) {
                    while ($row = $requestQuery->fetch()) {
                        $requestModel = new RequestModel();

                        $requestModel->setRequestId($row["requests_id"]);
                        $requestModel->setRequestTotalCost($row["requests_total_cost"]);
                        $requestModel->setRequestPayMethod($row["requests_pay_method"]);
                        $requestModel->setRequestTable($row["requests_table"]);

                        $requestQuery = $pdo->prepare("SELECT menu_items_id_fk, menu_items_quantity FROM requests_items WHERE requests_id_fk = ?;");
                        $requestQuery->bindValue(1, $requestModel->getRequestId(), PDO::PARAM_INT);

                        if ($requestQuery->execute()) {
                            if ($requestQuery->rowCount() > 0) {
                                $menuItemController = new MenuItemController();
                                $requestItemsArray = $requestModel->getRequestItemsArray();

                                while ($row = $requestQuery->fetch()) {
                                    $menuItemModel = new MenuItemModel();
                                    $menuItemModel->setMenuItemId($row["menu_items_id_fk"]);

                                    if (($menuItem = $menuItemController->getMenuItemById($menuItemModel)) != NULL)
                                        array_push($requestItemsArray, $menuItemModel);
                                }

                                $requestModel->setRequestItemArray($requestItemsArray);
                                array_push($requestsArray, $requestModel);
                            }
                        }
                    }
                }
            }

            return $requestsArray;
        }

        public function getAllRequests() {
            global $pdo;

            $requestQuery = $pdo->query("SELECT requests_id, requests_datetime, requests_total_cost, requests_pay_method, requests_table FROM requests;");
            
            $requestsArray = array();

            if ($requestQuery) {
                if ($requestQuery->rowCount() > 0) {
                    while ($row = $requestQuery->fetch()) {
                        $requestModel = new RequestModel();

                        $requestModel->setRequestId($row["requests_id"]);
                        $requestModel->setRequestDateTime($row["requests_datetime"]);
                        $requestModel->setRequestTotalCost($row["requests_total_cost"]);
                        $requestModel->setRequestPayMethod($row["requests_pay_method"]);
                        $requestModel->setRequestTable($row["requests_table"]);

                        $requestQuery = $pdo->prepare("SELECT menu_items_id_fk, menu_items_quantity FROM requests_items WHERE requests_id_fk = ?;");
                        $requestQuery->bindValue(1, $requestModel->getRequestId(), PDO::PARAM_INT);

                        if ($requestQuery->execute()) {
                            if ($requestQuery->rowCount() > 0) {
                                $menuItemController = new MenuItemController();
                                $requestItemsArray = $requestModel->getRequestItemsArray();

                                while ($row = $requestQuery->fetch()) {
                                    $menuItemModel = new MenuItemModel();
                                    $menuItemModel->setMenuItemId($row["menu_items_id_fk"]);

                                    if (($menuItem = $menuItemController->getMenuItemById($menuItemModel)) != NULL)
                                        array_push($requestItemsArray, $menuItemModel);
                                }

                                $requestModel->setRequestItemArray($requestItemsArray);
                                array_push($requestsArray, $requestModel);
                            }
                        }
                    }
                }
            }

            return $requestsArray;
        }
    }
?>