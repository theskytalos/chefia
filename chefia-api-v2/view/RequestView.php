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
                    $requestResponse = $requestController->createRequest($requestBody["requestPayMethod"], $requestBody["requestChangeFor"], $requestBody["requestCEP"], $requestBody["requestUF"], $requestBody["requestCity"], $requestBody["requestNeighbourhood"], $requestBody["requestStreet"], $requestBody["requestNumber"], $requestBody["requestComplement"], $requestBody["requestReference"], $requestBody["requestItems"]);
                    response(["success" => true, "content" => $requestResponse[0]], ["requestId" => $requestResponse[1]]);
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
            case "getRequestStatus":
                if (!checkNotNull($requestBody, ["requestId"]))
                    response(["success" => false, "content" => "URL inválida."]);

                $requestController = new RequestController();

                try {
                    response(["success" => true, "content" => $requestController->getRequestStatus($requestBody["requestId"])]);
                } catch (Exception $e) {
                    response(["success" => false, "content" => $e->getMessage()]);
                } finally {
                    response(["success" => false, "content" => "Um erro inesperado aconteceu."]);
                }
                break;
            case "setRequestStatus":
                if (!checkNotNull($requestBody, ["requestId", "requestStatus"]))
                    response(["success" => false, "content" => "URL inválida."]);

                $requestController = new RequestController();

                try {
                    response(["success" => true, "content" => $requestController->setRequestStatus($requestBody["requestId"], $requestBody["requestStatus"])]);
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