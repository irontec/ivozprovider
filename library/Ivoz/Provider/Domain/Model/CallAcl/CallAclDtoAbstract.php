<?php

namespace Ivoz\Provider\Domain\Model\CallAcl;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\CallAclRelMatchList\CallAclRelMatchListDto;

/**
* CallAclDtoAbstract
* @codeCoverageIgnore
*/
abstract class CallAclDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $defaultPolicy;

    /**
     * @var int
     */
    private $id;

    /**
     * @var CompanyDto | null
     */
    private $company;

    /**
     * @var CallAclRelMatchListDto[] | null
     */
    private $relMatchLists;

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
            'defaultPolicy' => 'defaultPolicy',
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
            'defaultPolicy' => $this->getDefaultPolicy(),
            'id' => $this->getId(),
            'company' => $this->getCompany(),
            'relMatchLists' => $this->getRelMatchLists()
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
     * @param string $defaultPolicy | null
     *
     * @return static
     */
    public function setDefaultPolicy(?string $defaultPolicy = null): self
    {
        $this->defaultPolicy = $defaultPolicy;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDefaultPolicy(): ?string
    {
        return $this->defaultPolicy;
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
     * @param CallAclRelMatchListDto[] | null
     *
     * @return static
     */
    public function setRelMatchLists(?array $relMatchLists = null): self
    {
        $this->relMatchLists = $relMatchLists;

        return $this;
    }

    /**
     * @return CallAclRelMatchListDto[] | null
     */
    public function getRelMatchLists(): ?array
    {
        return $this->relMatchLists;
    }

}
