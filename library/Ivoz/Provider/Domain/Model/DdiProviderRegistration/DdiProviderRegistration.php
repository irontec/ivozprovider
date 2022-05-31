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
     * @return array<string, mixed>
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    protected function sanitizeValues(): void
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
