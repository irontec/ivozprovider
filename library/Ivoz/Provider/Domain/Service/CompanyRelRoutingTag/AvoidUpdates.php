<?php
namespace Ivoz\Provider\Domain\Service\CompanyRelRoutingTag;

use Ivoz\Core\Domain\Service\AvoidEntityUpdatesAbstract;
use Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagInterface;

class AvoidUpdates extends AvoidEntityUpdatesAbstract implements CompanyRelRoutingTagLifecycleEventHandlerInterface
{
    public function __construct()
    {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => AvoidEntityUpdatesAbstract::PRE_PERSIST_PRIORITY,
        ];
    }

    /**
     * @param CompanyRelRoutingTagInterface $entity
     *
     * @throws \DomainException
     *
     * @return void
     */
    public function execute(CompanyRelRoutingTagInterface $entity)
    {
        $this->assertUnchanged($entity);
    }
}
