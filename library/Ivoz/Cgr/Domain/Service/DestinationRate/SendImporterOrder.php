<?php

namespace Ivoz\Cgr\Domain\Service\DestinationRate;

use Ivoz\Cgr\Domain\Model\DestinationRate\DestinationRateInterface;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Core\Infrastructure\Domain\Service\Gearman\Jobs\RatesImporter;

/**
 * Class SendImporterOrder
 * @package namespace Ivoz\Cgr\Domain\Service\DestinationRate;
 * @lifecycle on_commit
 */
class SendImporterOrder implements DestinationRateLifecycleEventHandlerInterface
{
    /**
     * @var RatesImporter
     */
    protected $importer;

    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    public function __construct(
        RatesImporter $importer,
        EntityPersisterInterface $entityPersister
    ) {
        $this->importer = $importer;
        $this->entityPersister = $entityPersister;
    }

    public function execute(DestinationRateInterface $entity)
    {
        $pendingStatus = $entity->getStatus() === 'waiting';
        $statusHasChanged = $entity->hasChanged('status');

        if ($pendingStatus && $statusHasChanged) {
            $this->importer
                ->setParams(['id' => $entity->getId()])
                ->send();
        }
    }
}