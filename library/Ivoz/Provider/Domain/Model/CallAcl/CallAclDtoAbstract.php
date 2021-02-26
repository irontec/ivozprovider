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
    private $name = '';

    /**
     * @var string
     */
    private $defaultPolicy = '';

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

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setDefaultPolicy(?string $defaultPolicy): static
    {
        $this->defaultPolicy = $defaultPolicy;

        return $this;
    }

    public function getDefaultPolicy(): ?string
    {
        return $this->defaultPolicy;
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

    public function setRelMatchLists(?array $relMatchLists): static
    {
        $this->relMatchLists = $relMatchLists;

        return $this;
    }

    public function getRelMatchLists(): ?array
    {
        return $this->relMatchLists;
    }

}
