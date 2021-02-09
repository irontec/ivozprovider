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

    public function __construct(
        CompanyRepository $companyRepository,
        UserFactory $userFactory,
        TerminalFactory $terminalFactory,
        ExtensionFactory $extensionFactory,
        DdiFactory $ddiFactory,
        EntityTools $entityTools
    ) {
        $this->companyRepository = $companyRepository;
        $this->userFactory = $userFactory;
        $this->terminalFactory = $terminalFactory;
        $this->extensionFactory = $extensionFactory;
        $this->ddiFactory = $ddiFactory;
        $this->entityTools = $entityTools;
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

        $errors = [];
        foreach ($rows as $k => $row) {
            $fields = str_getcsv(trim($row));
            if (count($fields) < 11) {
                $errors[$k+1] = 'Missing columns';
                continue;
            }

            $userArgs = array_splice($fields, 0, 3);
            $terminalArgs = array_splice($fields, 0, 4);
            $extensionArg = array_shift($fields);
            $outboundDdiArgs = $fields;

            try {
                $user = $this->userFactory->fromMassProvisioningCsv(
                    $company->getId(),
                    ...$userArgs
                );

                $terminal = $this->terminalFactory->fromMassProvisioningCsv(
                    $company->getId(),
                    ...$terminalArgs
                );

                $entities = [
                    $user,
                    $terminal
                ];

                if ($extensionArg) {
                    $extension = $this->extensionFactory->fromMassProvisioningCsv(
                        $company->getId(),
                        $extensionArg,
                        $user
                    );

                    $entities[] = $extension;
                }

                $ddi = $this->ddiFactory->fromMassProvisioningCsv(
                    $company,
                    ...$outboundDdiArgs
                );
                $entities[] = $ddi;

                $user
                    ->setTerminal($terminal)
                    ->setExtension($extension ?? null)
                    ->setOutgoingDdi($ddi);

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
