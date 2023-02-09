<?php

namespace Ivoz\Provider\Domain\Service\Voicemail;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class VoicemailLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /** @var array<array-key, array> $bindedBaseServices */
    public static $bindedBaseServices = [
        "post_persist" =>
        [
            \Ivoz\Ast\Domain\Service\Voicemail\UpdateByIvozVoicemail::class => 200,
        ],
        "pre_remove" =>
        [
            \Ivoz\Provider\Domain\Service\Ivr\UpdateByVoicemail::class => 200,
        ],
    ];

    protected function addService(string $event, $service): void
    {
        Assertion::isInstanceOf($service, VoicemailLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
