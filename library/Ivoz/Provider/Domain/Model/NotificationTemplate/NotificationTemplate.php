<?php

namespace Ivoz\Provider\Domain\Model\NotificationTemplate;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\Model\Helper\CriteriaHelper;
use Ivoz\Provider\Domain\Model\Language\LanguageInterface;

/**
 * NotificationTemplate
 */
class NotificationTemplate extends NotificationTemplateAbstract implements NotificationTemplateInterface
{
    use NotificationTemplateTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }

    protected function sanitizeValues(): void
    {
        $notNew = !$this->isNew();
        $brandHasChanged = $this->hasChanged('brandId');

        if ($notNew && $brandHasChanged) {
            $errorMsg = $this->getBrand()
                ? 'Unable to convert a global notification template into a brand notification template'
                : 'Unable to convert a brand notification template into a global notification template';

            throw new \DomainException($errorMsg);
        }
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
     * Get contents by language
     *
     * @param \Ivoz\Provider\Domain\Model\Language\LanguageInterface $language
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplateContent\NotificationTemplateContentInterface | null
     */
    public function getContentsByLanguage(LanguageInterface $language)
    {
        $contents = $this->getContents(CriteriaHelper::fromArray(
            [
                array('language', 'eq', $language)
            ]
        ));

        return array_shift($contents);
    }
}
