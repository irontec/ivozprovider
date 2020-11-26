<?php

namespace Ivoz\Provider\Domain\Model\ConferenceRoom;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;

/**
* ConferenceRoomDtoAbstract
* @codeCoverageIgnore
*/
abstract class ConferenceRoomDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $name;

    /**
     * @var bool
     */
    private $pinProtected = false;

    /**
     * @var string | null
     */
    private $pinCode;

    /**
     * @var int
     */
    private $maxMembers = 0;

    /**
     * @var int
     */
    private $id;

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
            'name' => 'name',
            'pinProtected' => 'pinProtected',
            'pinCode' => 'pinCode',
            'maxMembers' => 'maxMembers',
            'id' => 'id',
            'companyId' => 'company'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'name' => $this->getName(),
            'pinProtected' => $this->getPinProtected(),
            'pinCode' => $this->getPinCode(),
            'maxMembers' => $this->getMaxMembers(),
            'id' => $this->getId(),
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
     * @param string $name | null
     *
     * @return static
     */
    public function setName(?string $name = null): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param bool $pinProtected | null
     *
     * @return static
     */
    public function setPinProtected(?bool $pinProtected = null): self
    {
        $this->pinProtected = $pinProtected;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getPinProtected(): ?bool
    {
        return $this->pinProtected;
    }

    /**
     * @param string $pinCode | null
     *
     * @return static
     */
    public function setPinCode(?string $pinCode = null): self
    {
        $this->pinCode = $pinCode;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getPinCode(): ?string
    {
        return $this->pinCode;
    }

    /**
     * @param int $maxMembers | null
     *
     * @return static
     */
    public function setMaxMembers(?int $maxMembers = null): self
    {
        $this->maxMembers = $maxMembers;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getMaxMembers(): ?int
    {
        return $this->maxMembers;
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

}
