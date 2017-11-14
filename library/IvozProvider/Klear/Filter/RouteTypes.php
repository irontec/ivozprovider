<?php

use \Ivoz\Provider\Domain\Model\Feature\Feature;
use Ivoz\Provider\Domain\Model\Company\Company;

class IvozProvider_Klear_Filter_RouteTypes implements KlearMatrix_Model_Field_Select_Filter_Interface
{
    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        return true;
    }

    /**
     * Get route types to be excluded by company features
     * @return array
     */
    public function getCondition()
    {
        $auth = Zend_Auth::getInstance();
        $user = $auth->getIdentity();

        /**
         * @var \Ivoz\Core\Application\Service\DataGateway $dataGateway
         */
        $dataGateway = \Zend_Registry::get('data_gateway');

        /**
         * @var \Ivoz\Provider\Domain\Model\Company\CompanyDTO $companyDTO
         */
        $companyDTO = $dataGateway->find(
            Company::class,
            $user->companyId
        );

        if (is_null($companyDTO)) {
            // No company feature to filter by
            return [];
        }

        /***
         * @var \Ivoz\Provider\Domain\Model\Feature\FeatureDTO[] $features
         */
        $features = $dataGateway->findAll(Feature::class);

        $excludedRoutes = [];
        foreach ($features as $featureDTO) {
            switch ($featureDTO->getNameEn()) {
                case 'Queues':
                    $routeType = 'queue';
                    break;
                case 'Friends':
                    $routeType = 'friend';
                    break;
                case 'Faxes':
                    $routeType = 'fax';
                    break;
                case 'Conferences':
                    $routeType = 'conferenceRoom';
                    break;
                default:
                    $routeType = '';
            }

            if (empty($routeType)) {
                continue;
            }

            $hasFeature = $dataGateway->remoteProcedureCall(
                Company::class,
                $companyDTO->getId(),
                'hasFeature',
                [$featureDTO->getId()]
            );

            if (!$hasFeature) {
                $excludedRoutes[] = $routeType;
            }
        }

        if ($companyDTO->getType() === Company::VPBX) {
            $excludedRoutes[] = 'retailAccount';
        } else {
            $excludedRoutes[] = 'user';
            $excludedRoutes[] = 'IVRCommon';
            $excludedRoutes[] = 'IVRCustom';
            $excludedRoutes[] = 'huntGroup';
            $excludedRoutes[] = 'conditional';
        }

        return $excludedRoutes;
    }
}
