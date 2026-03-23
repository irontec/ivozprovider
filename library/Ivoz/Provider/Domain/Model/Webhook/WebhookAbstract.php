<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Webhook;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Ddi\Ddi;

/**
* WebhookAbstract
* @codeCoverageIgnore
*/
abstract class WebhookAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var ?string
     */
    protected $description = null;

    /**
     * @var string
     * column: URI
     */
    protected $uri;

    /**
     * @var bool
     */
    protected $eventStart = false;

    /**
     * @var bool
     */
    protected $eventRing = false;

    /**
     * @var bool
     */
    protected $eventAnswer = false;

    /**
     * @var bool
     */
    protected $eventEnd = false;

    /**
     * @var string
     */
    protected $template;

    /**
     * @var BrandInterface
     */
    protected $brand;

    /**
     * @var ?CompanyInterface
     */
    protected $company = null;

    /**
     * @var ?DdiInterface
     */
    protected $ddi = null;

    /**
     * Constructor
     */
    protected function __construct(
        string $name,
        string $uri,
        bool $eventStart,
        bool $eventRing,
        bool $eventAnswer,
        bool $eventEnd,
        string $template
    ) {
        $this->setName($name);
        $this->setUri($uri);
        $this->setEventStart($eventStart);
        $this->setEventRing($eventRing);
        $this->setEventAnswer($eventAnswer);
        $this->setEventEnd($eventEnd);
        $this->setTemplate($template);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "Webhook",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    /**
     * @param int | null $id
     */
    public static function createDto($id = null): WebhookDto
    {
        return new WebhookDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|WebhookInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?WebhookDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, WebhookInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param WebhookDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, WebhookDto::class);
        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $uri = $dto->getUri();
        Assertion::notNull($uri, 'getUri value is null, but non null value was expected.');
        $eventStart = $dto->getEventStart();
        Assertion::notNull($eventStart, 'getEventStart value is null, but non null value was expected.');
        $eventRing = $dto->getEventRing();
        Assertion::notNull($eventRing, 'getEventRing value is null, but non null value was expected.');
        $eventAnswer = $dto->getEventAnswer();
        Assertion::notNull($eventAnswer, 'getEventAnswer value is null, but non null value was expected.');
        $eventEnd = $dto->getEventEnd();
        Assertion::notNull($eventEnd, 'getEventEnd value is null, but non null value was expected.');
        $template = $dto->getTemplate();
        Assertion::notNull($template, 'getTemplate value is null, but non null value was expected.');
        $brand = $dto->getBrand();
        Assertion::notNull($brand, 'getBrand value is null, but non null value was expected.');

        $self = new static(
            $name,
            $uri,
            $eventStart,
            $eventRing,
            $eventAnswer,
            $eventEnd,
            $template
        );

        $self
            ->setDescription($dto->getDescription())
            ->setBrand($fkTransformer->transform($brand))
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setDdi($fkTransformer->transform($dto->getDdi()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param WebhookDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, WebhookDto::class);

        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $uri = $dto->getUri();
        Assertion::notNull($uri, 'getUri value is null, but non null value was expected.');
        $eventStart = $dto->getEventStart();
        Assertion::notNull($eventStart, 'getEventStart value is null, but non null value was expected.');
        $eventRing = $dto->getEventRing();
        Assertion::notNull($eventRing, 'getEventRing value is null, but non null value was expected.');
        $eventAnswer = $dto->getEventAnswer();
        Assertion::notNull($eventAnswer, 'getEventAnswer value is null, but non null value was expected.');
        $eventEnd = $dto->getEventEnd();
        Assertion::notNull($eventEnd, 'getEventEnd value is null, but non null value was expected.');
        $template = $dto->getTemplate();
        Assertion::notNull($template, 'getTemplate value is null, but non null value was expected.');
        $brand = $dto->getBrand();
        Assertion::notNull($brand, 'getBrand value is null, but non null value was expected.');

        $this
            ->setName($name)
            ->setDescription($dto->getDescription())
            ->setUri($uri)
            ->setEventStart($eventStart)
            ->setEventRing($eventRing)
            ->setEventAnswer($eventAnswer)
            ->setEventEnd($eventEnd)
            ->setTemplate($template)
            ->setBrand($fkTransformer->transform($brand))
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setDdi($fkTransformer->transform($dto->getDdi()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): WebhookDto
    {
        return self::createDto()
            ->setName(self::getName())
            ->setDescription(self::getDescription())
            ->setUri(self::getUri())
            ->setEventStart(self::getEventStart())
            ->setEventRing(self::getEventRing())
            ->setEventAnswer(self::getEventAnswer())
            ->setEventEnd(self::getEventEnd())
            ->setTemplate(self::getTemplate())
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth))
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setDdi(Ddi::entityToDto(self::getDdi(), $depth));
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'name' => self::getName(),
            'description' => self::getDescription(),
            'URI' => self::getUri(),
            'eventStart' => self::getEventStart(),
            'eventRing' => self::getEventRing(),
            'eventAnswer' => self::getEventAnswer(),
            'eventEnd' => self::getEventEnd(),
            'template' => self::getTemplate(),
            'brandId' => self::getBrand()->getId(),
            'companyId' => self::getCompany()?->getId(),
            'ddiId' => self::getDdi()?->getId()
        ];
    }

    protected function setName(string $name): static
    {
        Assertion::maxLength($name, 64, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    protected function setDescription(?string $description = null): static
    {
        if (!is_null($description)) {
            Assertion::maxLength($description, 255, 'description value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->description = $description;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    protected function setUri(string $uri): static
    {
        $this->uri = $uri;

        return $this;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    protected function setEventStart(bool $eventStart): static
    {
        $this->eventStart = $eventStart;

        return $this;
    }

    public function getEventStart(): bool
    {
        return $this->eventStart;
    }

    protected function setEventRing(bool $eventRing): static
    {
        $this->eventRing = $eventRing;

        return $this;
    }

    public function getEventRing(): bool
    {
        return $this->eventRing;
    }

    protected function setEventAnswer(bool $eventAnswer): static
    {
        $this->eventAnswer = $eventAnswer;

        return $this;
    }

    public function getEventAnswer(): bool
    {
        return $this->eventAnswer;
    }

    protected function setEventEnd(bool $eventEnd): static
    {
        $this->eventEnd = $eventEnd;

        return $this;
    }

    public function getEventEnd(): bool
    {
        return $this->eventEnd;
    }

    protected function setTemplate(string $template): static
    {
        $this->template = $template;

        return $this;
    }

    public function getTemplate(): string
    {
        return $this->template;
    }

    protected function setBrand(BrandInterface $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): BrandInterface
    {
        return $this->brand;
    }

    protected function setCompany(?CompanyInterface $company = null): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): ?CompanyInterface
    {
        return $this->company;
    }

    protected function setDdi(?DdiInterface $ddi = null): static
    {
        $this->ddi = $ddi;

        return $this;
    }

    public function getDdi(): ?DdiInterface
    {
        return $this->ddi;
    }
}
