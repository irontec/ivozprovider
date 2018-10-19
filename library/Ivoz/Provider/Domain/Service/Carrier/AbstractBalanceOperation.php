<?php

namespace Ivoz\Provider\Domain\Service\Carrier;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\BalanceMovement\BalanceMovement;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Symfony\Bridge\Monolog\Logger;
use Ivoz\Provider\Domain\Model\Carrier\CarrierRepository;

abstract class AbstractBalanceOperation
{
    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var CarrierBalanceServiceInterface
     */
    protected $client;

    /**
     * @var CarrierRepository
     */
    protected $carrierRepository;

    /**
     * @var SyncBalances
     */
    protected $syncBalanceService;

    /**
     * @var string
     */
    protected $lastError;

    /**
     * IncrementBalance constructor.
     *
     * @param EntityTools $entityTools
     * @param Logger $logger
     * @param CarrierBalanceServiceInterface $client
     * @param CarrierRepository $carrierRepository
     * @param SyncBalances $syncBalanceService
     */
    public function __construct(
        EntityTools $entityTools,
        Logger $logger,
        CarrierBalanceServiceInterface $client,
        CarrierRepository $carrierRepository,
        SyncBalances $syncBalanceService
    ) {
        $this->entityTools = $entityTools;
        $this->logger = $logger;
        $this->client = $client;
        $this->carrierRepository = $carrierRepository;
        $this->syncBalanceService = $syncBalanceService;
    }

    /**
     * @param $carrierId
     * @param float $amount
     * @return boolean
     */
    abstract public function execute($carrierId, float $amount);

    /**
     * @param $amount
     * @param array $response
     * @param CarrierInterface $carrier
     * @return boolean
     */
    protected function handleResponse($amount, array $response, CarrierInterface $carrier)
    {
        if (!empty($response['error'])) {
            $this->lastError = $response['error'];
            $this->logger->error('Could not modify balance: ' . $response['error']);
        }

        $success = $response['success'];

        if ($success) {
            $brandId = $carrier->getBrand()->getId();
            $carrierIds = [$carrier->getId()];

            $this->syncBalanceService->updateCarriers($brandId, $carrierIds);

            // Get current balance status
            $balance = $this->client->getBalance($brandId, $carrier->getId());

            // Store this transaction in a BalanceMovement
            $balanceMovementDto = BalanceMovement::createDto();
            $balanceMovementDto
                ->setCarrierId($carrier->getId())
                ->setAmount($amount)
                ->setBalance($balance);

            $this->entityTools->persistDto($balanceMovementDto, null, true);
        }

        return $success;
    }

    public function getLastError()
    {
        return $this->lastError;
    }
}
