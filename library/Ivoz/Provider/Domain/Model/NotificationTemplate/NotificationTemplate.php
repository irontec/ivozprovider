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
     * Get contents by language
     *
     * @param \Ivoz\Provider\Domain\Model\Language\LanguageInterface $language
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplateContent\NotificationTemplateContentInterface
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
