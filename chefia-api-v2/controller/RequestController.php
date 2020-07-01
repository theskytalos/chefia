<?php
    require_once dirname(__FILE__) . "/../model/RequestModel.php";
    require_once dirname(__FILE__) . "/../model/ItemModel.php";
    require_once dirname(__FILE__) . "/../model/dao/RequestDAO.php";
    require_once dirname(__FILE__) . "/../controller/ItemController.php";

    class RequestController {
        public function createRequest($requestPayMethod, $requestChangeFor, $requestCEP, $requestUF, $requestCity, $requestNeighbourhood, $requestStreet, $requestNumber, $requestComplement, $requestReference, $requestItems) {
            if (is_null($requestPayMethod))
                throw new Exception("O método de pagamento não pode ser nulo.");

            if (!is_numeric($requestPayMethod))
                throw new Exception("Método de pagamento inválido.");

            if ((int)$requestPayMethod < 0)
                throw new Exception("Método de pagamento inválido.");

            if ((int)$requestPayMethod == 2 && (double)$requestChangeFor != 0.0)
                $requestChangeFor = 0.0;

            if ((int)$requestPayMethod == 1 && (double)$requestChangeFor == 0.0)
                throw new Exception("'Troco para' inválido.");
                
            if (is_null($requestCEP))
                throw new Exception("CEP do pedido não pode ser nulo.");

            if (preg_match("/(^[0-9]{5}-[0-9]{3}$)|(^[0-9]{8}$)/", $requestCEP) == 0)
                throw new Exception("Formato de CEP inválido.");

            if (is_null($requestUF))
                throw new Exception("A Unidade Federativa do Pedido não pode ser nula.");
                
            $UFsArray = array("AC", "AL", "AP", "AM", "BA", "CE", "DF", "ES", "GO", "MA", "MT", "MS", "MG", "PA", "PB", "PR", "PE", "PI", "RJ", "RN", "RS", "RO", "RR", "SC", "SP", "SE", "TO");

            if (!in_array(strtoupper($requestUF), $UFsArray))
                throw new Exception("Unidade Federativa inválida.");

            if (is_null($requestCity) || empty($requestCity))
                throw new Exception("A cidade do pedido é obrigatória.");

            if (is_null($requestNeighbourhood) || empty($requestNeighbourhood))
                throw new Exception("O bairro do pedido é obrigatório.");

            if (is_null($requestStreet) || empty($requestStreet))
                throw new Exception("A rua do pedido é obrigatória.");

            if (is_null($requestNumber) || empty($requestNumber))
                throw new Exception("O número da casa do pedido é obrigatório.");

            if (!is_numeric($requestNumber))
                throw new Exception("O número da casa deve ser UM NÚMERO!");

            $itemController = new ItemController();
            $requestTotalCost = 0.0;
            $requestItemsArray = array();
            foreach($requestItems as $item) {
                if (!isset($item->item->itemId))
                    throw new Exception("URL inválida.");

                if (is_null($item->item->itemId))
                    throw new Exception("O Id do item não pode ser nulo.");

                if (!is_numeric($item->item->itemId))
                    throw new Exception("Id de item inválido.");
                
                if ((int)$item->item->itemId < 1)
                    throw new Exception("Id de item inválido");

                $itemModel = $itemController->getItem((int)$item->item->itemId);

                if (is_null($itemModel))
                    throw new Exception("O item " . $item->item->itemName . " não existe.");

                if (is_null($item->quantity))
                    throw new Exception("A quantidade do item não pode ser nula.");

                if (!is_numeric($item->quantity))
                    throw new Exception("A quantidade do item deve ser numérica.");

                if ((int)$item->quantity < 0)
                    throw new Exception("A quantidade do item não pode ser negativa.");

                if (is_null($item->observations))
                    throw new Exception("As observações do item não pode ser nula.");

                $requestTotalCost += (int)$item->quantity * (double)$itemModel->getItemPrice();

                $itemModel->setItemQuantity($item->quantity);
                $itemModel->setItemNote($item->observations);

                array_push($requestItemsArray, $itemModel);
            }

            if ((int)$requestPayMethod == 1 && (double)$requestChangeFor == 0.0 && $requestTotalCost > $requestChangeFor)
                throw new Exception("O custo total não pode ser maior que o 'troco para'.");

            $requestModel = new RequestModel();
            $requestModel->setRequestDatetime(date("Y-m-d H:i:s"));
            $requestModel->setRequestTotalCost($requestTotalCost);
            $requestModel->setRequestPayMethod($requestPayMethod);
            $requestModel->setRequestChangeFor((double)$requestChangeFor);
            $requestModel->setRequestCEP($requestCEP);
            $requestModel->setRequestUF($requestUF);
            $requestModel->setRequestCity($requestCity);
            $requestModel->setRequestNeighbourhood($requestCity);
            $requestModel->setRequestStreet($requestStreet);
            $requestModel->setRequestNumber($requestNumber);
            $requestModel->setRequestComplement($requestComplement);
            $requestModel->setRequestReference($requestReference);
            $requestModel->setRequestItems($requestItemsArray);

            $requestDAO = new RequestDAO();
            if ($requestDAO->createRequest($requestModel))
                return "Pedido realizado com sucesso.";
            else
                throw new Exception("Não foi possível realizar o pedido.");
        }

        public function editRequest() {
            
        }

        public function removeRequest($requestId) {
            
        }

        public function getRequest($requestId) {
            
        }

        public function getTodaysRequests() {
            $requestDAO = new RequestDAO();

            $requestsArray = $requestDAO->getTodaysRequests();

            $itemController = new ItemController();
            foreach ($requestsArray as &$request) {
                $itemsArray = array();
                foreach ($request->getRequestItems() as $item) {
                    if (!is_null($itemModel = $itemController->getItem($item->getItemId()))) {
                        $itemModel->setItemQuantity($item->getItemQuantity());
                        $itemModel->setItemNote($item->getItemNote());
                        array_push($itemsArray, $itemModel);
                    }   
                }
                $request->setRequestItems($itemsArray);
            }

            return $requestsArray;
        }

        public function getAllRequests() {
            
        }
    }
?>