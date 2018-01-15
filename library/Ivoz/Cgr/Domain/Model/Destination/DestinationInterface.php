<?php

namespace Ivoz\Cgr\Domain\Model\Destination;

use Ivoz\Core\Domain\Model\EntityInterface;

interface DestinationInterface extends EntityInterface
{
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
     * Set name
     *
     * @param \Ivoz\Cgr\Domain\Model\Destination\Name $name
     *
     * @return self
     */
    public function setName(\Ivoz\Cgr\Domain\Model\Destination\Name $name);

    /**
     * Get name
     *
     * @return \Ivoz\Cgr\Domain\Model\Destination\Name
     */
    public function getName();

    /**
     * Set description
     *
     * @param \Ivoz\Cgr\Domain\Model\Destination\Description $description
     *
     * @return self
     */
    public function setDescription(\Ivoz\Cgr\Domain\Model\Destination\Description $description);

    /**
     * Get description
     *
     * @return \Ivoz\Cgr\Domain\Model\Destination\Description
     */
    public function getDescription();

}

