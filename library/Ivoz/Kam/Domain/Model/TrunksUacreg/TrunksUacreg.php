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
        return parent::getChangeSet();
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
    }

    /**
     * {@inheritDoc}
     */
    public function setAuthProxy($authProxy)
    {
        if (!empty($authProxy)) {
            Assertion::regex($authProxy, '/^sip:.+$|^sips:.+$/');
        }

        return parent::setAuthProxy($authProxy);
    }

    /**
     * @inheritdoc
     */
    public function setLUuid($lUuid)
    {
        if (empty($lUuid)) {
            $lUuid = (string)round(microtime(true) * 1000);
        }

        return parent::setLUuid($lUuid);
    }
}
