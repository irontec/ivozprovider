<?php

namespace Ivoz\Provider\Domain\Service\User;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\User\UserRepository;
use Ivoz\Provider\Domain\Service\Company\CompanyLifecycleEventHandlerInterface;

class UpdateByCompany implements CompanyLifecycleEventHandlerInterface
{
    const POST_PERSIST_PRIORTY = self::PRIORITY_NORMAL;

    public function __construct(
        private UserRepository $userRepository,
    ) {
    }

    /**
     * @return array<string,int>
     */
    public static function getSubscribedEvents(): array
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORTY,
        ];
    }

    public function execute(CompanyInterface $company): void
    {
        $companyId = $company->getId();

        if (is_null($companyId)) {
            return;
        }

        $companyUsers = $this
            ->userRepository
            ->findByCompanyUsingDefaultLocation(
                $companyId,
            );

        $companyLocationId = $company->getLocation()?->getId();

        foreach ($companyUsers as $user) {
            $dto = $user->toDto();
            $dto->setLocationId(
                $companyLocationId,
            );

            $this
            ->userRepository
            ->persistDto(
                $dto,
                $user,
                true,
            );
        }
    }
}
