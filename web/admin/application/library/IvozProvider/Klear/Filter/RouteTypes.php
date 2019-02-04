<?php

use Ivoz\Core\Application\Service\DataGateway;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use \Ivoz\Provider\Domain\Model\Feature\Feature;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Feature\FeatureDto;

/**
 * Class IvozProvider_Klear_Filter_RouteTypes
 *
 * Filter RouteType Listbox to only show options enabled by active Features in emulated company
 */
class IvozProvider_Klear_Filter_RouteTypes implements KlearMatrix_Model_Field_Select_Filter_Interface
{
    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        return true;
    }

    /**
     * Get route types to be excluded by company features
     *
     * @return array
     * @throws Zend_Exception
     */
    public function getCondition()
    {
        $auth = Zend_Auth::getInstance();
        $user = $auth->getIdentity();

        /** @var DataGateway $dataGateway */
        $dataGateway = \Zend_Registry::get('data_gateway');

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

        $excludedRoutes = [];
        foreach ($features as $featureDto) {
            switch ($featureDto->getNameEn()) {
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
                $companyDto->getId(),
                'hasFeature',
                [$featureDto->getId()]
            );

            if (!$hasFeature) {
                $excludedRoutes[] = $routeType;
            }
        }

        switch ($companyDto->getType()) {
            case Company::VPBX:
                $excludedRoutes[] = 'residential';
                $excludedRoutes[] = 'retail';
                break;
            case Company::RETAIL:
                $excludedRoutes[] = 'user';
                $excludedRoutes[] = 'ivr';
                $excludedRoutes[] = 'huntGroup';
                $excludedRoutes[] = 'conditional';
                $excludedRoutes[] = 'residential';
                break;
            case Company::RESIDENTIAL:
                $excludedRoutes[] = 'user';
                $excludedRoutes[] = 'ivr';
                $excludedRoutes[] = 'huntGroup';
                $excludedRoutes[] = 'conditional';
                $excludedRoutes[] = 'retail';
                break;
        }

        return $excludedRoutes;
    }
}
