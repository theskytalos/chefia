<?php
    require_once dirname(__FILE__) . "/../controller/GeneralSettingController.php";
    require_once dirname(__FILE__) . "/../Rest.php";

    if (isset($requestBody["apiRequest"]) && !empty($requestBody["apiRequest"])) {
        switch ($requestBody["apiRequest"]) {
            case "create":
                break;
            case "edit":
                break;
            case "remove":
                break;
            case "get":
                break;
            case "getAllClientSettings":
                $generalSettingController = new GeneralSettingController();

                try {
                    response(["success" => true, "content" => $generalSettingController->getAllClientGeneralSettings()]);
                } catch (Exception $e) {
                    response(["success" => false, "content" => $e->getMessage()]);
                } finally {
                    response(["success" => false, "content" => "Um erro inesperado aconteceu."]);
                }
                break;
            default:
                response(["success" => false, "content" => "Comando de API desconhecido."]);
        }
    } else
        response(["success" => false, "content" => "URL inválida."]);
?>