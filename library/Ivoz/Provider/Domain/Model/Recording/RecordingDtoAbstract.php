<?php

namespace Ivoz\Provider\Domain\Model\Recording;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;

/**
* RecordingDtoAbstract
* @codeCoverageIgnore
*/
abstract class RecordingDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $callid;

    /**
     * @var \DateTimeInterface|string
     */
    private $calldate = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     */
    private $type = 'ddi';

    /**
     * @var float
     */
    private $duration = 0;

    /**
     * @var string|null
     */
    private $caller;

    /**
     * @var string|null
     */
    private $callee;

    /**
     * @var string|null
     */
    private $recorder;

    /**
     * @var int
     */
    private $id;

    /**
     * @var int|null
     */
    private $recordedFileFileSize;

    /**
     * @var string|null
     */
    private $recordedFileMimeType;

    /**
     * @var string|null
     */
    private $recordedFileBaseName;

    /**
     * @var CompanyDto | null
     */
    private $company;

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
            'callid' => 'callid',
            'calldate' => 'calldate',
            'type' => 'type',
            'duration' => 'duration',
            'caller' => 'caller',
            'callee' => 'callee',
            'recorder' => 'recorder',
            'id' => 'id',
            'recordedFile' => [
                'fileSize',
                'mimeType',
                'baseName',
            ],
            'companyId' => 'company'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'callid' => $this->getCallid(),
            'calldate' => $this->getCalldate(),
            'type' => $this->getType(),
            'duration' => $this->getDuration(),
            'caller' => $this->getCaller(),
            'callee' => $this->getCallee(),
            'recorder' => $this->getRecorder(),
            'id' => $this->getId(),
            'recordedFile' => [
                'fileSize' => $this->getRecordedFileFileSize(),
                'mimeType' => $this->getRecordedFileMimeType(),
                'baseName' => $this->getRecordedFileBaseName(),
            ],
            'company' => $this->getCompany()
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

    public function setCallid(?string $callid): static
    {
        $this->callid = $callid;

        return $this;
    }

    public function getCallid(): ?string
    {
        return $this->callid;
    }

    public function setCalldate(null|\DateTimeInterface|string $calldate): static
    {
        $this->calldate = $calldate;

        return $this;
    }

    public function getCalldate(): \DateTimeInterface|string|null
    {
        return $this->calldate;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setDuration(?float $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getDuration(): ?float
    {
        return $this->duration;
    }

    public function setCaller(?string $caller): static
    {
        $this->caller = $caller;

        return $this;
    }

    public function getCaller(): ?string
    {
        return $this->caller;
    }

    public function setCallee(?string $callee): static
    {
        $this->callee = $callee;

        return $this;
    }

    public function getCallee(): ?string
    {
        return $this->callee;
    }

    public function setRecorder(?string $recorder): static
    {
        $this->recorder = $recorder;

        return $this;
    }

    public function getRecorder(): ?string
    {
        return $this->recorder;
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

    public function setRecordedFileFileSize(?int $recordedFileFileSize): static
    {
        $this->recordedFileFileSize = $recordedFileFileSize;

        return $this;
    }

    public function getRecordedFileFileSize(): ?int
    {
        return $this->recordedFileFileSize;
    }

    public function setRecordedFileMimeType(?string $recordedFileMimeType): static
    {
        $this->recordedFileMimeType = $recordedFileMimeType;

        return $this;
    }

    public function getRecordedFileMimeType(): ?string
    {
        return $this->recordedFileMimeType;
    }

    public function setRecordedFileBaseName(?string $recordedFileBaseName): static
    {
        $this->recordedFileBaseName = $recordedFileBaseName;

        return $this;
    }

    public function getRecordedFileBaseName(): ?string
    {
        return $this->recordedFileBaseName;
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

    public function setCompanyId($id): static
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }
}
