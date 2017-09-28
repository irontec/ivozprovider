<?php

namespace Ivoz\Provider\Domain\Model\Service;

/**
 * Service
 */
class Service extends ServiceAbstract implements ServiceInterface
{
    use ServiceTrait;

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

