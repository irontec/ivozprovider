<?php

namespace Ivoz\Provider\Domain\Model\BalanceMovement;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Carrier\CarrierDto;

/**
* BalanceMovementDtoAbstract
* @codeCoverageIgnore
*/
abstract class BalanceMovementDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var float | null
     */
    private $amount = 0;

    /**
     * @var float | null
     */
    private $balance = 0;

    /**
     * @var \DateTimeInterface | null
     */
    private $createdOn = 'CURRENT_TIMESTAMP';

    /**
     * @var int
     */
    private $id;

    /**
     * @var CompanyDto | null
     */
    private $company;

    /**
     * @var CarrierDto | null
     */
    private $carrier;

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
            'amount' => 'amount',
            'balance' => 'balance',
            'createdOn' => 'createdOn',
            'id' => 'id',
            'companyId' => 'company',
            'carrierId' => 'carrier'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'amount' => $this->getAmount(),
            'balance' => $this->getBalance(),
            'createdOn' => $this->getCreatedOn(),
            'id' => $this->getId(),
            'company' => $this->getCompany(),
            'carrier' => $this->getCarrier()
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
     * @param float $amount | null
     *
     * @return static
     */
    public function setAmount(?float $amount = null): self
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return float | null
     */
    public function getAmount(): ?float
    {
        return $this->amount;
    }

    /**
     * @param float $balance | null
     *
     * @return static
     */
    public function setBalance(?float $balance = null): self
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * @return float | null
     */
    public function getBalance(): ?float
    {
        return $this->balance;
    }

    /**
     * @param \DateTimeInterface $createdOn | null
     *
     * @return static
     */
    public function setCreatedOn($createdOn = null): self
    {
        $this->createdOn = $createdOn;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
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
     * @param CarrierDto | null
     *
     * @return static
     */
    public function setCarrier(?CarrierDto $carrier = null): self
    {
        $this->carrier = $carrier;

        return $this;
    }

    /**
     * @return CarrierDto | null
     */
    public function getCarrier(): ?CarrierDto
    {
        return $this->carrier;
    }

    /**
     * @return static
     */
    public function setCarrierId($id): self
    {
        $value = !is_null($id)
            ? new CarrierDto($id)
            : null;

        return $this->setCarrier($value);
    }

    /**
     * @return mixed | null
     */
    public function getCarrierId()
    {
        if ($dto = $this->getCarrier()) {
            return $dto->getId();
        }

        return null;
    }

}
