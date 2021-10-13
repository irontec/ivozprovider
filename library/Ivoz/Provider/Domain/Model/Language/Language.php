<?php

namespace Ivoz\Provider\Domain\Model\Language;

/**
 * Language
 */
class Language extends LanguageAbstract implements LanguageInterface
{
    use LanguageTrait;

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
    public function getId()
    {
        return $this->id;
    }
}
