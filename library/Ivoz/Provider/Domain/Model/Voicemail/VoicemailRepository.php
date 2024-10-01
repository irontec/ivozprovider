<?php

namespace Ivoz\Provider\Domain\Model\Voicemail;

use Doctrine\Common\Collections\Selectable;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ObjectRepository;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\VoicemailMessage\VoicemailMessageInterface;

interface VoicemailRepository extends ObjectRepository, Selectable
{
    /**
     * @param UserInterface $user
     * @return VoicemailInterface[]
     */
    public function getAvailableVoicemailsForUser(UserInterface $user): array;

    /**
     * @return VoicemailInterface[]
     */
    public function getVoicemailsByUser(UserInterface $user): array;

    /**
     * @return array<int|null>
     */
    public function getVoicemailsIdsByUser(UserInterface $user): array;

    /**
     * @param array<string, mixed> $criteria
     */
    public function count(array $criteria): int;

    /**
     * @return   int[]
     */
    public function getGenericVoicemailIds(): array;

    /**
     * @return QueryBuilder
     */
    public function prepareAndJoinByUser(UserInterface $user): QueryBuilder;
}
