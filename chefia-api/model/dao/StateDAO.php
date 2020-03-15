<?php
    require_once dirname(__FILE__) . "/../../Connection.php";
    require_once dirname(__FILE__) . "/../StateModel.php";

    class StateDAO {
        public function createState($stateModel) {
            global $pdo;

            $stateQuery = $pdo->prepare("INSERT INTO states (states_text) VALUES (?);");
            $stateQuery->bindValue(1, $stateModel->getStateText(), PDO::PARAM_STR);

            return $stateQuery->execute();
        }

        public function editState($stateModel) {
            global $pdo;

            $stateQuery = $pdo->prepare("UPDATE states SET states_text = ? WHERE states_id = ?;");
            $stateQuery->bindValue(1, $stateModel->getStateText(), PDO::PARAM_STR);
            $stateQuery->bindValue(2, $stateModel->getStateId(), PDO::PARAM_INT);

            return $stateQuery->execute();
        }

        public function removeState($stateModel) {
            global $pdo;

            $stateQuery = $pdo->prepare("DELETE FROM states WHERE states_id = ?;");
            $stateQuery->bindValue(1, $stateModel->getStateId(), PDO::PARAM_INT);

            return $stateQuery->execute();
        }

        public function getState($stateModel) {
            global $pdo;

            $stateQuery = $pdo->prepare("SELECT states_text FROM states WHERE states_id = ?;");
            $stateQuery->bindValue(1, $stateModel->getStateId(), PDO::PARAM_INT);

            if ($stateQuery->execute()) {
                if ($stateQuery->rowCount() == 1) {
                    $row = $stateQuery->fetch();

                    $stateModel->setStateText($row["states_text"]);

                    return $stateModel;
                }
            }

            return NULL;
        }

        public function getAllStates() {
            global $pdo;

            $stateQuery = $pdo->query("SELECT states_id, states_text FROM states;");
            
            $statesArray = array();

            if ($stateQuery) {
                if ($stateQuery->rowCount() > 0) {
                    while ($row = $stateQuery->fetch()) {
                        $stateModel = new StateModel();

                        $stateModel->setStateId($row["states_id"]);
                        $stateModel->setStateText($row["states_text"]);

                        array_push($statesArray, $stateModel);
                    }
                }
            }

            return $statesArray;
        }

        // Returns true if the id on the stateModel exists on the database
        public function checkExistentState($stateModel) {
            global $pdo;

            $stateQuery = $pdo->query("SELECT states_id FROM states WHERE stated_id = ?;");
            $stateQuery->bindValue(1, $stateModel->getStateId(), PDO::PARAM_INT);

            if ($stateQuery->execute())
                if ($stateQuery->rowCount() == 1)
                    return true;

            return false;
        }
    }
?>