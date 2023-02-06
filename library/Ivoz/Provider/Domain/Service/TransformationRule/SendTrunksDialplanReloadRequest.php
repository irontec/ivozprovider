<?php

namespace Ivoz\Provider\Domain\Service\TransformationRule;

use Ivoz\Kam\Domain\Service\TrunksClientInterface;
use Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleInterface;

class SendTrunksDialplanReloadRequest implements TransformationRuleLifecycleEventHandlerInterface
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
    public function execute(TransformationRuleInterface $transformationRule)
    {
        $this->trunksClient->reloadDialplan();
    }
}
