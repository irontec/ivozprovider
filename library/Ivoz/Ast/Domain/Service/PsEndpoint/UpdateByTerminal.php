<?php

namespace Ivoz\Ast\Domain\Service\PsEndpoint;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointDto;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointRepository;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Friend\Friend;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
use Ivoz\Provider\Domain\Service\Terminal\TerminalLifecycleEventHandlerInterface;

class UpdateByTerminal implements TerminalLifecycleEventHandlerInterface
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var PsEndpointRepository
     */
    protected $psEndpointRepository;

    public function __construct(
        EntityPersisterInterface $entityPersister,
        PsEndpointRepository $psEndpointRepository
    ) {
        $this->entityPersister = $entityPersister;
        $this->psEndpointRepository = $psEndpointRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 10
        ];
    }

    /**
     * @param Friend $entity
     */
    public function execute(TerminalInterface $entity, $isNew)
    {
        // Replicate Terminal into ast_ps_endpoint
        /**
         * @var PsEndpointInterface $endpoint
         */
        $endpoint = $this->psEndpointRepository->findOneBy([
            'terminal' => $entity->getId()
        ]);

        if (is_null($endpoint)) {
            $endpointDto = new PsEndpointDto();
            $endpointDto
                ->setContext('users')
                ->setSendDiversion('yes')
                ->setSendPai('yes');
        } else {
            $endpointDto = $endpoint->toDto();
        }

        // Update/Insert endpoint data
        $endpointDto
            ->setTerminalId($entity->getId())
            ->setSorceryId($entity->getSorcery())
            ->setFromDomain($entity->getCompany()->getDomainUsers())
            ->setAors($entity->getSorcery())
            ->setDisallow($entity->getDisallow())
            ->setAllow($entity->getAllow())
            ->setDirectmediaMethod($entity->getDirectmediaMethod())
            ->setOutboundProxy('sip:users.ivozprovider.local^3Blr');

        $endpoint = $this
            ->entityPersister
            ->persistDto(
                $endpointDto,
                $endpoint,
                true
            );

        $entity->addAstPsEndpoint($endpoint);
    }
}