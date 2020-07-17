<?php
    require_once dirname(__FILE__) . "/../../Connection.php";
    require_once dirname(__FILE__) . "/../SugestionModel.php";

    class SugestionDAO {
        public function createSugestion($sugestionModel) {
            global $pdo;

            $sugestionQuery = $pdo->prepare("INSERT INTO sugestions (sugestions_text) VALUES (:sugestions_datetime, :sugestions_text);");
            $sugestionQuery->bindValue(":sugestions_datetime", $sugestionModel->getSugestionDatetime(), PDO::PARAM_STR);
            $sugestionQuery->bindValue(":sugestions_text", $sugestionModel->getSugestionText(), PDO::PARAM_STR);

            return $sugestionQuery->execute();
        }

        public function removeSugestion($sugestionModel) {
            global $pdo;

            $sugestionQuery = $pdo->prepare("DELETE FROM sugestions WHERE sugestions_id = :sugestions_id;");
            $sugestionQuery->bindValue(":sugestions_id", $sugestionModel->getSugestionId(), PDO::PARAM_INT);

            return $sugestionQuery->execute();
        }

        public function getAllSugestions() {
            global $pdo;

            $sugestionQuery = $pdo->query("SELECT sugestions_id, sugestions_datetime, sugestions_text FROM sugestions ORDER BY requests_datetime DESC;");

            $sugestionsArray = array();

            if ($sugestionQuery) {
                if ($sugestionQuery->rowCount() > 0) {
                    while ($row = $sugestionQuery->fetch()) {
                        $sugestionModel = new SugestionModel();

                        $sugestionModel->setSugestionId($row["sugestions_id"]);
                        $sugestionModel->setSugestionDatetime($row["sugestions_datetime"]);
                        $sugestionModel->setSugestionText($row["sugestions_text"]);

                        array_push($sugestionsArray, $sugestionModel);
                    }
                }
            }

            return $sugestionsArray;
        }
    }
?>