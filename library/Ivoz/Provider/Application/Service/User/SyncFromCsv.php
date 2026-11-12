<?php

declare(strict_types=1);

namespace Ivoz\Provider\Application\Service\User;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiDto;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionRepository;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\User\UsersMassImportResult;
use Ivoz\Provider\Domain\Service\Ddi\DdiFactory;
use Ivoz\Provider\Domain\Service\Extension\ExtensionFactory;
use Ivoz\Provider\Domain\Service\Terminal\TerminalFactory;
use Ivoz\Provider\Domain\Service\User\CsvRowsParser;
use Ivoz\Provider\Domain\Service\User\CsvStaticValidator;
use Ivoz\Provider\Domain\Service\User\UserFactory;
use Psr\Log\LoggerInterface;

class SyncFromCsv
{
    public function __construct(
        private UserFactory $userFactory,
        private TerminalFactory $terminalFactory,
        private ExtensionFactory $extensionFactory,
        private ExtensionRepository $extensionRepository,
        private DdiFactory $ddiFactory,
        private EntityTools $entityTools,
        private CsvStaticValidator $csvStaticValidator,
        private CsvRowsParser $csvRowsParser,
        private LoggerInterface $logger
    ) {
    }

    public function execute(CompanyInterface $company, string $csv): UsersMassImportResult
    {
        $result = new UsersMassImportResult();

        try {
            $rows = $this->csvRowsParser->parse($csv);
            $this
                ->csvStaticValidator
                ->execute($rows);
        } catch (\DomainException $e) {
            $result->addError(UsersMassImportResult::FILE_LINE, $e->getMessage());

            return $result;
        }

        foreach ($rows as $k => $fields) {
            $line = $k + 1;

            try {
                $this->importRow(
                    $company,
                    $fields,
                    $result
                );
            } catch (\DomainException | \InvalidArgumentException $e) {
                $result->addError($line, $e->getMessage());
            } catch (\Throwable $e) {
                $this->logger->error(
                    sprintf('Users mass import stopped at line %d: %s', $line, $e->getMessage()),
                    ['exception' => $e]
                );
                $result->addError($line, 'Unknown error');
                $this->markRemainingRowsAsNotProcessed($rows, $line, $result);

                return $result;
            }
        }

        return $result;
    }

    /**
     * @param array<int, string[]> $rows
     */
    private function markRemainingRowsAsNotProcessed(
        array $rows,
        int $failedLine,
        UsersMassImportResult $result
    ): void {
        $message = sprintf(
            'Not processed: the import stopped after an unexpected error at line %d',
            $failedLine
        );

        foreach (array_keys($rows) as $k) {
            $line = $k + 1;
            if ($line <= $failedLine) {
                continue;
            }

            $result->addError($line, $message);
        }
    }

    /**
     * @param string[] $fields
     */
    private function importRow(
        CompanyInterface $company,
        array $fields,
        UsersMassImportResult $result
    ): void {
        $companyId = (int) $company->getId();

        [
            $name,
            $lastname,
            $email,
            $terminalName,
            $terminalPassword,
            $terminalModel,
            $mac,
            $extensionNumber,
            $ddiCountry,
            $ddiNumber,
            $ddiProvider
        ] = $fields;

        $user = $this->userFactory->fromMassProvisioningCsv(
            $companyId,
            $name,
            $lastname,
            $email
        );
        $existingUser = $user->getId()
            ? $user
            : null;

        $terminal = $this->buildTerminal(
            $companyId,
            [$terminalName, $terminalPassword, $terminalModel, $mac],
            $existingUser
        );
        $extension = $this->buildExtension($companyId, $extensionNumber, $existingUser);
        $ddi = $this->buildDdi($company, [$ddiCountry, $ddiNumber, $ddiProvider]);
        $newDdi = $this->newDdiOrNull($ddi);

        foreach ([$terminal, $extension, $ddi] as $entity) {
            if ($entity) {
                $this->entityTools->persist($entity, true);
            }
        }

        /** @var UserDto $userDto */
        $userDto = $this->entityTools->entityToDto($user);

        if ($terminal) {
            $userDto->setTerminalId($terminal->getId());
        }

        if ($extension) {
            $userDto->setExtensionId($extension->getId());
        }

        if ($ddi) {
            $userDto->setOutgoingDdiId($ddi->getId());
        }

        /** @var UserInterface $user */
        $user = $this->entityTools->persistDto($userDto, $user, true);

        if ($newDdi) {
            $this->routeDdiToUser($newDdi, $user);
        }

        if ($existingUser) {
            $result->addUpdatedUser();
        } else {
            $result->addCreatedUser();
        }
    }

