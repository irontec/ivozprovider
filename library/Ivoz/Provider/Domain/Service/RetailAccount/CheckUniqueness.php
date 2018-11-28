<?php

namespace Ivoz\Provider\Domain\Service\RetailAccount;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceRepository;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;
use Zend\EventManager\Exception\DomainException;

/**
 * Class CheckUniqueness
 * @package Ivoz\Provider\Domain\Service\RetailAccount
 */
class CheckUniqueness implements RetailAccountLifecycleEventHandlerInterface
{
    const PRE_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var ResidentialDeviceRepository
     */
    protected $residentialDeviceRepository;

    public function __construct(
        ResidentialDeviceRepository $residentialDeviceRepository
    ) {
        $this->residentialDeviceRepository = $residentialDeviceRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => self::PRE_PERSIST_PRIORITY
        ];
    }

    /**
     * Check username and domain is unique in the whole platform
     *
     * @param RetailAccountInterface $retailAccount
     */
    public function execute(RetailAccountInterface $retailAccount)
    {
        $retailAccount = $this->residentialDeviceRepository
            ->findOneByNameAndDomain(
                $retailAccount->getName(),
                $retailAccount->getDomain()
            );

        if ($retailAccount) {
            throw new DomainException("There is already a residential device with that name.", 30006);
        }
    }
}
