<?php

namespace Ivoz\Ast\Domain\Service\PsEndpoint;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointDto;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointRepository;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Friend\Friend;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
use Ivoz\Provider\Domain\Service\Terminal\TerminalLifecycleEventHandlerInterface;

class UpdateByTerminal implements TerminalLifecycleEventHandlerInterface
{
    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var PsEndpointRepository
     */
    protected $psEndpointRepository;

    public function __construct(
        EntityTools $entityTools,
        PsEndpointRepository $psEndpointRepository
    ) {
        $this->entityTools = $entityTools;
        $this->psEndpointRepository = $psEndpointRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 10
        ];
    }

    /**
     * @param Friend $terminal
     */
    public function execute(TerminalInterface $terminal)
    {
        // Replicate Terminal into ast_ps_endpoint
        /**
         * @var PsEndpointInterface $endpoint
         */
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
            ->setOutboundProxy('sip:users.ivozprovider.local^3Blr');

        $endpoint = $this
            ->entityTools
            ->persistDto(
                $endpointDto,
                $endpoint,
                true
            );

        $terminal
            ->addAstPsEndpoint($endpoint);

        $this->entityTools
            ->persist($terminal);
    }
}
