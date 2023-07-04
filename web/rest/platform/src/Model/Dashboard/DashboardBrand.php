<?php

namespace Model\Dashboard;

use Ivoz\Api\Core\Annotation\AttributeDefinition;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;

class DashboardBrand
{
    /**
     * @var int
     * @AttributeDefinition(type="int")
     */
    protected $id;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $name;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $nif;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $sipDomain;

    /**
     * @var int
     * @AttributeDefinition(type="int")
     */
    protected $maxCalls;

    public function __construct(
        int $id,
        string $name,
        string $nif,
        string $sipDomain,
        int $maxCalls
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->nif = $nif;
        $this->sipDomain = $sipDomain;
        $this->maxCalls = $maxCalls;
    }

    public static function fromBrand(BrandInterface $brand): DashboardBrand
    {
        return new self(
            $brand->getId() ?? 0,
            $brand->getName(),
            $brand->getInvoice()->getNif(),
            $brand->getDomainUsers() ?? '',
            $brand->getMaxCalls()
        );
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNif(): string
    {
        return $this->nif;
    }

    public function getSipDomain(): string
    {
        return $this->sipDomain;
    }

    public function getMaxCalls(): int
    {
        return $this->maxCalls;
    }
}
