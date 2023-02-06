<?php

namespace Ivoz\Provider\Domain\Service\CompanyRelCodec;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\CompanyRelCodec\CompanyRelCodecInterface;

interface CompanyRelCodecLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(CompanyRelCodecInterface $relCodec);
}
