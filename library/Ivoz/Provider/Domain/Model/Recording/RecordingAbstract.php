<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\Recording;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
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
     * @var string | null
     */
    protected $callid;

    /**
     * @var \DateTimeInterface
     */
    protected $calldate = 'CURRENT_TIMESTAMP';

    /**
     * comment: enum:ondemand|ddi
     * @var string
     */
    protected $type = 'ddi';

    /**
     * @var float
     */
    protected $duration = 0;

    /**
     * @var string | null
     */
    protected $caller;

    /**
     * @var string | null
     */
    protected $callee;

    /**
     * @var string | null
     */
    protected $recorder;

    /**
     * @var RecordedFile | null
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
        $calldate,
        $type,
        $duration,
        RecordedFile $recordedFile
    ) {
        $this->setCalldate($calldate);
        $this->setType($type);
        $this->setDuration($duration);
        $this->setRecordedFile($recordedFile);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "Recording",
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
     * @return RecordingDto
     */
    public static function createDto($id = null)
    {
        return new RecordingDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param RecordingInterface|null $entity
     * @param int $depth
     * @return RecordingDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
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

        /** @var RecordingDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param RecordingDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, RecordingDto::class);

        $recordedFile = new RecordedFile(
            $dto->getRecordedFileFileSize(),
            $dto->getRecordedFileMimeType(),
            $dto->getRecordedFileBaseName()
        );

        $self = new static(
            $dto->getCalldate(),
            $dto->getType(),
            $dto->getDuration(),
            $recordedFile
        );

        $self
            ->setCallid($dto->getCallid())
            ->setCaller($dto->getCaller())
            ->setCallee($dto->getCallee())
            ->setRecorder($dto->getRecorder())
            ->setCompany($fkTransformer->transform($dto->getCompany()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param RecordingDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, RecordingDto::class);

        $recordedFile = new RecordedFile(
            $dto->getRecordedFileFileSize(),
            $dto->getRecordedFileMimeType(),
            $dto->getRecordedFileBaseName()
        );

        $this
            ->setCallid($dto->getCallid())
            ->setCalldate($dto->getCalldate())
            ->setType($dto->getType())
            ->setDuration($dto->getDuration())
            ->setCaller($dto->getCaller())
            ->setCallee($dto->getCallee())
            ->setRecorder($dto->getRecorder())
            ->setRecordedFile($recordedFile)
            ->setCompany($fkTransformer->transform($dto->getCompany()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return RecordingDto
     */
    public function toDto($depth = 0)
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
     * @return array
     */
    protected function __toArray()
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

    /**
     * Set callid
     *
     * @param string $callid | null
     *
     * @return static
     */
    protected function setCallid(?string $callid = null): RecordingInterface
    {
        if (!is_null($callid)) {
            Assertion::maxLength($callid, 255, 'callid value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->callid = $callid;

        return $this;
    }

    /**
     * Get callid
     *
     * @return string | null
     */
    public function getCallid(): ?string
    {
        return $this->callid;
    }

    /**
     * Set calldate
     *
     * @param \DateTimeInterface $calldate
     *
     * @return static
     */
    protected function setCalldate($calldate): RecordingInterface
    {

        $calldate = DateTimeHelper::createOrFix(
            $calldate,
            'CURRENT_TIMESTAMP'
        );

        if ($this->calldate == $calldate) {
            return $this;
        }

        $this->calldate = $calldate;

        return $this;
    }

    /**
     * Get calldate
     *
     * @return \DateTimeInterface
     */
    public function getCalldate(): \DateTimeInterface
    {
        return clone $this->calldate;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return static
     */
    protected function setType(string $type): RecordingInterface
    {
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

    /**
     * Get type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set duration
     *
     * @param float $duration
     *
     * @return static
     */
    protected function setDuration(float $duration): RecordingInterface
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return float
     */
    public function getDuration(): float
    {
        return $this->duration;
    }

    /**
     * Set caller
     *
     * @param string $caller | null
     *
     * @return static
     */
    protected function setCaller(?string $caller = null): RecordingInterface
    {
        if (!is_null($caller)) {
            Assertion::maxLength($caller, 128, 'caller value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->caller = $caller;

        return $this;
    }

    /**
     * Get caller
     *
     * @return string | null
     */
    public function getCaller(): ?string
    {
        return $this->caller;
    }

    /**
     * Set callee
     *
     * @param string $callee | null
     *
     * @return static
     */
    protected function setCallee(?string $callee = null): RecordingInterface
    {
        if (!is_null($callee)) {
            Assertion::maxLength($callee, 128, 'callee value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->callee = $callee;

        return $this;
    }

    /**
     * Get callee
     *
     * @return string | null
     */
    public function getCallee(): ?string
    {
        return $this->callee;
    }

    /**
     * Set recorder
     *
     * @param string $recorder | null
     *
     * @return static
     */
    protected function setRecorder(?string $recorder = null): RecordingInterface
    {
        if (!is_null($recorder)) {
            Assertion::maxLength($recorder, 128, 'recorder value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->recorder = $recorder;

        return $this;
    }

    /**
     * Get recorder
     *
     * @return string | null
     */
    public function getRecorder(): ?string
    {
        return $this->recorder;
    }

    /**
     * Get recordedFile
     *
     * @return RecordedFile
     */
    public function getRecordedFile(): RecordedFile
    {
        return $this->recordedFile;
    }

    /**
     * Set recordedFile
     *
     * @return static
     */
    protected function setRecordedFile(RecordedFile $recordedFile): RecordingInterface
    {
        $isEqual = $this->recordedFile && $this->recordedFile->equals($recordedFile);
        if ($isEqual) {
            return $this;
        }

        $this->recordedFile = $recordedFile;
        return $this;
    }

    /**
     * Set company
     *
     * @param CompanyInterface
     *
     * @return static
     */
    public function setCompany(CompanyInterface $company): RecordingInterface
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return CompanyInterface
     */
    public function getCompany(): CompanyInterface
    {
        return $this->company;
    }

}
