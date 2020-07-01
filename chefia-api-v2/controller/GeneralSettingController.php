<?php
    require_once dirname(__FILE__) . "/../model/GeneralSettingModel.php";
    require_once dirname(__FILE__) . "/../model/dao/GeneralSettingDAO.php";

    class GeneralSettingController {
        public function createGeneralSetting($generalSettingKey, $generalSettingValue) {
            if (is_null($generalSettingKey) || empty($generalSettingKey))
                throw new Exception("O campo chave da configuração é obrigatório.");

            if (is_null($generalSettingValue))
                throw new Exception("O campo valor da configuração é obrigatório.");

            $generalSettingModel = new GeneralSettingModel();
            $generalSettingDAO = new GeneralSettingDAO();

            $generalSettingModel->setGeneralSettingKey(strtolower($generalSettingValue));
            $generalSettingModel->setGeneralSettingValue($generalSettingValue);

            if ($generalSettingDAO->createGeneralSetting($generalSettingModel))
                return "Par chave/valor de configuração criado com sucesso.";
            else
                throw new Exception("Não foi possível criar o par chave/valor de configuração;");
        }

        public function editGeneralSetting($generalSettingKey, $generalSettingValue) {
            if (is_null($generalSettingKey) || empty($generalSettingKey))
                throw new Exception("O campo chave da configuração é obrigatório.");

            if (is_null($generalSettingValue))
                throw new Exception("O campo valor da configuração é obrigatório.");

            $generalSettingModel = new GeneralSettingModel();
            $generalSettingDAO = new GeneralSettingDAO();

            $generalSettingModel->setGeneralSettingKey(strtolower($generalSettingValue));
            $generalSettingModel->setGeneralSettingValue($generalSettingValue);

            if ($generalSettingDAO->editGeneralSetting($generalSettingModel))
                return "Valor da configuração editado com sucesso.";
            else
                throw new Exception("Não foi possível editar o valor da configuração.");
        }

        public function removeGeneralSetting($generalSettingKey) {
            if (is_null($generalSettingKey) || empty($generalSettingKey))
                throw new Exception("O campo chave da configuração é obrigatório.");

            $generalSettingModel = new GeneralSettingModel($generalSettingKey);
            $generalSettingDAO = new GeneralSettingDAO();

            if ($generalSettingDAO->removeGeneralSetting($generalSettingModel))
                return "Par chave/valor de configuração removido com sucesso.";
            else
                throw new Exception("Não foi possível remover o par chave/valor da configuração.");
        }

        public function getGeneralSettingByKey($generalSettingKey) {
            if (is_null($generalSettingKey) || empty($generalSettingKey))
                throw new Exception("O campo chave da configuração é obrigatório.");

            $generalSettingModel = new GeneralSettingModel($generalSettingKey);
            $generalSettingDAO = new GeneralSettingDAO();
            if (!is_null($generalSettingModel = $generalSettingDAO->getGeneralSettingByKey($generalSettingModel)))
                return $generalSettingModel;
            else
                throw new Exception("Este par/chave de configuração não existe.");
        }

        public function getAllGeneralSettings() {
            $generalSettingDAO = new GeneralSettingDAO();
            if (!empty($generalSettingsArray = $generalSettingDAO->getAllGeneralSettings()))
                return $generalSettingsArray;
            else
                throw new Exception("Não há nenhuma configuração.");
        }

        public function getAllGeneralSettingsKeys() {
            $generalSettingDAO = new GeneralSettingDAO();
            if (!empty($generalSettingsArray = $generalSettingDAO->getAllGeneralSettingsKeys()))
                return $generalSettingsArray;
            else
                throw new Exception("Não há nenhuma configuração.");
        }

        public function getAllClientGeneralSettings() {
            $generalSettings = $this->getAllGeneralSettings();
            $clientSettings = array("franchise_image");
            $returnArray = array();

            foreach ($generalSettings as $setting)
                if (in_array($setting->getGeneralSettingKey(), $clientSettings))
                    array_push($returnArray, $setting);
            
            return $returnArray;
        }

        public function checkExistentKey($generalSettingModel) {
            if (is_null($generalSettingModel->getGeneralSettingKey()) || empty($generalSettingModel->getGeneralSettingKey()))
                throw new Exception("O campo chave da configuração é obrigatório.");
            
            $generalSettingDAO = new GeneralSettingDAO();
            return $generalSettingDAO->checkExistentKey($generalSettingModel);
        }

        public function replaceSettings($content) {
            $generalSettings = $this->getAllGeneralSettings();
            $replaceableSettings = array("franchise_name");

            foreach ($generalSettings as $setting)
                if (in_array($setting->getGeneralSettingKey(), $replaceableSettings))
                    $content = str_replace("__" . strtoupper($setting->getGeneralSettingKey()) . "__", $setting->getGeneralSettingValue(), $content);

            return $content;
        }
    }
?>