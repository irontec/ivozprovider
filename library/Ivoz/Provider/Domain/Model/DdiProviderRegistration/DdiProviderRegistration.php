<?php

namespace Ivoz\Provider\Domain\Model\DdiProviderRegistration;

/**
 * DdiProviderRegistration
 */
class DdiProviderRegistration extends DdiProviderRegistrationAbstract implements DdiProviderRegistrationInterface
{
    use DdiProviderRegistrationTrait;

    /**
     * @codeCoverageIgnore
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

    /**
     * @inheritdoc
     */
    protected function sanitizeValues()
    {
        if ($this->getMultiDdi()) {
            $this->setContactUsername('');
        }
    }

    protected function setAuthPassword($authPassword)
    {
        $authPassword = trim($authPassword);
        return parent::setAuthPassword($authPassword);
    }
}
