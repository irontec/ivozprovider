<?php

use IvozProvider\Service\RestClient;
use Ivoz\Provider\Domain\Service\BillableCall\CsvExporter;
use Ivoz\Provider\Domain\Model\WebPortal\WebPortal;
use Ivoz\Provider\Domain\Model\Administrator\Administrator;

class KlearCustomBillableCallsController extends Zend_Controller_Action
{
    const PLATFORM_ENDPOINT = 'platform';
    const BRAND_ENDPOINT = 'brand';
    const CLIENT_ENDPOINT = 'client';

    protected $_mainRouter;

    public function init()
    {
        if ((!$this->_mainRouter = $this->getRequest()->getUserParam("mainRouter")) || (!is_object($this->_mainRouter))) {
            throw new Zend_Exception('', Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION);
        }

        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
    }

    public function exportToCsvAction()
    {
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            throw new Klear_Exception_Default("Session expired");
        }
        $user = $auth->getIdentity();

        $config = $this->_mainRouter->getCurrentItem()->getConfig();

        $criteria = $config->getProperty("forcedValues");
        $criteria = $criteria
            ? $criteria->toArray()
            : [];

        $criteria['_properties'] = CsvExporter::BRAND_PROPERTIES;
        $criteria['_timezone'] = date_default_timezone_get();
        $criteria['_order[startTime]'] = 'DESC';

        $requestFile = $this->_request->getParam('file');
        $endpoint = self::PLATFORM_ENDPOINT;

        switch ($requestFile) {
            case 'BillableCallsList':
                $criteria['_properties'][] = 'brand';
                $criteria['_properties'][] = 'company';
                break;
            case 'BillableCallsBrandList':
                $criteria['_properties'][] = 'company';
                $endpoint = self::BRAND_ENDPOINT;
                break;
            case 'InvoicesList':
                $invoiceId = $this->_request->getParam('parentId');
                $criteria['invoice'] = $invoiceId;
                $endpoint = self::BRAND_ENDPOINT;
                break;
            case 'CarriersList':
                $carrierId = $this->_request->getParam('parentId');
                $criteria['carrier'] = $carrierId;
                $endpoint = self::BRAND_ENDPOINT;
                break;
            default:
                $criteria['_properties'] = CsvExporter::CLIENT_PROPERTIES;
                $endpoint = self::CLIENT_ENDPOINT;
        }

        $requestParams = $this->_request->getParam('post', null);
        $where = [];

        if (isset($requestParams) && array_key_exists('searchFields', $requestParams)) {
            foreach ($requestParams['searchFields'] as $field => $values) {
                foreach ($values as $key => $value) {
                    $value = urldecode($value);
                    switch ($requestParams['searchOps'][$field][$key]) {
                        case 'eq':
                            $where[$field] = $value;
                            break;
                        case 'lt':
                            $argument = $field . '[lt]';
                            $where[$argument] = $value;
                            $argument = $field . '[strictly_before]';
                            $where[$argument] = $value;
                            break;
                        case 'gt':
                            $argument = $field . '[gt]';
                            $where[$argument] = $value;
                            $argument = $field . '[strictly_after]';
                            $where[$argument] = $value;
                            break;
                        case 'exact':
                            $argument = $field . '[exact]';
                            $where[$argument] = $value;
                            break;
                        case 'startsWith':
                            $argument = $field . '[start]';
                            $where[$argument] = $value;
                            break;
                        case 'contains':
                            $argument = $field . '[partial]';
                            $where[$argument] = $value;
                            break;
                        case 'endsWith':
                            $argument = $field . '[end]';
                            $where[$argument] = $value;
                            break;
                        case 'exists':
                            $argument = $field . '[exists]';
                            $where[$argument] = $value;
                            break;
                    }
                }
            }
        }
        $criteria += $where;

        if ($user->isTokenExpired()) {
            $this->renewToken(
                $user,
                $user->brandId
            );
        }

        if ($user->isMainOperator && $endpoint === self::BRAND_ENDPOINT
        ) {
            $brandId = $user->brandId;

            /** @var RestClient $apiClient */
            $apiClient = $this->getBrandAdminClient(
                $brandId,
                $user
            );
        } elseif ($user->isMainOperator && $endpoint === self::CLIENT_ENDPOINT
        ) {
            $brandId = $user->brandId;
            $companyId = $user->companyId;

            /** @var RestClient $apiClient */
            $brandClient = $this->getBrandAdminClient(
                $brandId,
                $user
            );

            $apiClient = $this->getAdminApiClient(
                $companyId,
                $brandId,
                $brandClient->getToken()
            );
        } elseif ($user->isBrandOperator && $endpoint === self::CLIENT_ENDPOINT
        ) {
            $brandId = $user->brandId;
            $companyId = $user->companyId;

            $apiClient = $this->getAdminApiClient(
                $companyId,
                $brandId,
                $user->token
            );
        } else {
            $apiClient = new RestClient(
                $user->token,
                $user->refreshToken
            );
        }

