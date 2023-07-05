<?php

namespace Model\Dashboard;

use Ivoz\Api\Core\Annotation\AttributeDefinition;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

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
    protected $type;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $domainUsers;

    /**
     * @var int
     * @AttributeDefinition(type="int")
     */
    protected $maxCalls;

    public function __construct(
        string $name,
        string $type,
        string $domainUsers,
        int $maxCalls
    ) {
        $this->name = $name;
        $this->type = $type;
        $this->domainUsers = $domainUsers;
        $this->maxCalls = $maxCalls;
    }

    public static function fromCompany(
        CompanyInterface $company
    ): DashboardClient {
        $self = new self(
            $company->getName(),
            $company->getType(),
            $company->getDomainUsers() ?? '',
            $company->getMaxCalls()
        );

        return $self;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getDomainUsers(): string
    {
        return $this->domainUsers;
    }

    public function getMaxCalls(): int
    {
        return $this->maxCalls;
    }
}
