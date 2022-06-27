<?php

namespace Ivoz\Kam\Domain\Service\TrunksUacreg;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregDto;
use Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationInterface;
use Ivoz\Provider\Domain\Service\DdiProviderRegistration\DdiProviderRegistrationLifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkRepository;

/**
 * Class CreatedByDdiProviderRegistration
 * @package Ivoz\Kam\Domain\Service\TrunksUacreg
 */
class CreatedByDdiProviderRegistration implements DdiProviderRegistrationLifecycleEventHandlerInterface
{
    public const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private EntityTools $entityTools,
        private ProxyTrunkRepository $proxyTrunkRepository
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
        ];
    }

    /**
     * @param DdiProviderRegistrationInterface $ddiProviderRegistration
     *
     * @throws \Exception
     *
     * @return void
     */
    public function execute(DdiProviderRegistrationInterface $ddiProviderRegistration)
    {
        $trunksUacreg = $ddiProviderRegistration->getTrunksUacreg();

        /** @var TrunksUacregDto $trunksUacregDto */
        $trunksUacregDto = ($trunksUacreg)
            ? $this->entityTools->entityToDto($trunksUacreg)
            : new TrunksUacregDto();

        $trunksUacregDto
            ->setBrandId($ddiProviderRegistration->getDdiProvider()->getBrand()->getId()) /** FIXME Why this require Brand? */
            ->setDdiProviderRegistrationId($ddiProviderRegistration->getId())
            ->setRUsername($ddiProviderRegistration->getUsername())
            ->setRDomain($ddiProviderRegistration->getDomain())
            ->setRealm($ddiProviderRegistration->getRealm())
            ->setAuthUsername($ddiProviderRegistration->getAuthUsername())
            ->setAuthPassword($ddiProviderRegistration->getAuthPassword())
            ->setAuthProxy($ddiProviderRegistration->getAuthProxy())
            ->setExpires($ddiProviderRegistration->getExpires());

        // Set socket depending on DDIProvider proxytrunks address
        $trunks = $ddiProviderRegistration->getDdiProvider()->getProxyTrunk();
        if (is_null($trunks)) {
            $trunks = $this->proxyTrunkRepository->getProxyMainAddress();
        }

        $trunksIp  = $trunks->getIp();

        $socket = 'udp:' . $trunksIp . ':5060';

        $trunksUacregDto->setSocket($socket);

        // Update registration contact if required
        $contactUsernameChanged = $ddiProviderRegistration->hasChanged('multiDdi')
            || $ddiProviderRegistration->hasChanged('contactUsername');

        if ($contactUsernameChanged) {
            $trunksUacregDto->setLUuid($ddiProviderRegistration->getContactUsername());
        }

        $this->entityTools->persistDto($trunksUacregDto, $trunksUacreg);
    }
}
