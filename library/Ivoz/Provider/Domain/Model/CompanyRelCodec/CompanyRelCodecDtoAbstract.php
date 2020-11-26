<?php

namespace Ivoz\Provider\Domain\Model\CompanyRelCodec;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Codec\CodecDto;

/**
* CompanyRelCodecDtoAbstract
* @codeCoverageIgnore
*/
abstract class CompanyRelCodecDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var int
     */
    private $id;

    /**
     * @var CompanyDto | null
     */
    private $company;

    /**
     * @var CodecDto | null
     */
    private $codec;

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
        $response = [
            'id' => $this->getId(),
            'company' => $this->getCompany(),
            'codec' => $this->getCodec()
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

    /**
     * @param CodecDto | null
     *
     * @return static
     */
    public function setCodec(?CodecDto $codec = null): self
    {
        $this->codec = $codec;

        return $this;
    }

    /**
     * @return CodecDto | null
     */
    public function getCodec(): ?CodecDto
    {
        return $this->codec;
    }

    /**
     * @return static
     */
    public function setCodecId($id): self
    {
        $value = !is_null($id)
            ? new CodecDto($id)
            : null;

        return $this->setCodec($value);
    }

    /**
     * @return mixed | null
     */
    public function getCodecId()
    {
        if ($dto = $this->getCodec()) {
            return $dto->getId();
        }

        return null;
    }

}
