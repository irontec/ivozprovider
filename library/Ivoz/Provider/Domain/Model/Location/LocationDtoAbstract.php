<?php

namespace Ivoz\Provider\Domain\Model\Location;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\SurvivalDevice\SurvivalDeviceDto;
use Ivoz\Provider\Domain\Model\User\UserDto;

/**
* LocationDtoAbstract
* @codeCoverageIgnore
*/
abstract class LocationDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $name = null;

    /**
     * @var string|null
     */
    private $description = null;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var CompanyDto | null
     */
    private $company = null;

    /**
     * @var SurvivalDeviceDto | null
     */
    private $survivalDevice = null;

    /**
     * @var UserDto[] | null
     */
    private $users = null;

    public function __construct(?int $id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'name' => 'name',
            'description' => 'description',
            'id' => 'id',
            'companyId' => 'company',
            'survivalDeviceId' => 'survivalDevice'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'id' => $this->getId(),
            'company' => $this->getCompany(),
            'survivalDevice' => $this->getSurvivalDevice(),
            'users' => $this->getUsers()
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

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param int|null $id
     */
    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
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

    public function setCompanyId(?int $id): static
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    public function getCompanyId(): ?int
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    public function setSurvivalDevice(?SurvivalDeviceDto $survivalDevice): static
    {
        $this->survivalDevice = $survivalDevice;

        return $this;
    }

    public function getSurvivalDevice(): ?SurvivalDeviceDto
    {
        return $this->survivalDevice;
    }

    public function setSurvivalDeviceId(?int $id): static
    {
        $value = !is_null($id)
            ? new SurvivalDeviceDto($id)
            : null;

        return $this->setSurvivalDevice($value);
    }

    public function getSurvivalDeviceId(): ?int
    {
        if ($dto = $this->getSurvivalDevice()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param UserDto[] | null $users
     */
    public function setUsers(?array $users): static
    {
        $this->users = $users;

        return $this;
    }

    /**
    * @return UserDto[] | null
    */
    public function getUsers(): ?array
    {
        return $this->users;
    }
}
