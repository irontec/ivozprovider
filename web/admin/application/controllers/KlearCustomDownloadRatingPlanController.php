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

        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
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
                'Rating profile not found'
            );
        }

        $company = $dataGateway->find(
            \Ivoz\Provider\Domain\Model\Company\Company::class,
            $ratingProfileDto->getCompanyId()
        );

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

        $billableCalls = $apiClient->getRatingPlanGroupPrices(
            $ratingPlanGroupDto->getId()
        );

        $response = $this->getResponse();
        $response->clearHeaders();
        $response->setHeader('Content-Length', mb_strlen($billableCalls));
        $response->setHeader('Content-Type', 'text/csv');
        $response->setHeader('Content-disposition', 'attachment; filename='. $fileName .'.csv');

        $response->sendHeaders();
        $response->clearHeaders();

        echo $billableCalls;
    }

    private function getAdminApiClient(CompanyDto $company, string $adminToken): RestClient
    {
        $dataGateway = Zend_Registry::get('data_gateway');

        /** @var \Ivoz\Provider\Domain\Model\Administrator\AdministratorDto $clientAdmin */
        $clientAdmin = $dataGateway->findOneBy(
            Administrator::class,
            [
                'Administrator.company = :companyId AND Administrator.active = 1',
                [':companyId' => $company->getId()]
            ]
        );

        if (!$clientAdmin) {
            throw new \DomainException(
                'Unable to find a suitable client admin'
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
     * @param $dataGateway
     * @param $company
     * @param $user
     * @return mixed
     */
    private function getBrandAdminToken(CompanyDto $company, $user)
    {
        $dataGateway = Zend_Registry::get('data_gateway');

        /** @var \Ivoz\Provider\Domain\Model\Administrator\AdministratorDto $brandAdmin */
        $brandAdmin = $dataGateway->findOneBy(
            Administrator::class,
            [
                'Administrator.brand = :brandId AND Administrator.active = 1 AND Administrator.company IS NULL',
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
