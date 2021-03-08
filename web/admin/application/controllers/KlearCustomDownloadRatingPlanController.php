<?php

use IvozProvider\Service\RestClient;
use Ivoz\Provider\Domain\Model\RatingProfile\RatingProfile;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroup;
use Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileDto;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupDto;
use Ivoz\Provider\Domain\Model\Administrator\Administrator;
use Ivoz\Provider\Domain\Model\WebPortal\WebPortal;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;

class KlearCustomDownloadRatingPlanController extends Zend_Controller_Action
{
    protected $_mainRouter;

    public function init()
    {
        if ((!$this->_mainRouter = $this->getRequest()->getUserParam("mainRouter")) || (!is_object($this->_mainRouter))) {
            throw new Zend_Exception('', Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION);
        }

        $this->_helper
            ->ContextSwitch()
            ->addActionContext('export-to-csv-dialog', 'json')
            ->initContext('json');

        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
    }

    public function exportToCsvDialogAction()
    {
        parse_str(
            $_SERVER['QUERY_STRING'],
            $currentUrlParams
        );

        $targetUrlParams = array_merge(
            $currentUrlParams,
            [
                'type' => 'command',
                'command' => 'exportRatingPlansToCsv_command'
            ]
        );

        $targetUrl =
            $this->view->serverUrl()
            . $this->view->url()
            . '?'
            . http_build_query($targetUrlParams);

        $message =
            "<a data-href='"
            . $targetUrl
            ."'>"
            . $this->_helper->translate("This may take some minutes")
            . "</a>";

        $data = [
            "title" => $this->_helper->translate("Downloading"),
            'message'=> $message,
            "options" => ['width'=>'300px'],
            "buttons" => array(
                $this->_helper->translate("Close") => [
                    "recall" => false,
                    "reloadParent" => false
                ]
            )
        ];

        $jsonResponse = new Klear_Model_DispatchResponse();
        $jsonResponse->setModule('default');
        $jsonResponse->setPlugin('customRemoteFileDownloader');
        $jsonResponse->addJsFile("/../klearMatrix/js/plugins/jquery.klearmatrix.genericdialog.js");
        $jsonResponse->addJsFile("/js/customRemoteFileDownloader.js");
        $jsonResponse->setData($data);

        return $jsonResponse->attachView($this->view);
    }


    public function exportToCsvAction()
    {
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            throw new Klear_Exception_Default("Session expired");
        }

        $dataGateway = Zend_Registry::get('data_gateway');

        /** @var \Ivozprovider\klear\Auth\User $user */
        $user = $auth->getIdentity();

        /** @var RatingProfileDto $ratingProfileDto */
        $ratingProfileDto = $dataGateway->find(
            RatingProfile::class,
            $this->_request->getParam('pk')
        );

        if (!$ratingProfileDto) {
            throw new \DomainException(
                'Rating profile not found',
                404
            );
        }

        $company = $dataGateway->find(
            \Ivoz\Provider\Domain\Model\Company\Company::class,
            $ratingProfileDto->getCompanyId()
        );


        $response = $this->getResponse();
        $response->clearHeaders();

        try {
            if ($user->isTokenExpired()) {
                $this->renewToken(
                    $user,
                    $company
                );
            }

            if ($user->isMainOperator) {
                $adminToken = $this->getBrandAdminToken(
                    $company,
                    $user
                );

                $apiClient = $this->getAdminApiClient(
                    $company,
                    $adminToken->token
                );
            } elseif ($user->isBrandOperator) {
                $apiClient = $this->getAdminApiClient(
                    $company,
                    $user->token
                );
            } else {
                $apiClient = new RestClient(
                    $user->token,
                    $user->refreshToken
                );
            }

            /** @var RatingPlanGroupDto $ratingPlanGroupDto */
            $ratingPlanGroupDto = $dataGateway->find(
                RatingPlanGroup::class,
                $ratingProfileDto->getRatingPlanGroupId()
            );

            $now = new \DateTime();
            $fileName =
                $ratingPlanGroupDto->getNameEn()
                . '_'
                . $now->format('Ymd');

            $responseContent = $apiClient->getRatingPlanGroupPrices(
                $ratingPlanGroupDto->getId()
            );

            $response->setHeader('Content-Length', mb_strlen($response));
            $response->setHeader('Content-Type', 'text/csv');
            $response->setHeader('Content-disposition', 'attachment; filename='. $fileName .'.csv');
        } catch (\Exception $e) {
            $response->setHttpResponseCode(
                $e->getCode()
            );

            $responseContent = $e->getMessage();
        }

        $response->sendHeaders();
        $response->clearHeaders();

        echo $responseContent;
    }

    private function getAdminApiClient(CompanyDto $company, string $adminToken): RestClient
    {
        $dataGateway = Zend_Registry::get('data_gateway');

        $where = [
            'Administrator.company = :companyId',
            'Administrator.active = 1',
            'Administrator.restricted = 0'
        ];

        /** @var \Ivoz\Provider\Domain\Model\Administrator\AdministratorDto $clientAdmin */
        $clientAdmin = $dataGateway->findOneBy(
            Administrator::class,
            [
                implode(' AND ', $where),
                [':companyId' => $company->getId()]
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
                    ':brandId' => $company->getBrandId(),
                    ':urlType' => 'admin'
                ]
            ]
        );

        $clientToken = RestClient::exchangeAdminToken(
            $adminToken,
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

    /**
     * @param $company
     * @param $user
     * @return mixed
     */
    private function getBrandAdminToken(CompanyDto $company, $user)
    {
        $dataGateway = Zend_Registry::get('data_gateway');

        $where = [
            'Administrator.company IS NULL',
            'Administrator.brand = :brandId',
            'Administrator.active = 1',
            'Administrator.restricted = 0',
        ];

        /** @var \Ivoz\Provider\Domain\Model\Administrator\AdministratorDto $brandAdmin */
        $brandAdmin = $dataGateway->findOneBy(
            Administrator::class,
            [
                implode(' AND ', $where),
                [':brandId' => $company->getBrandId()]
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
                    ':brandId' => $company->getBrandId(),
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

        return $adminToken;
    }

    private function renewToken($user, CompanyDto $company)
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
                        ':brandId' => $company->getBrandId(),
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
                        ':brandId' => $company->getBrandId(),
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
}
