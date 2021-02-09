<?php

namespace Ivoz\Provider\Domain\Service\User;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\User\UserRepository;

class UserFactory
{
    protected $userRepository;
    protected $entityTools;

    public function __construct(
        UserRepository $userRepository,
        EntityTools $entityTools
    ) {
        $this->userRepository = $userRepository;
        $this->entityTools = $entityTools;
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

        if ($user instanceof UserInterface) {
            return $user;
        }

        $userDto = new UserDto();
        $userDto
            ->setCompanyId($companyId)
            ->setName($name)
            ->setLastname($lastName)
            ->setEmail($email)
            ->setActive(false);

        /** @var UserInterface $user */
        $user = $this
            ->entityTools
            ->dtoToEntity(
                $userDto
            );

        return $user;
    }
}
