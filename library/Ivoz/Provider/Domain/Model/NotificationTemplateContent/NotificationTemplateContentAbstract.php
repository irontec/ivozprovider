<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\NotificationTemplateContent;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface;
use Ivoz\Provider\Domain\Model\Language\LanguageInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplate;
use Ivoz\Provider\Domain\Model\Language\Language;

/**
* NotificationTemplateContentAbstract
* @codeCoverageIgnore
*/
abstract class NotificationTemplateContentAbstract
{
    use ChangelogTrait;

    /**
     * @var string | null
     */
    protected $fromName;

    /**
     * @var string | null
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
     * comment: enum:text/plain|text/html
     * @var string
     */
    protected $bodyType = 'text/plain';

    /**
     * @var NotificationTemplateInterface
     * inversedBy contents
     */
    protected $notificationTemplate;

    /**
     * @var LanguageInterface | null
     */
    protected $language;

    /**
     * Constructor
     */
    protected function __construct(
        $subject,
        $body,
        $bodyType
    ) {
        $this->setSubject($subject);
        $this->setBody($body);
        $this->setBodyType($bodyType);
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
     * @param mixed $id
     * @return NotificationTemplateContentDto
     */
    public static function createDto($id = null)
    {
        return new NotificationTemplateContentDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param NotificationTemplateContentInterface|null $entity
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

        /** @var NotificationTemplateContentDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param NotificationTemplateContentDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, NotificationTemplateContentDto::class);

        $self = new static(
            $dto->getSubject(),
            $dto->getBody(),
            $dto->getBodyType()
        );

        $self
            ->setFromName($dto->getFromName())
            ->setFromAddress($dto->getFromAddress())
            ->setNotificationTemplate($fkTransformer->transform($dto->getNotificationTemplate()))
            ->setLanguage($fkTransformer->transform($dto->getLanguage()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param NotificationTemplateContentDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, NotificationTemplateContentDto::class);

        $this
            ->setFromName($dto->getFromName())
            ->setFromAddress($dto->getFromAddress())
            ->setSubject($dto->getSubject())
            ->setBody($dto->getBody())
            ->setBodyType($dto->getBodyType())
            ->setNotificationTemplate($fkTransformer->transform($dto->getNotificationTemplate()))
            ->setLanguage($fkTransformer->transform($dto->getLanguage()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
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
            ->setBodyType(self::getBodyType())
            ->setNotificationTemplate(NotificationTemplate::entityToDto(self::getNotificationTemplate(), $depth))
            ->setLanguage(Language::entityToDto(self::getLanguage(), $depth));
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
            'bodyType' => self::getBodyType(),
            'notificationTemplateId' => self::getNotificationTemplate()->getId(),
            'languageId' => self::getLanguage() ? self::getLanguage()->getId() : null
        ];
    }

    protected function setFromName(?string $fromName = null): static
    {
        if (!is_null($fromName)) {
            Assertion::maxLength($fromName, 255, 'fromName value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->fromName = $fromName;

        return $this;
    }

    public function getFromName(): ?string
    {
        return $this->fromName;
    }

    protected function setFromAddress(?string $fromAddress = null): static
    {
        if (!is_null($fromAddress)) {
            Assertion::maxLength($fromAddress, 255, 'fromAddress value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->fromAddress = $fromAddress;

        return $this;
    }

    public function getFromAddress(): ?string
    {
        return $this->fromAddress;
    }

    protected function setSubject(string $subject): static
    {
        Assertion::maxLength($subject, 255, 'subject value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->subject = $subject;

        return $this;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    protected function setBody(string $body): static
    {
        Assertion::maxLength($body, 65535, 'body value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->body = $body;

        return $this;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    protected function setBodyType(string $bodyType): static
    {
        Assertion::maxLength($bodyType, 25, 'bodyType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice(
            $bodyType,
            [
                NotificationTemplateContentInterface::BODYTYPE_TEXTPLAIN,
                NotificationTemplateContentInterface::BODYTYPE_TEXTHTML,
            ],
            'bodyTypevalue "%s" is not an element of the valid values: %s'
        );

        $this->bodyType = $bodyType;

        return $this;
    }

    public function getBodyType(): string
    {
        return $this->bodyType;
    }

    public function setNotificationTemplate(NotificationTemplateInterface $notificationTemplate): static
    {
        $this->notificationTemplate = $notificationTemplate;

        /** @var  $this */
        return $this;
    }

    public function getNotificationTemplate(): NotificationTemplateInterface
    {
        return $this->notificationTemplate;
    }

    protected function setLanguage(?LanguageInterface $language = null): static
    {
        $this->language = $language;

        return $this;
    }

    public function getLanguage(): ?LanguageInterface
    {
        return $this->language;
    }
}
