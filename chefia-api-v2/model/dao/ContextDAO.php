<?php
    require_once dirname(__FILE__) . "/../../Connection.php";
    require_once dirname(__FILE__) . "/../ContextModel.php";

    class ContextDAO {
        public function createContext($contextModel) {
            global $pdo;
        }

        public function editContext($contextModel) {
            global $pdo;
        }

        public function removeContext($contextModel) {
            global $pdo;
        }

        public function getContext($contextModel) {
            global $pdo;

            $contextQuery = $pdo->prepare("SELECT contexts_name FROM contexts WHERE contexts_id = :contexts_id;");
            $contextQuery->bindParam(":contexts_id", $contextModel->getContextId(), PDO::PARAM_INT);

            if ($contextQuery->execute()) {
                if ($contextQuery->rowCount() == 1) {
                    $row = $contextQuery->fetch();

                    $contextModel->setContextName($row["contexts_name"]);

                    return $contextModel;
                }
            }
      
            return NULL;
        }
    }
?>