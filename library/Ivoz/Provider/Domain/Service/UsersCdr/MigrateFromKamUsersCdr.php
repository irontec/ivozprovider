<?php

namespace Ivoz\Provider\Domain\Service\UsersCdr;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Kam\Domain\Model\UsersCdr\UsersCdrInterface as KamUsersCdrInterface;
use Ivoz\Kam\Domain\Service\UsersCdr\SetParsed;
use Ivoz\Provider\Domain\Model\UsersCdr\UsersCdrDto;
use Ivoz\Provider\Domain\Model\UsersCdr\UsersCdrInterface;
use Ivoz\Provider\Domain\Model\UsersCdr\UsersCdrRepository as ProviderUsersCdrRepository;

class MigrateFromKamUsersCdr
{
    public function __construct(
        private ProviderUsersCdrRepository $providerUsersCdrRepository,
        private SetParsed $setParsed,
        private EntityTools $entityTools
    ) {
    }

    public function execute(KamUsersCdrInterface $kamUsersCdr, bool $dispatchImmediately = false): void
    {
        $providerUserCdr = $this->providerUsersCdrRepository->findByKamUsersCdrId(
            (int) $kamUsersCdr->getId()
        );

        /** @var UsersCdrDto $providerUserCdrDto */
        $providerUserCdrDto = $providerUserCdr
            ? $this->entityTools->entityToDto($providerUserCdr)
            : new UsersCdrDto();

        $this->updateDtoByKamUsersCdr(
            $providerUserCdrDto,
            $kamUsersCdr
        );

        $this->entityTools->persistDto(
            $providerUserCdrDto,
            $providerUserCdr
        );

        $this->setParsed->execute(
            $kamUsersCdr
        );
    }

    public function updateDtoByKamUsersCdr(UsersCdrDto $providerUserCdrDto, KamUsersCdrInterface $kamUsersCdr): void
    {
        $providerUserCdrDto
            ->setStartTime(
                $kamUsersCdr->getStartTime()
            )->setDuration(
                ceil($kamUsersCdr->getDuration())
            )->setDirection(
                $kamUsersCdr->getDirection()
            )->setCaller(
                $kamUsersCdr->getCaller()
            )->setCallee(
                $kamUsersCdr->getCallee()
            )->setCallid(
                $kamUsersCdr->getCallid()
            )->setBrandId(
                $kamUsersCdr->getBrand()?->getId()
            )->setCompanyId(
                $kamUsersCdr->getCompany()?->getId()
            )->setUserId(
                $kamUsersCdr->getUser()?->getId()
            )->setFriendId(
                $kamUsersCdr->getFriend()?->getId()
            )->setKamUsersCdrId(
                $kamUsersCdr->getId()
            )->setOwner(
                $this->getOwner(
                    $kamUsersCdr
                )
            )->setDisposition(
                $this->getDisposition(
                    $kamUsersCdr
                )
            );

        $user = $kamUsersCdr->getUser();
        if ($user) {
            $providerUserCdrDto->setExtensionId(
                $user->getExtension()?->getId()
            );
        }
    }

    private function getDisposition(KamUsersCdrInterface $kamUsersCdr): string
    {
        return match ($kamUsersCdr->getResponseCode()) {
            '200' => UsersCdrInterface::DISPOSITION_ANSWERED,
            '480', '486' => UsersCdrInterface::DISPOSITION_BUSY,
            '500' => UsersCdrInterface::DISPOSITION_ERROR,
            default => UsersCdrInterface::DISPOSITION_MISSED,
        };
    }

    private function getOwner(
        KamUsersCdrInterface $kamUsersCdr,
    ): ?string {
        $user = $kamUsersCdr->getUser();
        $friend = $kamUsersCdr->getFriend();
        if ($friend) {
            return $friend->getName();
        } elseif ($user) {
            $owner = sprintf(
                '%s %s',
                $user->getName(),
                $user->getLastname()
            );

            return $owner;
        }

        return null;
    }
}
