<?php

namespace Ivoz\Provider\Domain\Model\Recording;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class RecordingDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $callid;

    /**
     * @var \DateTime
     */
    private $calldate = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     */
    private $type = 'ddi';

    /**
     * @var float
     */
    private $duration = 0.0;

    /**
     * @var string
     */
    private $caller;

    /**
     * @var string
     */
    private $callee;

    /**
     * @var string
     */
    private $recorder;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $recordedFileFileSize;

    /**
     * @var string
     */
    private $recordedFileMimeType;

    /**
     * @var string
     */
    private $recordedFileBaseName;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyDto | null
     */
    private $company;


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
            'callid' => 'callid',
            'calldate' => 'calldate',
            'type' => 'type',
            'duration' => 'duration',
            'caller' => 'caller',
            'callee' => 'callee',
            'recorder' => 'recorder',
            'id' => 'id',
            'recordedFile' => ['fileSize','mimeType','baseName'],
            'companyId' => 'company'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
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
                'baseName' => $this->getRecordedFileBaseName()
            ],
            'company' => $this->getCompany()
        ];
    }

    /**
     * @param string $callid
     *
     * @return static
     */
    public function setCallid($callid = null)
    {
        $this->callid = $callid;

        return $this;
    }

    /**
     * @return string
     */
    public function getCallid()
    {
        return $this->callid;
    }

    /**
     * @param \DateTime $calldate
     *
     * @return static
     */
    public function setCalldate($calldate = null)
    {
        $this->calldate = $calldate;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCalldate()
    {
        return $this->calldate;
    }

    /**
     * @param string $type
     *
     * @return static
     */
    public function setType($type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param float $duration
     *
     * @return static
     */
    public function setDuration($duration = null)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return float
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param string $caller
     *
     * @return static
     */
    public function setCaller($caller = null)
    {
        $this->caller = $caller;

        return $this;
    }

    /**
     * @return string
     */
    public function getCaller()
    {
        return $this->caller;
    }

    /**
     * @param string $callee
     *
     * @return static
     */
    public function setCallee($callee = null)
    {
        $this->callee = $callee;

        return $this;
    }

    /**
     * @return string
     */
    public function getCallee()
    {
        return $this->callee;
    }

    /**
     * @param string $recorder
     *
     * @return static
     */
    public function setRecorder($recorder = null)
    {
        $this->recorder = $recorder;

        return $this;
    }

    /**
     * @return string
     */
    public function getRecorder()
    {
        return $this->recorder;
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
     * @param integer $recordedFileFileSize
     *
     * @return static
     */
    public function setRecordedFileFileSize($recordedFileFileSize = null)
    {
        $this->recordedFileFileSize = $recordedFileFileSize;

        return $this;
    }

    /**
     * @return integer
     */
    public function getRecordedFileFileSize()
    {
        return $this->recordedFileFileSize;
    }

    /**
     * @param string $recordedFileMimeType
     *
     * @return static
     */
    public function setRecordedFileMimeType($recordedFileMimeType = null)
    {
        $this->recordedFileMimeType = $recordedFileMimeType;

        return $this;
    }

    /**
     * @return string
     */
    public function getRecordedFileMimeType()
    {
        return $this->recordedFileMimeType;
    }

    /**
     * @param string $recordedFileBaseName
     *
     * @return static
     */
    public function setRecordedFileBaseName($recordedFileBaseName = null)
    {
        $this->recordedFileBaseName = $recordedFileBaseName;

        return $this;
    }

    /**
     * @return string
     */
    public function getRecordedFileBaseName()
    {
        return $this->recordedFileBaseName;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyDto $company
     *
     * @return static
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyDto $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyDto
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setCompanyId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Company\CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    /**
     * @return integer | null
     */
    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }
}
