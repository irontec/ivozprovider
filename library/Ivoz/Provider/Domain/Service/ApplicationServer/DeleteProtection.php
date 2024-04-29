<?php

namespace Ivoz\Provider\Domain\Service\ApplicationServer;

use Ivoz\Kam\Domain\Service\TrunksClientInterface;
use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;

class DeleteProtection implements ApplicationServerLifecycleEventHandlerInterface
{
    public const PRE_REMOVE_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private CompanyRepository $companyRepository
    ) {
    }

    /**
     * @return array<string, int>
     */
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_REMOVE => self::PRE_REMOVE_PRIORITY
        ];
    }

    /**
     * @return void
     */
    public function execute(ApplicationServerInterface $applicationServer)
    {
        $applicationServerId = $applicationServer->getId();

        if ($applicationServerId === null) {
            return;
        }

        $companies = $this
            ->companyRepository
            ->findByApplicationServerId($applicationServerId);

        if (!empty($companies)) {
            throw new \DomainException(
                'Cannot delete application server because it is in use in at least one company'
            );
        }
    }
}
