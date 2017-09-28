<?php

namespace Ivoz\Ast\Domain\Service\PsAor;

use Ivoz\Ast\Domain\Model\PsAor\PsAorRepository;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
use Ivoz\Provider\Domain\Service\Terminal\TerminalLifecycleEventHandlerInterface;
use Ivoz\Ast\Domain\Model\PsAor\PsAor;
use Ivoz\Ast\Domain\Model\PsAor\PsAorInterface;

class UpdateByTerminal implements TerminalLifecycleEventHandlerInterface
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var PsAorRepository
     */
    protected $psAorRepository;

    public function __construct(
        EntityPersisterInterface $entityPersister,
        PsAorRepository $psAorRepository
    ) {
        $this->entityPersister = $entityPersister;
        $this->psAorRepository = $psAorRepository;
    }

    public function execute(TerminalInterface $entity, $isNew)
    {
        $endpoint = $entity->getAstPsEndpoint();

        /**
         * Replicate Terminal into ast_ps_aors
         * @var PsAorInterface $aor
         */
        $aor = $this->psAorRepository->find(
            $endpoint->getId()
        );

        // If not found create a new one
        $aorDTO = is_null($aor)
            ? PsAor::createDTO()
            : $aor->toDTO();

        $aorDTO
            ->setId($entity->getSorcery())
            ->setPsEndpointId($endpoint->getId())
            ->setContact($entity->getContact())
            ->setMaxContacts(1)
            ->setQualifyFrequency(0)
            ->setRemoveExisting('yes');

        $this->entityPersister->persistDto(
            $aorDTO,
            $aor
        );
    }
}