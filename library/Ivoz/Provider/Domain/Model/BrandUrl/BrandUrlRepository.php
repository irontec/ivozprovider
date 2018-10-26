<?php

namespace Ivoz\Provider\Domain\Model\BrandUrl;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface BrandUrlRepository extends ObjectRepository, Selectable
{
    /**
     * @param string $serverName
     * @return BrandUrlInterface | null
     */
    public function findUserUrlByServerName(string $serverName);
}
