<?php

namespace Ivoz\Provider\Domain\Model\ProxyTrunk;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface ProxyTrunkRepository extends ObjectRepository, Selectable
{
    /**
     * @return ProxyTrunkInterface
     * @throws \Exception
     */
    public function getProxyMainAddress();
}
