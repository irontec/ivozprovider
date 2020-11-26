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
     * @var string | null
     */
    private $fromName;

    /**
     * @var string | null
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

    /**
     * @param string $fromName | null
     *
     * @return static
     */
    public function setFromName(?string $fromName = null): self
    {
        $this->fromName = $fromName;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getFromName(): ?string
    {
        return $this->fromName;
    }

    /**
     * @param string $fromAddress | null
     *
     * @return static
     */
    public function setFromAddress(?string $fromAddress = null): self
    {
        $this->fromAddress = $fromAddress;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getFromAddress(): ?string
    {
        return $this->fromAddress;
    }

    /**
     * @param string $subject | null
     *
     * @return static
     */
    public function setSubject(?string $subject = null): self
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * @param string $body | null
     *
     * @return static
     */
    public function setBody(?string $body = null): self
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getBody(): ?string
    {
        return $this->body;
    }

    /**
     * @param string $bodyType | null
     *
     * @return static
     */
    public function setBodyType(?string $bodyType = null): self
    {
        $this->bodyType = $bodyType;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getBodyType(): ?string
    {
        return $this->bodyType;
    }

    /**
     * @param int $id | null
     *
     * @return static
     */
    public function setId(?int $id = null): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param NotificationTemplateDto | null
     *
     * @return static
     */
    public function setNotificationTemplate(?NotificationTemplateDto $notificationTemplate = null): self
    {
        $this->notificationTemplate = $notificationTemplate;

        return $this;
    }

    /**
     * @return NotificationTemplateDto | null
     */
    public function getNotificationTemplate(): ?NotificationTemplateDto
    {
        return $this->notificationTemplate;
    }

    /**
     * @return static
     */
    public function setNotificationTemplateId($id): self
    {
        $value = !is_null($id)
            ? new NotificationTemplateDto($id)
            : null;

        return $this->setNotificationTemplate($value);
    }

    /**
     * @return mixed | null
     */
    public function getNotificationTemplateId()
    {
        if ($dto = $this->getNotificationTemplate()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param LanguageDto | null
     *
     * @return static
     */
    public function setLanguage(?LanguageDto $language = null): self
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return LanguageDto | null
     */
    public function getLanguage(): ?LanguageDto
    {
        return $this->language;
    }

    /**
     * @return static
     */
    public function setLanguageId($id): self
    {
        $value = !is_null($id)
            ? new LanguageDto($id)
            : null;

        return $this->setLanguage($value);
    }

    /**
     * @return mixed | null
     */
    public function getLanguageId()
    {
        if ($dto = $this->getLanguage()) {
            return $dto->getId();
        }

        return null;
    }

}
