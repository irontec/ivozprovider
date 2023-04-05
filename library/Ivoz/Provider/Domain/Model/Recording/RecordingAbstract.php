<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Recording;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\Recording\RecordedFile;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Company\Company;

/**
* RecordingAbstract
* @codeCoverageIgnore
*/
abstract class RecordingAbstract
{
    use ChangelogTrait;

    /**
     * @var ?string
     */
    protected $callid = null;

    /**
     * @var \DateTime
     */
    protected $calldate;

    /**
     * @var string
     * comment: enum:ondemand|ddi
     */
    protected $type = 'ddi';

    /**
     * @var float
     */
    protected $duration = 0;

    /**
     * @var ?string
     */
    protected $caller = null;

    /**
     * @var ?string
     */
    protected $callee = null;

    /**
     * @var ?string
     */
    protected $recorder = null;

    /**
     * @var RecordedFile
     */
    protected $recordedFile;

    /**
     * @var CompanyInterface
     * inversedBy recordings
     */
    protected $company;

    /**
     * Constructor
     */
    protected function __construct(
        \DateTimeInterface|string $calldate,
        string $type,
        float $duration,
        RecordedFile $recordedFile
    ) {
        $this->setCalldate($calldate);
        $this->setType($type);
        $this->setDuration($duration);
        $this->recordedFile = $recordedFile;
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "Recording",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): RecordingDto
    {
        return new RecordingDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|RecordingInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?RecordingDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, RecordingInterface::class);

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
     * @param RecordingDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, RecordingDto::class);
        $calldate = $dto->getCalldate();
        Assertion::notNull($calldate, 'getCalldate value is null, but non null value was expected.');
        $type = $dto->getType();
        Assertion::notNull($type, 'getType value is null, but non null value was expected.');
        $duration = $dto->getDuration();
        Assertion::notNull($duration, 'getDuration value is null, but non null value was expected.');
        $company = $dto->getCompany();
        Assertion::notNull($company, 'getCompany value is null, but non null value was expected.');

        $recordedFile = new RecordedFile(
            $dto->getRecordedFileFileSize(),
            $dto->getRecordedFileMimeType(),
            $dto->getRecordedFileBaseName()
        );

        $self = new static(
            $calldate,
            $type,
            $duration,
            $recordedFile
        );

        $self
            ->setCallid($dto->getCallid())
            ->setCaller($dto->getCaller())
            ->setCallee($dto->getCallee())
            ->setRecorder($dto->getRecorder())
            ->setCompany($fkTransformer->transform($company));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param RecordingDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, RecordingDto::class);

        $calldate = $dto->getCalldate();
        Assertion::notNull($calldate, 'getCalldate value is null, but non null value was expected.');
        $type = $dto->getType();
        Assertion::notNull($type, 'getType value is null, but non null value was expected.');
        $duration = $dto->getDuration();
        Assertion::notNull($duration, 'getDuration value is null, but non null value was expected.');
        $company = $dto->getCompany();
        Assertion::notNull($company, 'getCompany value is null, but non null value was expected.');

        $recordedFile = new RecordedFile(
            $dto->getRecordedFileFileSize(),
            $dto->getRecordedFileMimeType(),
            $dto->getRecordedFileBaseName()
        );

        $this
            ->setCallid($dto->getCallid())
            ->setCalldate($calldate)
            ->setType($type)
            ->setDuration($duration)
            ->setCaller($dto->getCaller())
            ->setCallee($dto->getCallee())
            ->setRecorder($dto->getRecorder())
            ->setRecordedFile($recordedFile)
            ->setCompany($fkTransformer->transform($company));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): RecordingDto
    {
        return self::createDto()
            ->setCallid(self::getCallid())
            ->setCalldate(self::getCalldate())
            ->setType(self::getType())
            ->setDuration(self::getDuration())
            ->setCaller(self::getCaller())
            ->setCallee(self::getCallee())
            ->setRecorder(self::getRecorder())
            ->setRecordedFileFileSize(self::getRecordedFile()->getFileSize())
            ->setRecordedFileMimeType(self::getRecordedFile()->getMimeType())
            ->setRecordedFileBaseName(self::getRecordedFile()->getBaseName())
            ->setCompany(Company::entityToDto(self::getCompany(), $depth));
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'callid' => self::getCallid(),
            'calldate' => self::getCalldate(),
            'type' => self::getType(),
            'duration' => self::getDuration(),
            'caller' => self::getCaller(),
            'callee' => self::getCallee(),
            'recorder' => self::getRecorder(),
            'recordedFileFileSize' => self::getRecordedFile()->getFileSize(),
            'recordedFileMimeType' => self::getRecordedFile()->getMimeType(),
            'recordedFileBaseName' => self::getRecordedFile()->getBaseName(),
            'companyId' => self::getCompany()->getId()
        ];
    }

    protected function setCallid(?string $callid = null): static
    {
        if (!is_null($callid)) {
            Assertion::maxLength($callid, 255, 'callid value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->callid = $callid;

        return $this;
    }

    public function getCallid(): ?string
    {
        return $this->callid;
    }

    protected function setCalldate(string|\DateTimeInterface $calldate): static
    {

        /** @var \DateTime */
        $calldate = DateTimeHelper::createOrFix(
            $calldate,
            'CURRENT_TIMESTAMP'
        );

        if ($this->isInitialized() && $this->calldate == $calldate) {
            return $this;
        }

        $this->calldate = $calldate;

        return $this;
    }

    public function getCalldate(): \DateTime
    {
        return clone $this->calldate;
    }

    protected function setType(string $type): static
    {
        Assertion::maxLength($type, 25, 'type value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice(
            $type,
            [
                RecordingInterface::TYPE_ONDEMAND,
                RecordingInterface::TYPE_DDI,
            ],
            'typevalue "%s" is not an element of the valid values: %s'
        );

        $this->type = $type;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    protected function setDuration(float $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getDuration(): float
    {
        return $this->duration;
    }

    protected function setCaller(?string $caller = null): static
    {
        if (!is_null($caller)) {
            Assertion::maxLength($caller, 128, 'caller value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->caller = $caller;

        return $this;
    }

    public function getCaller(): ?string
    {
        return $this->caller;
    }

    protected function setCallee(?string $callee = null): static
    {
        if (!is_null($callee)) {
            Assertion::maxLength($callee, 128, 'callee value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->callee = $callee;

        return $this;
    }

    public function getCallee(): ?string
    {
        return $this->callee;
    }

    protected function setRecorder(?string $recorder = null): static
    {
        if (!is_null($recorder)) {
            Assertion::maxLength($recorder, 128, 'recorder value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->recorder = $recorder;

        return $this;
    }

    public function getRecorder(): ?string
    {
        return $this->recorder;
    }

    public function getRecordedFile(): RecordedFile
    {
        return $this->recordedFile;
    }

    protected function setRecordedFile(RecordedFile $recordedFile): static
    {
        $isEqual = $this->recordedFile->equals($recordedFile);
        if ($isEqual) {
            return $this;
        }

        $this->recordedFile = $recordedFile;
        return $this;
    }

    public function setCompany(CompanyInterface $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): CompanyInterface
    {
        return $this->company;
    }
}
