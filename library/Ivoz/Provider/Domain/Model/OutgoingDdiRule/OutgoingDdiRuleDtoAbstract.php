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
    public static function getPropertyMap(string $context = '', string $role = null)
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

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
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
     * @param string $defaultAction | null
     *
     * @return static
     */
    public function setDefaultAction(?string $defaultAction = null): self
    {
        $this->defaultAction = $defaultAction;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDefaultAction(): ?string
    {
        return $this->defaultAction;
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
    public function setForcedDdi(?DdiDto $forcedDdi = null): self
    {
        $this->forcedDdi = $forcedDdi;

        return $this;
    }

    /**
     * @return DdiDto | null
     */
    public function getForcedDdi(): ?DdiDto
    {
        return $this->forcedDdi;
    }

    /**
     * @return static
     */
    public function setForcedDdiId($id): self
    {
        $value = !is_null($id)
            ? new DdiDto($id)
            : null;

        return $this->setForcedDdi($value);
    }

    /**
     * @return mixed | null
     */
    public function getForcedDdiId()
    {
        if ($dto = $this->getForcedDdi()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param OutgoingDdiRulesPatternDto[] | null
     *
     * @return static
     */
    public function setPatterns(?array $patterns = null): self
    {
        $this->patterns = $patterns;

        return $this;
    }

    /**
     * @return OutgoingDdiRulesPatternDto[] | null
     */
    public function getPatterns(): ?array
    {
        return $this->patterns;
    }

}
