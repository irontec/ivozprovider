<?php

namespace Ivoz\Provider\Domain\Service\FaxesInOut;

use Ivoz\Core\Infrastructure\Service\Asterisk\ARI\ARIConnector;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutInterface;

/**
 * Class SendFaxFile
 * @package Ivoz\Provider\Domain\Service\FaxesInOut
 */
class SendFaxFile implements FaxesInOutLifecycleEventHandlerInterface
{
    protected $ariConnector;

    public function __construct(
        ARIConnector $ariConnector
    ) {
        $this->ariConnector = $ariConnector;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 10
        ];
    }

    /**
     * @throws \Exception
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
            $entity->setStatus('error');

            //@todo This will not be persisted...
            throw $e;
        }
    }
}