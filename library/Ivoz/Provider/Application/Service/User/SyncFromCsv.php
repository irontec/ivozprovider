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
                $entities = [$user];

                $missingTerminalArgs = count($terminalArgs) !== 4;
                $terminal = $missingTerminalArgs
                    ? null
                    : $this->terminalFactory->fromMassProvisioningCsv(
                        (int) $company->getId(),
                        ...$terminalArgs
                    );
                if ($terminal) {
                    $entities[] = $terminal;
                }

                $extension = $extensionArg
                    ? $this->extensionFactory->fromMassProvisioningCsv(
                        (int) $company->getId(),
                        $extensionArg,
                        $user
                    )
                    : null;
                if ($extension) {
                    $entities[] = $extension;
                }

                $missingDdiArgs = count($outboundDdiArgs) !== 3;
                $ddi = $missingDdiArgs
                    ? null
                    : $this->ddiFactory->fromMassProvisioningCsv(
                        $company,
                        ...$outboundDdiArgs
                    );
                if ($ddi?->isNew()) {
                    $ddi->setUser($user);
                    $ddi->setRouteType(DdiInterface::ROUTETYPE_USER);
                }
                if ($ddi) {
                    $entities[] = $ddi;
                }

                $user
                    ->setTerminal($terminal)
                    ->setExtension($extension);

                if ($ddi?->isNew()) {
                    $user->setOutgoingDdi($ddi);
                }

                $this->entityTools->persistFromArray(
                    $entities
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
