<?php
    require_once dirname(__FILE__) . "/../model/GeneralSettingModel.php";
    require_once dirname(__FILE__) . "/../model/dao/GeneralSettingDAO.php";

    class GeneralSettingController {
        public function createGeneralSetting($generalSettingModel) {
            if (is_null($generalSettingModel->getGeneralSettingKey()) || empty($generalSettingModel->getGeneralSettingKey()))
                return ["status" => false, "message" => "O campo chave da configuração é obrigatório."];

            if (is_null($generalSettingModel->getGeneralSettingValue()))
                return ["status" => false, "message" => "O campo valor da configuração é obrigatório."];

            $generalSettingDAO = new GeneralSettingDAO();

            if ($generalSettingDAO->createGeneralSetting($generalSettingModel))
                return ["status" => true, "message" => "Par chave/valor de configuração criado com sucesso."];
            else
                return ["status" => false, "message" => "Não foi possível criar o par chave/valor de configuração;"];
        }

        public function editGeneralSetting($generalSettingModel) {
            if (is_null($generalSettingModel->getGeneralSettingKey()) || empty($generalSettingModel->getGeneralSettingKey()))
                return ["status" => false, "message" => "O campo chave da configuração é obrigatório."];

            if (is_null($generalSettingModel->getGeneralSettingValue()))
                return ["status" => false, "message" => "O campo valor da configuração é obrigatório."];

            $generalSettingDAO = new GeneralSettingDAO();
            if ($generalSettingDAO->editGeneralSetting($generalSettingModel))
                return ["status" => true, "message" => "Valor da configuração editado com sucesso."];
            else
                return ["status" => false, "message" => "Não foi possível editar o valor da configuração."];
        }

        public function removeGeneralSetting($generalSettingModel) {
            if (is_null($generalSettingModel->getGeneralSettingKey()) || empty($generalSettingModel->getGeneralSettingKey()))
                return ["status" => false, "message" => "O campo chave da configuração é obrigatório."];

            $generalSettingDAO = new GeneralSettingDAO();
            if ($generalSettingDAO->removeGeneralSetting($generalSettingModel))
                return ["status" => true, "message" => "Par chave/valor de configuração removido com sucesso."];
            else
                return ["status" => false, "message" => "Não foi possível remover o par chave/valor da configuração."];
        }

        public function getGeneralSettingByKey($generalSettingModel) {
            if (is_null($generalSettingModel->getGeneralSettingKey()) || empty($generalSettingModel->getGeneralSettingKey()))
                return ["status" => false, "message" => "O campo chave da configuração é obrigatório."];

            $generalSettingDAO = new GeneralSettingDAO();
            if (!is_null($generalSettingModel = $generalSettingDAO->getGeneralSettingByKey($generalSettingModel)))
                return ["status" => true, "message" => $generalSettingModel];
            else
                return ["status" => false, "message" => "Este par/chave de configuração não existe."];
        }

        public function getAllGeneralSettings() {
            $generalSettingDAO = new GeneralSettingDAO();
            if (empty($generalSettingsArray = $generalSettingDAO->getAllGeneralSettings()))
                return ["status" => true, "message" => $generalSettingsArray];
            else
                return ["stauts" => false, "message" => "Não há nenhuma configuração."];
        }

        public function checkExistentKey($generalSettingModel) {
            if (is_null($generalSettingModel->getGeneralSettingKey()) || empty($generalSettingModel->getGeneralSettingKey()))
                return ["status" => false, "message" => "O campo chave da configuração é obrigatório."];
            
            $generalSettingDAO = new GeneralSettingDAO();
            return $generalSettingDAO->checkExistentKey($generalSettingModel);
        }
    }
?>