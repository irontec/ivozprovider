<?php

namespace Ivoz\Provider\Domain\Assembler\Voicemail;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailDto;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;
use Ivoz\Provider\Domain\Model\VoicemailRelUser\VoicemailRelUser;
use Ivoz\Provider\Domain\Model\VoicemailRelUser\VoicemailRelUserInterface;

class VoicemailDtoAssembler implements CustomDtoAssemblerInterface
{
    /**
     * @param VoicemailInterface $entity
     * @throws \Exception
     */
    public function toDto(EntityInterface $entity, int $depth = 0, string $context = null): DataTransferObjectInterface
    {
        Assertion::isInstanceOf($entity, VoicemailInterface::class);

        $dto = $entity->toDto($depth);

        if (in_array($context, VoicemailDto::CONTEXTS_WITH_REL_USERS, true)) {
            /** @var array<int> $userIds */
            $userIds = array_map(
                function (VoicemailRelUserInterface $voicemailRelUser) {
                    return $voicemailRelUser
                        ->getUser()
                        ->getId();
                },
                $entity->getVoicemailRelUsers()
            );

            if ($userIds) {
                $dto->setRelUserIds($userIds);
            }
        }

        return $dto;
    }
}
