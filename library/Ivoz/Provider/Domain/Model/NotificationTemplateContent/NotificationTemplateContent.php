<?php

namespace Ivoz\Provider\Domain\Model\NotificationTemplateContent;

/**
 * NotificationTemplateContent
 */
class NotificationTemplateContent extends NotificationTemplateContentAbstract implements NotificationTemplateContentInterface
{
    use NotificationTemplateContentTrait;

    /**
     * @codeCoverageIgnore
     * @return array
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
}
