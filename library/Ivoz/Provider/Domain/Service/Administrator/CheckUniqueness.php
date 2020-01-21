<?php

namespace Ivoz\Provider\Domain\Service\Administrator;

use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorRepository;

class CheckUniqueness implements AdministratorLifecycleEventHandlerInterface
{
    const PRE_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    protected $administratorRepository;

    public function __construct(
        AdministratorRepository $administratorRepository
    ) {
        $this->administratorRepository = $administratorRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => self::PRE_PERSIST_PRIORITY
        ];
    }

    /**
     * @return void
     */
    public function execute(AdministratorInterface $admin)
    {
        $administrator = $this
            ->administratorRepository
            ->findPlatformAdminByUsername(
                $admin->getUsername()
            );

        if (!$administrator) {
            return;
        }

        $isNew = $admin->isNew();
        $distinctId = $admin->getId() !== $administrator->getId();

        if ($isNew || $distinctId) {
            throw new \DomainException("There is already a platform administrator with that name.");
        }
    }
}
