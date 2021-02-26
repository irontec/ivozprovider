<?php

namespace Ivoz\Kam\Domain\Model\Trusted;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;

/**
* TrustedDtoAbstract
* @codeCoverageIgnore
*/
abstract class TrustedDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $srcIp;

    /**
     * @var string|null
     */
    private $proto;

    /**
     * @var string|null
     */
    private $fromPattern;

    /**
     * @var string|null
     */
    private $ruriPattern;

    /**
     * @var string|null
     */
    private $tag;

    /**
     * @var string|null
     */
    private $description;

    /**
     * @var int
     */
    private $priority = 0;

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
            'srcIp' => 'srcIp',
            'proto' => 'proto',
            'fromPattern' => 'fromPattern',
            'ruriPattern' => 'ruriPattern',
            'tag' => 'tag',
            'description' => 'description',
            'priority' => 'priority',
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
            'srcIp' => $this->getSrcIp(),
            'proto' => $this->getProto(),
            'fromPattern' => $this->getFromPattern(),
            'ruriPattern' => $this->getRuriPattern(),
            'tag' => $this->getTag(),
            'description' => $this->getDescription(),
            'priority' => $this->getPriority(),
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

    public function setSrcIp(?string $srcIp): static
    {
        $this->srcIp = $srcIp;

        return $this;
    }

    public function getSrcIp(): ?string
    {
        return $this->srcIp;
    }

    public function setProto(?string $proto): static
    {
        $this->proto = $proto;

        return $this;
    }

    public function getProto(): ?string
    {
        return $this->proto;
    }

    public function setFromPattern(?string $fromPattern): static
    {
        $this->fromPattern = $fromPattern;

        return $this;
    }

    public function getFromPattern(): ?string
    {
        return $this->fromPattern;
    }

    public function setRuriPattern(?string $ruriPattern): static
    {
        $this->ruriPattern = $ruriPattern;

        return $this;
    }

    public function getRuriPattern(): ?string
    {
        return $this->ruriPattern;
    }

    public function setTag(?string $tag): static
    {
        $this->tag = $tag;

        return $this;
    }

    public function getTag(): ?string
    {
        return $this->tag;
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

    public function setPriority(?int $priority): static
    {
        $this->priority = $priority;

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
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

}
