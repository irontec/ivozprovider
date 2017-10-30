<?php

namespace Ivoz\Kam\Domain\Model\TrunksUacreg;

/**
 * TrunksUacreg
 */
class TrunksUacreg extends TrunksUacregAbstract implements TrunksUacregInterface
{
    use TrunksUacregTrait;

    public function getChangeSet()
    {
        $changeSet = parent::getChangeSet();
        if (isset($changeSet['auth_password'])) {
            $changeSet['auth_password'] = '****';
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

