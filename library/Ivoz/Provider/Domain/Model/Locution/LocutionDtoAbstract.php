<?php

namespace Ivoz\Provider\Domain\Model\Locution;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class LocutionDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $status;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $encodedFileFileSize;

    /**
     * @var string
     */
    private $encodedFileMimeType;

    /**
     * @var string
     */
    private $encodedFileBaseName;

    /**
     * @var integer
     */
    private $originalFileFileSize;

    /**
     * @var string
     */
    private $originalFileMimeType;

    /**
     * @var string
     */
    private $originalFileBaseName;

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
            'name' => 'name',
            'status' => 'status',
            'id' => 'id',
            'encodedFile' => ['fileSize','mimeType','baseName'],
            'originalFile' => ['fileSize','mimeType','baseName'],
            'companyId' => 'company'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'name' => $this->getName(),
            'status' => $this->getStatus(),
            'id' => $this->getId(),
            'encodedFile' => [
                'fileSize' => $this->getEncodedFileFileSize(),
                'mimeType' => $this->getEncodedFileMimeType(),
                'baseName' => $this->getEncodedFileBaseName()
            ],
            'originalFile' => [
                'fileSize' => $this->getOriginalFileFileSize(),
                'mimeType' => $this->getOriginalFileMimeType(),
                'baseName' => $this->getOriginalFileBaseName()
            ],
            'company' => $this->getCompany()
        ];
    }

    /**
     * @param string $name
     *
     * @return static
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $status
     *
     * @return static
     */
    public function setStatus($status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
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
     * @param integer $encodedFileFileSize
     *
     * @return static
     */
    public function setEncodedFileFileSize($encodedFileFileSize = null)
    {
        $this->encodedFileFileSize = $encodedFileFileSize;

        return $this;
    }

    /**
     * @return integer
     */
    public function getEncodedFileFileSize()
    {
        return $this->encodedFileFileSize;
    }

    /**
     * @param string $encodedFileMimeType
     *
     * @return static
     */
    public function setEncodedFileMimeType($encodedFileMimeType = null)
    {
        $this->encodedFileMimeType = $encodedFileMimeType;

        return $this;
    }

    /**
     * @return string
     */
    public function getEncodedFileMimeType()
    {
        return $this->encodedFileMimeType;
    }

    /**
     * @param string $encodedFileBaseName
     *
     * @return static
     */
    public function setEncodedFileBaseName($encodedFileBaseName = null)
    {
        $this->encodedFileBaseName = $encodedFileBaseName;

        return $this;
    }

    /**
     * @return string
     */
    public function getEncodedFileBaseName()
    {
        return $this->encodedFileBaseName;
    }

    /**
     * @param integer $originalFileFileSize
     *
     * @return static
     */
    public function setOriginalFileFileSize($originalFileFileSize = null)
    {
        $this->originalFileFileSize = $originalFileFileSize;

        return $this;
    }

    /**
     * @return integer
     */
    public function getOriginalFileFileSize()
    {
        return $this->originalFileFileSize;
    }

    /**
     * @param string $originalFileMimeType
     *
     * @return static
     */
    public function setOriginalFileMimeType($originalFileMimeType = null)
    {
        $this->originalFileMimeType = $originalFileMimeType;

        return $this;
    }

    /**
     * @return string
     */
    public function getOriginalFileMimeType()
    {
        return $this->originalFileMimeType;
    }

    /**
     * @param string $originalFileBaseName
     *
     * @return static
     */
    public function setOriginalFileBaseName($originalFileBaseName = null)
    {
        $this->originalFileBaseName = $originalFileBaseName;

        return $this;
    }

    /**
     * @return string
     */
    public function getOriginalFileBaseName()
    {
        return $this->originalFileBaseName;
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
