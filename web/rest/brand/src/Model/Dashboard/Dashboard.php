<?php

namespace Model\Dashboard;

use Ivoz\Api\Core\Annotation\AttributeDefinition;

/**
 * @codeCoverageIgnore
 */
class Dashboard
{
    /**
     * @var DashboardBrand
     * @AttributeDefinition(
     *     type="object",
     *     class="Model\Dashboard\DashboardBrand"
     * )
     */
    protected $brand;

    /**
     * @var DashboardClient[]
     * @AttributeDefinition(
     *     type="array",
     *     class="Model\Dashboard\DashboardClient"
     * )
     */
    protected $recentActivity = [];

    /**
     * @var integer
     * @AttributeDefinition(type="int")
     */
    protected $clientNum;

    /**
     * @var integer
     * @AttributeDefinition(type="int")
     */
    protected $ddiNum;

    /**
     * @var integer
     * @AttributeDefinition(type="int")
     */
    protected $carrierNum;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $productName;

    /**
     * @param DashboardClient[] $recentActivity
     */
    public function __construct(
        DashboardBrand $brand,
        array $recentActivity,
        int $clientNum,
        int $ddiNum,
        int $carrierNum,
        string $productName = 'Ivoz Provider'
    ) {
        $this->brand = $brand;
        $this->recentActivity = $recentActivity;
        $this->clientNum = $clientNum;
        $this->ddiNum = $ddiNum;
        $this->carrierNum = $carrierNum;
        $this->productName = $productName;
    }

    public function getBrand(): DashboardBrand
    {
        return $this->brand;
    }

    /**
     * @return DashboardClient[]
     */
    public function getRecentActivity(): array
    {
        return $this->recentActivity;
    }

    public function getClientNum(): int
    {
        return $this->clientNum;
    }

    public function getDdiNum(): int
    {
        return $this->ddiNum;
    }

    public function getCarrierNum(): int
    {
        return $this->carrierNum;
    }

    public function getProductName(): string
    {
        return $this->productName;
    }
}
