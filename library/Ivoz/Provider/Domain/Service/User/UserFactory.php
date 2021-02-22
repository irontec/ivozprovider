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

        if (!$user && $email) {
            $user = $this
                ->userRepository
                ->findOneByEmail(
                    $email
                );
        }

        $userDto = $user instanceof UserInterface
            ? $this->entityTools->entityToDto($user)
            : new UserDto();

        $active = $user instanceof UserInterface
            ? $user->getActive()
            : false;

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
