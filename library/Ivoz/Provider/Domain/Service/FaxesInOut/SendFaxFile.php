<?php

namespace Ivoz\Provider\Domain\Service\FaxesInOut;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Infrastructure\Service\Asterisk\ARI\ARIConnector;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutDto;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutInterface;

/**
 * Class SendFaxFile
 * @package Ivoz\Provider\Domain\Service\FaxesInOut
 */
class SendFaxFile implements FaxesInOutLifecycleEventHandlerInterface
{
    /**
     * @var ARIConnector
     */
    protected $ariConnector;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    public function __construct(
        ARIConnector $ariConnector,
        EntityTools $entityTools
    ) {
        $this->ariConnector = $ariConnector;
        $this->entityTools = $entityTools;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 10
        ];
    }

    /**
     * @throws \Exception
     *
     * @return void
     */
    public function execute(FaxesInOutInterface $entity)
    {
        $isOutgoingFax = $entity->getType() == "Out";
        $isPending = $entity->getStatus() == "pending";
        $statusHaschanged = $entity->hasChanged("status");

        $mustSendFaxFile = $isOutgoingFax && $statusHaschanged && $isPending;
        if (!$mustSendFaxFile) {
            return;
        }

        try {
            $this->ariConnector->sendFaxfileRequest($entity);
        } catch (\Exception $e) {

            /** @var FaxesInOutDto $dto */
            $dto = $this->entityTools->entityToDto($entity);
            $dto->setStatus('error');
            $this->entityTools->persistDto($dto, $entity, true);

            throw $e;
        }
    }
}
