<?php

namespace Ivoz\Provider\Domain\Model\Recording;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * RecordingAbstract
 * @codeCoverageIgnore
 */
abstract class RecordingAbstract
{
    /**
     * @var string | null
     */
    protected $callid;

    /**
     * @var \DateTime
     */
    protected $calldate;

    /**
     * comment: enum:ondemand|ddi
     * @var string
     */
    protected $type = 'ddi';

    /**
     * @var float
     */
    protected $duration = 0.0;

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
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;


    use ChangelogTrait;

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
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
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
            ->setCompany($fkTransformer->transform($dto->getCompany()))
        ;

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
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
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
            ->setCompany(\Ivoz\Provider\Domain\Model\Company\Company::entityToDto(self::getCompany(), $depth));
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
    // @codeCoverageIgnoreStart

    /**
     * Set callid
     *
     * @param string $callid | null
     *
     * @return static
     */
    protected function setCallid($callid = null)
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
    public function getCallid()
    {
        return $this->callid;
    }

    /**
     * Set calldate
     *
     * @param \DateTime $calldate
     *
     * @return static
     */
    protected function setCalldate($calldate)
    {
        Assertion::notNull($calldate, 'calldate value "%s" is null, but non null value was expected.');
        $calldate = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
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
     * @return \DateTime
     */
    public function getCalldate()
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
    protected function setType($type)
    {
        Assertion::notNull($type, 'type value "%s" is null, but non null value was expected.');
        Assertion::choice($type, [
            RecordingInterface::TYPE_ONDEMAND,
            RecordingInterface::TYPE_DDI
        ], 'typevalue "%s" is not an element of the valid values: %s');

        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
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
    protected function setDuration($duration)
    {
        Assertion::notNull($duration, 'duration value "%s" is null, but non null value was expected.');
        Assertion::numeric($duration);

        $this->duration = (float) $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return float
     */
    public function getDuration()
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
    protected function setCaller($caller = null)
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
    public function getCaller()
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
    protected function setCallee($callee = null)
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
    public function getCallee()
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
    protected function setRecorder($recorder = null)
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
    public function getRecorder()
    {
        return $this->recorder;
    }

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return static
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set recordedFile
     *
     * @param \Ivoz\Provider\Domain\Model\Recording\RecordedFile $recordedFile
     *
     * @return static
     */
    protected function setRecordedFile(RecordedFile $recordedFile)
    {
        $isEqual = $this->recordedFile && $this->recordedFile->equals($recordedFile);
        if ($isEqual) {
            return $this;
        }

        $this->recordedFile = $recordedFile;
        return $this;
    }

    /**
     * Get recordedFile
     *
     * @return \Ivoz\Provider\Domain\Model\Recording\RecordedFile
     */
    public function getRecordedFile()
    {
        return $this->recordedFile;
    }
    // @codeCoverageIgnoreEnd
}
