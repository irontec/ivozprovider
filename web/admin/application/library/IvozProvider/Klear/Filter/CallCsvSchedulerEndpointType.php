<?php

use Ivoz\Core\Application\Service\DataGateway;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Feature\Feature;
use Ivoz\Provider\Domain\Model\Feature\FeatureDto;

class IvozProvider_Klear_Filter_CallCsvSchedulerEndpointType implements KlearMatrix_Model_Field_Select_Filter_Interface
{
    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        return true;
    }

    public function getCondition()
    {
        $auth = Zend_Auth::getInstance();
        $user = $auth->getIdentity();

        /** @var DataGateway $dataGateway */
        $dataGateway = \Zend_Registry::get('data_gateway');
        if (!$user->companyId) {
            return [];
        }

        /** @var CompanyDto $companyDto */
        $companyDto = $dataGateway->find(
            Company::class,
            $user->companyId
        );

        if (is_null($companyDto)) {
            // No company feature to filter by
            return [];
        }

        /** @var FeatureDto[] $features */
        $features = $dataGateway->findAll(Feature::class);

        $excludedEndpoints = [];

        foreach ($features as $featureDto) {
            switch ($featureDto->getNameEn()) {
                case 'Friends':
                    $endpointType = 'friend';
                    break;
                case 'Faxes':
                    $endpointType = 'fax';
                    break;
                default:
                    $endpointType = '';
                    break;
            }

            if (empty($endpointType)) {
                continue;
            }

            $hasFeature = $dataGateway->remoteProcedureCall(
                Company::class,
                $companyDto->getId(),
                'hasFeature',
                [$featureDto->getId()]
            );

            if (!$hasFeature) {
                $excludedEndpoints[] = $endpointType;
            }
        }

        return $excludedEndpoints;
    }
}
