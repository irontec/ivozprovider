<?php

namespace Ivoz\Provider\Domain\Service\Carrier;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Carrier\CarrierDto;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierRepository;
use Psr\Log\LoggerInterface;

class SyncBalances
{
    protected $entityTools;
    protected $logger;
    protected $client;

    protected $carrierRepository;

    public function __construct(
        EntityTools $entityTools,
        LoggerInterface $logger,
        CarrierBalanceServiceInterface $client,
        CarrierRepository $carrierRepository
    ) {
        $this->entityTools = $entityTools;
        $this->logger = $logger;
        $this->client = $client;
        $this->carrierRepository = $carrierRepository;
    }

    /**
     * @return void
     */
    public function updateAll()
    {
        $this->logger->info('Companies balances are about to be synced');

        $targetCarriers = $this->carrierRepository->getCarrierIdsGroupByBrand();
        foreach ($targetCarriers as $brandId => $carriers) {
            $this->updateCarriers($brandId, $carriers);
        }
    }

    /**
     * @param int $brandId
     * @param array $carrierIds
     * @return bool
     */
    public function updateCarriers($brandId, array $carrierIds)
    {
        try {
            $response = $this->client->getBalances($brandId, $carrierIds);

            if (isset($response->error) && $response->error) {
                $this->logger->error(
                    'There was an error while retrieving brand#' . $brandId . ' carriers balances'
                );
                throw new \Exception($response->error);
            }
            $this->persistBalances($response->result);

            return true;
        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage());

            return false;
        }
    }

    /**
     * @param array $carriersBalance
     *
     * @return void
     */
    private function persistBalances(array $carriersBalance)
    {
        foreach ($carriersBalance as $carrierId => $balance) {

            /** @var CarrierInterface $carrier */
            $carrier = $this->carrierRepository->find($carrierId);
            if (!$carrier) {
                $this->logger->error(
                    'Carrier#' . $carrierId . ' not found'
                );
                continue;
            }

            /** @var CarrierDto $carrierDto */
            $carrierDto = $this->entityTools->entityToDto($carrier);
            $carrierDto->setBalance($balance);
            $this->entityTools->persistDto($carrierDto, $carrier);
        }

        $this->entityTools->dispatchQueuedOperations();
    }
}
