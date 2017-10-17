<?php

namespace Ivoz\Ast\Domain\Service\PsAor;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Ast\Domain\Model\PsAor\PsAorRepository;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointRepository;
use Ivoz\Ast\Domain\Model\PsAor\PsAor;
use Ivoz\Ast\Domain\Model\PsAor\PsAorInterface;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;
use Ivoz\Provider\Domain\Service\RetailAccount\RetailAccountLifecycleEventHandlerInterface;

class UpdateByRetailAccount implements RetailAccountLifecycleEventHandlerInterface
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var PsAorRepository
     */
    protected $psAorRepository;

    /**
     * @varPsEndpointRepository
     */
    protected $psEndpointRepository;

    public function __construct(
        EntityPersisterInterface $entityPersister,
        PsAorRepository $psAorRepository,
        PsEndpointRepository $psEndpointRepository
    ) {
        $this->entityPersister = $entityPersister;
        $this->psAorRepository = $psAorRepository;
        $this->psEndpointRepository = $psEndpointRepository;
    }

    /**
     * @param RetailAccountInterface $entity
     */
    public function execute(RetailAccountInterface $entity, $isNew)
    {

        /**
         * @var PsEndpointInterface $endpoint
         */
        $endpoint = $this->psEndpointRepository->findOneBy([
            'retailAccount' => $entity->getId()
        ]);

        /**
         * @var PsAorInterface $aor
         */
        $aor = $this->psAorRepository->find(
            $endpoint->getSorceryId()
        );

        $aorDTO = is_null($aor)
            ? PsAor::createDTO()
            : $aor->toDTO();

        $aorDTO
            ->setId($endpoint->getSorceryId())
            ->setPsEndpointId($endpoint->getId())
            ->setContact($entity->getContact())
            ->setMaxContacts(1)
            ->setQualifyFrequency(0)
            ->setRemoveExisting('yes');

        $this->entityPersister->persistDto($aorDTO, $aor);
    }
}