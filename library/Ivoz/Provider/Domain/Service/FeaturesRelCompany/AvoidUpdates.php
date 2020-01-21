<?php
namespace Ivoz\Provider\Domain\Service\FeaturesRelCompany;

use Ivoz\Core\Domain\Service\AvoidEntityUpdatesAbstract;
use Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompanyInterface;

class AvoidUpdates extends AvoidEntityUpdatesAbstract implements FeaturesRelCompanyLifecycleEventHandlerInterface
{
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => AvoidEntityUpdatesAbstract::PRE_PERSIST_PRIORITY,
        ];
    }
    /**
     * @param FeaturesRelCompanyInterface $entity
     *
     * @throws \DomainException
     *
     * @return void
     */
    public function execute(FeaturesRelCompanyInterface $entity)
    {
        $this->assertUnchanged($entity);
    }
}
