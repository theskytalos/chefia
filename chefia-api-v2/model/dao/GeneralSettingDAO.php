<?php
    require_once dirname(__FILE__) . "/../../Connection.php";
    require_once dirname(__FILE__) . "/../GeneralSettingModel.php";

    class GeneralSettingDAO {
        public function createGeneralSetting($generalSettingModel) {
            global $pdo;

            $generalSettingQuery = $pdo->prepare("INSERT INTO general_settings (general_settings_key, general_settings_value) VALUES (:general_settings_key, :general_settings_value);");
            $generalSettingQuery->bindValue(":general_settings_key", $generalSettingModel->getGeneralSettingKey(), PDO::PARAM_STR);
            $generalSettingQuery->bindValue(":general_settings_value", $generalSettingModel->getGeneralSettingValue(), PDO::PARAM_STR);

            if ($generalSettingQuery->execute())
                return true;
            
            return false;
        }

        public function editGeneralSetting($generalSettingModel) {
            global $pdo;

            $generalSettingQuery = $pdo->prepare("UPDATE general_settings SET general_settings_value = :general_settings_value WHERE general_settings_key = :general_settings_key;");
            $generalSettingQuery->bindValue(":general_settings_key", $generalSettingModel->getGeneralSettingKey(), PDO::PARAM_STR);
            $generalSettingQuery->bindValue(":general_settings_value", $generalSettingModel->getGeneralSettingValue(), PDO::PARAM_STR);

            if ($generalSettingQuery->execute())
                return true;

            return false;
        }

        public function removeGeneralSetting($generalSettingModel) {
            global $pdo;

            $generalSettingQuery = $pdo->prepare("DELETE FROM general_settings WHERE general_settings_key = :general_settings_key;");
            $generalSettingQuery->bindValue(":general_settings_key", $generalSettingModel->getGeneralSettingKey(), PDO::PARAM_STR);

            if ($generalSettingQuery->execute())
                return true;

            return false;
        }

        public function getGeneralSetting($generalSettingModel) {
            global $pdo;

            $generalSettingQuery = $pdo->prepare("SELECT general_settings_value FROM general_settings WHERE general_settings_key = :general_settings_key;");
            $generalSettingQuery->bindValue(":general_settings_key", $generalSettingModel->getGeneralSettingKey(), PDO::PARAM_STR);

            if ($generalSettingQuery->execute()) {
                if ($generalSettingQuery->rowCount() == 1) {
                    $row = $generalSettingQuery->fetch();

                    $generalSettingModel->setGeneralSettingValue($row["general_settings_value"]);

                    return $generalSettingModel;
                }
            }

            return NULL;
        }

        public function getAllGeneralSettings() {
            global $pdo;

            $generalSettingQuery = $pdo->query("SELECT general_settings_key, general_settings_value FROM general_settings;");

            $generalSettingsArray = array();

            if ($generalSettingQuery) {
                if ($generalSettingQuery->rowCount() > 0) {
                    while ($row = $generalSettingQuery->fetch()) {
                        $generalSettingModel = new GeneralSettingModel();

                        $generalSettingModel->setGeneralSettingKey($row["general_settings_key"]);
                        $generalSettingModel->setGeneralSettingValue($row["general_settings_value"]);

                        array_push($generalSettingsArray, $generalSettingModel);
                    }
                }
            }

            return $generalSettingsArray;
        }

        public function getAllGeneralSettingsKeys() {
            global $pdo;

            $generalSettingQuery = $pdo->query("SELECT general_settings_key FROM general_settings;");

            $generalSettingsArray = array();

            if ($generalSettingQuery)
                if ($generalSettingQuery->rowCount() > 0)
                    while ($row = $generalSettingQuery->fetch())
                        array_push($generalSettingsArray, $row["general_settings_key"]);

            return $generalSettingsArray;
        }

        // Checa se uma determinada chave de configuração geral já existe.
        public function checkExistentKey($generalSettingModel) {
            global $pdo;

            $generalSettingQuery = $pdo->prepare("SELECT general_settings_key FROM general_settings WHERE general_settings_key = :general_settings_key;");
            $generalSettingQuery->bindValue(":general_settings_key", $generalSettingModel->getGeneralSettingKey(), PDO::PARAM_STR);

            if ($generalSettingQuery->execute())
                if ($generalSettingQuery->rowCount() > 0)
                    return true;

            return false;
        }
    }
?>