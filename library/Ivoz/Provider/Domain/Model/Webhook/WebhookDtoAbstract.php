<?php

namespace Ivoz\Provider\Domain\Model\Webhook;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Ddi\DdiDto;
use Ivoz\Provider\Domain\Model\User\UserDto;

/**
* WebhookDtoAbstract
* @codeCoverageIgnore
*/
abstract class WebhookDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $name = null;

    /**
     * @var string|null
     */
    private $description = null;

    /**
     * @var string|null
     */
    private $uri = null;

    /**
     * @var bool|null
     */
    private $eventStart = false;

    /**
     * @var bool|null
     */
    private $eventRing = false;

    /**
     * @var bool|null
     */
    private $eventAnswer = false;

    /**
     * @var bool|null
     */
    private $eventEnd = false;

    /**
     * @var bool|null
     */
    private $eventUpdateClid = false;

    /**
     * @var string|null
     */
    private $template = null;

    /**
     * @var string|null
     */
    private $callDirection = 'both';

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var BrandDto | null
     */
    private $brand = null;

    /**
     * @var CompanyDto | null
     */
    private $company = null;

    /**
     * @var DdiDto | null
     */
    private $ddi = null;

    /**
     * @var UserDto | null
     */
    private $user = null;

    public function __construct(?int $id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'name' => 'name',
            'description' => 'description',
            'uri' => 'uri',
            'eventStart' => 'eventStart',
            'eventRing' => 'eventRing',
            'eventAnswer' => 'eventAnswer',
            'eventEnd' => 'eventEnd',
            'eventUpdateClid' => 'eventUpdateClid',
            'template' => 'template',
            'callDirection' => 'callDirection',
            'id' => 'id',
            'brandId' => 'brand',
            'companyId' => 'company',
            'ddiId' => 'ddi',
            'userId' => 'user'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'uri' => $this->getUri(),
            'eventStart' => $this->getEventStart(),
            'eventRing' => $this->getEventRing(),
            'eventAnswer' => $this->getEventAnswer(),
            'eventEnd' => $this->getEventEnd(),
            'eventUpdateClid' => $this->getEventUpdateClid(),
            'template' => $this->getTemplate(),
            'callDirection' => $this->getCallDirection(),
            'id' => $this->getId(),
            'brand' => $this->getBrand(),
            'company' => $this->getCompany(),
            'ddi' => $this->getDdi(),
            'user' => $this->getUser()
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

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setUri(string $uri): static
    {
        $this->uri = $uri;

        return $this;
    }

    public function getUri(): ?string
    {
        return $this->uri;
    }

    public function setEventStart(bool $eventStart): static
    {
        $this->eventStart = $eventStart;

        return $this;
    }

    public function getEventStart(): ?bool
    {
        return $this->eventStart;
    }

    public function setEventRing(bool $eventRing): static
    {
        $this->eventRing = $eventRing;

        return $this;
    }

    public function getEventRing(): ?bool
    {
        return $this->eventRing;
    }

    public function setEventAnswer(bool $eventAnswer): static
    {
        $this->eventAnswer = $eventAnswer;

        return $this;
    }

    public function getEventAnswer(): ?bool
    {
        return $this->eventAnswer;
    }

    public function setEventEnd(bool $eventEnd): static
    {
        $this->eventEnd = $eventEnd;

        return $this;
    }

    public function getEventEnd(): ?bool
    {
        return $this->eventEnd;
    }

    public function setEventUpdateClid(bool $eventUpdateClid): static
    {
        $this->eventUpdateClid = $eventUpdateClid;

        return $this;
    }

    public function getEventUpdateClid(): ?bool
    {
        return $this->eventUpdateClid;
    }

    public function setTemplate(string $template): static
    {
        $this->template = $template;

        return $this;
    }

    public function getTemplate(): ?string
    {
        return $this->template;
    }

    public function setCallDirection(string $callDirection): static
    {
        $this->callDirection = $callDirection;

        return $this;
    }

    public function getCallDirection(): ?string
    {
        return $this->callDirection;
    }

    /**
     * @param int|null $id
     */
    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setBrand(?BrandDto $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): ?BrandDto
    {
        return $this->brand;
    }

    public function setBrandId(?int $id): static
    {
        $value = !is_null($id)
            ? new BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    public function getBrandId(): ?int
    {
        if ($dto = $this->getBrand()) {
            return $dto->getId();
        }

        return null;
    }

    public function setCompany(?CompanyDto $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): ?CompanyDto
    {
        return $this->company;
    }

    public function setCompanyId(?int $id): static
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    public function getCompanyId(): ?int
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    public function setDdi(?DdiDto $ddi): static
    {
        $this->ddi = $ddi;

        return $this;
    }

    public function getDdi(): ?DdiDto
    {
        return $this->ddi;
    }

    public function setDdiId(?int $id): static
    {
        $value = !is_null($id)
            ? new DdiDto($id)
            : null;

        return $this->setDdi($value);
    }

    public function getDdiId(): ?int
    {
        if ($dto = $this->getDdi()) {
            return $dto->getId();
        }

        return null;
    }

    public function setUser(?UserDto $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getUser(): ?UserDto
    {
        return $this->user;
    }

    public function setUserId(?int $id): static
    {
        $value = !is_null($id)
            ? new UserDto($id)
            : null;

        return $this->setUser($value);
    }

    public function getUserId(): ?int
    {
        if ($dto = $this->getUser()) {
            return $dto->getId();
        }

        return null;
    }
}
