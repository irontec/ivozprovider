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
     * @var string | null
     */
    private $callid;

    /**
     * @var \DateTimeInterface
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
     * @var string | null
     */
    private $caller;

    /**
     * @var string | null
     */
    private $callee;

    /**
     * @var string | null
     */
    private $recorder;

    /**
     * @var int
     */
    private $id;

    /**
     * @var int | null
     */
    private $recordedFileFileSize;

    /**
     * @var string | null
     */
    private $recordedFileMimeType;

    /**
     * @var string | null
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

    /**
     * @param string $callid | null
     *
     * @return static
     */
    public function setCallid(?string $callid = null): self
    {
        $this->callid = $callid;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCallid(): ?string
    {
        return $this->callid;
    }

    /**
     * @param \DateTimeInterface $calldate | null
     *
     * @return static
     */
    public function setCalldate($calldate = null): self
    {
        $this->calldate = $calldate;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getCalldate()
    {
        return $this->calldate;
    }

    /**
     * @param string $type | null
     *
     * @return static
     */
    public function setType(?string $type = null): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param float $duration | null
     *
     * @return static
     */
    public function setDuration(?float $duration = null): self
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return float | null
     */
    public function getDuration(): ?float
    {
        return $this->duration;
    }

    /**
     * @param string $caller | null
     *
     * @return static
     */
    public function setCaller(?string $caller = null): self
    {
        $this->caller = $caller;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCaller(): ?string
    {
        return $this->caller;
    }

    /**
     * @param string $callee | null
     *
     * @return static
     */
    public function setCallee(?string $callee = null): self
    {
        $this->callee = $callee;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCallee(): ?string
    {
        return $this->callee;
    }

    /**
     * @param string $recorder | null
     *
     * @return static
     */
    public function setRecorder(?string $recorder = null): self
    {
        $this->recorder = $recorder;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRecorder(): ?string
    {
        return $this->recorder;
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
     * @param int $recordedFileFileSize | null
     *
     * @return static
     */
    public function setRecordedFileFileSize(?int $recordedFileFileSize = null): self
    {
        $this->recordedFileFileSize = $recordedFileFileSize;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getRecordedFileFileSize(): ?int
    {
        return $this->recordedFileFileSize;
    }

    /**
     * @param string $recordedFileMimeType | null
     *
     * @return static
     */
    public function setRecordedFileMimeType(?string $recordedFileMimeType = null): self
    {
        $this->recordedFileMimeType = $recordedFileMimeType;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRecordedFileMimeType(): ?string
    {
        return $this->recordedFileMimeType;
    }

    /**
     * @param string $recordedFileBaseName | null
     *
     * @return static
     */
    public function setRecordedFileBaseName(?string $recordedFileBaseName = null): self
    {
        $this->recordedFileBaseName = $recordedFileBaseName;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRecordedFileBaseName(): ?string
    {
        return $this->recordedFileBaseName;
    }

    /**
     * @param CompanyDto | null
     *
     * @return static
     */
    public function setCompany(?CompanyDto $company = null): self
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return CompanyDto | null
     */
    public function getCompany(): ?CompanyDto
    {
        return $this->company;
    }

    /**
     * @return static
     */
    public function setCompanyId($id): self
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    /**
     * @return mixed | null
     */
    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

}
