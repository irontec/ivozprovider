<?php

namespace Tests\Provider\User;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpoint;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;
use Ivoz\Provider\Application\Service\User\SyncFromCsv;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Terminal\Terminal;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
use Ivoz\Provider\Domain\Model\User\UsersMassImportResult;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class SyncFromCsvTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    private const COMPANY_ID = 1;

    private const CSV = "Ada,Imported,ada@import.test,ada_import,Zx9*abc123DEF,YealinkT21P_E2,001565aabb01,2002,,,\n"
        . "Ben,Imported,ben@import.test,ben_import,Zx9*abc123DEF,YealinkT21P_E2,001565aabb02,2003,,,\n";

    /**
     * @test
     */
    public function imported_terminals_get_a_complete_ps_endpoint()
    {
        $result = $this->importCsv();

        $this->assertSame([], $result->getErrors());
        $this->assertSame(2, $result->getCreatedCount());

        $this->assertPsEndpoint('ada_import', 'Ada Imported <2002>', '2002');
        $this->assertPsEndpoint('ben_import', 'Ben Imported <2003>', '2003');
    }

    /**
     * @test
     */
    public function reimported_terminals_keep_a_complete_ps_endpoint()
    {
        $this->importCsv();
        $result = $this->importCsv();

        $this->assertSame([], $result->getErrors());
        $this->assertSame(2, $result->getUpdatedCount());

        $this->assertPsEndpoint('ada_import', 'Ada Imported <2002>', '2002');
        $this->assertPsEndpoint('ben_import', 'Ben Imported <2003>', '2003');
    }

    private function importCsv(): UsersMassImportResult
    {
        /** @var CompanyInterface $company */
        $company = $this->em
            ->getRepository(Company::class)
            ->find(self::COMPANY_ID);

        /** @var SyncFromCsv $syncFromCsv */
        $syncFromCsv = $this->serviceContainer->get(SyncFromCsv::class);
        $result = $syncFromCsv->execute($company, self::CSV);

        $this->em->clear();

        return $result;
    }

    private function assertPsEndpoint(
        string $terminalName,
        string $callerid,
        string $hintExtension
    ): void {
        /** @var TerminalInterface|null $terminal */
        $terminal = $this->em
            ->getRepository(Terminal::class)
            ->findOneByCompanyAndName(self::COMPANY_ID, $terminalName);
        $this->assertInstanceOf(TerminalInterface::class, $terminal);

        /** @var PsEndpointInterface|null $endpoint */
        $endpoint = $this->em
            ->getRepository(PsEndpoint::class)
            ->findOneByTerminalId($terminal->getId());
        $this->assertInstanceOf(PsEndpointInterface::class, $endpoint);

        $this->assertSame($callerid, $endpoint->getCallerid());
        $this->assertSame($hintExtension, $endpoint->getHintExtension());
        $this->assertNotEmpty($endpoint->getMailboxes());
    }
}
