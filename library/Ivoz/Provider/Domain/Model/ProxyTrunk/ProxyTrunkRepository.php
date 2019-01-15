<?php

namespace Ivoz\Provider\Domain\Model\ProxyTrunk;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface ProxyTrunkRepository extends ObjectRepository, Selectable
{
    /**
     * @return ProxyTrunkInterface
     * @throws \Exception
     */
    public function getProxyMainAddress();
}
