<?php

namespace Ivoz\Provider\Domain\Model\NotificationTemplateContent;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto;
use Ivoz\Provider\Domain\Model\Language\LanguageDto;

/**
* NotificationTemplateContentDtoAbstract
* @codeCoverageIgnore
*/
abstract class NotificationTemplateContentDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $fromName;

    /**
     * @var string|null
     */
    private $fromAddress;

    /**
     * @var string
     */
    private $subject;

    /**
     * @var string
     */
    private $body;

    /**
     * @var string
     */
    private $bodyType = 'text/plain';

    /**
     * @var int
     */
    private $id;

    /**
     * @var NotificationTemplateDto | null
     */
    private $notificationTemplate;

    /**
     * @var LanguageDto | null
     */
    private $language;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'fromName' => 'fromName',
            'fromAddress' => 'fromAddress',
            'subject' => 'subject',
            'body' => 'body',
            'bodyType' => 'bodyType',
            'id' => 'id',
            'notificationTemplateId' => 'notificationTemplate',
            'languageId' => 'language'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'fromName' => $this->getFromName(),
            'fromAddress' => $this->getFromAddress(),
            'subject' => $this->getSubject(),
            'body' => $this->getBody(),
            'bodyType' => $this->getBodyType(),
            'id' => $this->getId(),
            'notificationTemplate' => $this->getNotificationTemplate(),
            'language' => $this->getLanguage()
        ];

        if (!$hideSensitiveData) {
            return $response;
        }

        foreach ($this->sensitiveFields as $sensitiveField) {
            if (!array_key_exists($sensitiveField, $response)) {
                throw new \Exception($sensitiveField . ' field was not found');
            }
            $response[$sensitiveField] = '*****';
        }

        return $response;
    }

    public function setFromName(?string $fromName): static
    {
        $this->fromName = $fromName;

        return $this;
    }

    public function getFromName(): ?string
    {
        return $this->fromName;
    }

    public function setFromAddress(?string $fromAddress): static
    {
        $this->fromAddress = $fromAddress;

        return $this;
    }

    public function getFromAddress(): ?string
    {
        return $this->fromAddress;
    }

    public function setSubject(?string $subject): static
    {
        $this->subject = $subject;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setBody(?string $body): static
    {
        $this->body = $body;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBodyType(?string $bodyType): static
    {
        $this->bodyType = $bodyType;

        return $this;
    }

    public function getBodyType(): ?string
    {
        return $this->bodyType;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setNotificationTemplate(?NotificationTemplateDto $notificationTemplate): static
    {
        $this->notificationTemplate = $notificationTemplate;

        return $this;
    }

    public function getNotificationTemplate(): ?NotificationTemplateDto
    {
        return $this->notificationTemplate;
    }

    public function setNotificationTemplateId($id): static
    {
        $value = !is_null($id)
            ? new NotificationTemplateDto($id)
            : null;

        return $this->setNotificationTemplate($value);
    }

    public function getNotificationTemplateId()
    {
        if ($dto = $this->getNotificationTemplate()) {
            return $dto->getId();
        }

        return null;
    }

    public function setLanguage(?LanguageDto $language): static
    {
        $this->language = $language;

        return $this;
    }

    public function getLanguage(): ?LanguageDto
    {
        return $this->language;
    }

    public function setLanguageId($id): static
    {
        $value = !is_null($id)
            ? new LanguageDto($id)
            : null;

        return $this->setLanguage($value);
    }

    public function getLanguageId()
    {
        if ($dto = $this->getLanguage()) {
            return $dto->getId();
        }

        return null;
    }
}
