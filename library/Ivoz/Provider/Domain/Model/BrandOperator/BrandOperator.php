<?php

namespace Ivoz\Provider\Domain\Model\BrandOperator;

/**
 * BrandOperator
 */
class BrandOperator extends BrandOperatorAbstract implements BrandOperatorInterface
{
    use BrandOperatorTrait;

    public function getChangeSet()
    {
        $changeSet = parent::getChangeSet();
        if (isset($changeSet['pass'])) {
            $changeSet['pass'] = '****';
        }

        return $changeSet;
    }

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

