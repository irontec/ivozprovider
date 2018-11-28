<?php

namespace Ivoz\Kam\Domain\Service\TrunksUacreg;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregDto;
use Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregInterface;
use Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Service\DdiProviderRegistration\DdiProviderRegistrationLifecycleEventHandlerInterface;

/**
 * Class CreatedByDdiProviderRegistration
 * @package Ivoz\Kam\Domain\Service\TrunksUacreg
 */
class CreatedByDdiProviderRegistration implements DdiProviderRegistrationLifecycleEventHandlerInterface
{
    const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * CreatedByDdiProviderRegistration constructor.
     * @param EntityTools $entityTools
     */
    public function __construct(
        EntityTools $entityTools
    ) {
        $this->entityTools = $entityTools;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
        ];
    }

    /**
     * @param DdiProviderRegistrationInterface $ddiProviderRegistration
     * @param $isNew
     * @throws \Exception
     */
    public function execute(DdiProviderRegistrationInterface $ddiProviderRegistration)
    {
        $trunksUacreg = $ddiProviderRegistration->getTrunksUacreg();

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

        // Update registration contact if required
        $contactUsernameChanged = $ddiProviderRegistration->hasChanged('multiDdi')
            || $ddiProviderRegistration->hasChanged('contactUsername');

        if ($contactUsernameChanged) {
            $trunksUacregDto->setLUuid($ddiProviderRegistration->getContactUsername());
        }

        $this->entityTools->persistDto($trunksUacregDto, $trunksUacreg);
    }
}
