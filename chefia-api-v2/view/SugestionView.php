<?php
    require_once dirname(__FILE__) . "/../controller/SugestionController.php";
    require_once dirname(__FILE__) . "/../Rest.php";

    if (isset($requestBody["apiRequest"]) && !empty($requestBody["apiRequest"])) {
        switch ($requestBody["apiRequest"]) {
            case "create":
                if (!checkNotNull($requestBody, ["sugestionText"]))
                    response(["success" => false, "content" => "URL inválida."]);

                $sugestionController = new SugestionController();

                try {
                    response(["success" => true, "content" => $sugestionController->createSugestion($requestBody["sugestionText"])]);
                } catch (Exception $e) {
                    response(["success" => false, "content" => $e->getMessage()]);
                } finally {
                    response(["success" => false, "content" => "Um erro inesperado aconteceu."]);
                }

                break;
            case "remove":
                if (!checkNotNull($requestBody, ["sugestionId"]))
                    response(["success" => false, "content" => "URL inválida."]);

                $sugestionController = new SugestionController();

                try {
                    response(["success" => true, "content" => $sugestionController->removeSugestion($requestBody["sugestionId"])]);
                } catch (Exception $e) {
                    response(["success" => false, "content" => $e->getMessage()]);
                } finally {
                    response(["success" => false, "content" => "Um erro inesperado aconteceu."]);
                }

                break;
            case "getAll":
                $sugestionController = new SugestionController();

                try {
                    response(["success" => true, "content" => $sugestionController->getAllSugestions()]);
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