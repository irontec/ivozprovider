<?php

namespace Ivoz\Ast\Domain\Service\PsAor;

use Ivoz\Ast\Domain\Model\PsAor\PsAorDTO;
use Ivoz\Ast\Domain\Model\PsAor\PsAorRepository;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpoint;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointRepository;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Service\Friend\FriendLifecycleEventHandlerInterface;

class UpdateByFriend implements FriendLifecycleEventHandlerInterface
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var PsEndpointRepository
     */
    protected $psEndpointRepository;

    /**
     * @var PsAorRepository
     */
    protected $psAorRepository;

    public function __construct(
        EntityPersisterInterface $entityPersister,
        PsEndpointRepository $psEndpointRepository,
        PsAorRepository $psAorRepository
    ) {
        $this->entityPersister = $entityPersister;
        $this->psEndpointRepository = $psEndpointRepository;
        $this->psAorRepository = $psAorRepository;
    }

    public function execute(FriendInterface $entity, $isNew)
    {
        // Replicate Terminal into ast_ps_endpoint
        /**
         * @var PsEndpoint $endpoint
         */
        $endpoint = $this->psEndpointRepository->findOneBy([
            'friend' => $entity->getId()
        ]);

        if (is_null($endpoint)) {
            throw new \Exception('Endpoint not found');
        }
        $aor = $this->psAorRepository->findOneBy([
            "psEndpoint" => $endpoint->getId()
        ]);

        if (is_null($aor)) {
            $aorDto = new PsAorDTO();
        } else {
            $aorDto = $aor->toDto();
        }

        $aorDto
            ->setId($entity->getSorcery())
            ->setPsEndpointId($endpoint->getId())
            ->setContact($entity->getContact())
            ->setMaxContacts(1)
            ->setQualifyFrequency(0)
            ->setRemoveExisting('yes');

        $this->entityPersister->persistDto($aorDto, $aor);
    }
}