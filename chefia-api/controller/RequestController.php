<?php
    require_once dirname(__FILE__) . "/../model/RequestModel.php";
    require_once dirname(__FILE__) . "/../model/dao/RequestDAO.php";

    class RequestController {
        public function createRequest($requestModel) {
            if (is_null($requestModel->getRequestDateTime()) || empty($requestModel->getRequestDateTime()))
		return ["status" => false, "message" => "A data é obrigatória."];

            if (is_null($requestModel->getRequestTotalCost()) || empty($requestModel->getRequestTotalCost()))
		return ["status" => false, "message" => "O campo total a pagar é obrigatório."];

            if (is_null($requestModel->getRequestPayMethod()) || empty($requestModel->getRequestPayMethod()))
		return ["status" => false, "message" => "O campo método de pagamento é obrigatório."];

            if (is_null($requestModel->getRequestItemsArray()) || empty($requestModel->getRequestItemsArray()))
		return ["status" => false, "message" => "O campo itens é obrigatório."];

            if (count($requestModel->getRequestItemsArray()) == 0)
		return ["status" => false, "message" => "Um pedido não pode ser feito com carrinho vazio."];

            $requestDAO = new RequestDAO();
            if ($requestDAO->createRequest($requestModel))
		return ["status" => true, "message" => "Pedido feito com sucesso."];
	    else
		return ["status" => false, "message" => "Não foi possível realizar o pedido."];
        }

        public function editRequest($requestModel) {
            if (is_null($requestModel->getRequestId()) || empty($requestModel->getRequestId()))
		return ["status" => false, "message" => "O Id do pedido é obrigatório."];

            if (!is_numeric($requestModel->getRequestId()))
		return ["status" => false, "message" => "O Id do pedido deve ser numérico."];

            if (is_null($requestModel->getRequestDateTime()) || empty($requestModel->getRequestDateTime()))
		return ["status" => false, "message" => "A data é obrigatória."];

            if (is_null($requestModel->getRequestTotalCost()) || empty($requestModel->getRequestTotalCost()))
		return ["status" => false, "message" => "O campo total a pagar é obrigatório."];

            if (is_null($requestModel->getRequestPayMethod()) || empty($requestModel->getRequestPayMethod()))
		return ["status" => false, "message" => "O campo método de pagamento é obrigatório."];

            if (is_null($requestModel->getRequestItemsArray()) || empty($requestModel->getRequestItemsArray()))
		return ["status" => false, "message" => "O campo itens é obrigatório."];

            if (count($requestModel->getRequestItemsArray()) == 0)
                return ["status" => false, "message" => "Um pedido não pode ser feito com carrinho vazio."];

            $requestDAO = new RequestDAO();
            if ($requestDAO->editRequest($requestModel))
		return ["status" => true, "message" => "Pedido editado com sucesso."];
	    else
		return ["status" => false, "message" => "Não foi possível editar o pedido."];
        }

        public function removeRequest($requestModel) {
            if (is_null($requestModel->getRequestId()) || empty($requestModel->getRequestId()))
		return ["status" => false, "message" => "O Id do pedido é obrigatório."];

            if (!is_numeric($requestModel->getRequestId()))
 		return ["status" => false, "message" => "O Id do pedido deve ser numérico."];

	    // Verificar dependências

            $requestDAO = new RequestDAO();
            if ($requestDAO->removeRequest($requestModel))
		return ["status" => true, "message" => "Pedido removido com sucesso."];
	    else
		return ["status" => false, "message" => "Não foi possível remover o pedido."];
        }

        public function getRequestById($requestModel) {
            if (is_null($requestModel->getRequestId()) || empty($requestModel->getRequestId()))
		return ["status" => false, "message" => "O Id do pedido é obrigatório."];

            if (!is_numeric($requestModel->getRequestId()))
           	return ["status" => false, "message" => "O Id do pedido deve ser numérico."];

            $requestDAO = new RequestDAO();
            if (!is_null($requestModel = $requestDAO->getRequestById($requestModel)))
		return ["status" => true, "message" => $requestModel];
	    else
		return ["status" => false, "message" => "O Pedido não existe."];
        }

        public function getRequestsByDate($requestModel) {
            if (is_null($requestModel->getRequestDateTime()) || empty($requestModel->getRequestDateTime()))
		return ["status" => false, "message" => "A data do pedido é obrigatória."];

            // TODO: Checar se a data é valida

            $requestDAO = new RequestDAO();
            if (!empty($requestsArray = $requestDAO->getRequestsByDate($requestModel)))
		return ["status" => true, "message" => $requestsArray];
	    else
		return ["status" => false, "message" => "Não há pedidos para esta data."];
        }

        public function getAllRequests() {
            $requestDAO = new RequestDAO();
            if (!empty($requestsArray = $requestDAO->getAllRequests()))
		return ["status" => true, "message" => $requestsArray];
	    else
		return ["status" => false, "message" => "Não há pedidos."];
        }
    }
?>
