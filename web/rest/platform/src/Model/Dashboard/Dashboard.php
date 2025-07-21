<?php

namespace Model\Dashboard;

use Ivoz\Api\Core\Annotation\AttributeDefinition;

/**
 * @codeCoverageIgnore
 */
class Dashboard
{
    /**
     * @var DashboardAdmin
     * @AttributeDefinition(
     *     type="object",
     *     class="Model\Dashboard\DashboardAdmin"
     * )
     */
    protected $admin;

    /**
     * @var DashboardBrand[]
     * @AttributeDefinition(
     *     type="array",
     *     class="Model\Dashboard\DashboardBrand"
     * )
     */
    protected $recentActivity = [];

    /**
     * @var integer
     * @AttributeDefinition(type="int")
     */
    protected $brandNumber;

    /**
     * @var integer
     * @AttributeDefinition(type="int")
     */
    protected $clientNumber;

    /**
     * @var integer
     * @AttributeDefinition(type="int")
     */
    protected $userNumber;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $productName;

    /**
     * @param DashboardBrand[] $recentActivity
     */
    public function __construct(
        DashboardAdmin $admin,
        array $recentActivity,
        int $brandNumber,
        int $clientNumber,
        int $userNumber,
        string $productName = 'Ivoz Provider'
    ) {
        $this->admin = $admin;
        $this->recentActivity = $recentActivity;
        $this->brandNumber = $brandNumber;
        $this->clientNumber = $clientNumber;
        $this->userNumber = $userNumber;
        $this->productName = $productName;
    }

    public function getAdmin(): DashboardAdmin
    {
        return $this->admin;
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

    public function getProductName(): string
    {
        return $this->productName;
    }
}
