<?php
namespace Ivoz\Provider\Domain\Model\Language;

/**
 * Language
 */
class Language extends LanguageAbstract implements LanguageInterface
{
    use LanguageTrait;

    public function getChangeSet()
    {
        return parent::getChangeSet();
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

