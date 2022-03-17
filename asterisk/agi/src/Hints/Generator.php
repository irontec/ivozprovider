<?php

namespace Hints;

use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpoint;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointRepository;
use RouteHandlerAbstract;

class Generator extends RouteHandlerAbstract
{
    /**
     * Sender constructor.
     */
    public function __construct(
        protected EntityManagerInterface $em
    ) {
    }

    /**
     * @throws \InvalidArgumentException
     */
    public function process(): void
    {
        /** @var PsEndpointRepository $psEndpointRepository */
        $psEndpointRepository = $this->em->getRepository(PsEndpoint::class);
        $psEndpoints = $psEndpointRepository->getEndpointsWithExtensionOrderByContext();

        // Initialize current context endpoints
        $currentContext = "";

        /** @var PsEndpoint $psEndpoint */
        foreach ($psEndpoints as $psEndpoint) {
            if ($currentContext != $psEndpoint->getSubscribeContext()) {
                $currentContext = $psEndpoint->getSubscribeContext();
                echo sprintf("\n[%s]\n", $currentContext);
            }

            echo sprintf(
                "exten => %s,hint,PJSIP/%s\n",
                $psEndpoint->getHintExtension(),
                $psEndpoint->getSorceryId()
            );
        }
    }
}
