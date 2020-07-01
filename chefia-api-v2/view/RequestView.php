<?php
    require_once dirname(__FILE__) . "/../controller/RequestController.php";
    require_once dirname(__FILE__) . "/../Rest.php";

    if (isset($requestBody["apiRequest"]) && !empty($requestBody["apiRequest"])) {
        switch ($requestBody["apiRequest"]) {
            case "create":
                if (!checkNotNull($requestBody, ["requestPayMethod", "requestChangeFor", "requestCEP", "requestUF", "requestCity", "requestNeighbourhood", "requestStreet", "requestNumber", "requestComplement", "requestReference", "requestItems"]))
                    response(["success" => false, "content" => "URL inválida."]);

                $requestController = new RequestController();

                try {
                    response(["success" => true, "content" => $requestController->createRequest($requestBody["requestPayMethod"], $requestBody["requestChangeFor"], $requestBody["requestCEP"], $requestBody["requestUF"], $requestBody["requestCity"], $requestBody["requestNeighbourhood"], $requestBody["requestStreet"], $requestBody["requestNumber"], $requestBody["requestComplement"], $requestBody["requestReference"], $requestBody["requestItems"])]);
                } catch (Exception $e) {
                    response(["success" => false, "content" => $e->getMessage()]);
                } finally {
                    response(["success" => false, "content" => "Um erro inesperado aconteceu."]);
                }

                break;
            case "getTodaysRequests":
                $requestController = new RequestController();

                try {
                    response(["success" => true, "content" => $requestController->getTodaysRequests()]);
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