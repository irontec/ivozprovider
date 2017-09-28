<?php

namespace Ivoz\Provider\Domain\Model\BrandUrl;

/**
 * BrandUrl
 */
class BrandUrl extends BrandUrlAbstract implements BrandUrlInterface
{
    use BrandUrlTrait;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

