<?php

namespace Ivoz\Provider\Domain\Service\User;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\User\UserRepository;

class UserFactory
{
    public function __construct(
        private UserRepository $userRepository,
        private EntityTools $entityTools
    ) {
    }

    /**
     * @throws \DomainException
     */
    public function fromMassProvisioningCsv(
        int $companyId,
        string $name,
        string $lastName,
        ?string $email = null
    ): UserInterface {

        $user = $this
            ->userRepository
            ->findOneByCompanyAndName(
                $companyId,
                $name,
                $lastName
            );

        $emailOwner = $email
            ? $this->userRepository->findOneByEmail($email)
            : null;

        $isEmailTaken = $email && $emailOwner;
        if ($isEmailTaken) {
            $user = $this->matchEmailOwner($emailOwner, $user, $companyId, $email);
        }

        /** @var UserDto $userDto */
        $userDto = $user instanceof UserInterface
            ? $this->entityTools->entityToDto($user)
            : new UserDto();

        $active = $user instanceof UserInterface && $user->getActive();

        $userDto
            ->setCompanyId($companyId)
            ->setName($name)
            ->setLastname($lastName)
            ->setActive($active);

        if ($email) {
            $userDto->setEmail($email);
        }

        /** @var UserInterface $user */
        $user = $this
            ->entityTools
            ->dtoToEntity(
                $userDto,
                $user
            );

        return $user;
    }

    /**
     * @throws \DomainException
     */
    private function matchEmailOwner(
        UserInterface $emailOwner,
        ?UserInterface $user,
        int $companyId,
        string $email
    ): UserInterface {
        $belongsToAnotherClient = $emailOwner->getCompany()->getId() !== $companyId;
        if ($belongsToAnotherClient) {
            throw new \DomainException(
                sprintf('Email %s belongs to a user of another client', $email)
            );
        }

        if (!$user) {
            return $emailOwner;
        }

        $isOwnEmail = $emailOwner->getId() === $user->getId();
        if ($isOwnEmail) {
            return $user;
        }

        throw new \DomainException(
            sprintf('Email %s is already used by another user', $email)
        );
    }
}
