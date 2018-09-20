<?php

namespace Ivoz\Provider\Domain\Model\NotificationTemplateContent;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * NotificationTemplateContentAbstract
 * @codeCoverageIgnore
 */
abstract class NotificationTemplateContentAbstract
{
    /**
     * @var string
     */
    protected $fromName;

    /**
     * @var string
     */
    protected $fromAddress;

    /**
     * @var string
     */
    protected $subject;

    /**
     * @var string
     */
    protected $body;

    /**
     * @var \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface
     */
    protected $notificationTemplate;

    /**
     * @var \Ivoz\Provider\Domain\Model\Language\LanguageInterface
     */
    protected $language;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($subject, $body)
    {
        $this->setSubject($subject);
        $this->setBody($body);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "NotificationTemplateContent",
            $this->getId()
        );
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
    }

    /**
     * @param null $id
     * @return NotificationTemplateContentDto
     */
    public static function createDto($id = null)
    {
        return new NotificationTemplateContentDto($id);
    }

    /**
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return NotificationTemplateContentDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, NotificationTemplateContentInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto NotificationTemplateContentDto
         */
        Assertion::isInstanceOf($dto, NotificationTemplateContentDto::class);

        $self = new static(
            $dto->getSubject(),
            $dto->getBody()
        );

        $self
            ->setFromName($dto->getFromName())
            ->setFromAddress($dto->getFromAddress())
            ->setNotificationTemplate($dto->getNotificationTemplate())
            ->setLanguage($dto->getLanguage())
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto NotificationTemplateContentDto
         */
        Assertion::isInstanceOf($dto, NotificationTemplateContentDto::class);

        $this
            ->setFromName($dto->getFromName())
            ->setFromAddress($dto->getFromAddress())
            ->setSubject($dto->getSubject())
            ->setBody($dto->getBody())
            ->setNotificationTemplate($dto->getNotificationTemplate())
            ->setLanguage($dto->getLanguage());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @param int $depth
     * @return NotificationTemplateContentDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setFromName(self::getFromName())
            ->setFromAddress(self::getFromAddress())
            ->setSubject(self::getSubject())
            ->setBody(self::getBody())
            ->setNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplate::entityToDto(self::getNotificationTemplate(), $depth))
            ->setLanguage(\Ivoz\Provider\Domain\Model\Language\Language::entityToDto(self::getLanguage(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'fromName' => self::getFromName(),
            'fromAddress' => self::getFromAddress(),
            'subject' => self::getSubject(),
            'body' => self::getBody(),
            'notificationTemplateId' => self::getNotificationTemplate() ? self::getNotificationTemplate()->getId() : null,
            'languageId' => self::getLanguage() ? self::getLanguage()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * @deprecated
     * Set fromName
     *
     * @param string $fromName
     *
     * @return self
     */
    public function setFromName($fromName = null)
    {
        if (!is_null($fromName)) {
            Assertion::maxLength($fromName, 255, 'fromName value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->fromName = $fromName;

        return $this;
    }

    /**
     * Get fromName
     *
     * @return string
     */
    public function getFromName()
    {
        return $this->fromName;
    }

    /**
     * @deprecated
     * Set fromAddress
     *
     * @param string $fromAddress
     *
     * @return self
     */
    public function setFromAddress($fromAddress = null)
    {
        if (!is_null($fromAddress)) {
            Assertion::maxLength($fromAddress, 255, 'fromAddress value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->fromAddress = $fromAddress;

        return $this;
    }

    /**
     * Get fromAddress
     *
     * @return string
     */
    public function getFromAddress()
    {
        return $this->fromAddress;
    }

    /**
     * @deprecated
     * Set subject
     *
     * @param string $subject
     *
     * @return self
     */
    public function setSubject($subject)
    {
        Assertion::notNull($subject, 'subject value "%s" is null, but non null value was expected.');
        Assertion::maxLength($subject, 255, 'subject value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @deprecated
     * Set body
     *
     * @param string $body
     *
     * @return self
     */
    public function setBody($body)
    {
        Assertion::notNull($body, 'body value "%s" is null, but non null value was expected.');
        Assertion::maxLength($body, 65535, 'body value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set notificationTemplate
     *
     * @param \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface $notificationTemplate
     *
     * @return self
     */
    public function setNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface $notificationTemplate = null)
    {
        $this->notificationTemplate = $notificationTemplate;

        return $this;
    }

    /**
     * Get notificationTemplate
     *
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface
     */
    public function getNotificationTemplate()
    {
        return $this->notificationTemplate;
    }

    /**
     * Set language
     *
     * @param \Ivoz\Provider\Domain\Model\Language\LanguageInterface $language
     *
     * @return self
     */
    public function setLanguage(\Ivoz\Provider\Domain\Model\Language\LanguageInterface $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return \Ivoz\Provider\Domain\Model\Language\LanguageInterface
     */
    public function getLanguage()
    {
        return $this->language;
    }

    // @codeCoverageIgnoreEnd
}
