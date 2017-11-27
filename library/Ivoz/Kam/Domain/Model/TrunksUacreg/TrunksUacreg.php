<?php

namespace Ivoz\Kam\Domain\Model\TrunksUacreg;

use Assert\Assertion;

/**
 * TrunksUacreg
 */
class TrunksUacreg extends TrunksUacregAbstract implements TrunksUacregInterface
{
    use TrunksUacregTrait;

    /**
     * @return array
     */
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
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     */
    public function setAuthProxy($authProxy)
    {
        Assertion::regex($authProxy, '/^sip:.+$|^sips:.+$/');
        return parent::setAuthProxy($authProxy);
    }
}

