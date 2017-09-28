<?php

namespace Ivoz\Provider\Domain\Model\GenericMusicOnHold;

/**
 * GenericMusicOnHold
 */
class GenericMusicOnHold extends GenericMusicOnHoldAbstract implements GenericMusicOnHoldInterface
{
    use GenericMusicOnHoldTrait;
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function getOwner(){
        return
            'brand'
            . $this->getBrand()->getId();
    }
}

