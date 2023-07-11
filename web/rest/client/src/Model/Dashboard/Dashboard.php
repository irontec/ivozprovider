<?php

namespace Model\Dashboard;

use Ivoz\Api\Core\Annotation\AttributeDefinition;

/**
 * @codeCoverageIgnore
 */
class Dashboard
{
    /**
     * @var DashboardClient
     * @AttributeDefinition(
     *     type="object",
     *     class="Model\Dashboard\DashboardClient"
     * )
     */
    protected $client;

    /**
     * @var DashboardBillableCall[]
     * @AttributeDefinition(
     *     type="array",
     *     class="Model\Dashboard\DashboardBillableCall"
     * )
     */
    protected $latestBillableCalls;

    /**
     * @var DashboardUser[]
     * @AttributeDefinition(
     *     type="array",
     *     class="Model\Dashboard\DashboardUser"
     * )
     */
    protected $latestUsers;


    /**
     * @var DashboardResidentialDevice[]
     * @AttributeDefinition(
     *     type="array",
     *     class="Model\Dashboard\DashboardResidentialDevice"
     * )
     */
    protected $latestResidentialDevices;

    /**
     * @var DashboardRetailAccount[]
     * @AttributeDefinition(
     *     type="array",
     *     class="Model\Dashboard\DashboardRetailAccount"
     * )
     */
    protected $latestRetailAccounts;


    /**
     * @var int|null
     * @AttributeDefinition(type="int")
     */
    protected $userNum;

    /**
     * @var int|null
     * @AttributeDefinition(type="int")
     */
    protected $extensionNum;

    /**
     * @var int|null
     * @AttributeDefinition(type="int")
     */
    protected $ddiNum;

    /**
     * @var int|null
     * @AttributeDefinition(type="int")
     */
    protected $residentialDeviceNum;

    /**
     * @var int|null
     * @AttributeDefinition(type="int")
     */
    protected $voiceMailNum;

    /**
     * @var int|null
     * @AttributeDefinition(type="int")
     */
    protected $retailsAccountNum;

    /**
     * @param DashboardBillableCall[] $latestBillableCalls
     * @param DashboardUser[] $latestUsers
     * @param DashboardResidentialDevice[] $latestResidentialDevices
     * @param DashboardRetailAccount[] $latestRetailAccounts
     */
    public function __construct(
        DashboardClient $client,
        array $latestBillableCalls = [],
        array $latestUsers = [],
        array $latestResidentialDevices = [],
        array $latestRetailAccounts = [],
        int $userNum = null,
        int $extensionNum = null,
        int $ddiNum = null,
        int $residentialDeviceNum = null,
        int $voiceMailNum = null,
        int $retailsAccountNum = null,
    ) {
        $this->client = $client;
        $this->latestBillableCalls = $latestBillableCalls;
        $this->latestUsers = $latestUsers;
        $this->latestResidentialDevices = $latestResidentialDevices;
        $this->latestRetailAccounts = $latestRetailAccounts;
        $this->userNum = $userNum;
        $this->extensionNum = $extensionNum;
        $this->ddiNum = $ddiNum;
        $this->residentialDeviceNum = $residentialDeviceNum;
        $this->voiceMailNum = $voiceMailNum;
        $this->retailsAccountNum = $retailsAccountNum;
    }


    public function getClient(): DashboardClient
    {
        return $this->client;
    }

    /**
     * @return DashboardBillableCall[]
     */
    public function getLatestBillableCalls(): array
    {
        return $this->latestBillableCalls;
    }

    /**
     * @return DashboardUser[]
     */
    public function getLatestUsers(): array
    {
        return $this->latestUsers;
    }

    /**
     * @return DashboardResidentialDevice[]
     */
    public function getLatestResidentialDevices(): array
    {
        return $this->latestResidentialDevices;
    }

    /**
     * @return DashboardRetailAccount[]
     */
    public function getLatestRetailAccounts(): array
    {
        return $this->latestRetailAccounts;
    }

    public function getUserNum(): ?int
    {
        return $this->userNum;
    }

    public function setUserNum(int $totalUser): self
    {
        $this->userNum = $totalUser;
        return $this;
    }

    public function getExtensionNum(): ?int
    {
        return $this->extensionNum;
    }

    public function getDdiNum(): ?int
    {
        return $this->ddiNum;
    }

    public function getResidentialDeviceNum(): ?int
    {
        return $this->residentialDeviceNum;
    }

    public function getVoiceMailNum(): ?int
    {
        return $this->voiceMailNum;
    }

    public function getRetailsAccountNum(): ?int
    {
        return $this->retailsAccountNum;
    }
}
