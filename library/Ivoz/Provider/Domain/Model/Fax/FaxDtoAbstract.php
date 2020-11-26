<?php

namespace Ivoz\Provider\Domain\Model\Fax;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Ddi\DdiDto;

/**
* FaxDtoAbstract
* @codeCoverageIgnore
*/
abstract class FaxDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string | null
     */
    private $email;

    /**
     * @var bool
     */
    private $sendByEmail = true;

    /**
     * @var int
     */
    private $id;

    /**
     * @var CompanyDto | null
     */
    private $company;

    /**
     * @var DdiDto | null
     */
    private $outgoingDdi;

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
            'email' => 'email',
            'sendByEmail' => 'sendByEmail',
            'id' => 'id',
            'companyId' => 'company',
            'outgoingDdiId' => 'outgoingDdi'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'sendByEmail' => $this->getSendByEmail(),
            'id' => $this->getId(),
            'company' => $this->getCompany(),
            'outgoingDdi' => $this->getOutgoingDdi()
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
     * @param string $email | null
     *
     * @return static
     */
    public function setEmail(?string $email = null): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param bool $sendByEmail | null
     *
     * @return static
     */
    public function setSendByEmail(?bool $sendByEmail = null): self
    {
        $this->sendByEmail = $sendByEmail;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getSendByEmail(): ?bool
    {
        return $this->sendByEmail;
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
     * @param DdiDto | null
     *
     * @return static
     */
    public function setOutgoingDdi(?DdiDto $outgoingDdi = null): self
    {
        $this->outgoingDdi = $outgoingDdi;

        return $this;
    }

    /**
     * @return DdiDto | null
     */
    public function getOutgoingDdi(): ?DdiDto
    {
        return $this->outgoingDdi;
    }

    /**
     * @return static
     */
    public function setOutgoingDdiId($id): self
    {
        $value = !is_null($id)
            ? new DdiDto($id)
            : null;

        return $this->setOutgoingDdi($value);
    }

    /**
     * @return mixed | null
     */
    public function getOutgoingDdiId()
    {
        if ($dto = $this->getOutgoingDdi()) {
            return $dto->getId();
        }

        return null;
    }

}
