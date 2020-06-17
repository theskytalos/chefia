<?php
    require_once dirname(__FILE__) . "/../../Connection.php";
    require_once dirname(__FILE__) . "/../TransitionModel.php";
    require_once dirname(__FILE__) . "/../TransitionTypeModel.php";
    require_once dirname(__FILE__) . "/../InteractionModel.php";

    class TransitionDAO {
        public function createTransition($transitionModel) {
            global $pdo;
        }

        public function editTransition($transitionModel) {
            global $pdo;
        }

        public function removeTransition($transitionModel) {
            global $pdo;
        }

        public function getTransition($transitionModel) {
            global $pdo;

            $transitionQuery = $pdo->prepare("SELECT interactions_transitions_from, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value FROM interactions_transitions WHERE interactions_transitions_id = :interactions_transitions_id;");
            $transitionQuery->bindParam(":interactions_transitions_id", $transitionModel->getTransitionId(), PDO::PARAM_INT);

            if ($transitionQuery->execute()) {
                if ($transitionQuery->rowCount() == 1) {
                    $row = $transitionQuery->fetch();

                    $transitionModel->setTransitionFromModel(new InteractionModel($row["interactions_transitions_from"]));
                    $transitionModel->setTransitionToModel(new InteractionModel($row["interactions_transitions_to"]));
                    $transitionModel->setTransitionTypeModel(new TransitionTypeModel($row["transitions_types_id_fk"]));
                    $transitionModel->setTransitionValue($row["interactions_transitions_value"]);

                    return $transitionModel;
                }
            }

            return NULL;
        }

        public function getAllTransitionsByOwnerInteraction($transitionModel) {
            global $pdo;

            $transitionQuery = $pdo->prepare("SELECT interactions_transitions_id, interactions_transitions_to, transitions_types_id_fk, interactions_transitions_value FROM interactions_transitions WHERE interactions_transitions_from = :interactions_transitions_from;");
            $transitionQuery->bindParam(":interactions_transitions_from", $transitionModel->getTransitionFromModel()->getInteractionId(), PDO::PARAM_INT);

            $transitionsArray = array();

            if ($transitionQuery->execute()) {
                if ($transitionQuery->rowCount() > 0) {
                    while ($row = $transitionQuery->fetch()) {
                        $transitionModel = new TransitionModel();
                        $transitionModel->setTransitionId($row["interactions_transitions_id"]);
                        $transitionModel->setTransitionFromModel(new InteractionModel($row["interactions_transitions_from"]));
                        $transitionModel->setTransitionToModel(new InteractionModel($row["interactions_transitions_to"]));
                        $transitionModel->setTransitionTypeModel(new TransitionTypeModel($row["transitions_types_id_fk"]));
                        $transitionModel->setTransitionValue($row["interactions_transitions_value"]);

                        array_push($transitionsArray, $transitionModel);
                    }
                }
            }

            return $transitionsArray;
        }
    }
?>