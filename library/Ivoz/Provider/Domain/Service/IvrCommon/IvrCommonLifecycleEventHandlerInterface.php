<?php

namespace Ivoz\Provider\Domain\Service\IvrCommon;

use Ivoz\Provider\Domain\Model\IvrCommon\IvrCommonInterface;

interface IvrCommonLifecycleEventHandlerInterface
{
    public function execute(IvrCommonInterface $entity, $isNew);
}