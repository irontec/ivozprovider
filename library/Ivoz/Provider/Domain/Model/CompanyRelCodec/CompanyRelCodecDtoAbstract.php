<?php

namespace Ivoz\Provider\Domain\Model\CompanyRelCodec;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class CompanyRelCodecDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyDto | null
     */
    private $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Codec\CodecDto | null
     */
    private $codec;


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
            'id' => 'id',
            'companyId' => 'company',
            'codecId' => 'codec'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'id' => $this->getId(),
            'company' => $this->getCompany(),
            'codec' => $this->getCodec()
        ];
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

    /**
     * @param \Ivoz\Provider\Domain\Model\Codec\CodecDto $codec
     *
     * @return static
     */
    public function setCodec(\Ivoz\Provider\Domain\Model\Codec\CodecDto $codec = null)
    {
        $this->codec = $codec;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Codec\CodecDto
     */
    public function getCodec()
    {
        return $this->codec;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setCodecId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Codec\CodecDto($id)
            : null;

        return $this->setCodec($value);
    }

    /**
     * @return integer | null
     */
    public function getCodecId()
    {
        if ($dto = $this->getCodec()) {
            return $dto->getId();
        }

        return null;
    }
}
