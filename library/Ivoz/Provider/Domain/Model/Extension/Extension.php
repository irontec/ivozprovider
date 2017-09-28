<?php

namespace Ivoz\Provider\Domain\Model\Extension;

/**
 * Extension
 */
class Extension extends ExtensionAbstract implements ExtensionInterface
{
    use ExtensionTrait;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function toArrayPortal()
    {
        return [
            'id' => $this->getId(),
            'number' => $this->getNumber()
        ];
    }

}

