<?php declare(strict_types=1);

namespace Ivoz\Provider\Application\Service\User;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Ivoz\Provider\Domain\Service\Ddi\DdiFactory;
use Ivoz\Provider\Domain\Service\Extension\ExtensionFactory;
use Ivoz\Provider\Domain\Service\Terminal\TerminalFactory;
use Ivoz\Provider\Domain\Service\User\UserFactory;

class SyncFromCsv
{
    private $companyRepository;
    private $userFactory;
    private $terminalFactory;
    private $extensionFactory;
    private $ddiFactory;
    private $entityTools;
    private $csvStaticValidator;

    public function __construct(
        CompanyRepository $companyRepository,
        UserFactory $userFactory,
        TerminalFactory $terminalFactory,
        ExtensionFactory $extensionFactory,
        DdiFactory $ddiFactory,
        EntityTools $entityTools,
        CsvStaticValidator $csvStaticValidator
    ) {
        $this->companyRepository = $companyRepository;
        $this->userFactory = $userFactory;
        $this->terminalFactory = $terminalFactory;
        $this->extensionFactory = $extensionFactory;
        $this->ddiFactory = $ddiFactory;
        $this->entityTools = $entityTools;
        $this->csvStaticValidator = $csvStaticValidator;
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
                count($rows)
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
                    $company->getId(),
                    ...$userArgs
                );
                $entities = [$user];

                $notEmptyTerminalArgs = count(array_filter($terminalArgs)) > 0;
                if ($notEmptyTerminalArgs) {
                    $terminal = $this->terminalFactory->fromMassProvisioningCsv(
                        $company->getId(),
                        ...$terminalArgs
                    );

                    $entities[] = $terminal;
                }

                if ($extensionArg) {
                    $extension = $this->extensionFactory->fromMassProvisioningCsv(
                        $company->getId(),
                        $extensionArg,
                        $user
                    );

                    $entities[] = $extension;
                }

                $notEmptyDdiArgs = count(array_filter($outboundDdiArgs)) > 0;
                if ($notEmptyDdiArgs) {
                    $ddi = $this->ddiFactory->fromMassProvisioningCsv(
                        $company,
                        ...$outboundDdiArgs
                    );

                    if ($ddi->isNew()) {
                        $user->setOutgoingDdi($ddi);
                    }

                    $entities[] = $ddi;
                }

                $user
                    ->setTerminal($terminal ?? null)
                    ->setExtension($extension ?? null)
                    ->setOutgoingDdi($ddi ?? null);

                $this->entityTools->persistFromArray(
                    $entities
                );
            } catch (\Exception $e) {
                $errors[$k+1] = $e->getMessage();
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
