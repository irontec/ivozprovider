<?php

namespace Ivoz\Provider\Domain\Model\NotificationTemplateContent;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class NotificationTemplateContentDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $fromName;

    /**
     * @var string
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
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto | null
     */
    private $notificationTemplate;

    /**
     * @var \Ivoz\Provider\Domain\Model\Language\LanguageDto | null
     */
    private $language;


    use DtoNormalizer;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
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
        return [
            'fromName' => $this->getFromName(),
            'fromAddress' => $this->getFromAddress(),
            'subject' => $this->getSubject(),
            'body' => $this->getBody(),
            'bodyType' => $this->getBodyType(),
            'id' => $this->getId(),
            'notificationTemplate' => $this->getNotificationTemplate(),
            'language' => $this->getLanguage()
        ];
    }

    /**
     * @param string $fromName
     *
     * @return static
     */
    public function setFromName($fromName = null)
    {
        $this->fromName = $fromName;

        return $this;
    }

    /**
     * @return string
     */
    public function getFromName()
    {
        return $this->fromName;
    }

    /**
     * @param string $fromAddress
     *
     * @return static
     */
    public function setFromAddress($fromAddress = null)
    {
        $this->fromAddress = $fromAddress;

        return $this;
    }

    /**
     * @return string
     */
    public function getFromAddress()
    {
        return $this->fromAddress;
    }

    /**
     * @param string $subject
     *
     * @return static
     */
    public function setSubject($subject = null)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $body
     *
     * @return static
     */
    public function setBody($body = null)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $bodyType
     *
     * @return static
     */
    public function setBodyType($bodyType = null)
    {
        $this->bodyType = $bodyType;

        return $this;
    }

    /**
     * @return string
     */
    public function getBodyType()
    {
        return $this->bodyType;
    }

    /**
     * @param integer $id
     *
     * @return static
     */
    public function setId($id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto $notificationTemplate
     *
     * @return static
     */
    public function setNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto $notificationTemplate = null)
    {
        $this->notificationTemplate = $notificationTemplate;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto
     */
    public function getNotificationTemplate()
    {
        return $this->notificationTemplate;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setNotificationTemplateId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto($id)
            : null;

        return $this->setNotificationTemplate($value);
    }

    /**
     * @return integer | null
     */
    public function getNotificationTemplateId()
    {
        if ($dto = $this->getNotificationTemplate()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Language\LanguageDto $language
     *
     * @return static
     */
    public function setLanguage(\Ivoz\Provider\Domain\Model\Language\LanguageDto $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Language\LanguageDto
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setLanguageId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Language\LanguageDto($id)
            : null;

        return $this->setLanguage($value);
    }

    /**
     * @return integer | null
     */
    public function getLanguageId()
    {
        if ($dto = $this->getLanguage()) {
            return $dto->getId();
        }

        return null;
    }
}
