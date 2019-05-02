<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\TransformationRuleSet;

use Ivoz\Kam\Domain\Service\TrunksClientInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Provider\Domain\Service\TransformationRuleSet\TransformationRuleSetLifecycleEventHandlerInterface;

class SendTrunksDialplanReloadRequest implements TransformationRuleSetLifecycleEventHandlerInterface
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
    public function execute(TransformationRuleSetInterface $transformationRuleSet)
    {
        $this->trunksClient->reloadDialplan();
    }
}
