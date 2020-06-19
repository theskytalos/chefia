<?php
    require_once dirname(__FILE__) . "/../../Connection.php";
    require_once dirname(__FILE__) . "/../TransitionTypeModel.php";

    class TransitionTypeDAO {
        public function createTransitionType($transitionTypeModel) {
            global $pdo;
        }

        public function editTransitionType($transitionTypeModel) {
            global $pdo;
        }

        public function removeTransitionType($transitionTypeModel) {
            global $pdo;
        }

        public function getTransitionType($transitionTypeModel) {
            global $pdo;

            $transitionTypeQuery = $pdo->prepare("SELECT transitions_types_name FROM transitions_types WHERE transitions_types_id = :transitions_types_id;");
            $transitionTypeQuery->bindValue(":transitions_types_id", $transitionTypeModel->getTransitionTypeId(), PDO::PARAM_INT);

            if ($transitionTypeQuery->execute()) {
                if ($transitionTypeQuery->rowCount() == 1) {
                    $row = $transitionTypeQuery->fetch();

                    $transitionTypeModel->setTransitionTypeName($row["transitions_types_name"]);

                    return $transitionTypeModel;
                }
            }

            return NULL;
        }

        public function getAllTransitionTypes() {
            global $pdo;
        }

        public function checkExistentTransitionType($transitionTypeModel) {
            global $pdo;

            $transitionTypeQuery = $pdo->prepare("SELECT transitions_types_id FROM transitions_types WHERE transitions_types_id = :transitions_types_id;");
            $transitionTypeQuery->bindValue(":transitions_types_id", $transitionTypeModel->getTransitionTypeId(), PDO::PARAM_INT);

            if ($transitionTypeQuery->execute())
                if ($transitionTypeQuery->rowCount() == 1)
                    return true;

            return false;
        }
    }
?>