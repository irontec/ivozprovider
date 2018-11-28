<?php

namespace Ivoz\Provider\Domain\Service\Ivr;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Ivr\Ivr;
use Ivoz\Provider\Domain\Model\Ivr\IvrDto;
use Ivoz\Provider\Domain\Model\Ivr\IvrRepository;
use Ivoz\Provider\Domain\Service\Extension\ExtensionLifecycleEventHandlerInterface;

/**
 * Class UpdateByExtension
 * @package Ivoz\Provider\Domain\Service\Ivr
 */
class UpdateByExtension implements ExtensionLifecycleEventHandlerInterface
{
    const PRE_REMOVE_PRIORITY = 10;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var IvrRepository
     */
    protected $ivrRepository;

    public function __construct(
        EntityTools $entityTools,
        IvrRepository $ivrRepository
    ) {
        $this->entityTools = $entityTools;
        $this->ivrRepository = $ivrRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_REMOVE => self::PRE_REMOVE_PRIORITY
        ];
    }

    /**
     * @param ExtensionInterface $extension
     */
    public function execute(ExtensionInterface $extension)
    {
        /** @var Ivr[] $ivrs */
        $ivrs = $this->ivrRepository->findByExtension($extension);
        foreach ($ivrs as $ivr) {
            $noInputExtension = $ivr->getNoInputExtension();
            $errorExtension = $ivr->getErrorExtension();
            /** @var IvrDto $ivrDto */
            $ivrDto = $this->entityTools->entityToDto($ivr);

            if ($noInputExtension && $noInputExtension->getId() === $extension->getId()) {
                $ivrDto
                    ->setNoInputRouteType(null)
                    ->setNoInputExtensionId(null);

                $this->entityTools->persistDto($ivrDto, $ivr);
            }

            if ($errorExtension && $errorExtension->getId() === $extension->getId()) {
                $ivrDto
                    ->setErrorRouteType(null)
                    ->setErrorExtensionId(null);

                $this->entityTools->persistDto($ivrDto, $ivr);
            }
        }
    }
}
