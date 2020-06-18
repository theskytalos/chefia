<?php
    require_once dirname(__FILE__) . "/../../Connection.php";
    require_once dirname(__FILE__) . "/../InteractionModel.php";
    require_once dirname(__FILE__) . "/../ContextModel.php";

    class InteractionDAO {
        public function createInteraction($interactionModel) {
            global $pdo;
        }

        public function editInteraction($interactionModel) {
            global $pdo;
        }

        public function removeInteraction($interactionModel) {
            global $pdo;
        }

        public function getInteraction($interactionModel) {
            global $pdo;

            $interactionQuery = $pdo->prepare("SELECT interactions_content, contexts_id_fk FROM interactions WHERE interactions_id = :interactions_id;");
            $interactionQuery->bindParam("interactions_id", $interactionModel->getInteractionId(), PDO::PARAM_INT);

            if ($interactionQuery->execute()) {
                if ($interactionQuery->rowCount() == 1) {
                    $row = $interactionQuery->fetch();

                    $interactionModel->setInteractionContent($row["interactions_content"]);
                    $interactionModel->setContextModel(new ContextModel($row["contexts_id_fk"]));

                    return $interactionModel;
                }
            }

            return NULL;
        }

        public function getFirstInteraction() {
            global $pdo;

            $interactionQuery = $pdo->query("SELECT interactions_id, interactions_content, contexts_id_fk FROM interactions ORDER BY interactions_id ASC LIMIT 1;");

            if ($interactionQuery) {
                if ($interactionQuery->rowCount() == 1) {
                    $row = $interactionQuery->fetch();

                    $interactionModel = new InteractionModel();
                    $interactionModel->setInteractionId($row["interactions_id"]);
                    $interactionModel->setInteractionContent($row["interactions_content"]);
                    $interactionModel->setContextModel(new ContextModel($row["contexts_id_fk"]));

                    return $interactionModel;
                }
            }

            return NULL;
        }

        public function getAllInteractions() {
            global $pdo;   
        }

        public function countAllInteractions() {
            global $pdo;

            $interactionQuery = $pdo->query("SELECT COUNT(interactions_id) AS interactions_count FROM interactions;");
            
            return $interactionQuery ? $interactionQuery->fetch()["interactions_count"] : 0;
        }
    }
?>