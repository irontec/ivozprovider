<?php

namespace Ivoz\Provider\Domain\Model\ProxyUser;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface ProxyUserRepository extends ObjectRepository, Selectable
{
    /**
     * @return ProxyUserInterface
     * @throws \Exception
     */
    public function getProxyMainAddress();
}
