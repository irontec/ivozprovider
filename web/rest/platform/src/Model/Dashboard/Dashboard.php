<?php

namespace Model\Dashboard;

use Ivoz\Api\Core\Annotation\AttributeDefinition;

/**
 * @codeCoverageIgnore
 */
class Dashboard
{
    /**
     * SELECT id, name FROM Brands ORDER BY id desc LIMIT 5
     * @var DashboardBrand[]
     * @AttributeDefinition(
     *     type="array",
     *     class="Model\Dashboard\DashboardBrand"
     * )
     */
    protected $recentActivity = [];

    /**
     * SELECT COUNT(*) FROM Brands
     * @var integer
     * @AttributeDefinition(type="int")
     */
    protected $brandNumber;

    /**
     * SELECT COUNT(*) FROM Companies
     * @var integer
     * @AttributeDefinition(type="int")
     */
    protected $clientNumber;

    /**
     * SELECT COUNT(*) FROM Users
     * @var integer
     * @AttributeDefinition(type="int")
     */
    protected $userNumber;

    /**
     * @param DashboardBrand[] $recentActivity
     */
    public function __construct(
        array $recentActivity,
        int $brandNumber,
        int $clientNumber,
        int $userNumber
    ) {
        $this->recentActivity = $recentActivity;
        $this->brandNumber = $brandNumber;
        $this->clientNumber = $clientNumber;
        $this->userNumber = $userNumber;
    }

    /**
     * @return DashboardBrand[]
     */
    public function getRecentActivity(): array
    {
        return $this->recentActivity;
    }

    public function getBrandNumber(): int
    {
        return $this->brandNumber;
    }

    public function getClientNumber(): int
    {
        return $this->clientNumber;
    }

    public function getUserNumber(): int
    {
        return $this->userNumber;
    }
}
