<?php

namespace Ivoz\Cgr\Domain\Model\Rate;

use Ivoz\Core\Domain\Model\EntityInterface;
use Doctrine\Common\Collections\Collection;

interface RateInterface extends EntityInterface
{
    public function __toString();

    /**
     * Set tag
     *
     * @param string $tag
     *
     * @return self
     */
    public function setTag($tag = null);

    /**
     * Get tag
     *
     * @return string
     */
    public function getTag();

    /**
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand);

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand();

    /**
     * Add tpRate
     *
     * @param \Ivoz\Cgr\Domain\Model\TpRate\TpRateInterface $tpRate
     *
     * @return RateTrait
     */
    public function addTpRate(\Ivoz\Cgr\Domain\Model\TpRate\TpRateInterface $tpRate);

    /**
     * Remove tpRate
     *
     * @param \Ivoz\Cgr\Domain\Model\TpRate\TpRateInterface $tpRate
     */
    public function removeTpRate(\Ivoz\Cgr\Domain\Model\TpRate\TpRateInterface $tpRate);

    /**
     * Replace tpRates
     *
     * @param \Ivoz\Cgr\Domain\Model\TpRate\TpRateInterface[] $tpRates
     * @return self
     */
    public function replaceTpRates(Collection $tpRates);

    /**
     * Get tpRates
     *
     * @return \Ivoz\Cgr\Domain\Model\TpRate\TpRateInterface[]
     */
    public function getTpRates(\Doctrine\Common\Collections\Criteria $criteria = null);

}

