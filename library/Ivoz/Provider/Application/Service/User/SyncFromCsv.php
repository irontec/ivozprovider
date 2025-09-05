<?php

declare(strict_types=1);

namespace Ivoz\Provider\Application\Service\User;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Service\Ddi\DdiFactory;
use Ivoz\Provider\Domain\Service\Extension\ExtensionFactory;
use Ivoz\Provider\Domain\Service\Terminal\TerminalFactory;
use Ivoz\Provider\Domain\Service\User\CsvStaticValidator;
use Ivoz\Provider\Domain\Service\User\UserFactory;
use Ivoz\Ast\Domain\Service\PsEndpoint\UpdateByUser;

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
     *
     * @return void
     */
    public function execute(CompanyInterface $company, string $csv)
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
            $userArgs = array_splice($fields, 0, 3);
            $terminalArgs = array_splice($fields, 0, 4);
            $extensionArg = array_shift($fields);
            $outboundDdiArgs = $fields;

            try {
                $user = $this->userFactory->fromMassProvisioningCsv(
                    (int) $company->getId(),
                    ...$userArgs
                );

                $terminal = null;
                $notEmptyTerminalArgs = count(array_filter($terminalArgs)) > 0;
                if ($notEmptyTerminalArgs) {
                    $terminal = $this->terminalFactory->fromMassProvisioningCsv(
                        (int) $company->getId(),
                        ...$terminalArgs
                    );
                }

                $extension = null;
                if ($extensionArg) {
                    $extension = $this->extensionFactory->fromMassProvisioningCsv(
                        (int) $company->getId(),
                        $extensionArg,
                        null
                    );
                }

                $ddi = null;
                $notEmptyDdiArgs = count(array_filter($outboundDdiArgs)) > 0;
                if ($notEmptyDdiArgs) {
                    $ddi = $this->ddiFactory->fromMassProvisioningCsv(
                        $company,
                        ...$outboundDdiArgs
                    );
                }

                if ($terminal !== null) {
                    $this->entityTools->persist($terminal);
                }

                if ($extension !== null) {
                    $this->entityTools->persist($extension);
                }

                if ($ddi !== null && $ddi->isNew()) {
                    /** @var \Ivoz\Provider\Domain\Model\Ddi\DdiDto $ddiDto */
                    $ddiDto = $this->entityTools->entityToDto($ddi);
                    $ddiDto->setRouteType(DdiInterface::ROUTETYPE_USER);
                    $this->entityTools->persistDto($ddiDto, $ddi, false);
                } elseif ($ddi !== null) {
                    $this->entityTools->persist($ddi);
                }

                /** @var \Ivoz\Provider\Domain\Model\User\UserDto $userDto */
                $userDto = $this->entityTools->entityToDto($user);

                if ($terminal !== null) {
                    /** @var \Ivoz\Provider\Domain\Model\Terminal\TerminalDto $terminalDto */
                    $terminalDto = $this->entityTools->entityToDto($terminal);
                    $userDto->setTerminal($terminalDto);
                }

                if ($extension !== null) {
                    /** @var \Ivoz\Provider\Domain\Model\Extension\ExtensionDto $extensionDto */
                    $extensionDto = $this->entityTools->entityToDto($extension);
                    $userDto->setExtension($extensionDto);
                }

                if ($ddi !== null) {
                    /** @var \Ivoz\Provider\Domain\Model\Ddi\DdiDto $ddiDto */
                    $ddiDto = $this->entityTools->entityToDto($ddi);
                    $userDto->setOutgoingDdi($ddiDto);
                }

                $this->entityTools->persistDto(
                    $userDto,
                    $user,
                    false
                );
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
