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
     * @var string | null
     */
    private $srcIp;

    /**
     * @var string | null
     */
    private $proto;

    /**
     * @var string | null
     */
    private $fromPattern;

    /**
     * @var string | null
     */
    private $ruriPattern;

    /**
     * @var string | null
     */
    private $tag;

    /**
     * @var string | null
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

    /**
     * @param string $srcIp | null
     *
     * @return static
     */
    public function setSrcIp(?string $srcIp = null): self
    {
        $this->srcIp = $srcIp;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getSrcIp(): ?string
    {
        return $this->srcIp;
    }

    /**
     * @param string $proto | null
     *
     * @return static
     */
    public function setProto(?string $proto = null): self
    {
        $this->proto = $proto;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getProto(): ?string
    {
        return $this->proto;
    }

    /**
     * @param string $fromPattern | null
     *
     * @return static
     */
    public function setFromPattern(?string $fromPattern = null): self
    {
        $this->fromPattern = $fromPattern;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getFromPattern(): ?string
    {
        return $this->fromPattern;
    }

    /**
     * @param string $ruriPattern | null
     *
     * @return static
     */
    public function setRuriPattern(?string $ruriPattern = null): self
    {
        $this->ruriPattern = $ruriPattern;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRuriPattern(): ?string
    {
        return $this->ruriPattern;
    }

    /**
     * @param string $tag | null
     *
     * @return static
     */
    public function setTag(?string $tag = null): self
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTag(): ?string
    {
        return $this->tag;
    }

    /**
     * @param string $description | null
     *
     * @return static
     */
    public function setDescription(?string $description = null): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param int $priority | null
     *
     * @return static
     */
    public function setPriority(?int $priority = null): self
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getPriority(): ?int
    {
        return $this->priority;
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
