<?php

namespace Ivoz\Provider\Domain\Model\BrandService;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;

interface BrandServiceRepository extends ObjectRepository, Selectable
{
    /**
     * @param BrandInterface $brand
     * @param string $iden
     * @return BrandInterface
     */
    public function findByIden(BrandInterface $brand, string $iden);

    /**
     * @param $id
     * @return BrandServiceInterface[]
     */
    public function findByBrandId($id);
}
