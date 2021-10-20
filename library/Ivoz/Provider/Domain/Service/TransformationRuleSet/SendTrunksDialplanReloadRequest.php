<?php

namespace Ivoz\Provider\Domain\Service\TransformationRuleSet;

use Ivoz\Kam\Domain\Service\TrunksClientInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;

class SendTrunksDialplanReloadRequest implements TransformationRuleSetLifecycleEventHandlerInterface
{
    public const ON_COMMIT_PRIORITY = self::PRIORITY_LOW;

    public function __construct(
        private TrunksClientInterface $trunksClient
    ) {
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
    public function execute(TransformationRuleSetInterface $transformationRuleSet)
    {
        $this->trunksClient->reloadDialplan();
    }
}
