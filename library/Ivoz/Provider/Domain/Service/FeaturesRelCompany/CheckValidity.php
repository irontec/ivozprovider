<?php

namespace Ivoz\Provider\Domain\Service\FeaturesRelCompany;

use Ivoz\Core\Domain\Service\AvoidEntityUpdatesAbstract;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Feature\Feature;
use Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompanyInterface;

class CheckValidity extends AvoidEntityUpdatesAbstract implements FeaturesRelCompanyLifecycleEventHandlerInterface
{
    /**
     * @return array<array-key, int>
     */
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => AvoidEntityUpdatesAbstract::PRE_PERSIST_PRIORITY,
        ];
    }

    public function execute(FeaturesRelCompanyInterface $relCompany): void
    {
        $feature = $relCompany->getFeature();
        $operatorPanelFeature = $feature->getIden() === Feature::OPERATOR_PANEL_IDEN;

        $client = $relCompany->getCompany();
        $vpbxClient = $client?->getType() === CompanyInterface::TYPE_VPBX;

        if ($operatorPanelFeature && ! $vpbxClient) {
            throw new \DomainException('Operator panel feature can only be assigned to vPBX clients');
        }
    }
}
