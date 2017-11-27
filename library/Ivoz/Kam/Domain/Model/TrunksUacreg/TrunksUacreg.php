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

    protected function sanitizeValues()
    {
        if (empty($this->getAuthUsername())) {
            $this->setAuthUsername($this->getRUsername());
        }

        if (!$this->getAuthProxy()) {
            $this->setAuthProxy('sip:' . $this->getRDomain());
        }

        if (!$this->getMultiDdi()) {
            return;
        }

        $isNew = !$this->getId();
        $multiDdi_is_enabled_in_new_item = $isNew; # New item
        $multiDdi_has_been_enabled = !$isNew && $this->hasChanged('multiDdi'); # Existing item
        if ($multiDdi_has_been_enabled || $multiDdi_is_enabled_in_new_item) {
            $this->setLUuid(round(microtime(true) * 1000));
        }
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

