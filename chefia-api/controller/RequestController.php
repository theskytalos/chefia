<?php
    require_once dirname(__FILE__) . "/../model/RequestModel.php";
    require_once dirname(__FILE__) . "/../model/dao/RequestDAO.php";

    class RequestController {
        public function createRequest($requestModel) {
            if (is_null($requestModel->getRequestDateTime()) || empty($requestModel->getRequestDateTime())) {

            }

            if (is_null($requestModel->getRequestTotalCost()) || empty($requestModel->getRequestTotalCost())) {

            }

            if (is_null($requestModel->getRequestPayMethod()) || empty($requestModel->getRequestPayMethod())) {

            }

            if (is_null($requestModel->getRequestItemsArray()) || empty($requestModel->getRequestItemsArray())) {

            }

            if (count($requestModel->getRequestItemsArray()) == 0) {

            }

            $requestDAO = new RequestDAO();
            return $requestDAO->createRequest($requestModel);
        }

        public function editRequest($requestModel) {
            if (is_null($requestModel->getRequestId()) || empty($requestModel->getRequestId())) {

            }

            if (!is_numeric($requestModel->getRequestId())) {

            }

            if (is_null($requestModel->getRequestDateTime()) || empty($requestModel->getRequestDateTime())) {

            }

            if (is_null($requestModel->getRequestTotalCost()) || empty($requestModel->getRequestTotalCost())) {

            }

            if (is_null($requestModel->getRequestPayMethod()) || empty($requestModel->getRequestPayMethod())) {

            }

            if (is_null($requestModel->getRequestItemsArray()) || empty($requestModel->getRequestItemsArray())) {

            }

            if (count($requestModel->getRequestItemsArray()) == 0) {
                
            }

            $requestDAO = new RequestDAO();
            return $requestDAO->editRequest($requestModel);
        }

        public function removeRequest($requestModel) {
            if (is_null($requestModel->getRequestId()) || empty($requestModel->getRequestId())) {

            }

            if (!is_numeric($requestModel->getRequestId())) {
                
            }

            $requestDAO = new RequestDAO();
            return $requestDAO->removeRequest($requestModel);
        }

        public function getRequestById($requestModel) {
            if (is_null($requestModel->getRequestId()) || empty($requestModel->getRequestId())) {

            }

            if (!is_numeric($requestModel->getRequestId())) {
                
            }

            $requestDAO = new RequestDAO();
            return $requestDAO->getRequestById($requestModel);
        }

        public function getRequestsByDate($requestModel) {
            if (is_null($requestModel->getRequestDateTime()) || empty($requestModel->getRequestDateTime())) {

            }

            // TODO: Checar se a data é valida

            $requestDAO = new RequestDAO();
            return $requestDAO->getRequestsByDate($requestModel);
        }

        public function getAllRequests() {
            $requestDAO = new RequestDAO();
            return $requestDAO->getAllRequests();
        }
    }
?>