<?php

namespace Ivoz\Provider\Domain\Model\BrandService;

/**
 * BrandService
 */
class BrandService extends BrandServiceAbstract implements BrandServiceInterface
{
    use BrandServiceTrait;

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

