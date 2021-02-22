<?php

namespace Ivoz\Provider\Domain\Service\TransformationRule;

use Ivoz\Kam\Domain\Service\TrunksClientInterface;
use Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleInterface;

class SendTrunksDialplanReloadRequest implements TransformationRuleLifecycleEventHandlerInterface
{
    const ON_COMMIT_PRIORITY = self::PRIORITY_LOW;

    protected $trunksClient;

    public function __construct(
        TrunksClientInterface $trunksClient
    ) {
        $this->trunksClient = $trunksClient;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_COMMIT => self::ON_COMMIT_PRIORITY
        ];
    }

    /**
     * @return void
     */
    public function execute(TransformationRuleInterface $entity)
    {
        $this->trunksClient->reloadDialplan();
    }
}
