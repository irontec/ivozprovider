<?php

namespace Ivoz\Provider\Domain\Model\OutgoingDdiRule;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Ddi\DdiDto;
use Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern\OutgoingDdiRulesPatternDto;

/**
* OutgoingDdiRuleDtoAbstract
* @codeCoverageIgnore
*/
abstract class OutgoingDdiRuleDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $defaultAction;

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
    private $forcedDdi;

    /**
     * @var OutgoingDdiRulesPatternDto[] | null
     */
    private $patterns;

    public function __construct($id = null)
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
            'defaultAction' => 'defaultAction',
            'id' => 'id',
            'companyId' => 'company',
            'forcedDdiId' => 'forcedDdi'
        ];
    }

    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'name' => $this->getName(),
            'defaultAction' => $this->getDefaultAction(),
            'id' => $this->getId(),
            'company' => $this->getCompany(),
            'forcedDdi' => $this->getForcedDdi(),
            'patterns' => $this->getPatterns()
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

    public function setDefaultAction(string $defaultAction): static
    {
        $this->defaultAction = $defaultAction;

        return $this;
    }

    public function getDefaultAction(): ?string
    {
        return $this->defaultAction;
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

    public function setForcedDdi(?DdiDto $forcedDdi): static
    {
        $this->forcedDdi = $forcedDdi;

        return $this;
    }

    public function getForcedDdi(): ?DdiDto
    {
        return $this->forcedDdi;
    }

    public function setForcedDdiId($id): static
    {
        $value = !is_null($id)
            ? new DdiDto($id)
            : null;

        return $this->setForcedDdi($value);
    }

    public function getForcedDdiId()
    {
        if ($dto = $this->getForcedDdi()) {
            return $dto->getId();
        }

        return null;
    }

    public function setPatterns(?array $patterns): static
    {
        $this->patterns = $patterns;

        return $this;
    }

    public function getPatterns(): ?array
    {
        return $this->patterns;
    }
}
