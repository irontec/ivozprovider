<?php

namespace Ivoz\Cgr\Domain\Service\TpAccountAction;

use Ivoz\Cgr\Domain\Model\TpAccountAction\TpAccountActionInterface;

class UpdatedTpAccountActionNotificator implements TpAccountActionLifecycleEventHandlerInterface
{
    /**
     * @var LoadTpAccountActionInterface
     */
    protected $loadTpAccount;

    /**
     * @var RemoveTpAccountActionInterface
     */
    protected $removeTpAccount;

    public function __construct(
        LoadTpAccountActionInterface $loadService,
        RemoveTpAccountActionInterface $removeService
    ) {
        $this->loadTpAccount = $loadService;
        $this->removeTpAccount = $removeService;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_COMMIT => 10
        ];
    }

    public function execute(TpAccountActionInterface $entity)
    {
        $wasRemoved = is_null($entity->getId());
        if ($wasRemoved) {

            $this->removeTpAccount->execute($entity);
            return;
        }

        $this->loadTpAccount->execute($entity);
    }
}