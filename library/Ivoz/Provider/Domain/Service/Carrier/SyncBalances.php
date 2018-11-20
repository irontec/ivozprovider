<?php

namespace Ivoz\Provider\Domain\Service\Carrier;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Psr\Log\LoggerInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierRepository;

class SyncBalances
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityTools;

    /**
     * @var LoggerInterface
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

    public function updateAll()
    {
        $this->logger->info('Companies balances are about to be synced');

        $targetCarriers = $this->getCarrierIdsGroupByBrand();
        foreach ($targetCarriers as $brandId => $carriers) {
            $this->updateCarriers($brandId, $carriers);
        }
    }

    /**
     * @param $brandId
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
     * @return array
     */
    private function getCarrierIdsGroupByBrand()
    {
        $carriers = $this->carrierRepository->findAll();
        $response = [];

        foreach ($carriers as $carrier) {
            $brandId = $carrier->getBrand()->getId();
            if (!array_key_exists($brandId, $response)) {
                $response[$brandId] = [];
            }
            $response[$brandId][] = $carrier->getId();
        }

        return $response;
    }

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
