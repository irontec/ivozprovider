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
     * @throws \Exception
     */
    public function fromMassProvisioningCsv(
        int $companyId,
        string $name,
        string $lastName,
        string $email = null
    ): UserInterface {

        $user = $this
            ->userRepository
            ->findOneByCompanyAndName(
                $companyId,
                $name,
                $lastName
            );

        if (!$user && $email) {
            $user = $this
                ->userRepository
                ->findOneByEmail(
                    $email
                );
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
            ->setEmail($email)
            ->setActive($active);

        /** @var UserInterface $user */
        $user = $this
            ->entityTools
            ->dtoToEntity(
                $userDto,
                $user
            );

        return $user;
    }
}
