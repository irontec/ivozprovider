<?php

declare(strict_types=1);

namespace Ivoz\Provider\Application\Service\User;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointDto;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiDto;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionDto;
use Ivoz\Provider\Domain\Model\Terminal\TerminalDto;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Service\Ddi\DdiFactory;
use Ivoz\Provider\Domain\Service\Extension\ExtensionFactory;
use Ivoz\Provider\Domain\Service\Terminal\TerminalFactory;
use Ivoz\Provider\Domain\Service\User\CsvStaticValidator;
use Ivoz\Provider\Domain\Service\User\UserFactory;

class SyncFromCsv
{
    public function __construct(
        private UserFactory $userFactory,
        private TerminalFactory $terminalFactory,
        private ExtensionFactory $extensionFactory,
        private DdiFactory $ddiFactory,
        private EntityTools $entityTools,
        private CsvStaticValidator $csvStaticValidator
    ) {
    }

    /**
     * @throws \Exception
     */
    public function execute(CompanyInterface $company, string $csv): void
    {
        $rows = explode(
            PHP_EOL,
            trim($csv)
        );

        foreach ($rows as $k => $row) {
            if (trim($row) == '') {
                unset($rows[$k]);
                continue;
            }

            $rows[$k] = str_getcsv(trim($row));
        }

        try {
            $this
                ->csvStaticValidator
                ->execute($rows);
        } catch (\Exception $e) {
            throw new \DomainException(
                $e->getMessage(),
                count($rows),
                $e
            );
        }

        $errors = [];
        foreach ($rows as $k => $fields) {
            /** @var array<string> $userArgs */
            $userArgs = array_pad(
                array_splice($fields, 0, 3),
                3,
                '',
            );
            /** @var array<string> $terminalArgs */
            $terminalArgs = array_pad(
                array_splice($fields, 0, 4),
                4,
                '',
            );
            $extensionArg = array_shift($fields);
            /** @var array<string> $outboundDdiArgs */
            $outboundDdiArgs = array_pad((array) $fields, 2, '');

            try {
                $user = $this->userFactory->fromMassProvisioningCsv(
                    companyId: (int) $company->getId(),
                    name: $userArgs[0],
                    lastName: $userArgs[1],
                    email: $userArgs[2],
                );

                /** @var UserDto $userDto */
                $userDto = $this->entityTools->entityToDto($user);

                $hasAllTerminalArgs = !empty($terminalArgs[0]) && !empty($terminalArgs[1]);
                if ($hasAllTerminalArgs) {
                    $terminal = $this->terminalFactory->fromMassProvisioningCsv(
                        companyId: (int) $company->getId(),
                        name: $terminalArgs[0],
                        password: $terminalArgs[1],
                        model: $terminalArgs[2],
                        mac: $terminalArgs[3],
                    );

                    /** @var TerminalDto $terminalDto */
                    $terminalDto = $this->entityTools->entityToDto($terminal);
                    $userDto->setTerminal($terminalDto);
                }

                if ($extensionArg) {
                    $extension = $this->extensionFactory->fromMassProvisioningCsv(
                        companyId:(int) $company->getId(),
                        extensionNumber: $extensionArg,
                    );

                    /** @var ExtensionDto $extensionDto */
                    $extensionDto = $this->entityTools->entityToDto($extension);
                    $userDto->setExtension($extensionDto);
                }

                $hasAllDdiArgs = !empty($outboundDdiArgs[1]);
                if ($hasAllDdiArgs) {
                    $ddi = $this->ddiFactory->fromMassProvisioningCsv(
                        $company,
                        countryCode: $outboundDdiArgs[0],
                        ddiNumber: $outboundDdiArgs[1],
                        ddiProviderName: $outboundDdiArgs[2]
                    );

                    /** @var DdiDto $ddiDto */
                    $ddiDto = $this->entityTools->entityToDto($ddi);
                    $ddiDto->setRouteType(DdiInterface::ROUTETYPE_USER);
                    $userDto->setOutgoingDdi($ddiDto);
                }

                /** @var UserInterface $persistedUser */
                $persistedUser = $this->entityTools->persistDto(
                    $userDto,
                    $user,
                );

                $endpoint = $persistedUser->getEndpoint();
                if (!$endpoint) {
                    continue;
                }

                $extensionNumber = $persistedUser->getExtensionNumber();
                if (!$extensionNumber) {
                    continue;
                }
            } catch (\Exception $e) {
                $errors[$k + 1] = $e->getMessage();
                continue;
            }
        }

        if (count($errors) > 0) {
            $errorMsgs = [];
            foreach ($errors as $key => $val) {
                $errorMsgs[] = $key . ' => ' . $val;
            }
            $errorMsg = implode("\n", $errorMsgs);
            throw new \Exception(
                $errorMsg,
                count($errors)
            );
        }
    }
}
