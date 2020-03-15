<?php
    require_once dirname(__FILE__) . "/../../Connection.php";
    require_once dirname(__FILE__) . "/../AlternativeModel.php";

    class AlternativeDAO {
        public function createAlternative($alternativeModel) {
            global $pdo;

            $alternativeQuery = $pdo->prepare("INSERT INTO alternatives (alternatives_text, alternatives_next_state_id_fk, states_id_fk) VALUES (?, ?, ?);");
            $alternativeQuery->bindValue(1, $alternativeModel->getAlternativeText(), PDO::PARAM_STR);
            $alternativeQuery->bindValue(2, $alternativeModel->getAlternativeNextStateModel()->getStateId(), PDO::PARAM_INT);
            $alternativeQuery->bindValue(3, $alternativeModel->getStateModel()->getStateId(), PDO::PARAM_INT);

            return $alternativeQuery->execute();
        }

        public function editAlternative($alternativeModel) {
            global $pdo;

            $alternativeQuery = $pdo->prepare("UPDATE alternatives SET alternatives_text = ?, alternatives_next_state_id_fk = ?, states_id_fk = ? WHERE alternatives_id = ?;");
            $alternativeQuery->bindValue(1, $alternativeModel->getAlternativeText(), PDO::PARAM_STR);
            $alternativeQuery->bindValue(2, $alternativeModel->getAlternativeNextStateModel()->getStateId(), PDO::PARAM_INT);
            $alternativeQuery->bindValue(3, $alternativeModel->getStateModel()->getStateId(), PDO::PARAM_INT);
            $alternativeQuery->bindValue(4, $alternativeModel->getAlternativeId(), PDO::PARAM_INT);

            return $alternativeQuery->execute();
        }

        public function removeAlternative($alternativeModel) {
            global $pdo;

            $alternativeQuery = $pdo->prepare("DELETE FROM alternatives WHERE alternatives_id = ?;");
            $alternativeQuery->bindValue(1, $alternativeModel->getAlternativeId(), PDO::PARAM_INT);

            return $alternativeQuery->execute();
        }

        public function getAllAlternativesByState($alternativeModel) {
            global $pdo;

            $alternativeQuery = $pdo->prepare("SELECT alternatives_id, alternatives_text, alternatives_next_state_id_fk, states_id_fk FROM alternatives WHERE states_id_fk = ?;");
            $alternativeQuery->bindValue(1, $alternativeModel->getStateModel()->getStateId(), PDO::PARAM_INT);

            $alternativesArray = array();

            if ($alternativeQuery->execute()) {
                if ($alternativeQuery->rowCount() > 0) {
                    while ($row = $alternativeQuery->fetch()) {
                        $alternativeModel = new AlternativeModel();

                        $alternativeModel->setAlternativeId($row["alternatives_id"]);
                        $alternativeModel->setAlternativeText($row["alternatives_text"]);
                        $alternativeModel->setAlternativeNextStateModel(new StateModel($row["alternatives_next_state_id_fk"]));
                        $alternativeModel->setStateModel(new StateModel($row["states_id_fk"]));

                        array_push($alternativesArray, $alternativeModel);
                    }
                }
            }

            return $alternativesArray;
        }

        public function checkExistentAlternative($alternativeModel) {
            global $pdo;

            $alternativeQuery = $pdo->prepare("SELECT alternatives_id FROM alternatives WHERE alternatives_id = ?;");
            $alternativeQuery->bindValue(1, $alternativeModel->getAlternativeId(), PDO::PARAM_INT);

            if ($alternativeQuery->execute())
                if ($alternativeQuery->rowCount() == 1)
                    return true;

            return false;
        }
    }
?>