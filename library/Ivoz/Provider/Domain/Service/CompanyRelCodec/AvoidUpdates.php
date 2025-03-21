<?php

namespace Ivoz\Provider\Domain\Service\CompanyRelCodec;

use Ivoz\Core\Domain\Service\AvoidEntityUpdatesAbstract;
use Ivoz\Provider\Domain\Model\CompanyRelCodec\CompanyRelCodecInterface;

class AvoidUpdates extends AvoidEntityUpdatesAbstract implements CompanyRelCodecLifecycleEventHandlerInterface
{
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => AvoidEntityUpdatesAbstract::PRE_PERSIST_PRIORITY,
        ];
    }
    /**
     * @param CompanyRelCodecInterface $relCodec
     *
     * @return void
     *@throws \DomainException
     *
     */
    public function execute(CompanyRelCodecInterface $relCodec)
    {
        $this->assertUnchanged($relCodec);
    }
}
