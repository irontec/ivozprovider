<?php

namespace Model\Dashboard;

use Ivoz\Api\Core\Annotation\AttributeDefinition;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

/**
 * @codeCoverageIgnore
 */
class DashboardClient
{
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
    protected $postalCode;

    /**
     * @var string|null
     * @AttributeDefinition(type="string")
     */
    protected $domainUsers;

    /**
     * @var int|null
     * @AttributeDefinition(type="int")
     */
    protected $maxCalls;

    private function __construct(
        string $name,
        string $nif,
        string $postalCode,
        ?string $domainUsers,
        ?int $maxCalls,
    ) {
        $this->name = $name;
        $this->nif = $nif;
        $this->postalCode = $postalCode;
        $this->domainUsers = $domainUsers;
        $this->maxCalls = $maxCalls;
    }

    public static function fromCompany(CompanyInterface $company): self
    {
        $invoicing = $company->getInvoicing();

        return new self(
            $company->getName(),
            $invoicing->getNif(),
            $invoicing->getPostalCode(),
            $company->getDomainUsers(),
            $company->getMaxCalls()
        );
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNif(): string
    {
        return $this->nif;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function getDomainUsers(): ?string
    {
        return $this->domainUsers;
    }

    public function getMaxCalls(): ?int
    {
        return $this->maxCalls;
    }
}