    /**
     * @param string[] $terminalArgs name, password, model and mac
     * @throws \DomainException
     */
    private function buildTerminal(
        int $companyId,
        array $terminalArgs,
        ?UserInterface $existingUser
    ): ?TerminalInterface {
        $hasTerminalArgs = count(array_filter($terminalArgs)) > 0;
        if (!$hasTerminalArgs) {
            return null;
        }

        [$name, $password, $model, $mac] = $terminalArgs;

        $terminal = $this->terminalFactory->fromMassProvisioningCsv(
            $companyId,
            $name,
            $password,
            $model,
            $mac
        );

        /** @var UserInterface|null $currentUser */
        $currentUser = $terminal->getUser();
        $isAssignedToAnotherUser = $this->isAssignedToAnotherUser($currentUser, $existingUser);
        if ($isAssignedToAnotherUser) {
            throw new \DomainException(
                sprintf(
                    'Terminal %s is already assigned to another user',
                    $terminal->getName()
                )
            );
        }

        return $terminal;
    }

    /**
     * @throws \DomainException
     */
    private function buildExtension(
        int $companyId,
        string $extensionNumber,
        ?UserInterface $existingUser
    ): ?ExtensionInterface {
        if ($extensionNumber === '') {
            return null;
        }

        $currentExtension = $this->extensionRepository->findCompanyExtension(
            $companyId,
            $extensionNumber
        );
        if ($currentExtension) {
            $this->assertExtensionIsAvailable($currentExtension, $existingUser);
        }

        return $this->extensionFactory->fromMassProvisioningCsv(
            $companyId,
            $extensionNumber
        );
    }

    /**
     * @throws \DomainException
     */
    private function assertExtensionIsAvailable(
        ExtensionInterface $extension,
        ?UserInterface $user
    ): void {
        $routeType = $extension->getRouteType();
        if ($routeType === null) {
            return;
        }

        if ($routeType !== ExtensionInterface::ROUTETYPE_USER) {
            throw new \DomainException(
                sprintf(
                    'Extension %s is already routed to a %s',
                    $extension->getNumber(),
                    $routeType
                )
            );
        }

        $currentUser = $extension->getUser();
        if ($this->isAssignedToAnotherUser($currentUser, $user)) {
            throw new \DomainException(
                sprintf(
                    'Extension %s is already assigned to another user',
                    $extension->getNumber()
                )
            );
        }
    }

    private function isAssignedToAnotherUser(
        ?UserInterface $currentUser,
        ?UserInterface $user
    ): bool {
        if (!$currentUser) {
            return false;
        }

        $isSameUser = $user && $currentUser->getId() === $user->getId();

        return !$isSameUser;
    }

    /**
     * @param string[] $ddiArgs country, number and provider
     */
    private function buildDdi(CompanyInterface $company, array $ddiArgs): ?DdiInterface
    {
        $hasDdiArgs = count(array_filter($ddiArgs)) > 0;
        if (!$hasDdiArgs) {
            return null;
        }

        [$country, $number, $provider] = $ddiArgs;

        return $this->ddiFactory->fromMassProvisioningCsv(
            $company,
            $country,
            $number,
            $provider
        );
    }

    private function newDdiOrNull(?DdiInterface $ddi): ?DdiInterface
    {
        if (!$ddi) {
            return null;
        }

        return $ddi->isNew()
            ? $ddi
            : null;
    }

    private function routeDdiToUser(DdiInterface $ddi, UserInterface $user): void
    {
        /** @var DdiDto $ddiDto */
        $ddiDto = $this->entityTools->entityToDto($ddi);
        $ddiDto
            ->setUserId($user->getId())
            ->setRouteType(DdiInterface::ROUTETYPE_USER);

        $this->entityTools->persistDto($ddiDto, $ddi, true);
    }
}
