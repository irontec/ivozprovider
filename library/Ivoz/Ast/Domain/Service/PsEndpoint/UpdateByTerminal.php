<?php

namespace Ivoz\Ast\Domain\Service\PsEndpoint;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointDto;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointRepository;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
use Ivoz\Provider\Domain\Service\Terminal\TerminalLifecycleEventHandlerInterface;

class UpdateByTerminal implements TerminalLifecycleEventHandlerInterface
{
    public function __construct(
        private EntityTools $entityTools,
        private PsEndpointRepository $psEndpointRepository
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 10
        ];
    }

    /**
     * @param TerminalInterface $terminal
     *
     * @return void
     */
    public function execute(TerminalInterface $terminal)
    {
        // Replicate Terminal into ast_ps_endpoint
        $endpoint = $this->psEndpointRepository->findOneByTerminalId(
            $terminal->getId()
        );

        if (is_null($endpoint)) {
            $endpointDto = new PsEndpointDto();
            $endpointDto
                ->setContext('users')
                ->setSendDiversion('yes')
                ->setSendPai('yes');
        } else {
            /** @var PsEndpointDto $endpointDto */
            $endpointDto = $this->entityTools->entityToDto($endpoint);
        }

        // Update/Insert endpoint data
        $endpointDto
            ->setTerminalId($terminal->getId())
            ->setSorceryId($terminal->getSorcery())
            ->setFromDomain($terminal->getCompany()->getDomainUsers())
            ->setAors($terminal->getSorcery())
            ->setDisallow($terminal->getDisallow())
            ->setAllow($terminal->getAllow())
            ->setDirectmediaMethod($terminal->getDirectmediaMethod())
            ->setT38Udptl($terminal->getT38Passthrough())
            ->setOutboundProxy('sip:users.ivozprovider.local^3Blr');

        // Disable direct media for T.38 capable devices
        if ($terminal->getT38Passthrough() === TerminalInterface::T38PASSTHROUGH_YES) {
            $endpointDto->setDirectMedia('no');
        } else {
            $endpointDto->setDirectMedia('yes');
        }

        /** @var PsEndpointInterface $endpoint */
        $endpoint = $this
            ->entityTools
            ->persistDto(
                $endpointDto,
                $endpoint,
                true
            );

        $terminal
            ->setPsEndpoint($endpoint);

        $this->entityTools
            ->persist($terminal);
    }
}