        $billableCalls = $apiClient->getBillableCalls($criteria, $endpoint);
        $response = $this->getResponse();
        $response->clearHeaders();
        $response->setHeader('Content-Length', mb_strlen($billableCalls));
        $response->setHeader('Content-Type', 'text/csv');
        $response->setHeader('Content-disposition', 'attachment; filename=calls.csv');

        $response->sendHeaders();
        $response->clearHeaders();

        echo $billableCalls;
    }


    private function renewToken($user, $brandId)
    {
        $dataGateway = Zend_Registry::get('data_gateway');

        $portal = null;
        $api = 'platform';

        if ($user->isBrandOperator) {
            /** @var \Ivoz\Provider\Domain\Model\WebPortal\WebPortalDto $brandWebPortal */
            $brandWebPortal = $dataGateway->findOneBy(
                WebPortal::class,
                [
                    'WebPortal.brand = :brandId AND WebPortal.urlType = :urlType',
                    [
                        ':brandId' => $brandId,
                        ':urlType' => 'brand'
                    ]
                ]
            );

            $portal = $brandWebPortal->getUrl();
            $api = 'brand';
        } elseif ($user->isCompanyAdmin) {

            /** @var \Ivoz\Provider\Domain\Model\WebPortal\WebPortalDto $clientWebPortal */
            $clientWebPortal = $dataGateway->findOneBy(
                WebPortal::class,
                [
                    'WebPortal.brand = :brandId AND WebPortal.urlType = :urlType',
                    [
                        ':brandId' => $brandId,
                        ':urlType' => 'admin'
                    ]
                ]
            );

            $portal = $clientWebPortal->getUrl();
            $api = 'client';
        }

        $user->token = RestClient::getRefreshedToken(
            $user->refreshToken,
            $portal,
            $api
        );

        return;
    }

    /**
     * @param $dataGateway
     * @param $company
     * @param $user
     * @return mixed
     */
    private function getBrandAdminClient($brandId, $user): RestClient
    {
        $dataGateway = Zend_Registry::get('data_gateway');

        /** @var \Ivoz\Provider\Domain\Model\Administrator\AdministratorDto $brandAdmin */
        $brandAdmin = $dataGateway->findOneBy(
            Administrator::class,
            [
                'Administrator.brand = :brandId AND Administrator.active = 1 AND Administrator.company IS NULL',
                [':brandId' => $brandId]
            ]
        );

        if (!$brandAdmin) {
            throw new \DomainException(
                'Unable to find a suitable brand admin'
            );
        }

        /** @var \Ivoz\Provider\Domain\Model\WebPortal\WebPortalDto $brandWebPortal */
        $brandWebPortal = $dataGateway->findOneBy(
            WebPortal::class,
            [
                'WebPortal.brand = :brandId AND WebPortal.urlType = :urlType',
                [
                    ':brandId' => $brandId,
                    ':urlType' => 'brand'
                ]
            ]
        );

        $adminToken = RestClient::exchangeAdminToken(
            $user->token,
            $brandAdmin->getUsername(),
            'brand',
            $brandWebPortal->getUrl()
        );

        if (isset($adminToken->token)) {
            RestClient::setBaseUrl(
                $brandWebPortal->getUrl()
            );
        }

        $apiClient = new RestClient(
            $adminToken->token,
            ''
        );

        return $apiClient;
    }

    private function getAdminApiClient($companyId, $brandId, string $brandAdminToken): RestClient
    {
        $dataGateway = Zend_Registry::get('data_gateway');

        /** @var \Ivoz\Provider\Domain\Model\Administrator\AdministratorDto $clientAdmin */
        $clientAdmin = $dataGateway->findOneBy(
            Administrator::class,
            [
                'Administrator.company = :companyId AND Administrator.active = 1',
                [':companyId' => $companyId]
            ]
        );

        if (!$clientAdmin) {
            throw new \DomainException(
                'Unable to find a suitable client admin',
                403
            );
        }

        /** @var \Ivoz\Provider\Domain\Model\WebPortal\WebPortalDto $clientWebPortal */
        $clientWebPortal = $dataGateway->findOneBy(
            WebPortal::class,
            [
                'WebPortal.brand = :brandId AND WebPortal.urlType = :urlType',
                [
                    ':brandId' => $brandId,
                    ':urlType' => 'admin'
                ]
            ]
        );

        $clientToken = RestClient::exchangeAdminToken(
            $brandAdminToken,
            $clientAdmin->getUsername(),
            'client',
            $clientWebPortal->getUrl()
        );

        if (isset($clientToken->token)) {
            RestClient::setBaseUrl(
                $clientWebPortal->getUrl()
            );
        }

        $apiClient = new RestClient(
            $clientToken->token,
            ''
        );

        return $apiClient;
    }
}
